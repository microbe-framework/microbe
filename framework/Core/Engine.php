<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Engine.php
 *     Class: Engine
 *     About: Application data process and render engine
 *     Begin: 2019/03/24
 *   Current: 2019/03/27
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

use \Microbe\Library\Arrays;

class Engine
{
    /**************************************************************************/
    // Render methods
    // Enum is better then constants

    // No render
    const METHOD_NONE                   = 0x00;

    // Render a views by controller
    const METHOD_VIEW                   = 0x01;
    
    // Render layout indirect
    const METHOD_LAYOUT                 = 0x02;
    
    // Render template indirect
    const METHOD_TEMPLATE               = 0x03;

    // Render get data request
    const METHOD_GET                    = 0x04;

    // Render post data request
    const METHOD_POST                   = 0x05;

    // Render json data request
    const METHOD_JSON                   = 0x06;

    // Render xml data request
    const METHOD_XML                    = 0x07;

    /**************************************************************************/
    // Renderer classes

    public static $classes = array(
        self::METHOD_NONE               => null,
        self::METHOD_VIEW               => '\Microbe\Core\ViewRenderer',
        self::METHOD_LAYOUT             => '\Microbe\Core\LayoutRenderer',
        self::METHOD_TEMPLATE           => '\Microbe\Core\TemplateRenderer',
    //  self::METHOD_GET                => '\Microbe\Core\GetRenderer',
        self::METHOD_POST               => '\Microbe\Core\PostRenderer',
        self::METHOD_JSON               => '\Microbe\Core\JsonRenderer',
        self::METHOD_XML                => '\Microbe\Core\XmlRenderer',
    );

    /**************************************************************************/
    // Instance variables

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
     * Get framework facade class Application instance
     *
     * @return Application
     */
    public function &getApp() {
        return $this->app;
    }

    /**************************************************************************/

    /**
     * Process a data request
     * Detect a rendering method by router and render a response
     *
     * @param Application app
     * @return void
     */
    public function __construct(&$app) {

        $this->app = &$app;

        $this->request();
        $this->response();
    }

    /**************************************************************************/
    // Detect a method
    /**************************************************************************/

    /**
     * Detect a method by router
     *
     * @return int
     */
    protected function getInputMethod() {

        if (count($_POST))
            return self::METHOD_POST;

        if (count($_GET))
            return self::METHOD_GET;

        return self::METHOD_NONE;
    }

    /**************************************************************************/

    /**
     * Detect a method by router
     *
     * @return int
     */
    protected function getOutputMethod() {

        $router = &$this->app->getRouter();

        if ($router->getControllerName())
            return self::METHOD_VIEW;

        if ($router->getLayoutName())
            return self::METHOD_LAYOUT;

        if ($router->getTemplateName())
            return self::METHOD_TEMPLATE;

        return self::METHOD_NONE;
    }

    /**************************************************************************/ 

    /**
     * Return a renderer class name by method
     *
     * @param int $method
     * @return string
     */
    public function getClass($method) {
        return Arrays::get(self::$classes, $method);
    }

    /**************************************************************************/
    // Process request
    /**************************************************************************/

    /**
     * Process a data request
     *
     * @return void
     */
    public function request() {
        $method = $this->getInputMethod();
        if ($class = $this->getClass($method)) {
            new $class($this->app);
        }
    }

    /**************************************************************************/
    // Render response
    /**************************************************************************/

    /**
     * Detect a rendering method by router and run renderer
     * Handle a routing rule
     * Do one of the following:
     * - Create controller and call controller action method
     * - Render a response by $layourName directly (without controller)
     * - Render a response by $templateName directly (without controller)
     *
     * @return void
     */
    public function response() {
        $method = $this->getOutputMethod();
        if ($class = $this->getClass($method)) {
            new $class($this->app);
        }
    }

    /**************************************************************************/
}

/******************************************************************************/