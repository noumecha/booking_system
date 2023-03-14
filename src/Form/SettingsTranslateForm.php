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
    /* You will need additional form elements for your custom properties. */
    $jours = \Drupal\booking_system\DaysSettingsInterface::DAYS;
    $default_config = \Drupal\booking_system\StepsSettingsInterface::DEFAULT_CONFIG;
    //dump($jours);
    /*if (!empty($this->config('booking_system.settings')->get('jours'))) {
      $jours = $this->config('booking_system.settings')->get('jours');
    }*/
    //Configurations steps
    $form['tabs'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Configurations des étapes'),
      '#default_tab' => 'edit-publication',
    ];

    $form['tab0'] = [
      '#type' => 'details',
      '#title' => t('titles configurations'),
      '#group' => 'tabs',
      '#tree' => True,
    ];

    foreach ($default_config['steps_labels'] as $index => $value) {
      $form['tab0'][$index] = [
        '#type' => 'textfield',
        '#title' => $index,
        '#default_value' => isset($config['tab0'][$index]) ? $config['tab0'][$index] : $value,
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
    for ($i = 0; $i < sizeof($default_config['months']); $i++) {
      $form['tab1']['months_config']['months' . ($i + 1)] = [
        '#type' => 'textfield',
        '#title' => t('label month ' . $i),
        '#default_value' => isset($config['tab1']['months_config']['month' . ($i + 1)]) ? $config['tab1']['months_config']['months' . ($i + 1)] : $default_config['months'][$i],
      ];
    }
    $form['tab1']['weeks_config'] = [
      '#type' => 'details',
      '#title' => 'Weeks configurations',
      '#tree' => TRUE
    ];
    for ($i = 0; $i < sizeof($default_config['week_days']); $i++) {
      $form['tab1']['weeks_config']['day' . ($i + 1)] = [
        '#type' => 'textfield',
        '#title' => t('label'),
        '#default_value' => isset($config['tab1']['weeks_config']['day' . ($i + 1)]) ? $config['tab1']['weeks_config']['day' . ($i + 1)] : $default_config['week_days'][$i],
      ];
    }
    $form['tab1']['labels_config'] = [
      '#type' => 'details',
      '#title' => 'Calendar Labels',
      '#tree' => TRUE
    ];
    foreach ($default_config['labels'] as $index => $value) {
      $form['tab1']['labels_config'][$index] = [
        '#type' => 'textfield',
        '#title' => t($index),
        '#default_value' => isset($config['tab1']['labels_config'][$index]) ? $config['tab1']['labels_config'][$index] : $value,
      ];
    }
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
      ->set('tab0', $form_state->getValue('tab0'))
      ->set('tab1', $form_state->getValue('tab1'))
      ->save();
    dump($form_state->getValue('tab0'));
    parent::submitForm($form, $form_state);
  }
}
