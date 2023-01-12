<?php

namespace Drupal\booking_system\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A widget period.
 *
 * @FieldWidget(
 *   id = "period_widget",
 *   label = @Translation("Periode Field widget"),
 *   field_types = {
 *     "period_type",
 *   }
 * )
 */

 class PeriodFieldWidget extends WidgetBase
{

    /**
    *
    * {@inheritdoc}
    */
    public static function defaultSettings() {
        return [
            'size' => 60,
            'intervalle_size' => 60,
            'decallage_size' => 15,
            'placeholder_titre' => '',
            'label_start_hour' => 'Heure de Debut',
            'label_end_hour' => 'Heure de fin',
            'label_intervalle' => 'Intervalle entre les heures',
            'label_decallage' => 'Décallage entre les plages',
            'label_status' => 'Activé',
        ] + parent::defaultSettings();
    }
  

    /**
    * {@inheritdoc}
    * Settings the form for each field
    */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $elts = [];
        $date_type = 'none';
        $time_type = 'time';
        $startTimeValue = isset($items[$delta]->start_hour) ? DrupalDateTime::createFromTimestamp($items[$delta]->start_hour) : '';
        $elts['start_hour'] = [
            '#title' => t($this->getSetting('label_start_hour')),
            '#type' => 'datetime',
            '#date_date_element' => $date_type,
            '#date_time_element' => $time_type,
            '#default_value' => $startTimeValue
        ] + $element;

        $endTimeValue = isset($items[$delta]->end_debut) ? DrupalDateTime::createFromTimestamp($items[$delta]->end_hour) : '';
        $elts['end_hour'] = [
            '#title' => t($this->getSetting('label_end_hour')),
            '#type' => 'datetime',
            '#date_date_element' => $date_type,
            '#date_time_element' => $time_type,
            '#default_value' => $endTimeValue,
        ] + $element;
        $elts['status'] = [
            '#title' => t($this->getSetting('label_status')),
            '#type' => 'checkbox',
            '#default_value' => isset($items[$delta]->status) ? $items[$delta]->status : NULL,
          ] + $element;
        $elts['intervalle'] = [
            '#title' => t($this->getSetting('label_intervalle')),
            '#type' => 'textfield',
            '#default_value' => isset($items[$delta]->intervalle) ? $items[$delta]->intervalle : NULL,
        ] + $element;
        $elts['decallage'] = [
            '#title' => t($this->getSetting('label_decallage')),
            '#type' => 'number',
            '#default_value' => isset($items[$delta]->decallage) ? $items[$delta]->decallage : NULL,
            '#required' => TRUE,
            '#min' => 1,
            '#max' => 60
        ] + $element;

        return $elts;
    }
    /**
    * {@inheritdoc}
    * Allow user to override the form configuration
    */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $element['decallage'] = [
        '#type' => 'number',
        '#title' => $this->getSetting('label_decallage'),
        '#default_value' => $this->getSetting('size'),
        '#required' => TRUE,
        '#min' => 5,
        ];
        $element['intervalle'] = [
            '#type' => 'number',
            '#title' => $this->getSetting('label_intervalle'),
            '#default_value' => $this->getSetting('size'),
            '#required' => TRUE,
            '#min' => 5,
        ];
        $element['status'] = [
            '#type' => 'textfield',
            '#title' => $this->getSetting('label_status'),
            '#default_value' => $this->getSetting('size'),
        ];
        $element['start_hour'] = [
            '#type' => 'textfield',
            '#title' => $this->getSetting('label_start_hour'),
            '#default_value' => $this->getSetting('size'),
        ];
        $element['end_hour'] = [
            '#type' => 'textfield',
            '#title' => $this->getSetting('label_end_four'),
            '#default_value' => $this->getSetting('size'),
        ];
        return $element;
    }
}