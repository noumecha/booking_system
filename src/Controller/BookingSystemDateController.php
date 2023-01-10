<?php

namespace Drupal\booking_system\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\booking_system\Entity\BookingSystemDateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BookingSystemDateController.
 *
 *  Returns responses for Booking system date routes.
 */
class BookingSystemDateController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Displays a Booking system date revision.
   *
   * @param int $booking_system_date_revision
   *   The Booking system date revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($booking_system_date_revision) {
    $booking_system_date = $this->entityTypeManager()->getStorage('booking_system_date')
      ->loadRevision($booking_system_date_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('booking_system_date');

    return $view_builder->view($booking_system_date);
  }

  /**
   * Page title callback for a Booking system date revision.
   *
   * @param int $booking_system_date_revision
   *   The Booking system date revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($booking_system_date_revision) {
    $booking_system_date = $this->entityTypeManager()->getStorage('booking_system_date')
      ->loadRevision($booking_system_date_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $booking_system_date->label(),
      '%date' => $this->dateFormatter->format($booking_system_date->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Booking system date.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemDateInterface $booking_system_date
   *   A Booking system date object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(BookingSystemDateInterface $booking_system_date) {
    $account = $this->currentUser();
    $booking_system_date_storage = $this->entityTypeManager()->getStorage('booking_system_date');

    $langcode = $booking_system_date->language()->getId();
    $langname = $booking_system_date->language()->getName();
    $languages = $booking_system_date->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $booking_system_date->label()]) : $this->t('Revisions for %title', ['%title' => $booking_system_date->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all booking system date revisions") || $account->hasPermission('administer booking system date entities')));
    $delete_permission = (($account->hasPermission("delete all booking system date revisions") || $account->hasPermission('administer booking system date entities')));

    $rows = [];

    $vids = $booking_system_date_storage->revisionIds($booking_system_date);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\booking_system\Entity\BookingSystemDateInterface $revision */
      $revision = $booking_system_date_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $booking_system_date->getRevisionId()) {
          $link = Link::fromTextAndUrl($date, new Url('entity.booking_system_date.revision', [
            'booking_system_date' => $booking_system_date->id(),
            'booking_system_date_revision' => $vid,
          ]))->toString();
        }
        else {
          $link = $booking_system_date->toLink($date)->toString();
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.booking_system_date.translation_revert', [
                'booking_system_date' => $booking_system_date->id(),
                'booking_system_date_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.booking_system_date.revision_revert', [
                'booking_system_date' => $booking_system_date->id(),
                'booking_system_date_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.booking_system_date.revision_delete', [
                'booking_system_date' => $booking_system_date->id(),
                'booking_system_date_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['booking_system_date_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
