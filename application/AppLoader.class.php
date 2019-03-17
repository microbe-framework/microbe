<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: AppLoader.class.php
 *     Class: AppLoader
 *     About: Application classes loader
 *     Begin: 2019/03/13
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

use Microbe\Loader;

class AppLoader
{
    /**************************************************************************/
    // Define a path to Your own classes

    /**
     * Associative array with classnames as keys and paths to files with classes
     * @var string[] $classes
     */
    public static $classes = array(

        // Application classes
        "AppLoader" => "./application/AppLoader.class.php",

        // Routers
        "AppRouter" => "./application/routers/AppRouter.class.php",

        // Models
        "AppModel"  => "./application/models/AppModel.class.php",

        // Views
        "AppView" => "./application/views/AppView.class.php",

        // Controllers
        "AppController" => "./application/controllers/AppController.class.php",
        
    //  "" => "./application/.class.php",

    );

    /**************************************************************************/

    /**
     * Init AppLoader class
     * Adds AppLoader::classes to Microbe\Loader::classes
     * @return void
     */
    public static function init() {
    	Loader::$classes = array_merge(Loader::$classes, self::$classes);
    }

    /**************************************************************************/
}

/******************************************************************************/

AppLoader::init();

/******************************************************************************/