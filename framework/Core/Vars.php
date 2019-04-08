<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Vars.php
 *     Class: Vars
 *     About: Application variables
 *     Begin: 2017/05/01
 *   Current: 2019/04/02
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

namespace Microbe\Core;

class Vars extends \Microbe\Library\Params
{
    /**************************************************************************/

    /**
     * Application facade instance
     *
     * @var Application
     */
    protected $app                      = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Application facade instance
     *
     * @var Application
     */
    public function &getApp() {
        return $this->app;
    }

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create a Vars instance
     * Vars are application variables
     * Load Vars from file by $path if defined
     *
     * @param Application $app The application instance
     * @param string $path The application variables file path
     * @return Vars
     */
    public function __construct(&$app, $path = null) {
    //  parent::__construct();

        $this->app = &$app;

        $this->loadFromFileEx($path);
    }

    /**************************************************************************/    
}

/******************************************************************************/