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
    'months' => [
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
    'week_days' => [
      'Monday',
      'Tuesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday'
    ],
    'labels' => [
      'label_prev_year' => 'Année précédente',
      'label_prev_month' => 'Mois précédent',
      'label_current_month' => 'Mois actuel',
      'label_next_month' => 'Mois suivant',
      'label_next_year' => 'Année suivante',
      'label_no_date_selected' => 'Aucune date selectionné',
      'label_help' => 'Utilisez les touches du curseur pour naviguer dans les dates du calendrier',
    ],
    'steps_labels' => [
      'step_one_title' => 'Date de reservation',
      'step_two_title' => 'Heure de reservation',
      'step_three_title' => 'Nombre de places',
      'step_four_title' => 'Bilan de la reservation',
    ],
  ];
}
