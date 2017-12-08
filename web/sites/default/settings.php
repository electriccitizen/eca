<?php

/**
 * Load services definition file.
 */
# $settings['container_yamls'][] = __DIR__ . '/services.yml';



/**
 * Place the config directory outside of the Drupal root.
 */
$config_directories = array(
  CONFIG_SYNC_DIRECTORY => dirname(DRUPAL_ROOT) . '/config',
);

/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * Always install the 'standard' profile to stop the installer from
 * modifying settings.php.
 *
 * See: tests/installer-features/installer.feature
 */

/* CI TOKEN: f510a1a570e64a13ee5c83b020583cdc17f4d08d */

$conf['install_profile'] = 'oc';




/**
 * @file
 * Main settings file.
 */

$databases = array();
$config_directories = array();
$secrets_directory = $app_root . '/' . $site_path;
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['entity_update_batch_size'] = 50;

// Get Acquia database settings.
if (file_exists('/var/www/site-php')) {
  require '/var/www/site-php/electriccitizen/electriccitizen-settings.inc';
}

if (isset($_ENV['AH_SITE_ENVIRONMENT'])) {
  $secrets_directory = '/mnt/gfs/home/' . '/' . $_ENV['AH_SITE_GROUP'] . '/' . $_ENV['AH_SITE_ENVIRONMENT'] . '/nobackup';
}

if (file_exists($secrets_directory . '/settings.secrets.php')) {
  require $secrets_directory . '/settings.secrets.php';
}

$config_directories['sync'] = $app_root . '/../config/';

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
