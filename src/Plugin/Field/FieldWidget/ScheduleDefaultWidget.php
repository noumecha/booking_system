<?php

/**
 * @file
 * Contains \Drupal\booking_system\Plugin\Field\FieldWidget\ScheduleDefaultWidget.
 */

namespace Drupal\booking_system\Plugin\Field\FieldWidget;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'schedule_default' widget.
 *
 * @FieldWidget(
 *   id = "schedule_default",
 *   label = @Translation("schedule default"),
 *   field_types = {
 *     "schedule"
 *   }
 * )
 */
class ScheduleDefaultWidget extends WidgetBase
{

    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
    {

        $element['start_hour'] = [
            '#title' => $this->t('Start Hour'),
            '#type' => 'datetime',
            '#date_date_element' => 'none',
            '#date_time_element' => 'time',
            '#date_increment' => 0
        ];

        $element['end_hour'] = [
            '#title' => $this->t('End Hour'),
            '#type' => 'datetime',
            '#date_date_element' => 'none',
            '#date_time_element' => 'time',
            '#date_increment' => 0
        ];


        $defalultValue = isset($items[$delta]->start_date) ? DrupalDateTime::createFromTimestamp($items[$delta]->start_date) : '';
        $element['start_date'] = [
            "#type" => 'datetime',
            '#title' => t('Start Date'),
            '#default_value' => $defalultValue,
            '#date_date_element' => 'date',
            '#date_time_element' => 'none',
            '#date_increment' => 0
        ];

        $defalultValue = isset($items[$delta]->end_date) ? DrupalDateTime::createFromTimestamp($items[$delta]->end_date) : '';
        $element['end_date'] = [
            "#type" => 'datetime',
            '#title' => t('End Date'),
            '#default_value' => $defalultValue,
            '#date_date_element' => 'date',
            '#date_time_element' => 'none',
            '#date_increment' => 0
        ];

        $element['discount'] = [
            '#title' => $this->t('Discount'),
            '#type' => 'number',
            '#default_value' => isset($items[$delta]->discount) ? $items[$delta]->discount : NULL,
        ];

        $element['status'] = [
            '#title' => $this->t('Disable'),
            '#type' => 'checkbox',
            '#default_value' => isset($items[$delta]->status) ? $items[$delta]->status : NULL,
        ];

        return $element;
    }

    /**
     * {@inheritdoc}
     */
    function massageFormValues($values, $form, $form_state)
    {
        foreach ($values as &$value) {

            $value["start_hour"] = date("h:i", $value["start_hour"]->getTimestamp());
            $value["end_hour"] = date("h:i", $value["end_hour"]->getTimestamp());
            $value["start_date"] = $value["start_date"]->getTimestamp();
            $value["end_date"] = $value["end_date"]->getTimestamp();
            $value["discount"] = (int) $value["discount"];

        }

        return $values;
    }
}
