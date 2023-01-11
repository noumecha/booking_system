<?php

namespace Drupal\booking_system\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\booking_system\DaysSettingsInterface;

/**
 * Configure booking_system settings for this site.
 */
class SettingsForm extends ConfigFormBase implements DaysSettingsInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'booking_system_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['booking_system.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('booking_system.settings');
    /*$form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->config('booking_system.settings')->get('example'),
    ];*/
    $form['id'] = [
      '#type' => 'machine_name',
      //'#default_value' => $manage_days_entity_type->id(),
      '#default_value' => $this->config('booking_system.settings')->get('id'),
      '#machine_name' => [
        'exists' => '\Drupal\booking_system\Entity\ManageDaysEntityType::load'
      ],
      //'#disabled' => !$manage_days_entity_type->isNew()
    ];

    // dinner type : 
    $booking_type = \Drupal\booking_system\DaysSettingsInterface::booking_type;
    if (!empty($this->config('booking_system.settings')->get('booking_type'))) {
      $booking_type = $this->config('booking_system.settings')->get('booking_type');
    }
    $form['booking_type'] = [
      '#type' => 'fieldset',
      '#title' => 'Configuration Heure de debut & fin des types',
      '#tree' => TRUE
    ];
    foreach ($booking_type as $i => $val) {
      //
      $form['booking_type'][$i] = [
        "#type" => 'details',
        '#title' => $val['label'],
        '#open' => false
      ];
      $form['booking_type'][$i]['label'] = [
        "#type" => 'textfield',
        '#title' => 'Label',
        '#default_value' => $val['label']
      ];
      //
      $form['booking_type'][$i]['status'] = [
        "#type" => 'checkbox',
        '#title' => 'Status',
        '#default_value' => $val['status']
      ];
      //
      $form['booking_type'][$i]['h_d__m_d'] = [
        "#type" => 'textfield',
        '#title' => 'Heure debut',
        '#default_value' => $val['h_d'] . ':' . $val['m_d']
      ];
      //
      $form['booking_type'][$i]['h_f__m_f'] = [
        "#type" => 'textfield',
        '#title' => 'Heure fin',
        '#default_value' => $val['h_f'] . ':' . $val['m_f']
      ];
    }
    /* You will need additional form elements for your custom properties. */
    $jours = \Drupal\booking_system\DaysSettingsInterface::jours;
    if (!empty($this->config('booking_system.settings')->get('jours'))) {
      $jours = $this->config('booking_system.settings')->get('jours');
    }
    $form['jours'] = [
      '#type' => 'fieldset',
      '#title' => 'Configuration des dates',
      '#tree' => TRUE
    ];
    //
    foreach ($jours as $i => $val) {
      //
      $form['jours'][$i] = [
        "#type" => 'details',
        '#title' => $val['label'],
        '#open' => false
      ];
      $form['jours'][$i]['label'] = [
        "#type" => 'textfield',
        '#title' => 'Label',
        '#default_value' => $val['label']
      ];
      //
      $form['jours'][$i]['status'] = [
        "#type" => 'checkbox',
        '#title' => 'Status',
        '#default_value' => $val['status']
      ];
      //
      $form['jours'][$i]['h_d__m_d'] = [
        "#type" => 'textfield',
        '#title' => 'Heure debut',
        '#default_value' => $val['h_d'] . ':' . $val['m_d']
      ];
      //
      $form['jours'][$i]['h_f__m_f'] = [
        "#type" => 'textfield',
        '#title' => 'Heure fin',
        '#default_value' => $val['h_f'] . ':' . $val['m_f']
      ];
    }
    $form['reduction'] = [
      '#type' => 'number',
      '#title' => "Valeur de la reduction",
      '#default_value' => $this->config('booking_system.settings')->get('reduction')
    ];
    $form['months_number'] = [
      '#type' => 'number',
      '#title' => "Nombre de mois à afficher",
      '#default_value' => $this->config('booking_system.settings')->get('months_number')
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /*if ($form_state->getValue('example') != 'example') {
      $form_state->setErrorByName('example', $this->t('The value is not correct.'));
    }*/
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('booking_system.settings')
      ->set('booking_type', $form_state->getValue('booking_type'))
      ->set('jours', $form_state->getValue('jours'))
      ->set('reduction', $form_state->getValue('reduction'))
      ->set('months_number', $form_state->getValue('months_number'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
