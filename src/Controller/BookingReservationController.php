<?php

namespace Drupal\booking_system\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\booking_system\Entity\BookingReservationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BookingReservationController.
 *
 *  Returns responses for Booking reservation routes.
 */
class BookingReservationController extends ControllerBase implements ContainerInjectionInterface {

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
   * Displays a Booking reservation revision.
   *
   * @param int $booking_reservation_revision
   *   The Booking reservation revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($booking_reservation_revision) {
    $booking_reservation = $this->entityTypeManager()->getStorage('booking_reservation')
      ->loadRevision($booking_reservation_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('booking_reservation');

    return $view_builder->view($booking_reservation);
  }

  /**
   * Page title callback for a Booking reservation revision.
   *
   * @param int $booking_reservation_revision
   *   The Booking reservation revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($booking_reservation_revision) {
    $booking_reservation = $this->entityTypeManager()->getStorage('booking_reservation')
      ->loadRevision($booking_reservation_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $booking_reservation->label(),
      '%date' => $this->dateFormatter->format($booking_reservation->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Booking reservation.
   *
   * @param \Drupal\booking_system\Entity\BookingReservationInterface $booking_reservation
   *   A Booking reservation object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(BookingReservationInterface $booking_reservation) {
    $account = $this->currentUser();
    $booking_reservation_storage = $this->entityTypeManager()->getStorage('booking_reservation');

    $langcode = $booking_reservation->language()->getId();
    $langname = $booking_reservation->language()->getName();
    $languages = $booking_reservation->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $booking_reservation->label()]) : $this->t('Revisions for %title', ['%title' => $booking_reservation->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all booking reservation revisions") || $account->hasPermission('administer booking reservation entities')));
    $delete_permission = (($account->hasPermission("delete all booking reservation revisions") || $account->hasPermission('administer booking reservation entities')));

    $rows = [];

    $vids = $booking_reservation_storage->revisionIds($booking_reservation);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\booking_system\Entity\BookingReservationInterface $revision */
      $revision = $booking_reservation_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $booking_reservation->getRevisionId()) {
          $link = Link::fromTextAndUrl($date, new Url('entity.booking_reservation.revision', [
            'booking_reservation' => $booking_reservation->id(),
            'booking_reservation_revision' => $vid,
          ]))->toString();
        }
        else {
          $link = $booking_reservation->toLink($date)->toString();
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
              Url::fromRoute('entity.booking_reservation.translation_revert', [
                'booking_reservation' => $booking_reservation->id(),
                'booking_reservation_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.booking_reservation.revision_revert', [
                'booking_reservation' => $booking_reservation->id(),
                'booking_reservation_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.booking_reservation.revision_delete', [
                'booking_reservation' => $booking_reservation->id(),
                'booking_reservation_revision' => $vid,
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

    $build['booking_reservation_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
