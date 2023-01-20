<?php

namespace Drupal\booking_system\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Booking system reservation entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemReservationInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Booking system reservation name.
   *
   * @return string
   *   Name of the Booking system reservation.
   */
  public function getName();

  /**
   * Sets the Booking system reservation name.
   *
   * @param string $name
   *   The Booking system reservation name.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemReservationInterface
   *   The called Booking system reservation entity.
   */
  public function setName($name);

  /**
   * Gets the Booking system reservation creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Booking system reservation.
   */
  public function getCreatedTime();

  /**
   * Sets the Booking system reservation creation timestamp.
   *
   * @param int $timestamp
   *   The Booking system reservation creation timestamp.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemReservationInterface
   *   The called Booking system reservation entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Booking system reservation revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Booking system reservation revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemReservationInterface
   *   The called Booking system reservation entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Booking system reservation revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Booking system reservation revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemReservationInterface
   *   The called Booking system reservation entity.
   */
  public function setRevisionUserId($uid);

}
