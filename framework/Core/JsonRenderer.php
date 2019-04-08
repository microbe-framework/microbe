<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: JsonRenderer.php
 *     Class: JsonRenderer
 *     About: Application controller json data processing class
 *     Begin: 2019/03/26
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

class JsonRenderer extends Renderer
{
    /**************************************************************************/

    /**
     * Setup renderer variables
     *
     * @return void
     */
    protected function setup()
    {
    //  $this->controllerName = $_POST['controller'];
    //  $this->actionName = $_POST['action'];
    //  $this->params = array($_POST); // <= wrap up $params
    }

    /**************************************************************************/

    /**
     * Render an output
     *
     * @return void
     */
    protected function render() {
        $this->runController();
    }

    /**************************************************************************/
}

/******************************************************************************/