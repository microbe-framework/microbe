<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Application.php
 *     Class: Application
 *     About: Application class
 *     Begin: 2017/05/01
 *   Current: 2019/04/04
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
use \Microbe\Library\Path;
use \Microbe\Library\Timer;
use \Microbe\Library\HttpRequest;

class Application
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static Application instance for single instance usage (singleton)
     *
     * @var Application $instance
     */
    private static $instance            = null;

    /**************************************************************************/
    // Nothing

    /**
     * Null varuable
     *
     * @var null $nothing
     */
    protected $nothing                  = null;

    /**************************************************************************/
    // Instance variables

    /**
     * Application root directory
     *
     * @var string $root
     */
    protected $root                     = null;

    /**
     * Application configuration class instance
     *
     * @var Config $config
     */
    protected $config                   = null;

    /**
     * Application registry
     *
     * @var Registry $registry
     */
    protected $registry                 = null;

    /**
     * Application output buffer
     *
     * @var string $buffer
     */
    protected $buffer                   = null; // [?]

    /**
     * Application router class instance
     *
     * @var Router|RouterEx|AppRouter $router
     */
    protected $router                   = null;

    /**
     * Application router rule parameters
     *
     * @var mixed[] $params
     */
    protected $params                   = null;

    /**
     * Application model class instance
     *
     * @var Model|ModelEx|AppModel $model
     */
    protected $model                    = null; // [-] on-the-fly

    /**
     * Application view renderer class instance
     *
     * @var View|AppView $view
     */
    protected $view                     = null; // [?] on-the-fly

    /**
     * Application default controller
     *
     * @var Controller $controller
     */
