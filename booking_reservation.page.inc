<?php

/**
 * @file
 * Contains booking_reservation.page.inc.
 *
 * Page callback for Booking reservation entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Booking reservation templates.
 *
 * Default template: booking_reservation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_booking_reservation(array &$variables) {
  // Fetch BookingReservation Entity Object.
  $booking_reservation = $variables['elements']['#booking_reservation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
