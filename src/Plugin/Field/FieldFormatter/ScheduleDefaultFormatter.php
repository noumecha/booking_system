<?php

/**
 * @file
 * Contains \Drupal\booking_system\Plugin\field\formatter\ScheduleDefaultFormatter.
 */

namespace Drupal\booking_system\Plugin\Field\FieldFormatter;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'snippets_default' formatter.
 *
 * @FieldFormatter(
 *   id = "schedule_default",
 *   label = @Translation("Schedule default"),
 *   field_types = {
 *     "schedule"
 *   }
 * )
 */
class ScheduleDefaultFormatter extends FormatterBase
{

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $elements = [];
        foreach ($items as $delta => $item) {
            $startDate = '';
            if (!empty($item->date_debut)) {
                $startDate = DrupalDateTime::createFromTimestamp($item->startDate);
                $startDate = $startDate->format("y-m-d");
            }

            $endDate = '';
            if (!empty($item->date_fin)) {
                $endDate = DrupalDateTime::createFromTimestamp($item->endDate);
                $endDate = $endDate->format("y-m-d");
            }

            // Render output using schedule_default theme.
            $source = [
                '#theme' => 'schedule_default',
                '#start_hour' => $item->start_hour,
                '#end_hour' => $item->end_hour,
                '#start_date' => $startDate,
                '#end_date' => $endDate,
                '#discount' => $item->discount,
                '#status' => $item->status,
            ];

            $elements[$delta] = ['#markup' => \Drupal::service('renderer')->render($source)];
        }

        return $elements;
    }
}
