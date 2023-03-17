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
      'step_one' => [
        'name' => 'Reservation Date',
        'title' => 'Choose a booking date',
      ],
      'step_two' => [
        'name' => 'Reservation Hour',
        'title' => 'Choose a time',
      ],
      'step_three' => [
        'name' => 'Number of seats',
        'title' => 'Choose the number of places',
      ],
      'step_four' => [
        'name' => 'Booking summary',
        'title' => 'Reservation report',
      ],
      'step_five' => [
        'name' => 'Operation report',
        'title' => '',
      ]
    ],
    'report_configs' => [
      'messages' => [
        'success' => [
          'message' => 'Success',
          'resume'  => 'yay, everything is working.',
        ],
        'error' => [
          'message' => 'Error',
          'resume'  => 'oh no, something went wrong.'
        ],
      ],
      'user_state' => [
        'online' => 'User Online',
        'offline' => 'User Offline'
      ],
      'call_to_action' => 'Book Now',
      'reset_btn_label' => 'Book again'
    ]
  ];
}
