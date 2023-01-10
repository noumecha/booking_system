<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\booking_system\Entity\BookingSystemScheduleInterface;

/**
 * Defines the storage handler class for Booking system schedule entities.
 *
 * This extends the base storage class, adding required special handling for
 * Booking system schedule entities.
 *
 * @ingroup booking_system
 */
interface BookingSystemScheduleStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Booking system schedule revision IDs for a specific Booking system schedule.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemScheduleInterface $entity
   *   The Booking system schedule entity.
   *
   * @return int[]
   *   Booking system schedule revision IDs (in ascending order).
   */
  public function revisionIds(BookingSystemScheduleInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Booking system schedule author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Booking system schedule revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\booking_system\Entity\BookingSystemScheduleInterface $entity
   *   The Booking system schedule entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(BookingSystemScheduleInterface $entity);

  /**
   * Unsets the language for all Booking system schedule with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
