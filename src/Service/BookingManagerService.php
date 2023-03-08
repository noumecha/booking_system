<?php

namespace Drupal\booking_system\Service;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\booking_system\Entity\BookingReservation;
use Entity;
use Google\Service\Kgsearch\Resource\Entities;

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

  /**
   * 
   * {@inheritdoc}
   * 
   */
  public function generateDates()
  {
    $data = [];
    $config = $this->config('booking_system.settings')->getRawData();
    $data["globalDiscount"] = $config["reduction"];
    $data["numberOfDisplayedDays"] = $config["number_of_days"];
    $data["maxPeoples"] = $config["number_of_persons"];
    $disabledDaysOfTheWeek = $this->getDisabledDaysOfTheWeek($config["jours"]);
    $data["disabledDays"] = $disabledDaysOfTheWeek;

    /**
     *
     * @var \Drupal\booking_system\Entity\BookingDateEntity $entity
     */
    $disabledDays = $this->em->getStorage('booking_system_date')->loadMultiple(); //getQuery permet de construire une requête
    /*$disabledDates = $this->getDisabledDates($disabledDays);
    $data['disabledDates'] = $disabledDates;*/
    //dump($disabledDays);
    return $data;
  }

  /**
   * 
   * {@inheritdoc}
   * 
   */
  public function generateDisabledDates(){
    $data=[];
    $entities = $this->em->getStorage('booking_system_date')->loadMultiple(); //getQuery permet de construire une requête
    $today = strtotime('today');
    /**
     *
     * @var \Drupal\booking_system\Entity\BookingSystemDate $entity
     */
    foreach($entities as $entity){
      $date_status = $entity->get("status")->getValue()[0]['value'];
      $date_value  = strtotime($entity->get("start_date")->getValue()[0]['value']);
      if(!$date_status && $date_value >= $today){
        $data[] =  $date_value;
      }
    }
    //check if today has a valid schedule
    if(!$this->hasValidSchedule($today)){
      if(!in_array($today, $data) ){
        $data[] = $today;
      }
    }
    return $data;
  }

  /**
   * 
   * {@inheritdoc}
   * 
   */
  public function generateSchdules($day)
  {
    $data = [];

    $dayNames = [
      'Sunday' => 0,
      'Monday' => 1,
      'Tuesday' => 2,
      'Wednesday' => 3,
      'Thursday' => 4,
      'Friday' => 5,
      'Saturday' => 6,
    ];

    // retrive the global config alues
    $config = $this->config('booking_system.settings')->getRawData();

    //very if the date is valid
    $today = strtotime("today");
    if ($day < $today) {
      $data["error"] = "The day sent must be posterior to the current day";
      return $data;
    }

    $numberOfDays = (int) $config["number_of_days"];
    $maxDate = strtotime("+$numberOfDays day");
    if ($day > $maxDate) {
      $data["error"] = "The day sent must be in a interval time of $numberOfDays from the current date";
      return $data;
    }
    //check if the date is modified specificaly


    //else get the default configuration and render it
    $dayOfTheWeek = date('l', $day);
    $isValidated = $config["jours"][$dayNames[$dayOfTheWeek]]["status"];
    if ($isValidated != 1) {
      $data["error"] = "This day is not activated";
      return $data;
    }
    $selectedDay = $config["jours"][$dayNames[$dayOfTheWeek]];

    $periods = [];

    foreach ($selectedDay["periodes"] as $period) {
      $dayPeriod = [];
      $dayPeriod["name"] = $period["label"];
      $dayPeriod['discount'] = -$period['reduction'];
      $temp = $this->getPeriodes($period["h_d__m_d"], $period["h_f__m_f"], (int) $period["intervalle"], $day, $period["decallage"]);

      foreach($temp as $hour){
        $time_hour = strtotime($hour) - strtotime("today");
        $state = $this->periodIsValid($day, $time_hour, $time_hour + $period['intervalle']*60, $period['decallage'], $period['intervalle']);
        $state = $this->getSeats($day, $hour)['number'] && $state==true? true: false;
        $dayPeriod["times"][]= [
          'hour' => $hour,
          'status' => $state,
        ]; 
      }

      $periods[] = $dayPeriod;
    }
    // $datas = [];
    // //range of hours to disabled
    // $entities = $this->em->getStorage('booking_system_schedule')->loadMultiple();
    // /**
    //  *
    //  * @var \Drupal\booking_system\Entity\BookingSystemSchedule $entity
    //  */    
    // foreach($entities as $entity){
    //   $schedules = $entity->get("schedule")->getValue(); 
    //   /**
    //   *
    //   * @var \Drupal\booking_system\Plugin\Field\FieldType\ScheduleItem $schedule
    //   */
    //   foreach($schedules as $schedule){      
    //     $datas[] = $schedule;
    //   }
    // }

    return $periods;
  }

  /**
   * 
   * {@inheritdoc}
   * get the disabled days
   * 
   */
  public function getDisabledDaysOfTheWeek(array $days)
  {
    $disabledDays = [];
    foreach ($days as $k => $day) {
      if ($day["status"] == 0) {
        $disabledDays[$k] = $k;
      }
    }
    $disabledDays = array_values($disabledDays);
    //dump($disabledDays);
    return $disabledDays;
  }

  /**
   * 
   * {@inheritdoc}
   * 
   */

  public function getDisabledDates(array $dates) {
    $disabledDates = [];
    foreach ($dates as $d => $date) {
      if ($date['status'] == 0) {
        $disabledDates[$d] = $date['date_debut'];
      }
    }
    $disabledDates = array_values($disabledDates);

    return $disabledDates;
  }

  /**
   * 
   * {@inheritdoc}
   * get the periods
   */
  public function getPeriodes($start, $end, $gap, $day, $intervalle)
  {
    $intervalle = (int) $intervalle;

    $times = [];
    $date = date("y-m-d", $day) . " " . $start;
    $time = strtotime($date);
    $startHour = (int) explode(":", $start)[0];
    $endHour = (int) explode(":", $end)[0];

    $newGap = $gap * 60;
    $maxTimestamp = ($endHour - $startHour) * 3600 + $time;
    $timestamp = $time;

    while ($timestamp <= $maxTimestamp) {
      $times[] = date("H:i", $timestamp);
      $timestamp += $newGap;
      $timestamp += $intervalle;
    }

    return $times;
  }
  /**
   * 
   * {@inheritdoc}
   * check the validity of a period
   */
  public function periodIsValid($day, $start_hour, $end_hour, $gap = 15, $intervalle=15){
    $isValid = true;
    $current_schedule =[
      'start' => $day + $start_hour,
      'end'   =>$day + $end_hour
    ];
    //get the current time + 6hours (to match timezone)    
    $currentTime = strtotime("now") ;

    //checking if the hour isn't passed yet
    if($current_schedule['start'] <= ($currentTime +$gap*60)){
      return false;
    }

    //range of hours to disabled
    $entities = $this->em->getStorage('booking_system_schedule')->loadMultiple();
    /**
     *
     * @var \Drupal\booking_system\Entity\BookingSystemSchedule $entity
     */    
    foreach($entities as $entity){
      $schedules = $entity->get("schedule")->getValue(); 
      /**
      *
      * @var \Drupal\booking_system\Plugin\Field\FieldType\ScheduleItem $schedule
      */
      foreach($schedules as $schedule){
        $start  = $schedule['start_date'] + strtotime($schedule['start_hour']) - strtotime('today');
        $end    = $schedule['end_date'] + strtotime($schedule['end_hour']) - strtotime('today');
        //check if the schedule is in the range of de disabled range of hours
        if($current_schedule['start'] >= $start && $current_schedule['start'] <$end ||
           $current_schedule['end'] >= $start && $current_schedule['end'] <= $end){
          $isValid = false;
          break;   
        }
      }
      if(!$isValid)
        break;
    }    
    return $isValid;
  }

  /**
   * {@inheritdoc}
   * @param array $reservation
   * @throws \Exception
   * set the reservations
   */
  public function setRerservations(array $reservation) {
    $user_id = $this->currentUser->id();
    if ($user_id) {
      $this->reservationIsValid($reservation);
      $reservation = BookingReservation::create([
        // 'entity_id' => '',
        'number_of_places' => $reservation['number_of_places'],
        'time_of_reservation' => $reservation['time_of_reservation'],
        'periode_name' => $reservation['periode_name'],
        'reservation_date' => $reservation['reservation_date'],
        'reservation_reduction' => $reservation['reservation_reduction'],
      ]);
      return $reservation->save();
    }
    throw new \Exception("You must be logged in to be able to");
  }
  
  /**
   * {@inheritdoc}
   * @param array $reservation
   * @throws \Exception
   * set the reservations
   */

  public function reservationIsValid(array $reservation){
    $schedules = $this->generateSchdules($reservation['reservation_date']);
    $text_to_throw = 'Invalids datas';
    //how we expect to find our schedule in the array. 
    $expected_hour = [
      'hour' => $reservation['time_of_reservation'],
      'status' => true
    ];
    //will get True if the hour exist
    $hour_exist = false;
    
    //will get 'true' if the period_name received is valid
    $period_exist = false;

    $period_name = $reservation['periode_name'];
    //Store the index of the period in which we wish to make a reservation
    
    $period_index = 0;
    //start verifications
    if('integer' != gettype($reservation['reservation_reduction'])){
      throw new \Exception($text_to_throw." reduction");
    }

    if('integer' != gettype($reservation['number_of_places'])){
      throw new \Exception($text_to_throw." place");
    }

    foreach($schedules as $period){
      if($period["name"] == $period_name){
        $period_exist = true;
        break;
      }
      $period_index +=1;
    }

    if(!$period_exist){
      throw new \Exception($text_to_throw." period");
    }

    foreach($schedules as $period){
      if(in_array($expected_hour, $period['times'])){
        $hour_exist = true;
        break;
      }
    }

    if(!$hour_exist){
      throw new \Exception($text_to_throw." hour");
    }
    return true;
  }

   /**
   * {@inheritdoc}
   * check if the date contain at least one valid schedule
   */
  private function hasValidSchedule($day){
    $schedules = $this->generateSchdules($day);
    $status = false;
    foreach ($schedules as $periods) {
      foreach ($periods['times'] as $schedule) {
        if($schedule['status']){
          $status = true;
          break;
        }
      }
      if($status){
        break;
      }
    }
    return $status;
  }

  /**
   * {@inheritdoc}
   * get how many seats left to be reserved in an hour of a day
   */
  function getSeats($day, $hour){
    $config = $this->config('booking_system.settings')->getRawData();
    $data["number"] = (int) $config["number_of_persons"];
    $entities = $this->em->getStorage('booking_reservation')->loadMultiple(); //getQuery permet de construire une requête
    $today = strtotime('today');
    /**
     *
     * @var \Drupal\booking_system\Entity\BookingReservation $entity
     */
    foreach($entities as $entity){
      
      $reservation_date = $entity->get("reservation_date")->getValue();
      $time_of_reservation = $entity->get("time_of_reservation")->getValue();
      
      if ($reservation_date && $time_of_reservation) {
        $reservation_date = $reservation_date[0]['value'];
        $time_of_reservation = $time_of_reservation[0]['value'];
        if($reservation_date == $day && $time_of_reservation == $hour){
          $data["number"] -= (int)$entity->get("number_of_places")->getValue()[0]['value'];
        }
      }
    }
    return $data;
  }
}
