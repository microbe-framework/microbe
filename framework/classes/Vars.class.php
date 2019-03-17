<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Vars.class.php
 *     Class: Vars
 *     About: Application variables
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

class Vars extends Params
{
    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Application facade instance
     * @var Application
     */
    public function getApp() {
        return $this->app;
    }

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create a Vars instance
     * Vars are application variables
     * @param Application $app The application instance
     * @return Vars
     */
    public function __construct($app) {
    //  parent::__construct();
        $this->init($app);
    }

    /**************************************************************************/
    // Init

    /**
     * Vars instance variables initializer
     * @param Application $app The application instance
     * @return void
     */
    protected function init($app) {
        $this->app = $app;
    }
    
    /**************************************************************************/    
}