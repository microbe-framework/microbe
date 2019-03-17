<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.1
 *    Module: index.php
 *     Class:
 *     About: Application entry point
 *     Begin: 2017/05/01
 *   Current: 2019/03/17
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
// Error handling
// [!] Disable error reporting for prodaction site

ini_set('display_startup_errors',1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

/******************************************************************************/
// Loader
// Place Your classes files in './application/' directory
// Add path to Your classes in './application/AppLoader.class.php'

// Required path to framework classes loader
require_once './framework/classes/Loader.class.php';

// Path to application classes loader (optional)
require_once('./application/AppLoader.class.php');

/******************************************************************************/
// Application

Microbe\Application::execute();

/******************************************************************************/