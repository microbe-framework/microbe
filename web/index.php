<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.2
 *    Module: index.php
 *     Class:
 *     About: Application entry point
 *     Begin: 2017/05/01
 *   Current: 2019/03/29
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license 
 *    Source: https://github.com/microbe-framework/microbe/
 ******************************************************************************/

/******************************************************************************
 *            This file is part of the Microbe PHP Framework.                 *
 *                                                                            *
 *         Copyright (c) 2017-2019 Microbe PHP Framework author               *
 *                  <microbe-framework@protonmail.com>                        *
 *                                                                            *
 *            For the full copyright and license information,                 *
 *                     please view the LICENSE file                           *
 *              that was distributed with this source code.                   *
 ******************************************************************************/

/******************************************************************************/
// Bootstap
/******************************************************************************/
// Application constants

const APP_PHP_VERSION_MIN               = 5.3;
const APP_PRODUCTION                    = false;
const APP_ENTRY                         = __DIR__;

/******************************************************************************/
// Detect application root path

//const APP_ENTRY                         = '/web/index.php';
//const APP_ENTRY_LENGTH                  = 14;
//$APP_PATH = substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * APP_ENTRY_LENGTH);

// -4 is minus one multiply on length of '/web'
$APP_PATH = substr(__DIR__, 0, -4);

/******************************************************************************/
// Required version

if (floatval(PHP_VERSION) < APP_PHP_VERSION_MIN) {
    echo 'Required PHP version >= '.APP_PHP_VERSION_MIN;
    exit();
}

/******************************************************************************/
// Error handling

// [!] Disable error reporting for prodaction site
if (APP_PRODUCTION) {
    ini_set('display_startup_errors', 0);
    ini_set('display_errors', 0);
    error_reporting(0);
} else {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(E_ALL | E_STRICT);
}

/******************************************************************************/
// Loader

// Required path to framework classes loader
require($APP_PATH.'/framework/Loader.php');

/******************************************************************************/
// Application

\Microbe\Core\Application::execute();

/******************************************************************************/
