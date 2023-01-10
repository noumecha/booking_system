<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\booking_system\Entity\BookingSystemDateInterface;

/**
 * Defines the storage handler class for Booking system date entities.
 *
 * This extends the base storage class, adding required special handling for
 * Booking system date entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemDateStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Booking system date revision IDs for a specific Booking system date.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemDateInterface $entity
   *   The Booking system date entity.
   *
   * @return int[]
   *   Booking system date revision IDs (in ascending order).
   */
  public function revisionIds(BookingSystemDateInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Booking system date author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Booking system date revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemDateInterface $entity
   *   The Booking system date entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(BookingSystemDateInterface $entity);

  /**
   * Unsets the language for all Booking system date with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
