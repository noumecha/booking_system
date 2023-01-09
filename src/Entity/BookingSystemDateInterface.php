<?php

namespace Drupal\booking_system\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Booking system date entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemDateInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Booking system date name.
   *
   * @return string
   *   Name of the Booking system date.
   */
  public function getName();

  /**
   * Sets the Booking system date name.
   *
   * @param string $name
   *   The Booking system date name.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemDateInterface
   *   The called Booking system date entity.
   */
  public function setName($name);

  /**
   * Gets the Booking system date creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Booking system date.
   */
  public function getCreatedTime();

  /**
   * Sets the Booking system date creation timestamp.
   *
   * @param int $timestamp
   *   The Booking system date creation timestamp.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemDateInterface
   *   The called Booking system date entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Booking system date revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Booking system date revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemDateInterface
   *   The called Booking system date entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Booking system date revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Booking system date revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\booking_system\Entity\BookingSystemDateInterface
   *   The called Booking system date entity.
   */
  public function setRevisionUserId($uid);

}
