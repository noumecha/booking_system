<?php

namespace Drupal\booking_system\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'experience_type' field type.
 *
 * @FieldType(
 *   id = "period_type",
 *   label = @Translation("Periode"),
 *   description = @Translation("Permet de surcharger les périodes sur une date"),
 *   default_widget = "period_widget",
 *   default_formatter = "period_formatter"
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
          'type' => 'varchar',
          'not null' => FALSE,
          'length' => '256'
        ],
        'end_hour' => [
          'type' => 'varchar',
          'length' => '256',
          'not null' => FALSE,
        ],
        'intervalle' => [
            'type' => 'int',
            'unsigned' => FALSE,
            'not null' => FALSE,
            'size' => 'tiny',
        ],
        'decallage' => [
            'type' => 'int',
            'not null' => FALSE,
            'unsigned' => FALSE,
            'size' => 'tiny',
        ],
        'status' => [
            'type' => 'int',
            'not null' => FALSE,
            'size' => 'tiny',
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
    $properties['start_hour'] = DataDefinition::create('string')
        ->setLabel(t('Text value'))
        ->setRequired(TRUE);
    # heure de fin
    $properties['end_hour'] = DataDefinition::create('string')
        ->setLabel(t('Text value'))
        ->setRequired(TRUE);
    # period status  
    $properties['status'] = DataDefinition::create('boolean')
        ->setLabel(t('Boolean value'))
        ->setRequired(TRUE);
    # preriode interavalle // this guy need to have 2 subfields
    $properties['intervalle'] = DataDefinition::create('integer')
        ->setLabel(t('Integer value'))
        ->setRequired(TRUE);
    # period decallage 
    $properties['decallage'] = DataDefinition::create('integer')
        ->setLabel(t('Integer value'))
        ->setRequired(TRUE);

    return $properties;
  }

  /**
   *
   * {@inheritdoc}
   * set the default value
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    //$date = new \DateTime();
    $values['start_hour'] = '7:00';
    $values['end_hour'] = '8:00';
    $values['intervalle'] = 15;
    $values['decallage'] = 15;
    return $values;
  }

  /**
   * {@//inheritdoc}
   */
  /*public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }*/

}
