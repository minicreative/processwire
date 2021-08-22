<?php namespace ProcessWire;

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 * 
 * SECURITY NOTICE
 * In non-dedicated environments, you should lock down the permissions of this file so
 * that it cannot be seen by other users on the system. For more information, please
 * see the config.php section at: https://processwire.com/docs/security/file-permissions/
 * 
 * This file is licensed under the MIT license
 * https://processwire.com/about/license/mit/
 *
 * ProcessWire 3.x, Copyright 2019 by Ryan Cramer
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

/** @var Config $config */

/**
 * Allow core API variables to also be accessed as functions?
 *
 * Recommended. This enables API varibles like $pages to also be accessed as pages(),
 * as an example. And so on for most other core variables.
 *
 * Benefits are better type hinting, always in scope, and potentially shorter API calls.
 * See the file /wire/core/FunctionsAPI.php for details on these functions.
 *
 * @var bool
 *
 */
$config->useFunctionsAPI = true;


/*** INSTALLER CONFIG ********************************************************************/


/**
 * Installer: Database Configuration
 * 
 */
$config->dbHost = getenv("PW_DB_HOST");
$config->dbName = getenv("PW_DB_NAME");
$config->dbUser = getenv("PW_DB_USER");
$config->dbPass = getenv("PW_DB_PASS");
if (getenv("PW_DB_PORT") !== false) {
    $config->dbPort = getenv("PW_DB_PORT");
} else {
    $config->dbPort = '3306';
}


/**
 * Installer: User Authentication Salt 
 * 
 * This value was randomly generated for your system on 2021/08/22.
 * This should be kept as private as a password and never stored in the database.
 * Must be retained if you migrate your site from one server to another.
 * Do not change this value, or user passwords will no longer work.
 * 
 */
$config->userAuthSalt = getenv("PW_USER_AUTH_SALT");; 

/**
 * Installer: Table Salt (General Purpose) 
 * 
 * Use this rather than userAuthSalt when a hashing salt is needed for non user 
 * authentication purposes. Like with userAuthSalt, you should never change 
 * this value or it may break internal system comparisons that use it. 
 * 
 */
if (getenv("PW_TABLE_SALT") !== false) {
    $config->tableSalt = getenv("PW_TABLE_SALT"); 
}

/**
 * Installer: File Permission Configuration
 * 
 */
$config->chmodDir = '0755'; // permission for directories created by ProcessWire
$config->chmodFile = '0644'; // permission for files created by ProcessWire 

/**
 * Installer: Time zone setting
 * 
 */
if (getenv("PW_TIMEZONE") !== false) {
    $config->timezone = getenv("PW_TIMEZONE");
} else {
    $config->timezone = 'UTC';
}

/**
 * Installer: Admin theme
 * 
 */
$config->defaultAdminTheme = 'AdminThemeUikit';

/**
 * Installer: Unix timestamp of date/time installed
 * 
 * This is used to detect which when certain behaviors must be backwards compatible.
 * Please leave this value as-is.
 * 
 */
if (getenv("PW_INSTALLED") !== false) {
    $config->installed = intval(getenv("PW_INSTALLED"));
} else {
    $config->installed = 1629641518;
}

/**
 * Installer: HTTP Hosts Whitelist
 * 
 */
if (getenv("PW_HTTP_HOST") !== false && getenv("PW_HTTP_HOST_ALT") !== false) {
    $config->httpHosts = array(getenv("PW_HTTP_HOST"), getenv("PW_HTTP_HOST_ALT"));
} else if (getenv("PW_HTTP_HOST") !== false) {
    $config->httpHosts = array(getenv("PW_HTTP_HOST"));
} else {
    $config->httpHosts = array('localhost');
}

/**
 * Installer: Debug mode?
 * 
 * When debug mode is true, errors and exceptions are visible. 
 * When false, they are not visible except to superuser and in logs. 
 * Should be true for development sites and false for live/production sites. 
 * 
 */
if (getenv("PW_DEBUG") == "true") {
    $config->debug = true;
} else {
    $config->debug = false;
}


