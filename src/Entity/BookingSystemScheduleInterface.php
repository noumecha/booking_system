<?php

namespace Drupal\booking_system\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Booking system schedule entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemScheduleInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Booking system schedule discount.
   *
   * @return string
   *   Name of the Booking system schedule.
   */
  public function getDiscount();

  /**
   * Sets the Booking system schedule discount.
   *
   * @param string $discount
   *   The Booking system schedule discount.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setDiscount($discount);

  /**
   * Gets the Booking system schedule date range.
   *
   * @return string
   *   Name of the Booking system schedule.
   */
  public function getDateRange();

  /**
   * Sets the Booking system schedule date range.
   *
   * @param string $dateRange
   *   The Booking system schedule date range.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setDateRange($dateRange);

  /**
   * Gets the Booking system schedule time.
   *
   * @return string
   *   Name of the Booking system schedule.
   */
  public function getTime();

  /**
   * Sets the Booking system schedule time.
   *
   * @param string $time
   *   The Booking system schedule discount.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setTime($time);

  /**
   * Gets the Booking system schedule name.
   *
   * @return string
   *   Name of the Booking system schedule.
   */
  public function getName();

  /**
   * Sets the Booking system schedule name.
   *
   * @param string $name
   *   The Booking system schedule name.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setName($name);

  /**
   * Gets the Booking system schedule creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Booking system schedule.
   */
  public function getCreatedTime();

  /**
   * Sets the Booking system schedule creation timestamp.
   *
   * @param int $timestamp
   *   The Booking system schedule creation timestamp.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Booking system schedule revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Booking system schedule revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Booking system schedule revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Booking system schedule revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemScheduleInterface
   *   The called Booking system schedule entity.
   */
  public function setRevisionUserId($uid);

}
