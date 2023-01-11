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
    $config = $this->config('booking_system.settings')->getRawData();
    dump($config);
    /* You will need additional form elements for your custom properties. */
    $jours = \Drupal\booking_system\DaysSettingsInterface::jours;
    //dump($jours);
    /*if (!empty($this->config('booking_system.settings')->get('jours'))) {
      $jours = $this->config('booking_system.settings')->get('jours');
    }*/
    $form['jours'] = [
      '#type' => 'fieldset',
      '#title' => 'Configuration des dates',
      '#tree' => TRUE
    ];
    // boucles pour l'affichage des élemntes des jours
    foreach ($jours as $i => $val) {
      //dump($jours);
      // display the dropdown
      $form['jours'][$i] = [
        "#type" => 'details',
        '#title' => $val['label'],
        '#open' => false
      ];
      // label
      $form['jours'][$i]['label'] = [
        "#type" => 'textfield',
        '#title' => 'Label',
        '#default_value' => $val['label']
      ];
      // status
      $form['jours'][$i]['status'] = [
        "#type" => 'checkbox',
        '#title' => 'Status',
        '#default_value' => isset($config['jours'][$i]['status']) ? $config['jours'][$i]['status'] : $val['status']
      ];
      // periodes
      $form['jours'][$i]['periodes'] = [
        '#type' => 'fieldset',
        '#title' => 'Configuration des périodes',
        '#tree' => TRUE
      ];
      // boucles pour les periodes 
      $periods = $jours[$i]['periodes'];
      //dump($periods);
      foreach ($periods as $j => $period) {
        // dropdown activation
        $form['jours'][$i]['periodes'][$j] = [
          "#type" => 'details',
          '#title' => $period['label'],
          '#open' => false
        ];
        // label
        $form['jours'][$i]['periodes'][$j]['label'] = [
          "#type" => 'textfield',
          '#title' => 'Label',
          '#default_value' => $period['label']
        ];
        // status
        $form['jours'][$i]['periodes'][$j]['status'] = [
          "#type" => 'checkbox',
          '#title' => 'Status',
          '#default_value' => $period['status']
        ];
        // heure de but
        $form['jours'][$i]['periodes'][$j]['h_d__m_d'] = [
          "#type" => 'textfield',
          '#title' => 'Heure debut',
          '#default_value' => $period['h_d'] . ':' . $period['m_d']
        ];
        // heure de but
        $form['jours'][$i]['periodes'][$j]['h_f__m_f'] = [
          "#type" => 'textfield',
          '#title' => 'Heure de fin',
          '#default_value' => $period['h_f'] . ':' . $period['m_f']
        ];
        // decallage : 
        $form['jours'][$i]['periodes'][$j]['decallage']  = [
          '#type' => 'number',
          '#title' => "Valeur de la reduction",
          '#default_value' => $period['decallage']
        ];
        // intervalle : 
        $form['jours'][$i]['periodes'][$j]['intervalle']  = [
          '#type' => 'number',
          '#title' => "Valeur de la reduction",
          '#default_value' => $period['intervalle']
        ];
      }
    }
    $form['reduction'] = [
      '#type' => 'number',
      '#title' => "Valeur de la reduction",
      '#default_value' => $this->config('booking_system.settings')->get('reduction')
    ];
    $form['number_of_days'] = [
      '#type' => 'number',
      '#title' => "Nombre de mois à afficher",
      '#default_value' => $this->config('booking_system.settings')->get('number_of_days')
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
      ->set('jours', $form_state->getValue('jours'))
      ->set('reduction', $form_state->getValue('reduction'))
      ->set('number_of_days', $form_state->getValue('number_of_days'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
