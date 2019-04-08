<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Config.php
 *     Class: Config
 *     About: Application configuration class
 *     Begin: 2017/05/01
 *   Current: 2019/03/28
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

use \Microbe\Library\Path;

class Config extends \Microbe\Library\Params
{
    /**************************************************************************/
    // Applicatio entry point relation path

    const ENTRY_PATH                         = 'web/index.php';
    const ENTRY_LENGTH                       = 13;

    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static Config instance for single instance usage (singleton)
     *
     * @var Router
     */
    private static $instance            = null; 

    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     *
     * @var Application
     */
    protected $app                      = null;

    /**************************************************************************/
    // Absolute path

    /**
     * Application root directory
     *
     * @var string $root
     */
    protected $root                     = null;
    
    /**************************************************************************/
    // Absolute path

    /**
     * Application directory
     *
     * @var string $application
     */
    protected $application              = null;

    /**************************************************************************/

    /**
     * Application configuration directory
     *
     * [?] Rename to something like configDirPath
     * @var string $configs
     */
    protected $configs                  = null;

    /**
     * Application configuration file path
     *
     * [?] Rename to something like configFilePath
     * @var string $config 
     */
    protected $config                   = null;

    /**
     * Application variables file path
     *
     * @var string $vars
     */
    protected $vars                     = null;

    /**
     * Application routes file path
     *
     * @var string $routes
     */
    protected $routes                   = null;

    /**************************************************************************/

    /**
     * Application temporary data directory path
     *
     * @var string $tmp
     */
    protected $tmp                      = null;

    /**
     * Application uploads directory
     *
     * @var string $uploads
     */
    protected $uploads                  = null;

    /**
     * Application global variables directory path
     *
     * @var string $globals
     */
    protected $globals                  = null;

    /**
     * Application logs directory
     *
     * @var string $logs
     */
    protected $logs                     = null;

    /**
     * Application cache directory
     *
     * [!] TODO
     * @var string $cache
     */
    protected $cache                    = null;

    /**************************************************************************/

    /**
     * Application models directory
     *
     * @var string $models
     */
    protected $models                   = null;

    /**
     * Application controllers directory
     *
     * @var string $controllers
     */
    protected $controllers              = null;

    /*********************************************************************/

    /**
     * Application views directory
     *
     * @var string $views
     */
    protected $views                    = null;

    /**
     * Application blocks directory
     *
     * @var string $blocks
     */
    protected $blocks                   = null;

    /**
     * Application layouts directory
     *
     * @var string $layouts
     */
    protected $layouts                  = null;

    /**
     * Application templates directory
     *
     * @var string $templates
     */
    protected $templates                = null;

    /**************************************************************************/
    // Relative web paths

    /**
     * Application assets directory
     *
     * @var string $assets
     */
    protected $assets                   = null;
    
    /**
     * Application styles directory
     *
     * @var string $styles
     */
    protected $styles                   = null;

    /**
     * Application client-side scripts directory
     *
     * @var string $scripts
     */
    protected $scripts                  = null;

    /**
     * Application images directory
     *
     * @var string $images
     */
    protected $images                   = null;

    /**
     * Application icons directory
     *
     * @var string $icons
     */
    protected $icons                    = null;

    /**
     * Application fonts directory
     *
     * @var string $icons
     */
    protected $fonts                    = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Application facade instance
     *
     * @return Application
     */
    public function &getApp() {
        return $this->app;
    }

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
     * Get an application directory
     *
     * @return string
     */
    public function &getApplication() {
        return $this->application;
    }

    /**************************************************************************/

    /**
     * Get an application configuration directory
     *
     * @return string
     */
    public function &getConfigs() {
        return $this->configs;
    }

    /**
     * Get an application configuration file path
     *
     * @return string
     */
    public function &getConfig() {
        return $this->config;
    }    

    /**
     * Get an application routes file path
     * @return string
     */
    public function &getRoutes() {
        return $this->routes;
    }

    /**
     * Get an application variables file path
     *
     * @return string
     */
    public function &getVars() {
        return $this->vars;
    }

    /**************************************************************************/

    /**
     * Get an application temporary data directory path
     *
     * @return string
     */
    public function &getTmp() {
        return $this->tmp;
    }

    /**
     * Get an application global variables directory path
     *
     * @return string
     */
    public function &getGlobals() {
        return $this->globals;
    }

    /**
     * Get an application global variables directory path
     *
     * @return string
     */
    public function &getUploads() {
        return $this->uploads;
    }

