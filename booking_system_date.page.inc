<?php

/**
 * @file
 * Contains booking_system_date.page.inc.
 *
 * Page callback for Booking system date entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Booking system date templates.
 *
 * Default template: booking_system_date.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_booking_system_date(array &$variables) {
  // Fetch BookingSystemDate Entity Object.
  $booking_system_date = $variables['elements']['#booking_system_date'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
