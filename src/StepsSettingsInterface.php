<?php

/**
 *
 * @file
 * Provides Drupal\booking_system\StepsSettingsInterface
 */

namespace Drupal\booking_system;


/**
 * Defines an interface the reservation app
 */
interface StepsSettingsInterface /*extends PluginInspectionInterface*/
{
  const DEFAULT_CONFIG = [
    'months_config' => [
      'January',
      'Febrary',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December',
    ],
    'weeks_config' => [
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday'
    ],
    'labels_config' => [
      'label_prev_year' => 'Année précédente',
      'label_prev_month' => 'Mois précédent',
      'label_current_month' => 'Mois actuel',
      'label_next_month' => 'Mois suivant',
      'label_next_year' => 'Année suivante',
      'label_no_date_selected' => 'Aucune date selectionné',
      'label_help' => 'Utilisez les touches du curseur pour naviguer dans les dates du calendrier',
    ],
    'steps_labels' => [
      'step_one_title' => 'Reservation Date',
      'step_two_title' => 'Reservation Hour',
      'step_three_title' => 'Number of seats',
      'step_four_title' => 'Booking summary',
      'step_five_title' => 'Operation report',
    ],
    'report_configs' => [
      'success' => [
        'message' => 'Success',
        'resume'  => 'yay, everything is working.'
      ],
      'error' => [
        'message' => 'Error',
        'resume'  => 'oh no, something went wrong.'
      ],

    ]
  ];
}
