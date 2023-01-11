<?php

/**
 *
 * @file
 * Provides Drupal\icecream\FlavorInterface
 */
namespace Drupal\booking_system;

//use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for days configuration.
 */
interface DaysSettingsInterface /*extends PluginInspectionInterface*/ {
  const booking_type = [
    [
      'label' => 'déjeuner',
      'status' => 'false',
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'diné',
      'status' => 'false',
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ]
  ];
  const jours = [
    [
      'label' => 'Dimanche',
      'status' => false,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Lundi',
      'status' => true,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Mardi',
      'status' => true,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Mercredi',
      'status' => true,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Jeudi',
      'status' => true,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Vendredi',
      'status' => true,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ],
    [
      'label' => 'Samedi',
      'status' => false,
      'h_d' => 7,
      'm_d' => 0,
      'h_f' => 17,
      'm_f' => 0
    ]
  ];

}