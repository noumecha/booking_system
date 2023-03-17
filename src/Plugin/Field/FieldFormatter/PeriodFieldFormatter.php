<?php

namespace Drupal\booking_system\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "period_formatter",
 *   label = @Translation("Random text"),
 *   field_types = {
 *     "period_type"
 *   }
 * )
 **/

class PeriodFieldFormatter extends FormatterBase 
{
    /**
    *
    * {@inheritdoc}
    */
    public static function defaultSettings() {
        return [ // Implement default settings.
        ] + parent::defaultSettings();
    }

    /**
    *
    * {@inheritdoc}
    */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        return [ // Implement settings form.
        ] + parent::settingsForm($form, $form_state);
    }

    /**
    * {@inheritdoc}
    */
    public function settingsSummary() {
        $summary = [];
        //$summary[] = $this->t('Displays the random string.');
        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];    
        foreach ($items as $delta => $item) {
            // Render each element as markup.
            $element[$delta] = ['#markup' => $item->value];
        } 
        return $element;
    }
}