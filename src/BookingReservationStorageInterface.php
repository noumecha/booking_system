<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\booking_system\Entity\BookingReservationInterface;

/**
 * Defines the storage handler class for Booking reservation entities.
 *
 * This extends the base storage class, adding required special handling for
 * Booking reservation entities.
 *
 * @ingroup booking_system
 */
interface BookingReservationStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Booking reservation revision IDs for a specific Booking reservation.
   *
   * @param \Drupal\booking_system\Entity\BookingReservationInterface $entity
   *   The Booking reservation entity.
   *
   * @return int[]
   *   Booking reservation revision IDs (in ascending order).
   */
  public function revisionIds(BookingReservationInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Booking reservation author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Booking reservation revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\booking_system\Entity\BookingReservationInterface $entity
   *   The Booking reservation entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(BookingReservationInterface $entity);

  /**
   * Unsets the language for all Booking reservation with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
