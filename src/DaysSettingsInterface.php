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
  const DAYS = [
    [
      'label' => 'Dimanche',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],
    [
      'label' => 'Lundi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],    
    [
      'label' => 'Mardi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],    
    [
      'label' => 'Mercredi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],    
    [
      'label' => 'Jeudi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],    
    [
      'label' => 'Vendredi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],    
    [
      'label' => 'Samedi',
      'status' => true, // status pour le jour
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
        'reduction' => 20,
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
          'reduction' => 10,
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
          'reduction' => 0,
          'creneaux' => []
        ]
      ]
    ],
  ];

}