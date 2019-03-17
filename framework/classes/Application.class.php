<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Application.class.php
 *     Class: Application
 *     About: Application class
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

class Application
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static Application instance for single instance usage (singleton)
     * @var Application $instance
     */
    private static $instance            = null;

    /**************************************************************************/
    // Instance variables

    /**
     * Application configuration class instance
     * @var Config $config
     */
    protected $config                   = null;

    /**
     * Application root directory
     * @var string $root
     */
    protected $root                     = null;
        
    /**
     * Application output buffer
     * @var string $buffer
     */
    protected $buffer                   = null;

    /**
     * Application router class instance
     * @var Router|RouterEx|AppRouter $router
     */
    protected $router                   = null;

//  protected $controllerName           = null;
//  protected $layoutName               = null;
//  protected $templateName             = null;
//  protected $actionName               = null;

    /**
     * Application router rule parameters
     * @var mixed[] $params
     */
    protected $params                   = null;

    /**
     * Application model class instance
     * @var Model|ModelEx|AppModel $model
     */
    protected $model                    = null;

    /**
     * Application view class instance
     * @var View|AppView $view
     */
    protected $view                     = null; // ? singleton
    
//  protected $controller               = null; // ? on-the-fly

    /**
     * Application variables
     * @var Vars $vars
     */
    protected $vars                     = null;

    /**
     * Application variables
     * @var HttpRequest $request
     */
    protected $request                  = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Application output buffer getter
     * @return string
     */
    public function getBuffer() {
        return $this->buffer;
    }

    /**
     * Application router getter
     * @return Router|RouterEx|AppRouter
     */
    public function getRouter() {
        return $this->router;
    }

    /**
     * Application model getter
     * @return Model|ModelEx|AppModel
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Application view getter
     * @return View|AppView
     */
    public function getView() {
        return $this->view;
    }

