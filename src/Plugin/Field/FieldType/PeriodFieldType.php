<?php

namespace Drupal\booking_system\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Field\BaseFieldDefinition;
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
          'lenght' => '256'
        ],
        'end_hour' => [
          'type' => 'varchar',
          'not null' => FALSE,
          'lenght' => '256'
        ],
        'intervalle' => [
            'type' => 'int',
            'size' => 'tiny',
        ],
        'decallage' => [
            'type' => 'int',
            'size' => 'tiny',
        ],
        'status' => [
            'type' => 'int',
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
        ->setLabel(t('Heure de debut'))
        ->setDescription(t('Définir l\'heure de debut la periode'))
        ->setRequired(TRUE);
    # heure de fin
    $properties['end_hour'] = DataDefinition::create('string')
        ->setLabel(t('Heure de fin'))
        ->setDescription(t('Définir l\'heure de fin la periode'))
        ->setRequired(TRUE);
    # period status  
    $properties['status'] = DataDefinition::create('boolean')
        ->setLabel(t('Boolean value'))
        ->setRequired(TRUE);
    # preriode interavalle // this guy need to have 2 subfields
    $properties['intervalle'] = DataDefinition::create('integer')
        ->setLabel(t('intervalle'))
        ->setDescription(t('Intervalle de temps entre les heures'))
        ->setRequired(TRUE);
    # period decallage 
    $properties['decallage'] = DataDefinition::create('integer')
        ->setLabel(t('decallage'))
        ->setDescription(t('Decallage entre intervalle de temps '))
        ->setRequired(TRUE);

    return $properties;
  }

  /**
   *
   * {@inheritdoc}
   * set the default value
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $date = new \DateTime();
    $values['start_hour'] = date('H:i', $date->getTimestamp());
    $values['end_hour'] = date('H:i', $date->getTimestamp());
    $values['status'] = false;
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
