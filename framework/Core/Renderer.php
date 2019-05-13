<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Renderer.php
 *     Class: Renderer
 *     About: Application renderer abstract class
 *     Begin: 2019/03/24
 *   Current: 2019/05/01
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

abstract class Renderer
{
    /**************************************************************************/
    // Variables
    /**************************************************************************/

    /**
     * Application facade instance
     *
     * @var Application $app
     */
    protected $app                      = null;

    /**
     * Application configuration class instance
     *
     * @var Config $config
     */
    protected $config                   = null;

    /**
     * Application router class instance
     *
     * @var Router|RouterEx|AppRouter $router
     */
    protected $router                   = null;

    /**
     * Application views renderer class instance
     *
     * @var View|AppView $view
     */
    protected $view                     = null;

    /**************************************************************************/

    /**
     * Renderer controller name
     *
     * @var string $controllerName
     */
    protected $controllerName          = null;

    /**
     * Renderer controller action name
     *
     * @var string $actionName
     */
    protected $actionName              = null;

    /**
     * Renderer controller parameters
     *
     * @var mixed[] $params
     */
    protected $params                  = [];

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create a Renderer instance
     *
     * @return Renderer
     */
    public function __construct()
    {
        $this->app    = &Registry::getApp();
        $this->config = &$this->app->getConfig();
        $this->router = &$this->app->getRouter();

        $this->setup();                 // <= to override

        $this->render();                // <= to override
    }

    /**************************************************************************/

    /**
     * Setup renderer variables
     *
     * @return void
     */
    abstract protected function setup();

    /**************************************************************************/

    /**
     * Render an output
     *
     * @return void
     */
    abstract protected function render();

    /**************************************************************************/
    // Exit after render

    /**
     * Return true if script work ends
     *
     * @return boolean
     */
    public function getExit() {
        return false;
    }

    /**************************************************************************/
    // View

    /**
     * Create a view by configuration parameter value
     * If exists return existing
     * If configuration parameter not set create default View
     *
     * @return boolean
     */
    public function initView()
    {
        $this->view = &$this->app->initView();
        return $this->view != null;
    }

    /**************************************************************************/
    // Controller
    /**************************************************************************/

    /**
     * Create controller and call controller action method
     *
     * @return void
     */
    public function runController()
    {
    //  assert($controllerName);
    //  assert($actionName);

        $controller = $this->createController($this->controllerName);
        if ($controller == null)
            return;

        $actionMethodName = $this->config->getActionMethodName($this->actionName);
        if (method_exists($controller, $actionMethodName)) {
            call_user_func_array([$controller, $actionMethodName], $this->params);
        }
    }

    /**************************************************************************/

    /**
     * Create an AppController instance
     *
     * @return AppController
     */
    protected function &createAppController() {
        return new AppController();
    }

    /**
     * Create an controller instance by $controllerName
     * Controller must be located in 'application/Controllers' directory
     *
     * [!] Use controller prefefined path '\App\Controllers\'
     * [!] Use controller prefefined path '\Cms\Controllers\'
     * [?] That is not good
     * @return Controller|AppController
     */
    protected function &createController($controllerName)
    {
    //  require_once $this->config->getControllerModule($controllerName);
        $controllerClassName = $this->config->getControllerClassName($controllerName);
        $prefix = $this->app->isCms() ? '\\Cms\\' : '\\App\\';
    //  $controllerClassName = '\\App\\Controllers\\'.$controllerClassName;
        $controllerClassName = $prefix . 'Controllers\\' . $controllerClassName;
    //  return new $controllerClassName($this->app);
    //  echo $controllerClassName; exit;
        return Registry::getObject($controllerClassName);
    }

    /**************************************************************************/ 
}

/******************************************************************************/