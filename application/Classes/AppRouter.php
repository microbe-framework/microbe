<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.2
 *    Module: AppRouter.php
 *     Class: AppRouter
 *     About: AppRouter sample
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

class AppRouter extends Microbe\RouterEx
{
    /**************************************************************************/
    // Filters
    /**************************************************************************/
    // Action MUST be valid filter action
    // WARNING:
    // If exists file '/config/routes.json'
    // then all those rules will be overriden

    /**
     * Routing filters
     * Can be overriden by configuration routing rules file (high priority)
     * Override predecessors (Router, RouterEx) $filters
     * @var string[][] $filters
     */
    protected $filters = array(
    );

    /**************************************************************************/
    // Rules
    /**************************************************************************/
    // Here override basic rules to Your custom
    // Controller name MUST begins from low case letter
    // Action name MUST begins from low case letter
    // Params (if exists) MUST be associative array
    // WARNING:
    // If exists file '/config/routes.json'
    // then all those rules will be overriden

    /**
     * Routing rules
     * Can be overriden by configuration routing rules file (high priority)
     * Override predecessors (Router, RouterEx) $routes
     * @var string[][] $routes
     */
    protected $routes = array(
    );

    /**************************************************************************/
    // Pre routing and post routing functions

    /**
     * Actions before routing
     * Override predecessors (Router, RouterEx) methods
     * @return void
     */
    protected function before() {
        // Place Your code here
    }

    /**
     * Actions after routing
     * Override predecessors (Router, RouterEx) methods
     * @return void
     */
    protected function after() {
        // Place Your code here
    }

    /**************************************************************************/
}

/******************************************************************************/