<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Registry.class.php
 *     Class: Registry
 *     About: Registry class for application objects storage (singleton)
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

namespace Microbe;

class Registry extends Collection
{
    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     * @var Application
     */
    protected $app = null;

    /**************************************************************************/
    // Accessors

    /**
     * Get framework facade class Application instance
     * @return Application
     */
    public function getApp() {
        return $this->app;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Registry instance
     * @param Application $app The application instance
     * @return Registry
     */
    public function __construct($app) {
        $this->init($app);
    }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    /**
     * Registry instance variables initializer
     * @param Application $app The application instance
     * @return void
     */
    protected function init($app) {
        $this->app = $app;
    }

    /**************************************************************************/
}

/******************************************************************************/