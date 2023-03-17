<?php

/**
 * @file
 * Contains \Drupal\booking_system\Plugin\Field\FieldType\ScheduleItem.
 */


namespace Drupal\booking_system\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'snippets' field type.
 *
 * @FieldType(
 *   id = "schedule",
 *   label = @Translation("Schedule field"),
 *   description = @Translation("This field stores schedule modifications in the database."),
 *   default_widget = "schedule_default",
 *   default_formatter = "schedule_default"
 * )
 */
class ScheduleItem extends FieldItemBase
{
    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field)
    {
        return [
            'columns' => [
                'start_hour' => [
                    'type' => 'varchar',
                    'length' => 256,
                    'not null' => FALSE,
                ],
                'end_hour' => [
                    'type' => 'varchar',
                    'length' => 256,
                    'not null' => FALSE,
                ],
                'start_date' => [
                    'type' => 'int',
                    'unsigned' => FALSE,
                    'size' => 'normal'
                ],
                'end_date' => [
                    'type' => 'int',
                    'unsigned' => FALSE,
                    'size' => 'normal'
                ],
                'discount' => [
                    'type' => 'int',
                    'unsigned' => FALSE,
                    'size' => 'normal'
                ],
                'status' => [
                    'type' => 'int',
                    'size' => 'tiny',
                    'not null' => FALSE,
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {

        $isStartHourEmpty = $this->get('start_hour')->getValue() === NULL || $this->get('start_hour')->getValue() === '' ? TRUE : FALSE;

        $isEndHourEmpty = $this->get('end_hour')->getValue() === NULL || $this->get('end_hour')->getValue() === '' ? TRUE : FALSE;

        $isStartDateEmpty = $this->get('start_date')->getValue() === NULL || $this->get('start_date')->getValue() === 0 ? TRUE : FALSE;

        $isEndDateEmpty = $this->get('end_date')->getValue() === NULL || $this->get('end_date')->getValue() === 0 ? TRUE : FALSE;

        $isDiscountEmpty = $this->get('discount')->getValue() === NULL || $this->get('discount')->getValue() === 0 ? TRUE : FALSE;

        $isEmptySatus = $this->get('status')->getValue() === NULL;


        return $isStartHourEmpty && $isEndHourEmpty && $isStartDateEmpty && $isEndDateEmpty && $isDiscountEmpty && $isEmptySatus;
    }


    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
    {
        $properties['start_hour'] = DataDefinition::create('string')
            ->setLabel(t('start hour'));

        $properties['end_hour'] = DataDefinition::create('string')
            ->setLabel(t('end hour'));


        $properties['start_date'] = DataDefinition::create('integer')
            ->setLabel(t('start date'));


        $properties['end_date'] = DataDefinition::create('integer')
            ->setLabel(t('end date'));

        $properties['discount'] = DataDefinition::create('integer')
            ->setLabel(t('discount'));

        $properties['status'] = DataDefinition::create('boolean')
            ->setLabel(t('status'));

        return $properties;
    }
}
