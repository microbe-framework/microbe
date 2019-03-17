<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Config.class.php
 *     Class: Config
 *     About: Application configuration class
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

class Config extends Params
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static Config instance for single instance usage (singleton)
     * @var Router
     */
    private static $instance            = null; 

    /**************************************************************************/
    // Instance variables

    private $app                        = null;

    /**************************************************************************/
    // Absolute path

    protected $root                     = null;
    
    /**************************************************************************/
    // Relative path
    
    protected $config                   = null;
    protected $routes                   = null;

//  protected $framework                = null;
//  protected $library                  = null;
//  protected $classes                  = null;

    protected $application              = null;
    protected $configs                  = null;

    protected $controllers              = null;

    protected $views                    = null;

    protected $blocks                   = null;
    protected $layouts                  = null;
    protected $templates                = null;
    
    protected $assets                   = null;
    protected $styles                   = null;
    protected $scripts                  = null;
    protected $images                   = null;
    protected $icons                    = null;

//  protected $data;
//  protected $actions;
//  protected $models;
//  protected $forms;
//  protected $includes;
//  protected $logs;
//  protected $vars;
//  protected $globals;
//  protected $temp;
//  protected $cache;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    public function getApp() {
        return $this->app;
    }

    /**************************************************************************/

    public function getRoot() {
        return $this->root;
    }

    /**************************************************************************/

    public function getRoutes() {
        return $this->routes;
    }
        
    public function getConfig() {
        return $this->config;
    }    

    /**************************************************************************/
    // Questionable routines

//  public function getFramework() {
//      return $this->framework;
//  }
    
//  public function getLibrary() {
//      return $this->library;
//  }    

