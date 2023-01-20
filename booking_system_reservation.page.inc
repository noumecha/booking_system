<?php

/**
 * @file
 * Contains booking_system_reservation.page.inc.
 *
 * Page callback for Booking system reservation entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Booking system reservation templates.
 *
 * Default template: booking_system_reservation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_booking_system_reservation(array &$variables) {
  // Fetch BookingSystemReservation Entity Object.
  $booking_system_reservation = $variables['elements']['#booking_system_reservation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
