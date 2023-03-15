<?php

namespace Drupal\booking_system\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\booking_system\StepsSettingsInterface;

/**
 * Configure booking_system translate settings for this site.
 */
class SettingsTranslateForm  extends ConfigFormBase implements StepsSettingsInterface
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'booking_system_translate_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['booking_system_translate.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('booking_system_translate.settings')->getRawData();
    //load default configuration from the settings interface
    $default_config = \Drupal\booking_system\StepsSettingsInterface::DEFAULT_CONFIG;

    $form['tabs'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Steps Configuration'),
      '#default_tab' => 'edit-publication',
    ];

    $form['steps_labels'] = [
      '#type' => 'details',
      '#title' => t('titles configurations'),
      '#group' => 'tabs',
      '#tree' => True,
    ];

    foreach ($default_config['steps_labels'] as $index => $value) {
      $form['steps_labels'][$index] = [
        '#type' => 'details',
        '#title' => $index,
        '#tree' => True,
      ];
      $form['steps_labels'][$index]['name'] = [
        '#type' => 'textfield',
        '#title' => t('label'),
        '#default_value' => isset($config['steps_labels'][$index]['name']) ? $config['steps_labels'][$index]['name'] : $value['name'],
      ];
      $form['steps_labels'][$index]['title'] = [
        '#type' => 'textfield',
        '#title' => t('label'),
        '#default_value' => isset($config['steps_labels'][$index]['title']) ? $config['steps_labels'][$index]['title'] : $value['title'],
      ];
    }

    //Configurations tab1 (step1) start 
    $form['tab1'] = [
      '#type' => 'details',
      '#title' => t('calendar configuration'),
      '#group' => 'tabs',
      '#tree'  => True,
    ];
    $form['tab1']['months_config'] = [
      '#type' => 'details',
      '#title' => 'Months configurations',
      '#tree' => TRUE
    ];
    for ($i = 0; $i < sizeof($default_config['months_config']); $i++) {
      $form['tab1']['months_config'][$i] = [
        '#type' => 'textfield',
        '#title' => t('label month ' . $i),
        '#default_value' => isset($config['tab1']['months_config'][$i]) ? $config['tab1']['months_config'][$i] : $default_config['months_config'][$i],
      ];
    }
    $form['tab1']['weeks_config'] = [
      '#type' => 'details',
      '#title' => 'Weeks configurations',
      '#tree' => TRUE
    ];
    for ($i = 0; $i < sizeof($default_config['weeks_config']); $i++) {
      $form['tab1']['weeks_config'][$i] = [
        '#type' => 'textfield',
        '#title' => t('label'),
        '#default_value' => isset($config['tab1']['weeks_config'][$i]) ? $config['tab1']['weeks_config'][$i] : $default_config['weeks_config'][$i],
      ];
    }
    $form['tab1']['labels_config'] = [
      '#type' => 'details',
      '#title' => 'Calendar Labels',
      '#tree' => TRUE
    ];
    foreach ($default_config['labels_config'] as $index => $value) {
      $form['tab1']['labels_config'][$index] = [
        '#type' => 'textfield',
        '#title' => t($index),
        '#default_value' => isset($config['tab1']['labels_config'][$index]) ? $config['tab1']['labels_config'][$index] : $value,
      ];
    }

    //configuration de l'onglet rapports(tab4)
    $form['report'] = [
      '#type' => 'details',
      '#title' => t('Report Configs'),
      '#group' => 'tabs',
      '#tree'  => True,
    ];
    foreach ($default_config['report_configs']['messages'] as $index => $value) {
      $form['report'][$index] = [
        '#type' => 'details',
        '#title' => $index . ' Configs',
        '#tree'  => True,
      ];
      $form['report'][$index]['message'] = [
        '#type' => 'textfield',
        '#title' => $index . ' Configs message',
        '#default_value' => isset($config['report'][$index]['message']) ? $config['report'][$index]['message'] : $value['message'],
      ];
      $form['report'][$index]['resume'] = [
        '#type' => 'textfield',
        '#title' => $index . ' Configs resume',
        '#default_value' => isset($config['report'][$index]['resume']) ? $config['report'][$index]['resume'] : $value['resume'],
      ];
    }
    $form['report']['call_to_action'] = [
      '#type' => 'textfield',
      '#title' => t('call_to_action'),
      '#default_value' => isset($config['report']['call_to_action']) ? $config['report']['call_to_action'] : $default_config['report_configs']['call_to_action'],
    ];
    $form['report']['user_state'] = [
      '#type' => 'details',
      '#title' => t('user_state'),
      '#tree' => True,
    ];
    $form['report']['user_state']['online'] = [
      '#type' => 'textfield',
      '#title' => t('user_state_online'),
      '#default_value' => isset($config['report']['user_state']) ? $config['report']['user_state'] : $default_config['report_configs']['user_state']['online'],
    ];
    $form['report']['user_state']['offline'] = [
      '#type' => 'textfield',
      '#title' => t('user_state_offline'),
      '#default_value' => isset($config['report']['user_state']) ? $config['report']['user_state'] : $default_config['report_configs']['user_state']['offline'],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    /*if ($form_state->getValue('example') != 'example') {
      $form_state->setErrorByName('example', $this->t('The value is not correct.'));
    }*/
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('booking_system_translate.settings')
      ->set('steps_labels', $form_state->getValue('steps_labels'))
      ->set('tab1', $form_state->getValue('tab1'))
      ->set('report', $form_state->getValue('report'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