//  public function getClasses() {
//      return $this->classes;
//  }

    /**************************************************************************/

    public function getApplication() {
        return $this->application;
    }

    public function getConfigs() {
        return $this->configs;
    }

    public function getControllers() {
        return $this->controllers;
    }

    /**************************************************************************/
    
    public function getViews() {
        return $this->views;
    }

    public function getLayouts() {
        return $this->layouts;
    }

    public function getBlocks() {
        return $this->blocks;
    }

    public function getTemplates() {
        return $this->templates;
    }
    
    /**************************************************************************/

    public function getAssets() {
        return $this->assets;
    }

    public function getStyles() {
        return $this->styles;
    }

    public function getScripts() {
        return $this->scripts;
    }
    
    public function getImages() {
        return $this->images;
    }
    
    public function getIcons() {
        return $this->icons;
    }

    /**************************************************************************/

    public function getCoalesce($name, $value) {
        $result = $this->get($name);
        return $result ? $result : $value;
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/
    //  $this->root = substr(__DIR__, 0, -1 * strlen('framework/classes/'));
    //  echo __DIR__.'<br>';
    //  echo realpath(__DIR__).'<br>';
    //  echo $this->root.'<br>';
    //  print($_SERVER['PWD'] . "/" . $_SERVER['PHP_SELF']);
    //  echo $_SERVER['SCRIPT_FILENAME'].'<br>';
    //  echo $_SERVER['DOCUMENT_ROOT'].'<br>';
    //  $this->root = substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * strlen('index.php'));
    //  exit();

    private function _initRoot() {
        return substr($_SERVER['SCRIPT_FILENAME'], 0, -1 * strlen('index.php'));
    }

    protected function initRoot() {
        return $this->root = $this->_initRoot();
    }

    /**************************************************************************/

    protected function getPath($path) {
        return Path::join($this->root, $path);
    }

    /**************************************************************************/

    protected function getAbsolutePath($path) {
        return Path::getAbsolutePath($this->root, $path);
    }

    protected function getRelativePath($path) {
        return Path::getRelativePath($this->root, $path);
    }

    /**************************************************************************/

    protected function getAbsolutePathEx($path, $name, $ext) {
        $path = $this->getAbsolutePath($path);
        return Path::joinEx($path, $name, $ext);
    }

    protected function getRelativePathEx($path, $name, $ext) {
        $path = $this->getRelativePath($path);
        return Path::joinEx($path, $name, $ext);
    }

    /**************************************************************************/
    // Default file extension id '.inc.php'

    protected function getModule($path, $name, $ext = '.inc.php') {
        return Path::joinEx($path, $name, $ext);
    }

    protected function getAbsoluteModule($path, $name, $ext = '.inc.php') {
        $path = $this->getAbsolutePath($path);    
        return Path::joinEx($path, $name, $ext);
    }

    protected function getRelativeModule($path, $name, $ext = '.inc.php') {
        $path = $this->getRelativePath($path);    
        return Path::joinEx($path, $name, $ext);
    }

    /**************************************************************************/
    // Default file extension id '.inc.php'

    protected function getClass($path, $name, $ext = '.class.php') {
        return Path::joinEx($path, $name, $ext);
    }

    protected function getAbsoluteClass($path, $name, $ext = '.class.php') {
        $path = $this->getAbsolutePath($path);    
        return Path::joinEx($path, $name, $ext);
    }

    protected function getRelativeClass($path, $name, $ext = '.class.php') {
        $path = $this->getRelativePath($path);    
        return Path::joinEx($path, $name, $ext);
    }

    /**************************************************************************/    
    /* Questionable routines
    
    public function getLibraryPath($path) {
        return $this->getModule($this->library, $path, '.class.php');
    }

    public function getClassPath($path) {
        return $this->getModule($this->classes, $path, '.class.php');
    }

    /**************************************************************************/
    /* Questionable routines

    protected function getApplicationPath($path) {
        return Path::join($this->application, $path);
    }

    public function getConfigPath($path) {
        return $this->getModule($this->configs, $path, '.txt');
    }

    /**************************************************************************/

    public function getControllerModule($name) {
    //  $className = $this->getControllerClassName($name);
    //  return $this->getModule($this->controllers, $className.'class.php');
        return $this->getModule($this->controllers, ucfirst($name), 'Controller.class.php');
    }

    /**************************************************************************/

    public function getControllerClassName($name) {
        return ucfirst($name).'Controller';
    }

    public function getActionMethodName($name) {
        return $name.'Action';
    }

    /**************************************************************************/
    
//  protected function getViewsPath($path) {
//      return Path::join($this->views, $path);
//  }

    public function getBlockModule($path) {
        return $this->getModule($this->blocks, $path, '.inc.php');
    }

    public function getLayoutModule($path) {
        return $this->getModule($this->layouts, $path, '.inc.php');
    }

    public function getTemplateModule($path) {
        return $this->getModule($this->templates, $path, '.inc.php');
    }

    /**************************************************************************/
    /* Questionable routines
    
    public function getAssetPath($path) {
        return $this->getModule($this->assets, $path);
    }

    public function getStylePath($path) {
        return $this->getModule($this->styles, $path, '.css');
    }

    public function getScriptPath($path) {
        return $this->getModule($this->scripts, $path, '.js');
    }

    protected function getImagePath($path) {
        return $this->getModule($this->images, $path);
    }

    protected function getIconPath($path) {
        return $this->getModule($this->icons, $path);
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Config instance
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return Config
     */
    public function __construct($app, $path = null) {
    //  parent::__construct();
        $this->init($app, $path);
    }

//  private function __clone() { }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    /**
     * Config instance variables initializer and loader
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return void
     */
    protected function init($app, $path = null)
    {
        $this->app = $app;

        $this->initRoot();

        $this->loadDefault();
        $this->load($path);
    }

    /**************************************************************************/
    // Load default config
    /**************************************************************************/

    /**
     * Load an application default configuration
     * @return void
     */
    protected function loadDefault()
    {
        $this->configs          = './config/';
        $this->config           = Path::join($this->configs, './config.txt');
        $this->routes           = Path::join($this->configs, './routes.json');

        // Unused !!!
    //  $this->framework        = './framework/';
    //  $this->library          = Path::join($this->framework, './library/');
    //  $this->classes          = Path::join($this->framework, './classes/');

        $this->application      = './application/';
        $this->controllers      = $this->application;        
    //  $this->controllers      = Path::join($this->application, './controllers/');

        $this->views            = './views/';
        $this->layouts          = Path::join($this->views, './layouts/');
        $this->blocks           = Path::join($this->views, './blocks/');
        $this->templates        = Path::join($this->views, './templates/');

        $this->assets           = './assets/';
        $this->styles           = Path::join($this->assets, './css/');
        $this->scripts          = Path::join($this->assets, './js/');
        $this->images           = Path::join($this->assets, './images/');
        $this->icons            = Path::join($this->assets, './images/icons/');

        return true;
    }

    /**************************************************************************/
    // Load
    /**************************************************************************/

    /**
     * Load a Config from configuration file
     * @param string $path Path to configuration file, null by default
     * @return void
     */
    protected function load($path = null)
    {
        if (file_exists($path)) {
            $this->config = $path;
        }

        // 2019/03/08 add JSON config files support
        $this->loadFromFileEx($this->config);
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return instantiated Config or not
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Config instance creation method
     * For correct usage make method __construct private
     * @param Application $app The application instance
     * @param string $path Path to configuration file, null by default
     * @return Config
     */
    public static function getInstance($app, $path = null)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $path);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/