<?php

namespace Drupal\booking_system\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'experience_type' field type.
 *
 * @FieldType(
 *   id = "periode_type",
 *   label = @Translation("Periode"),
 *   description = @Translation("Permet de surcharger les périodes sur une dates"),
 *   default_widget = "periode_field_widget",
 *   default_formatter = "periode_field_formatter"
 * )
 */

class PeriodFieldType extends FieldItemBase
{
  /**
   * {@inheritdoc}
   * set the king of data type that the field cant contain
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'start_hour' => [
            'type' => 'int',
            'unsigned' => FALSE,
            'size' => 'normal'
        ],
        'end_hour' => [
            'type' => 'int',
            'unsigned' => FALSE,
            'size' => 'normal'
        ],
        'intervalle' => [
            'type' => 'text',
            'size' => 'tiny',
            'not null' => FALSE,
        ],
        'decallage' => [
            'type' => 'int',
            'size' => 'tiny',
            'not null' => FALSE,
        ],
        'status' => [
            'type' => 'boolean',
            'size' => 'tiny',
            'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   * set properties basic configuration
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    # heure de debut
    $properties['start_hour'] = BaseFieldDefinition::create('daterange')
        ->setLabel(t('Heure de debut'))
        ->setDescription(t('Définir l\'heure de debut la periode'))
        ->setSettings(['datetime_type' => 'date',])
        ->setRevisionable(FALSE)
        ->setDisplayOptions('view', [
          'label' => 'above',
          'type' => 'string',
          'weight' => 0,
        ])
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE)
        ->setDisplayOptions('form', [
          'type' => 'dis_hours_date_time_widget',
          'weight' => 0,
        ]);
    # heure de fin
    $properties['end_hour'] = BaseFieldDefinition::create('daterange')
        ->setLabel(t('Heure de fin'))
        ->setDescription(t('Définir l\'heure de fin la periode'))
        ->setRevisionable(FALSE)
        ->setSettings(['datetime_type' => 'date',])
        ->setDisplayOptions('view', [
          'label' => 'above',
          'type' => 'string',
          'weight' => 0,
        ])
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE)
        ->setDisplayOptions('form', [
          'type' => 'dis_hours_date_time_widget',
          'weight' => 0,
        ]);
    # period status  
    $properties['status'] = DataDefinition::create('boolean')
        ->setLabel(t('Status'))
        ->setDescription(t('Activer / Desactiver la période'))
        ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'checkbox',
            'weight' => 0,
        ])
        ->setDisplayOptions('form', [
            'type' => 'checkbox',
            'weight' => 0,
        ])
        ->setRequired(TRUE)
        ->setDefaultValue(false)
        ->setDisplayConfigurable('view', TRUE)
        ->setDisplayConfigurable('form', TRUE);
    # preriode interavalle
    $properties['intervalle'] = DataDefinition::create('text')
        ->setLabel(t('intervalle'))
        ->setDescription(t('Intervalle de temps entre les heures'))
        ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'text',
            'weight' => 0,
        ])
        ->setDisplayOptions('form', [
            'type' => 'text',
            'weight' => 0,
        ])
        ->setDefaultValue(15)
        ->setDisplayConfigurable('view', TRUE)
        ->setDisplayConfigurable('form', TRUE);
    # period decallage 
    $properties['decallage'] = DataDefinition::create('integer')
        ->setLabel(t('decallage'))
        ->setDescription(t('Decallage entre intervalle de temps '))
        ->setSettings([
            'min' => 5,
            'max' => 15
        ])
        ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => 0,
        ])
        ->setDisplayOptions('form', [
            'type' => 'number_unformatted',
            'weight' => 0,
        ])
        ->setDefaultValue(10)
        ->setDisplayConfigurable('view', TRUE)
        ->setDisplayConfigurable('form', TRUE);

    return $properties;
  }

  /**
  *
  * {@inheritdoc}
  */
  public static function defaultStorageSettings() {
    return [
      'max_length' => 255,
      'is_ascii' => FALSE,
      'case_sensitive' => FALSE
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
