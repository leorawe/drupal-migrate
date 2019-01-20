# Fake University Drupal 7 to 8 migration module

Modified version of module used in a university Drupal 7 to Drupal 8 migration.  Parts are yml files, parts are php code. 

## fakeu_d7migrate.info.yml - the Basic Information
This is a module that needs to be included with other migration modules in order to work. It migrates Contacts content type and Events content type.

## migrate_plus.migration_group.content_d7.yml
This is the group yml file - has information about the group as a whole.  The migration is from a Drupal 7 database into a Drupal 8 database.

## migrate_plus.migration.d7_contacts.yml  
Before doing the Contacts migration, one must do the Departments (depts.yml) migration.  The Drupal 7 contacts had the machine name of facultystaff - this gets updated to a new Drupal 8 machine name of contact_information.

