<?php

namespace Drupal\booking_system\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Booking system reservation revision.
 *
 * @ingroup booking_system
 */
class BookingSystemReservationRevisionDeleteForm extends ConfirmFormBase {


  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * The Booking system reservation revision.
   *
   * @var \Drupal\booking_system\Entity\BookingSystemReservationInterface
   */
  protected $revision;

  /**
   * The Booking system reservation storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $bookingSystemReservationStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->bookingSystemReservationStorage = $container->get('entity_type.manager')->getStorage('booking_system_reservation');
    $instance->connection = $container->get('database');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'booking_system_reservation_revision_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the revision from %revision-date?', [
      '%revision-date' => $this->dateFormatter->format($this->revision->getRevisionCreationTime()),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.booking_system_reservation.version_history', ['booking_system_reservation' => $this->revision->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $booking_system_reservation_revision = NULL) {
    $this->revision = $this->BookingSystemReservationStorage->loadRevision($booking_system_reservation_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->BookingSystemReservationStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Booking system reservation: deleted %title revision %revision.', ['%title' => $this->revision->label(), '%revision' => $this->revision->getRevisionId()]);
    $this->messenger()->addMessage(t('Revision from %revision-date of Booking system reservation %title has been deleted.', ['%revision-date' => $this->dateFormatter->format($this->revision->getRevisionCreationTime()), '%title' => $this->revision->label()]));
    $form_state->setRedirect(
      'entity.booking_system_reservation.canonical',
       ['booking_system_reservation' => $this->revision->id()]
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {booking_system_reservation_field_revision} WHERE id = :id', [':id' => $this->revision->id()])->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.booking_system_reservation.version_history',
         ['booking_system_reservation' => $this->revision->id()]
      );
    }
  }

}
