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
    $data = [];
    $config = $this->config('booking_system.settings')->getRawData();
    $data["globalDiscount"] = $config["reduction"];
    $data["numberOfDisplayedDays"] = $config["number_of_days"];
    $disabledDaysOfTheWeek = $this->getDisabledDaysOfTheWeek($config["jours"]);
    $data["disabledDays"] = $disabledDaysOfTheWeek;

    $disabledDays = $this->em->getStorage('booking_system_date')->loadMultiple(); //getQuery permet de construire une requête
    return $data;
  }

  public function getDisabledDaysOfTheWeek(array $days)
  {
    $disabledDays = [];
    foreach ($days as $day) {
      $i = 0;
      if ($day["status"] == 0) {
        $disabledDays[] = $i;
      }
      ++$i;
    }
    return $disabledDays;
  }
}