//  protected $controller               = null; // [-] on-the-fly

    /**
     * Application variables
     *
     * @var Vars $vars
     */
    protected $vars                     = null;

    /**
     * Application global variables
     *
     * @var Globals $globals
     */
    protected $globals                  = null;

    /**
     * Application variables
     *
     * @var HttpRequest $request
     */
    protected $request                  = null;

    /**
     * Application log
     *
     * @var Log $log
     */
    protected $log                      = null;

    /**
     * Application timer
     *
     * @var Timer $timer
     */
    protected $timer                    = null;

    /**
     * Application user
     *
     * @var int|null $user
     */
    protected $user                     = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Application registry getter
     *
     * @return Registry
     */
    public function &getRegistry() {
        return $this->registry;
    }

    /**
     * Application output buffer getter
     *
     * [?] Not used
     * @return string
     */
    public function &getBuffer() {
        return $this->buffer;
    }

    /**
     * Application router getter
     *
     * @return Router|RouterEx|AppRouter
     */
    public function &getRouter() {
        return $this->router;
    }

    /**
     * Application model getter
     *
     * [?] Don't needs in default model
     * @return Model|ModelEx|AppModel
     */
    public function &getModel() {
        return $this->model;
    }

    /**
     * Application view renderer getter
     *
     * @return View|AppView
     */
    public function &getView() {
        return $this->view;
    }

    /**
     * Application http request getter
     *
     * @return HttpRequest
     */
    public function &getRequest() {
        return $this->request;
    }

    /**
     * Get an application log instance
     *
     * @return string
     */
    public function &getLog() {
        return $this->log;
    }

    /**
     * Get an application timer instance
     *
     * @return Timer
     */
    public function &getTimer() {
        return $this->timer;
    }

    /**
     * Get an application user if exists
     *
     * @return int|null
     */
    public function &getUser() {
        return $this->user;
    }

    /**************************************************************************/

    /**
     * Application global variables getter
     *
     * @return Globals
     */
    public function &getGlobals() {
        return $this->globals;
    }

    /**
     * Get by name application global variable value
     *
     * @param string $name
     * @return mixed
     */
    public function getGlobal($name) {
        return $this->globals ? $this->globals->get($name) : null;
    }

    /**
     * Set by name application global variable value
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setGlobal($name, $value) {
        if ($this->globals) $this->globals->set($name, $value);
    }

    /**************************************************************************/

    /**
     * Application vars getter
     *
     * @return Vars
     */
    public function &getVars() {
        return $this->vars;
    }

    /**
     * Get by name application vars value
     *
     * @param string $name
     * @return mixed
     */
    public function getVar($name) {
        return $this->vars ? $this->vars->get($name) : null;
    }

    /**
     * Set by name application vars value
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setVar($name, $value) {
        if ($this->vars) $this->vars->set($name, $value);
    }

    /**************************************************************************/
    
    /**
     * Application router parameters getter
     *
     * @return Params
     */
    public function &getParams() {
        return $this->params;
    }

    /**
     * Get by name application router parameter value
     *
     * @param string $name
     * @return mixed
     */
    public function getParam($name) {
        return Arrays::get($this->params, $name);
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/

    /**
     * Get an application root directory path
     *
     * @return string
     */
    public function &getRoot() {
        return $this->root;
    }

    /**************************************************************************/    

    /**
     * Get an application directory path
     *
     * @param string $path
     * @return string
     */
    public function getPath($path) {
        return Path::getPath($this->root, $path);
    }

    /**
     * Get an application directory absolute path
     *
     * @param string $path
     * @return string
     */
    public function getAbsolutePath($path) {
        return Path::getAbsolutePath($this->root, $path);
    }

    /**
     * Get an application directory relative path
     *
     * @param string $path
     * @return string
     */
    public function getRelativePath($path) {
        return Path::getRelativePath($this->root, $path);
    }
    
    /**************************************************************************/
    // Url (Router proxy)
    /**************************************************************************/

    /**
     * Get an application object url
     *
     * @param string $path null by default
     * @return string
     */
    public function getUrl($path = null) {
        return $this->router->getUrl($path);
    }

    /**
     * Get an application object absolute url
     *
     * @param string $path
     * @return string
     */
    public function getAbsoluteUrl($path) {
        return $this->router->getAbsoluteUrl($path);
    }
    
    /**
     * Get an application object relative url
     *
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
     *
     * @return Config
     */
    public function &getConfig() {
        return $this->config;
    }

    /**
     * Get by name application configuration parameter value
     *
     * @param string $name
     * @return string|mixed
     */
    public function getConfigValue($name) {
        return $this->config->get($name);
    }

    /**************************************************************************/

    /**
     * Get server path to view's block file by name if exists or null
     *
     * @param string $name
     * @return string|null
     */
    public function getBlock($name) {
        return $this->config->getBlockModule($name);
    }

    /**
     * Get server path to view's layout file by name if exists or null
     *
     * @param string $name
     * @return string|null
     */
    public function getLayout($name) {
        return $this->config->getLayoutModule($name);
    }
  
    /**
     * Get server path to view's template file by name if exists or null
     *
     * @param string $name
     * @return string|null
     */
    public function getTemplate($name) {
        return $this->config->getTemplateModule($name);
    }

    /**************************************************************************/
    // Registry

    /**
     * Return class instance use registry
     *
     * @param string $ckassName
     * @return object|null
     */
    public function &getObject($className) {
        return $this->registry->getObject($className);
    }

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create an Application instance
     *
     * @return Application
     */
    public function __construct()
    {
    //  parent::__construct();
        $this->init();
    }

//  private final function __clone() {}

//  private final function __wakeup() {}

    /**************************************************************************/
    // Init

    /**
     * Application instance variables initializer
     * - Initialize an application timer
     * - Initialize application registry
     * - Read a configuration file
     * - Detect an application root directory
     * - Initialize global application variables
     * - Initialize local application variables
     * - Initialize a HttpRequest object
     * - Initialize a current user
     *
     * [!] Sequence of actions are significant
     * @return void
     */
    protected function init()
    {
        // Init an application timer
        $this->initTimer();

        // Init an application objects registry
        $this->initRegistry();

        // Init an application config
        $this->initConfig();

        // Init an application log
        $this->initLog();

        // Init application global variables
        $this->initGlobals();

        // Init application variables
        $this->initVars();

        // Init a request
        $this->initRequest();

        // Init current user
        $this->initUser();
    }

    /**************************************************************************/
    // Done

    /**
     * Application finalizer
     * If a buffer is used:
     * - get and clean a content of php buffer
     * - send it to response
     *
     * [!] Sequence of actions are significant
     * @return void
     */
    protected function done()
    {
        // View done
        $this->doneView();

        // Timer done
        $this->doneTimer();

        // Log done
        $this->doneLog();
    }

    /**************************************************************************/
    // Init & done application objects
    /**************************************************************************/

    /**
     * Init an application config
     *
     * @return void
     */
    protected function initConfig()
    {
        $this->config = new Config($this);
        $this->root = $this->config->getRoot();
    }

    /**************************************************************************/
    
    /**
     * Init an application registry
     *
     * @return void
     */
    protected function initRegistry() {
        $this->registry = new Registry($this);
    }

    /**************************************************************************/

    /**
     * Create an application timer
     * Store an application begin time
     *
     * @return void
     */
    protected function initTimer() {
        $this->timer = new Timer();
    }

    /**
     * Create an application timer
     * Store an application end time     
     *
     * @return void
     */
    protected function doneTimer() {
        $this->timer->stop();
    }

    /**************************************************************************/    

    /**
     * Create an application log
     *
     * [!] Use string constants
     * @return void
     */
    protected function initLog()
    {
        if ($this->config->get('log.enable') == false)
            return;

        $filepath  = $this->config->get('log.filepath');
        $path      = $this->config->getCoalesce('log.directory', './tmp/logs');
        $className = $this->config->getCoalesce('log.class', 'Microbe\Core\Log');
 
        $this->log = new $className($this, $filepath ? $filepath : $path);
    }

    /**
     * Done an application log
     *
     * @return void
     */
    protected function doneLog()
    {
        if ($this->log) {
            $this->log->done();
        }
    }

    /**************************************************************************/
    
    /**
     * Init application global variables
     *
     * [!] Use string constants
     * @return void
     */
    protected function initGlobals()
    {
        if ($this->config->get('globals.enable') == false)
            return;

        $path = $this->config->getGlobals();
        $this->globals = new Globals($this, $path);
    }

    /**************************************************************************/

    /**
     * Init application variables
     * Load variables from default file if exists
     *
     * [!] Use string constants
     * @return void
     */
    protected function initVars()
    {
        if ($this->config->get('vars.enable') == false)
            return;

        $path = $this->config->getVars();
        $this->vars = new Vars($this, $path);
    }

    /**************************************************************************/

    /**
     * Create a HttpRequest instance
     *
     * @return void
     */
    protected function initRequest() {
        $this->request = new HttpRequest();
    }

    /**************************************************************************/

    /**
     * Create an application user
     *
     * [!] Use string constants
     * @return void
     */
    protected function initUser()
    {
        if ($this->config->get('auth.enable') == false)
            return;

        if ($sid = Arrays::get($_COOKIE, 'sid')) {
        //  return $this->getObject('AuthModel')->queryUserBySid($sid);
            $this->user = 'microbe';
        }
    }

    /**************************************************************************/
    // This methods returns value
    /**************************************************************************/

    /**
     * Create a router by configuration parameter value
     * If configuration parameter not set create default Router
     * If exists return existing
     *
     * [!] Use string constants
     * @return Router
     */
    public function &initRouter()
    {
        if ($this->router)
            return $this->router;

        $routes = &$this->config->getRoutes();
    //  $className = $this->config->getCoalesce('router.class', 'Microbe\Core\RouterEx');
        $className = $this->config->getCoalesce('router.class', 'Microbe\Core\Router');
        $this->router = $className ? new $className($this, $routes) : null;
        return $this->router;
    }

    /**************************************************************************/

    /**
     * Create a model by configuration parameter value
     * If configuration parameter not set create nothing
     * If exists return existing
     *
     * [!] Use string constants
     * @return Model
     */
    public function &initModel()
    {
        if ($this->model)
            return $this->model;

        $className = $this->config->get('model.class');
        $this->model = $className ? new $className($this, true) : null;
        return $this->model;
    }

    /**************************************************************************/

    /**
     * Create a view by configuration parameter value
     * If configuration parameter not set create default View
     * If exists return existing
     *
     * [!] Use string constants
     * @return View
     */
    public function &initView()
    {
        if ($this->view)
            return $this->view;

        $className = $this->config->getCoalesce('view.class', '\Microbe\Core\View');

        $this->view = $className ? new $className($this, true) : null;
        return $this->view;
    }

    /**
     * Done an application view renderer
     * Send a response
     *
     * @return void
     */
    protected function doneView()
    {
        if ($this->view) {
            $this->view->done();
        //  $this->view->show();
        }
    }

    /**************************************************************************/
    // Main
    /**************************************************************************/

    /**
     * Route a request
     * - Create a router
     * - Apply routing filters and rules to http request
     * - Store routing rule's parameters to $params     
     * If fail or needs to exit return true, false otherwise
     *
     * @return boolean
     */
    protected function route()
    {
        // Init router.
        // Exit if can't. Never run without router!
        if ($this->initRouter() == false)
            return true;

        // Exit without render if $router->exit is set
        if ($this->router->getExit())
            return true;

        // Store params to application
    //  $this->params = $this->router->getParamsArray(); // [?]
        $this->params = &$this->router->getParams(); // [?]

        return false;
    }

    /**************************************************************************/

    /**
     * Main application method
     * - Create a router
     * - Apply routing filters and rules to http request
     * - Performs a check for access violation
     * - Process data manipulation queries
     * - Render a response and send it to client
     *
     * [!] Sequence of actions are significant
     * @return void
     */
    protected function main()
    {

        // Route
        if ($this->route())
            return;

        // Process data and render
    //  Engine::execute($this);
        new Engine($this);
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return Application if instantiated or null if not
     *
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Application instance creation method
     * For correct usage make method __construct private
     *
     * @return Application
     */
    public static function getInstance()
    {
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
     *
     * @return void
     */
    public static function execute()
    {
        $app = new Application();    
        $app->main();
        $app->done();
    }

    /**************************************************************************/
}

/*******************************************************************************/