    /**
     * Get an application global variables directory path
     *
     * @return string
     */
    public function &getLogs() {
        return $this->logs;
    }

    /**
     * Get an application cache directory path
     *
     * [!] TODO
     * @return string
     */
    public function &getCache() {
        return $this->cache;
    }

    /**************************************************************************/

    /**
     * Get an application controllers directory
     *
     * @return string
     */
    public function &getModels() {
        return $this->models;
    }

    /**
     * Get an application controllers directory
     *
     * @return string
     */
    public function &getControllers() {
        return $this->controllers;
    }

    /**************************************************************************/

    /**
     * Get an application views directory
     *
     * @return string
     */
    public function &getViews() {
        return $this->views;
    }

    /**
     * Get an application layouts directory
     *
     * @return string
     */
    public function &getLayouts() {
        return $this->layouts;
    }

    /**
     * Get an application blocks directory
     *
     * @return string
     */
    public function &getBlocks() {
        return $this->blocks;
    }

    /**
     * Get an application templates directory
     *
     * @return string
     */
    public function &getTemplates() {
        return $this->templates;
    }
    
    /**************************************************************************/
    // Relative paths for web

    /**
     * Get an application assets directory
     *
     * @return string
     */
    public function &getAssets() {
        return $this->assets;
    }

    /**
     * Get an application styles directory*
     *
     * @return string
     */
    public function &getStyles() {
        return $this->styles;
    }

    /**
     * Get an application client-side scripts directory
     *
     * @return string
     */
    public function &getScripts() {
        return $this->scripts;
    }
    
    /**
     * Get an application images directory
     *
     * @return string
     */
    public function &getImages() {
        return $this->images;
    }
    
    /**
     * Get an application icons directory
     *
     * @return string
     */
    public function &getIcons() {
        return $this->icons;
    }

    /**
     * Get an application fonts directory
     *
     * @return string
     */
    public function &getFonts() {
        return $this->fonts;
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/
    //  $this->root = substr(__DIR__, 0, -1 * strlen('core/classes/'));
    //  echo __DIR__.'<br>';
    //  echo realpath(__DIR__).'<br>';
    //  echo $this->root.'<br>';
    //  print($_SERVER['PWD'] . "/" . $_SERVER['PHP_SELF']);
    //  echo $_SERVER['SCRIPT_FILENAME'].'<br>';
    //  echo $_SERVER['DOCUMENT_ROOT'].'<br>';
    //  $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * strlen('index.php'));
    //  exit();

    /**
     * Get application root directory path from $_SERVER['SCRIPT_FILENAME']
     * Return an application root directory path
     *
     * @return void
     */
    protected function initRoot() {
    //  $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * strlen('index.php'));
    //  $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -9);
    //  $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * strlen('web/index.php'));
        $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -13);
    }

    /**************************************************************************/

    /**
     * Return an absolute path by relative $path
     *
     * @param string $path
     * @return string
     */
    protected function getPath($path) {
        return Path::join($this->root, $path);
    }

    /**************************************************************************/

    /**
     * Return an absolute value for $path
     *
     * @param string $path
     * @return string
     */
    protected function getAbsolutePath($path) {
        return Path::getAbsolutePath($this->root, $path);
    }

    /**
     * Return an relative value for $path
     *
     * @param string $path
     * @return string
     */
    protected function getRelativePath($path) {
        return Path::getRelativePath($this->root, $path);
    }

    /**************************************************************************/

    /**
     * Return an absolute value for $path $name $ext
     * $file is a file directory path
     * $name is a file name
     * $ext  is a file extention
     *
     * @param string $path
     * @param string $name
     * @param string $ext
     * @return string
     */
    protected function getAbsolutePathEx($path, $name, $ext) {
        $path = $this->getAbsolutePath($path);
        return Path::joinEx($path, $name, $ext);
    }

    /**
     * Return an relative value for $path $name $ext
     * $file is a file directory path
     * $name is a file name
     * $ext  is a file extention
     *
     * @param string $path
     * @param string $name
     * @param string $ext
     * @return string
     */
    protected function getRelativePathEx($path, $name, $ext) {
        $path = $this->getRelativePath($path);
        return Path::joinEx($path, $name, $ext);
    }

    /**************************************************************************/
    // Default file extension id '.inc.php'

