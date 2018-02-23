<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.0
 *    Module: index.php
 *     Class:
 *     About: Application entry point
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
// Error handling

ini_set('display_startup_errors',1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

/******************************************************************************/
// Require

//require_once('./library/load.inc.php');
//require_once('./classes/load.inc.php');
require_once('./application/load.inc.php');

/******************************************************************************/
// Application

Application::execute();

/******************************************************************************/