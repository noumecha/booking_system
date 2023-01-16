<?php

namespace Drupal\booking_system\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a special API block.
 *
 * @Block(
 *   id = "booking_system_app",
 *   admin_label = @Translation("Booking System App"),
 *   category = @Translation("booking system app")
 * )
 */
class BookingSystemBlock extends BlockBase {
  
  /**
   *
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#type' => 'html_tag',
      '#tag' => 'section',
      "#attributes" => [
        'id' => 'app',
        'class' => [
          'm-5',
          'p-5'
        ]
      ]
    ];
    $build['content']['#attached']['library'][] = 'booking_system/booking_system_app';
    return $build;
  }
  
}
