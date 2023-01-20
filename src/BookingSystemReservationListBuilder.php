<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Booking system reservation entities.
 *
 * @ingroup booking_system
 */
class BookingSystemReservationListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Booking system reservation ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\booking_system\Entity\BookingSystemReservation $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.booking_system_reservation.edit_form',
      ['booking_system_reservation' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
