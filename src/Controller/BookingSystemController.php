<?php

namespace Drupal\booking_system\Controller;
use Stephane888\DrupalUtility\HttpResponse;
use Stephane888\Debug\ExceptionExtractMessage;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for booking_system routes.
 */
class BookingSystemController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }
  /**
   * 
   * creating dates()
   * 
   */
  public function dates() {
    try {
      $datas = [];
      return HttpResponse::response($datas);
    } catch (\Exception $e) {
      $errors = ExceptionExtractMessage::errorAll($e);
      $this->getLogger('booking_system')->critical(ExceptionExtractMessage::errorAllToString($e));
      return HttpResponse::response($errors, 400, $e->getMessage());
    }
  }
  
}
