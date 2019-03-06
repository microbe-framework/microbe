<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.0
 *    Module: loader.inc.php
 *     Class: 
 *     About: application loader sample
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/microbe/
 ******************************************************************************/

/******************************************************************************
 *            This file is part of the Microbe PHP Framework.                 *
 *                                                                            *
 *         Copyright (c) 2017-2018 Microbe PHP Framework author               *
 *                  <microbe-framework@protonmail.com>                        *
 *                                                                            *
 *            For the full copyright and license information,                 *
 *                     please view the LICENSE file                           *
 *              that was distributed with this source code.                   *
 ******************************************************************************/

/******************************************************************************/

// README: Place Your relative path from application root to loader here!
//$dir = rtrim(__DIR__, '/application');
//$dir = '/var/www/microbe.lan/public';
$dir = substr(__DIR__, 0, -1 * strlen('/application'));

//echo __DIR__;
//echo $dir;
//exit();
 
// Microbe PHP Library
require_once($dir.'/framework/library/Base.class.php');
require_once($dir.'/framework/library/Path.class.php'); // ???
require_once($dir.'/framework/library/Url.class.php'); // ???
require_once($dir.'/framework/library/Collection.class.php'); // ???
require_once($dir.'/framework/library/Params.class.php'); // ???
require_once($dir.'/framework/library/Debug.class.php'); // ???
require_once($dir.'/framework/library/Http.class.php'); // ???

// Microbe PHP Framework
require_once($dir.'/framework/classes/Config.class.php'); // ???
//require_once($dir.'/framework/classes/Registry.class.php');
//require_once($dir.'/framework/classes/Globals.class.php');
require_once($dir.'/framework/classes/Router.class.php');
require_once($dir.'/framework/classes/RouterEx.class.php'); // ???
require_once($dir.'/framework/classes/View.class.php');
require_once($dir.'/framework/classes/Controller.class.php');
require_once($dir.'/framework/classes/Application.class.php');

// Application
require_once('AppRouter.class.php');
//require_once('AppView.class.php');
require_once('AppController.class.php');

/******************************************************************************/