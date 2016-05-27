<?php
/**
 * This file contains an example of base setup for the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
//exit('COMMENT ME TO TEST THE EXAMPLES!');
 
// require the autoloader class
require_once dirname(__FILE__) . '/MailWizzApi/Autoloader.php';

// register the autoloader.
MailWizzApi_Autoloader::register();

// if using a framework that already uses an autoloading mechanism, like Yii for example, 
// you can register the autoloader like:
// Yii::registerAutoloader(array('MailWizzApi_Autoloader', 'autoloader'), true);

/**
 * Notes: 
 * If SSL present on the webhost, the api can be accessed via SSL as well (https://...).
 * A self signed SSL certificate will work just fine.
 * If the MailWizz powered website doesn't use clean urls, 
 * make sure your apiUrl has the index.php part of url included, i.e: 
 * http://www.mailwizz-powered-website.tld/api/index.php
 * 
 * Configuration components:
 * The api for the MailWizz EMA is designed to return proper etags when GET requests are made.
 * We can use this to cache the request response in order to decrease loading time therefore improving performance.
 * In this case, we will need to use a cache component that will store the responses and a file cache will do it just fine.
 * Please see MailWizzApi/Cache for a list of available cache components and their usage.
 */



// start UTC
date_default_timezone_set('Asia/Ho_Chi_Minh');
