<?php
namespace Drupal\fakeu_d7migrate\Plugin\migrate\process;

use Drupal\Core\Database\Database;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Maps D7 location values to D8 address field in event.
 *
 * Example:
 *
 * @code
 * process:
 *   field_address:
 *     plugin: location_to_address
 *     source: nid
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "location_to_address_field"
 * )
 */
class LocationToAddressField extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // $value is the nid for the event.
    $nid = $value;

  // Connect to the database defined by key 'migrated7'.
  $db = Database::getConnection('default', 'migrated7');
  $lid = $db->select('location_instance', 'i')
	  ->where('i.nid = ' . $nid)
	  ->fields('i', [
	  'lid',
   ])
   ->execute()
   ->fetchAssoc();

    //TEST CASE - commenting out above and using this instead worked
   // $lid = 152;
   // $lid['lid']

// it is an array unless it is empty
//    if (is_array($lid)) {
//     return "array";
//   }
//   else {
//     return(trim($lid));
//   }

// if (is_string($lid['lid'])) {
//          return $lid['lid']; --> if there is a value
//        }
//        else {
//          return "not string";  --> if it is empty
//        }

    if(empty($lid['lid']))
            { return "";}

    // Connect to the database defined by key 'migrated7'.
    $db = Database::getConnection('default', 'migrated7');
    $location = $db->select('location', 'l')
    ->where('l.lid = ' . $lid['lid'])
    ->fields('l', [
        'name',
        'street',
        'additional',
        'city',
        'province',
        'postal_code',
        'country',
    ])
    ->execute()
    ->fetchAssoc();


    //it is a string to go into value
   $address  = $location['name'];
   if(isset($location['street']) && ($location['street'] != "")){
      $address .= "\n".$location['street'];
   }
   if(isset($location['additional']) && ($location['additional'] != "")){
    $address .= "\n".$location['additional'];
 }

  $cityline = "\n";

   if(isset($location['city']) && ($location['city'] != "")){
     $cityline .= $location['city'];
   }

   if(isset($location['province']) && ($location['province'] != "")){
    $cityline .= ", ".$location['province'];
  }

  if(isset($location['postal_code']) && ($location['postal_code'] != "")){
    $cityline .= " ".$location['postal_code'];
  }
  //do not do the empty ones
  if($cityline != "\n"){
    $address .= $cityline;
  }
   //$address .= "\n".$location['city'].", ".$location['province']." ".$location['postal_code'];
   return $address;
   
    
  }

}
