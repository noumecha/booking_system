<?php

namespace Drupal\booking_system\Controller;

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

}
