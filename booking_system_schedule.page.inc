<?php

/**
 * @file
 * Contains booking_system_schedule.page.inc.
 *
 * Page callback for Booking system schedule entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Booking system schedule templates.
 *
 * Default template: booking_system_schedule.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_booking_system_schedule(array &$variables) {
  // Fetch BookingSystemSchedule Entity Object.
  $booking_system_schedule = $variables['elements']['#booking_system_schedule'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
