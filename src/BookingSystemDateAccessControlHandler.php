<?php

namespace Drupal\booking_system;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Booking system date entity.
 *
 * @see \Drupal\booking_system\Entity\BookingSystemDate.
 */
class BookingSystemDateAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\booking_system\Entity\BookingSystemDateInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished booking system date entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published booking system date entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit booking system date entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete booking system date entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add booking system date entities');
  }


}
