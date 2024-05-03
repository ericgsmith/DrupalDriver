<?php

namespace Drupal\Driver\Fields\Drupal8;

/**
 * Daterange field handler for Drupal 8.
 */
class DaterangeHandler extends DatetimeHandler {

  /**
   * {@inheritdoc}
   */
  public function expand($values) {
    $return = [];

    foreach ($values as $value) {
      // Value will be a string if only 1 value is provided without date
      // properties.
      if (!is_array($value)) {
        $value = ['value' => $value];
      }
      // Allow date ranges properties to be specified either explicitly,
      // or implicitly by array position.
      if (!isset($value['value']) && isset($value[0])) {
        $value['value'] = $value[0];
      }
      if (!isset($value['end_value'])) {
        if (isset($value[1])) {
          $value['end_value'] = $value[1];
        }
      }

      // Filter out NULL values to allow end value to be optional.
      $return[] = parent::expand(array_filter($value));
    }

    return $return;
  }

}