//  public function getController() {
//      return $this->controller;
//  }
    
    /**
     * Application http request getter
     * @return HttpRequest
     */
    public function getRequest() {
        return $this->request;
    }

    /**************************************************************************/

    /**
     * Application vars getter
     * @return Vars
     */
    public function getVars() {
        return $this->vars;
    }

    /**
     * Get by name application vars value
     * @param string $name
     * @return mixed
     */
    public function getVar($name) {
        return $this->vars->get($name);
    }

    /**
     * Set by name application vars value
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setVar($name, $value) {
        $this->vars->set($name, $value);
    }

    /**************************************************************************/
    
    /**
     * Application router parameters getter
     * @return Params
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Get by name application router parameter value
     * @param string $name
     * @return mixed
     */
    public function getParamsValue($name) {
        return Arrays::get($this->params, $name);
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/
    
    /**
     * Get an application root directory path
     * @return string
     */
    public function getRoot() {
        return $this->root;
    }

    /**************************************************************************/    

    /**
     * Get an application directory path
     * @param string $path
     * @return string
     */
    public function getPath($path) {
        return Path::getPath($this->root, $path);
    }

    /**
     * Get an application directory absolute path
     * @param string $path
     * @return string
     */
    public function getAbsolutePath($path) {
        return Path::getAbsolutePath($this->root, $path);
    }

    /**
     * Get an application directory relative path
     * @param string $path
     * @return string
     */
    public function getRelativePath($path) {
        return Path::getRelativePath($this->root, $path);
    }
    
    /**************************************************************************/
    // Router proxy
    /**************************************************************************/

    /**
     * Get an application object url
     * @param string $path null by default
     * @return string
     */
    public function getUrl($path = null) {
        return $this->router->getUrl($path);
    }

    /**
     * Get an application object absolute url
     * @param string $path
     * @return string
     */
    public function getAbsoluteUrl($path) {
        return $this->router->getAbsoluteUrl($path);
    }
    
    /**
     * Get an application object relative url
     * @param string $path
     * @return string
     */
    public function getRelativeUrl($path) {
        return $this->router->getRelativeUrl($path);
    }

    /**************************************************************************/
    // Config proxy
    /**************************************************************************/

    /**
     * Get application configuration instance
     * @return Config
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Get by name application configuration parameter value
     * @param string $name
     * @return string|mixed
     */
    public function getConfigValue($name) {
        return $this->config->get($name);
    }

    /**************************************************************************/

    /**
     * Get server path to view's block file by name if exists or null
     * @param string $name
     * @return string|null
     */
    public function getBlock($name) {
        return $this->config->getBlockModule($name);
    }

    /**
     * Get server path to view's layout file by name if exists or null
     * @param string $name
     * @return string|null
     */
    public function getLayout($name) {
        return $this->config->getLayoutModule($name);
    }
  
    /**
     * Get server path to view's template file by name if exists or null
     * @param string $name
     * @return string|null
     */
    public function getTemplate($name) {
        return $this->config->getTemplateModule($name);
    }

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create an Application instance
     * @return Application
     */
    public function __construct() {
    //  parent::__construct();
        $this->init();
    }

//  private final function __clone() {}

//  private final function __wakeup() {}

    /**************************************************************************/
    // Init

    /**
     * Application instance variables initializer
     * - Read a configuration file
     * - Detect an application root directory
     * - Initialize application registry (not used)
     * - Initialize global application variables (not used)
     * - Initialize local application variables
     * @return void
     */
    public function init()
    {
        // Unused here    
        // Init application objects registry    
    //  $this->registry = new Registry($this);
    
        // Init application config
        $this->config = new Config($this);
        $this->root = $this->config->getRoot();

        // Unused here
        // Init application global variables
    //  $this->globals = new Globals($this, null);

        // Init application variables
        $this->vars = new Vars($this);
    }

    /**************************************************************************/
    // Done

    /**
     * Application finalizer
     * If a buffer is used:
     * - get and clean a content of php buffer
     * - send it to response
     * @return void
     */
    public function done() {
        if ($this->view) {
            $this->view->done();
            $this->view->show();
        }
    }

    /**************************************************************************/
    // Handle
    /**************************************************************************/

    /**
     * Handle a routing rule
     * Do one of the following:
     * - Create controller and call controller action method
     * - Render a response by $layourName directly (without controller)
     * - Render a response by $templateName directly (without controller)
     * @param string $controllerName
     * @param string $layoutName
     * @param string $templateName
     * @param string $actionName
     * @param string[] $params
     * @return void
     */
    public function handle(
        $controllerName,
        $layoutName,
        $templateName,
        $actionName,
        $params = []
    ) {
        if ($controllerName) {
            $this->handleAction(
                $controllerName,
                $actionName,                
                $params
            );
        } elseif ($layoutName) {
            $this->handleLayout(
                $layoutName,
                $params
            );
        } elseif ($templateName) {
            $this->handleTemplate(
                $templateName,
                $params
            );
        }
    }

    /**************************************************************************/
    // Controller

    /**
     * Create an AppController instance
     * @return AppController
     */
    protected function createAppController() {
        return new AppController($this);
    }

    /**
     * Create an controller instance by $controllerName
     * @return Controller|AppController
     */
    protected function createController($controllerName) {
    //  require_once $this->config->getControllerModule($controllerName);
        $controllerClassName = $this->config->getControllerClassName($controllerName);
    //  $this->controller = new $controllerClassName($this);
        return new $controllerClassName($this);
    }

    /**
     * Create controller and call controller action method
     * @param string $controllerName
     * @param string $actionName
     * @param string[] $params
     * @return void
     */
    protected function handleAction($controllerName, $actionName, $params = []) {
    //  assert($controllerName);
    //  assert($actionName);

        $controller = $this->createController($controllerName);
        if ($controller == null)
            return;

        $actionMethodName = $this->config->getActionMethodName($actionName);
        if (method_exists($controller, $actionMethodName)) {
            call_user_func_array([$controller, $actionMethodName], $params);
        }
    }

    /**************************************************************************/
    // Layout

    /**
     * Render a response by $layourName directly (without controller)
     * @param string $layoutName
     * @param string[] $params
     * @return string
     */
    protected function handleLayout($layoutName, $params = []) {
    //  assert($layoutName);
        return $this->view->renderLayout(
            $layoutName,
            $params
        );
    }

    /**************************************************************************/
    // Template

    /**
     * Render a response by $templateName directly (without controller)
     * @param string $templateName
     * @param string[] $params
     * @return string
     */
    protected function handleTemplate($templateName, $params = []) {
    //  assert($templateName);
        return $this->view->renderTemplate(
            $templateName,
            $params
        );
    }

    /**************************************************************************/
    // Main
    /**************************************************************************/

    /**
     * Main application method
     * - Apply routing filters and rules to http request
     * - Create a data model if needs
     * - Create a view
     * - Create controller and call controller actions if needs
     * - Render a response and send it to client
     * @return void
     */
    public function main()
    {
        // Request
        $this->request = new HttpRequest();

        // Router
        $routes = $this->config->getRoutes();
        $routerClass = $this->config->getCoalesce('app.router.class', 'Microbe\RouterEx');
        $this->router = new $routerClass($this, $routes);
        // Never run without router
        if (empty($this->router))
            return;

        // Router results
        $controllerName = $this->router->getControllerName();
        $layoutName = $this->router->getLayoutName();
        $templateName = $this->router->getTemplateName();
        $actionName = $this->router->getActionName();
        $params = $this->router->getParamsArray();
        $this->params = $params;

        // Model
        // Model will be created if defined in configuration only
        $modelClass = $this->config->get('app.model.class');
        $this->model = $modelClass ? new $modelClass($this, true) : null;

        // View
        $viewClass = $this->config->getCoalesce('app.view.class', 'Microbe\View');
        $this->view = new $viewClass($this, true);

        // Controller or direct render
        $this->handle(
            $controllerName,
            $layoutName,
            $templateName,
            $actionName,
            $params
        );
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return Application if instantiated or null if not
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Application instance creation method
     * For correct usage make method __construct private
     * @return Application
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**************************************************************************/
    // Execute
    /**************************************************************************/

    /**
     * Create and execute an application
     * @return void
     */
    public static function execute() {
    //  $app = Application::getInstance(); // <= no way
        $app = new Application();    
        $app->main();
        $app->done();
    }

    /**************************************************************************/
}

/*******************************************************************************/