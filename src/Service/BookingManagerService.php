<?php

namespace Drupal\booking_system\Service;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;

/**
 * Manage the booking system
 */
class BookingManagerService extends ControllerBase
{

  protected $currentUser;
  protected $em;

  public function __construct(AccountInterface $currentUser, EntityTypeManager $em)
  {
    $this->currentUser = $currentUser;
    $this->em = $em;
  }

  public function generateDates()
  {
dd($this->config('booking_system.settings')->getRawData());
    $data = $this->em->getStorage('booking_system_date')->loadMultiple(); //getQuery permet de construire une requête
    return $data;
  }
}
