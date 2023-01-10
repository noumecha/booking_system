<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Booking system schedule entities.
 *
 * @ingroup booking_system
 */
class BookingSystemScheduleListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Booking system schedule ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\booking_system\Entity\BookingSystemSchedule $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.booking_system_schedule.edit_form',
      ['booking_system_schedule' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
