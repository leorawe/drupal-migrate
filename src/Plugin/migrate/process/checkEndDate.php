<?php
namespace Drupal\fakeu_d7migrate\Plugin\migrate\process;

use Drupal\Core\Database\Database;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Compare start with end date. If start === end, make end date empty.
 *
 * Example:
 *
 * @code
 * process:
 *   field_end_date_time:
 *     plugin: check_end_date
 *     source: field_date
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "check_end_date"
 * )
 */
class checkEndDate extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
  //  $fakedate = "3333-02-09 02:00:00";

   $empty_date = "";
   if (!is_array($value)) {
    throw new MigrateException(sprintf('Merge process failed for destination property (%s): input is not an array.', $destination_property));
    }

    if($value['value']===$value['value2']){
        //return $fakedate;
        return;
    }
    else {
      $new_date = date("Y-m-d\TH:i:s", strtotime($value['value2']));
      return $new_date;
    }
  }
}