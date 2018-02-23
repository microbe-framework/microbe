<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Application.class.php
 *     Class: Application
 *     About: Application class
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

/******************************************************************************/

class Application
{
    /**************************************************************************/
    // Class variables

    private static $instance            = null;
    
    /**************************************************************************/
    // Instance variables

    protected $root                     = null;
        
    protected $buffer                   = null;

    protected $router                   = null;
    protected $controllerName           = null;
    protected $actionName               = null;
    protected $params                   = null;

    protected $view                     = null;
    
    protected $controller               = null;

    protected $config                   = null;
    
    protected $vars                     = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    public function getBuffer() {
        return $this->buffer;
    }

    public function getRouter() {
        return $this->router;
    }

    public function getView() {
        return $this->view;
    }

    public function getController() {
        return $this->controller;
    }

    /**************************************************************************/

    public function getVars() {
        return $this->vars;
    }

    public function getVar($name) {
        return $this->vars->get($name);
    }

    public function setVar($name, $value) {
        return $this->vars->set($name, $value);
    }

    /**************************************************************************/
    // Controller
    /**************************************************************************/

    public function getControllerName() {
        return $this->controllerName;
    }
    
    public function getControllerClass() {
        return $this->controllerName ? ucfirst($this->controller) : null;
    }

    // Naming convention
    public function getControllerFileName() {
        return $this->controllerName ? ucfirst($this->controller).'.class.php' : null;
    }    

    /**************************************************************************/
    
    public function getActionName() {
        return $this->actionName;
    }
    
    public function getParams() {
        return $this->params;
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/
    
    public function getRoot() {
        return $this->root;
    }
    
    /**************************************************************************/    

    public function getPath($path) {
        return Path::getPath($this->root, $path);
    }

    public function getAbsolutePath($path) {
        return Path::getAbsolutePath($this->root, $path);
    }

    public function getRelativePath($path) {
        return Path::getRelativePath($this->root, $path);
    }

    /**************************************************************************/
    // Router proxy
    /**************************************************************************/

    public function getUrl() {
        return $this->router->getUrl();
    }

    public function getAbsoluteUrl($path) {
        return $this->router->getAbsoluteUrl($path);
    }
    
    public function getRelativeUrl($path) {
        return $this->router->getAbsoluteUrl($path);
    }

    /**************************************************************************/
    // Config proxy
    /**************************************************************************/

    public function getLayout($name) {
        return $this->config->getLayoutModule($name);
    }
  
    public function getBlock($name) {
        return $this->config->getBlockModule($name);
    }

    public function getTemplate($name) {
        return $this->config->getTemplateModule($name);
    }

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    private function __construct() {
    //  parent::__construct();
        $this->init();
    }

    private function __clone() {
    }

    /**************************************************************************/
    // Init

    public function init()
    {
        // Init config as singleton
    //  $this->config = new Config($this);
        $this->config = Config::create($this);
    //  $this->root = rtrim(__DIR__, 'classes/application');
        $this->root = $this->config->getRoot();

        // Unused here
    //  $this->registry = Registry::create($this);

        // Unused here
    //  $this->globals = Globals::create($this, null);

        // Unused here
        // Init application variables
        $this->vars = new Params();
    }

    /**************************************************************************/
    // Done

    public function done() {
        $this->view->done();
        $this->view->show();
    }

    /**************************************************************************/
    // Controller
    /**************************************************************************/

    public function handleAction($controllerName, $actionName, $params = [])
    {
    //  require_once $this->config->getControllerModule($this->controllerName);
    //  $this->controller = new $this->controllerName();
        $this->controller = new AppController($this);
        $controller = $this->controller;

        if (method_exists($controller, $actionName)) {
            call_user_func_array([$controller, $actionName], $params);
        }
    }

    /**************************************************************************/
    // Main
    /**************************************************************************/

    public function main()
    {
        $this->router = new AppRouter(
            $this,
            $this->config->getRoutes()
        );
        $this->controllerName = $this->router->getControllerName();
        $this->actionName = $this->router->getActionName();
        $this->params = $this->router->getParamsArray();

        $this->view = new View($this);

        $this->handleAction(
            $this->controllerName,
            $this->actionName,
            $this->params
        );
    }

    /**************************************************************************/
    // Singleton 'getInstance'
    /**************************************************************************/

    public static function create()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**************************************************************************/
    // Execute
    /**************************************************************************/

    public static function execute()
    {
    //  $app = new Application();
        $app = Application::create();
        $app->main();
        $app->done();
    }

    /**************************************************************************/
}

/*******************************************************************************/