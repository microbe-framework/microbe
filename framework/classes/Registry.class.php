<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Registry.class.php
 *     Class: Registry
 *     About: Registry class for store application objects 
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

class Registry extends Collection
{
    /**************************************************************************/
    // Class variables

    private static $instance = null;

    /**************************************************************************/
    // Instance variables

    protected $app = null;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    private function __construct($app) {
        $this->init($app);
    }

    private function __clone() {
    }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    protected function init($app) {
        $this->app = $app;
    }

    /**************************************************************************/
    // Singleton
    /**************************************************************************/

    public static function create($app)
    {
        if (self::$instance == null) {
            self::$instance = new self($app);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/******************************************************************************/