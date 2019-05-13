<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: PostRenderer.php
 *     Class: PostRenderer
 *     About: Application controller data processing class
 *     Begin: 2019/03/25
 *   Current: 2019/03/29
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

class PostRenderer extends Renderer
{
     /**************************************************************************/

    /**
     * Setup renderer variables
     *
     * @return void
     */
    protected function setup()
    {
        $this->controllerName = $_POST['controller'];
        $this->actionName     = $_POST['action'];
        $this->params         = array($_POST); // <= wrap up $params
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