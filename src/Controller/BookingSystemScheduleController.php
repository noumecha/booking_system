<?php

namespace Drupal\booking_system\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\booking_system\Entity\BookingSystemScheduleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BookingSystemScheduleController.
 *
 *  Returns responses for Booking system schedule routes.
 */
class BookingSystemScheduleController extends ControllerBase implements ContainerInjectionInterface {

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
   * Displays a Booking system schedule revision.
   *
   * @param int $booking_system_schedule_revision
   *   The Booking system schedule revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($booking_system_schedule_revision) {
    $booking_system_schedule = $this->entityTypeManager()->getStorage('booking_system_schedule')
      ->loadRevision($booking_system_schedule_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('booking_system_schedule');

    return $view_builder->view($booking_system_schedule);
  }

  /**
   * Page title callback for a Booking system schedule revision.
   *
   * @param int $booking_system_schedule_revision
   *   The Booking system schedule revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($booking_system_schedule_revision) {
    $booking_system_schedule = $this->entityTypeManager()->getStorage('booking_system_schedule')
      ->loadRevision($booking_system_schedule_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $booking_system_schedule->label(),
      '%date' => $this->dateFormatter->format($booking_system_schedule->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Booking system schedule.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemScheduleInterface $booking_system_schedule
   *   A Booking system schedule object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(BookingSystemScheduleInterface $booking_system_schedule) {
    $account = $this->currentUser();
    $booking_system_schedule_storage = $this->entityTypeManager()->getStorage('booking_system_schedule');

    $langcode = $booking_system_schedule->language()->getId();
    $langname = $booking_system_schedule->language()->getName();
    $languages = $booking_system_schedule->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $booking_system_schedule->label()]) : $this->t('Revisions for %title', ['%title' => $booking_system_schedule->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all booking system schedule revisions") || $account->hasPermission('administer booking system schedule entities')));
    $delete_permission = (($account->hasPermission("delete all booking system schedule revisions") || $account->hasPermission('administer booking system schedule entities')));

    $rows = [];

    $vids = $booking_system_schedule_storage->revisionIds($booking_system_schedule);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\booking_system\Entity\BookingSystemScheduleInterface $revision */
      $revision = $booking_system_schedule_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $booking_system_schedule->getRevisionId()) {
          $link = Link::fromTextAndUrl($date, new Url('entity.booking_system_schedule.revision', [
            'booking_system_schedule' => $booking_system_schedule->id(),
            'booking_system_schedule_revision' => $vid,
          ]))->toString();
        }
        else {
          $link = $booking_system_schedule->toLink($date)->toString();
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
              Url::fromRoute('entity.booking_system_schedule.translation_revert', [
                'booking_system_schedule' => $booking_system_schedule->id(),
                'booking_system_schedule_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.booking_system_schedule.revision_revert', [
                'booking_system_schedule' => $booking_system_schedule->id(),
                'booking_system_schedule_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.booking_system_schedule.revision_delete', [
                'booking_system_schedule' => $booking_system_schedule->id(),
                'booking_system_schedule_revision' => $vid,
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

    $build['booking_system_schedule_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
