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
  const jours = [
    [
      'label' => 'Dimanche',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Lundi',
      'text' => 'noumel',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Mardi',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Mercredi',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Jeudi',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Vendredi',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Samedi',
      'status' => false, // status pour le jour
      'periodes' => [
        [
        'label' => 'Petit déjeuné',
        'status' => true, // status pour période
        'h_d' => 07,
        'm_d' => 00,
        'h_f' => 9,
        'm_f' => 00,
        'decallage' => 5,
        'intervalle' => 15,
        'creneaux' => []
        ],
        [
          'label' => 'Déjeuner',
          'status' => true, // status pour période
          'h_d' => 12,
          'm_d' => 00,
          'h_f' => 14,
          'm_f' => 00,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ],
        [
          'label' => 'Diner',
          'status' => true, // status pour période
          'h_d' => 17,
          'm_d' => 00,
          'h_f' => 19,
          'm_f' => 30,
          'decallage' => 10,
          'intervalle' => 30,
          'creneaux' => []
        ]
      ]
    ],
  ];

}