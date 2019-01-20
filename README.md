# Fake University Drupal 7 to 8 migration module

Modified version of module used in a university Drupal 7 to Drupal 8 migration.  Parts are yml files, parts are php code. 

## fakeu_d7migrate.info.yml - the Basic Information
This is a module that needs to be included with other migration modules in order to work. It migrates Contacts content type and Events content type.

## migrate_plus.migration_group.content_d7.yml
This is the group yml file - has information about the group as a whole.  The migration is from a Drupal 7 database into a Drupal 8 database.

## migrate_plus.migration.d7_contacts.yml  
Before doing the Contacts migration, one must do the Departments (depts.yml) migration.  The Drupal 7 contacts had the machine name of facultystaff - this gets updated to a new Drupal 8 machine name of contact_information.  
One of the callbacks - the contact categories needed changing.  There is a short function within **fakeu_d7migrate.module** to do this.

## migrate_plus.migration.d7_events.yml  
Events has two parts that must proceed it - event categories and event paragraphs.  The new Drupal 8 site has date/times for the events done with paragraphs, so a special **migrate_plus.migration.d7_evparagraphs.yml** need to be created.  Within this migration there is a function (/src/Plugin/migrate/process/checkEndDate.php) to check if an event has an end date that matches the start date - and it should not do this in Drupal 8, it should be empty instead.  There is also a plugin location_to_address_field (src/Plugin/migrate/process/LocationToAddressField.php) to convert data originally stored in the Location module that needs conversion to be stored in a new text field in Drupal 8.  



