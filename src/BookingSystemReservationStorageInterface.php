<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\booking_system\Entity\BookingSystemReservationInterface;

/**
 * Defines the storage handler class for Booking system reservation entities.
 *
 * This extends the base storage class, adding required special handling for
 * Booking system reservation entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemReservationStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Booking system reservation revision IDs for a specific Booking system reservation.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemReservationInterface $entity
   *   The Booking system reservation entity.
   *
   * @return int[]
   *   Booking system reservation revision IDs (in ascending order).
   */
  public function revisionIds(BookingSystemReservationInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Booking system reservation author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Booking system reservation revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemReservationInterface $entity
   *   The Booking system reservation entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(BookingSystemReservationInterface $entity);

  /**
   * Unsets the language for all Booking system reservation with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
