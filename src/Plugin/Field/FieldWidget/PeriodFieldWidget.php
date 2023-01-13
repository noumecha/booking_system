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
            'intervalle_size' => 30,
            'decallage_size' => 15,
            'placeholder_titre' => '',
            'label_start_hour' => 'Heure de Debut',
            'label_end_hour' => 'Heure de fin',
            'label_intervalle' => 'Intervalle de temps entre les heures',
            'label_decallage' => 'Décallage entre les plages',
            'label_status' => 'Activé/Désactivé la période',
        ] + parent::defaultSettings();
    }
  

    /**
    * {@inheritdoc}
    * Settings the form for each field
    */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        //dump($element);
        $element['#type'] = 'details';
        $elts = $element;       
        $date_type = 'none';
        $time_type = 'time';
        if (!empty($element['#title_display']))
            unset($element['#title_display']);
        # period start time
        $elts['start_hour'] = [
            '#title' => t($this->getSetting('label_start_hour')),
            '#type' => 'datetime',
            '#date_time_format' => 'H:m',
            '#date_date_element' => $date_type,
            '#date_time_element' => $time_type,
            '#default_value' =>  isset($items[$delta]->start_hour) ? DrupalDateTime::createFromTimestamp($items[$delta]->start_hour) : '12:00:00 AM'
        ];

        # period end hour
        $elts['end_hour'] = [
            '#title' => t($this->getSetting('label_end_hour')),
            '#type' => 'datetime',
            '#date_time_format' => 'H:m',
            '#date_date_element' => $date_type, // none
            '#date_time_element' => $time_type,
            '#default_value' => isset($items[$delta]->end_debut) ? DrupalDateTime::createFromTimestamp($items[$delta]->end_hour) : '12:00:00 AM'
        ];
        # period status
        $elts['status'] = [
            '#title' => t($this->getSetting('label_status')),
            '#type' => 'checkbox',
            '#description' => 'Cochez la case pour désactiver la période',
            '#default_value' => isset($items[$delta]->status) ? $items[$delta]->status : false,
            '#size' => $this->getSetting('size'),
            '#maxlength' => $this->getFieldSetting('max_length')
          ];
        # period interval
        $elts['intervalle'] = [
            '#title' => t($this->getSetting('label_intervalle')),
            '#type' => 'number',
            '#default_value' => isset($items[$delta]->intervalle) ? $items[$delta]->intervalle : $this->getSetting('intervalle_size'),
            '#required' => TRUE,
            '#min' => 1,
            '#max' => 59
        ];
        # period decallage
        $elts['decallage'] = [
            '#title' => t($this->getSetting('label_decallage')),
            '#type' => 'number',
            '#default_value' => isset($items[$delta]->decallage) ? $items[$delta]->decallage : $this->getSetting('decallage_size'),
            '#required' => TRUE,
            '#min' => 1,
            '#max' => 59
        ];
        //dump($elts);
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
        '#min' => 1,
        ];
        $element['intervalle'] = [
            '#type' => 'number',
            '#title' => $this->getSetting('label_intervalle'),
            '#default_value' => $this->getSetting('size'),
            '#required' => TRUE,
            '#min' => 1,
        ];
        $element['status'] = [
            '#type' => 'textfield',
            '#title' => $this->getSetting('label_status'),
            '#default_value' => $this->getSetting('size'),
        ];
        $element['start_hour'] = [
            '#type' => 'textfield',
            '#date_time_format' => 'H:m',
            '#title' => $this->getSetting('label_start_hour'),
            '#default_value' => $this->getSetting('size'),
        ];
        $element['end_hour'] = [
            '#type' => 'textfield',
            '#date_time_format' => 'H:m',
            '#title' => $this->getSetting('label_end_four'),
            '#default_value' => $this->getSetting('size'),
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    function massageFormValues($values, $form, $form_state) {
        $vals = parent::massageFormValues($values, $form, $form_state);
        // format the hours
        foreach ($vals as &$val) {
            if(!empty($val['start_hour'])) {
                /**
                 *
                 * @var \Drupal\Core\Datetime\DrupalDateTime $date
                 */
                $date = $val['start_hour'];

                $val['start_hour'] = date('H:i', $date->getTimestamp());
                //dump($val);
            }
            if(!empty($val['end_hour'])) {
                /**
                 *
                 * @var \Drupal\Core\Datetime\DrupalDateTime $date
                 */
                $date = $val['end_hour'];

                $val['end_hour'] = date('H:i', $date->getTimestamp());
            }
        }
        return $vals;
    }
}