    /**
     * Return a path of module by $path $name $ext
     * $file is a file directory path
     * $name is a file name
     * $ext  is a file extention
     *
     * @param string $path
     * @param string $name
     * @param string $ext
     * @return string
     */
    protected function getModule($path, $name, $ext = '.inc.php') {
        return Path::joinEx($path, $name, $ext);
    }
    
    /**************************************************************************/
    // Default file extension id '.inc.php'

    /**
     * Return a path of class by $path $name $ext
     * $file is a file directory path
     * $name is a file name
     * $ext  is a file extention
     *
     * @param string $path
     * @param string $name
     * @param string $ext
     * @return string
     */
    protected function getClass($path, $name, $ext = '.class.php') {
        return Path::joinEx($path, $name, $ext);
    }

    /**************************************************************************/

    /**
     * Return a path of controller by $name
     *
     * [!] UNUSED: controller class path stored in AppLoader/Loader
     * [-] To deletion
     * @param string $name
     * @return string
     */
//  public function getControllerModule($name) {
//  //  $className = $this->getControllerClassName($name);
//  //  return $this->getModule($this->controllers, $className.'class.php');
//      return $this->getModule($this->controllers, ucfirst($name), 'Controller.class.php');
//  }

    /**************************************************************************/

    /**
     * Return a controller class name by $name
     *
     * @param string $name
     * @return string
     */
    public function getControllerClassName($name) {
        return ucfirst($name).'Controller';
    }

    /**
     * Return a controller's action name by $name
     *
     * @param string $name
     * @return string
     */
    public function getActionMethodName($name) {
        return $name.'Action';
    }

    /**************************************************************************/
    
//  protected function getViewsPath($path) {
//      return Path::join($this->views, $path);
//  }

    /**
     * Return an absolute views' block module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getBlockModule($path) {
        return $this->getModule($this->blocks, $path, '.inc.php');
    }

    /**
     * Return an absolute views' layout module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getLayoutModule($path) {
    //  return $this->getModule($this->layouts, $path, '.inc.php');
        return $this->getModule($this->layouts, $path, '.layout.php');
    }

    /**
     * Return an absolute views' template module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getTemplateModule($path) {
        return $this->getModule($this->templates, $path, '.inc.php');
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Config instance
     *
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return Config
     */
    public function __construct(&$app, $path = null) {
    //  parent::__construct();
        $this->init($app, $path);
    }

//  private function __clone() { }

//  private function __wakeup() { }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    /**
     * Config instance variables initializer and loader
     *
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return void
     */
    protected function init(&$app, $path = null) {

        $this->app = &$app;

        $this->initRoot();

        $this->loadDefault();
        $this->load($path);
    }

    /**************************************************************************/
    // Load default config
    /**************************************************************************/

    /**
     * Load an application default structure and configuration
     * All application paths must be absolute
     * All web paths must be relative
     *
     * [!] Use string constants
     * @return void
     */
    protected function loadDefault()
    {
        // Absolute paths for application

        $this->application = $this->root.'application/';

        $this->configs     = $this->application.'configs/';
        $this->config      = $this->configs.'config.txt';
        $this->vars        = $this->configs.'vars.json';
        $this->routes      = $this->configs.'routes.json';

    //  $this->controllers = $this->application.'controllers/';
    //  $this->models      = $this->application.'models/';

        $this->tmp         = $this->root.'tmp/';
        $this->globals     = $this->tmp.'globals/';
        $this->logs        = $this->tmp.'logs/';
        $this->uploads     = $this->tmp.'uploads/';

        $this->views       = $this->application.'views/';
        $this->layouts     =&$this->views;
        $this->blocks      =&$this->views;
        $this->templates   = $this->views.'templates/';

        // Relative paths fow web

    //  $this->assets      = $this->root.'web/assets/';
        $this->assets      = './assets/';
        $this->styles      = $this->assets.'css/';
        $this->scripts     = $this->assets.'js/';
        $this->fonts       = $this->assets.'fonts/';
        $this->images      = $this->assets.'images/';
        $this->icons       = $this->assets.'images/icons/';

        return true;
    }

    /**************************************************************************/
    // Load
    /**************************************************************************/

    /**
     * Load a Config from configuration file
     *
     * @param string $path Path to configuration file, null by default
     * @return void
     */
    protected function load($path = null) {
        if (file_exists($path)) {
            $this->config = $path;
        }

        $this->loadFromFileEx($this->config);
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return instantiated Config or not
     *
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Config instance creation method
     * For correct usage make method __construct private
     *
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return Config
     */
    public static function getInstance(&$app, $path = null)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $path);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/