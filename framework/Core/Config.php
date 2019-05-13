<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Config.php
 *     Class: Config
 *     About: Application configuration class
 *     Begin: 2017/05/01
 *   Current: 2019/04/30
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
    // CMS

    const CMS_URI                       = 'cms';

    const CMS_PATH                      = 'cms';

    const APP_PATH                      = 'application';

    /**************************************************************************/
    // File names

    const VARS_FILE_NAME                = 'vars.json';

    const CONFIG_FILE_NAME              = 'config.json';

    const ROUTES_FILE_NAME              = 'routes.json';

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
     * Application site directory
     *
     * @var string $site
     */
    protected $site                     = null;

    /**
     * Application CMS directory
     *
     * @var string $cms
     */
    protected $cms                      = null;

    /**
     * Application working directory (CMS or site)
     *
     * @var string $current
     */
    protected $current                  = null;

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
     * Application configuration directory
     *
     * [?] Rename to something like configDirPath
     * @var string $configs
     */
    protected $appConfigs               = null;

    /**
     * Application configuration file path
     *
     * [?] Rename to something like configFilePath
     * @var string $config 
     */
    protected $appConfig                = null;

    /**
     * Application variables file path
     *
     * @var string $vars
     */
    protected $appVars                  = null;

    /**
     * Application routes file path
     *
     * @var string $routes
     */
    protected $appRoutes                = null;

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

    /**
     * Application classes directory
     *
     * @var string $classes
     */
    protected $classes                  = null;

    /**
     * Application models directory
     *
     * @var string $models
     */
    protected $appModels                = null;

    /**
     * Application controllers directory
     *
     * @var string $controllers
     */
    protected $appControllers           = null;

    /**
     * Application classes directory
     *
     * @var string $classes
     */
    protected $appClasses               = null;

    /*********************************************************************/

    /**
     * Application queries directory
     *
     * @var string $queries
     */
    protected $queries                  = null;

    /**
     * Application queries directory
     *
     * @var string $queries
     */
    protected $appQueries               = null;

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

    /*********************************************************************/

    /**
     * Application views directory
     *
     * @var string $appViews
     */
    protected $appViews                 = null;

    /**
     * Application blocks directory
     *
     * @var string $appBlocks
     */
    protected $appBlocks                = null;

    /**
     * Application layouts directory
     *
     * @var string $appLayouts
     */
    protected $appLayouts               = null;

    /**
     * Application templates directory
     *
     * @var string $appTemplates
     */
    protected $appLemplates             = null;

    /**************************************************************************/
    // Absolute web paths

    /**
     * Application web root directory
     *
     * @var string $web
     */
    protected $web                      = null;

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
     * Application banners directory
     *
     * @var string $banners
     */
    protected $banners                  = null;

    /**
     * Application audio directory
     *
     * @var string $audios
     */
    protected $audios                   = null;

    /**
     * Application video directory
     *
     * @var string $videos
     */
    protected $videos                   = null;

    /**
     * Application icons directory
     *
     * @var string $flashes
     */
    protected $flashes                  = null;

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
    public function &getSite() {
        return $this->site;
    }

    /**
     * Get an application CMS directory
     *
     * @return string
     */
    public function &getCms() {
        return $this->cms;
    }

    /**
     * Get an application working directory (CMS or site)
     *
     * @return string
     */
    public function &getCurrent() {
        return $this->current;
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
     * Get an application configuration directory
     *
     * @return string
     */
    public function &getAppConfigs() {
        return $this->appConfigs;
    }

    /**
     * Get an application configuration file path
     *
     * @return string
     */
    public function &getAppConfig() {
        return $this->appConfig;
    }    

    /**
     * Get an application routes file path
     * @return string
     */
    public function &getAppRoutes() {
        return $this->appRoutes;
    }

    /**
     * Get an application variables file path
     *
     * @return string
     */
    public function &getAppVars() {
        return $this->appVars;
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

    /**
     * Get an application classes directory
     *
     * @return string
     */
    public function &getClasses() {
        return $this->classes;
    }

    /**
     * Get an application controllers directory
     *
     * @return string
     */
    public function &getAppModels() {
        return $this->appModels;
    }

    /**
     * Get an application controllers directory
     *
     * @return string
     */
    public function &getAppControllers() {
        return $this->appControllers;
    }

    /**
     * Get an application classes directory
     *
     * @return string
     */
    public function &getAppClasses() {
        return $this->appClasses;
    }

    /**************************************************************************/

    /**
     * Get an application queries directory
     *
     * @return string
     */
    public function &getQueries() {
        return $this->queries;
    }

    /**
     * Get an application queries directory
     *
     * @return string
     */
    public function &getAppQueries() {
        return $this->appQueries;
    }

    /**************************************************************************/

    /**
     * Get an application views directory
     *
     * @return string
     */
    public function &getAppViews() {
        return $this->appViews;
    }

    /**
     * Get an application layouts directory
     *
     * @return string
     */
    public function &getAppLayouts() {
        return $this->appLayouts;
    }

    /**
     * Get an application blocks directory
     *
     * @return string
     */
    public function &getAppBlocks() {
        return $this->appBlocks;
    }

    /**
     * Get an application templates directory
     *
     * @return string
     */
    public function &getAppTemplates() {
        return $this->appTemplates;
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
    // Absolute paths for web

    /**
     * Get an application web root directory
     *
     * @return string
     */
    public function &getWeb() {
        return $this->web;
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
     * Get an application banners directory
     *
     * @return string
     */
    public function &getBanners() {
        return $this->banners;
    }

    /**
     * Get an application fonts directory
     *
     * @return string
     */
    public function &getFonts() {
        return $this->fonts;
    }

    /**
     * Get an application audio directory
     *
     * @return string
     */
    public function &getAudios() {
        return $this->audios;
    }

    /**
     * Get an application video directory
     *
     * @return string
     */
    public function &getVideos() {
        return $this->videos;
    }

    /**
     * Get an application flash directory
     *
     * @return string
     */
    public function &getFlashes() {
        return $this->flashes;
    }

    /**************************************************************************/
    // Absolute paths for web

    /**
     * Get an application assets directory
     *
     * @return string
     */
    public function getAppAssets() {
        return Path::join($this->web, $this->assets);
    }

    /**
     * Get an application asset
     *
     * @return string
     */
    public function getAppAsset($path = null) {
        return Path::join($this->web, $this->assets . $path);
    }

    /**
     * Get an application images directory
     *
     * @return string
     */
    public function getAppImages() {
        return Path::join($this->web, $this->images);
    }

    /**
     * Get an application image
     *
     * @return string
     */
    public function getAppImage($path = null) {
        return Path::join($this->web, $this->images . $path);
    }

    /**
     * Get an application icons directory
     *
     * @return string
     */
    public function getAppIcons() {
        return Path::join($this->web, $this->icons);
    }

    /**
     * Get an application icon
     *
     * @return string
     */
    public function getAppIcon($path = null) {
        return Path::join($this->web, $this->icons . $path);
    }

    /**
     * Get an application banners directory
     *
     * @return string
     */
    public function getAppBanners() {
        return Path::join($this->web, $this->banners);
    }

    /**
     * Get an application banner
     *
     * @return string
     */
    public function getAppBanner($path = null) {
        return Path::join($this->web, $this->banners . $path);
    }

    /**
     * Get an application fonts directory
     *
     * @return string
     */
    public function getAppFonts() {
        return Path::join($this->web, $this->fonts);
    }

    /**
     * Get an application font
     *
     * @return string
     */
    public function getAppFont($path = null) {
        return Path::join($this->web, $this->fonts . $path);
    }

    /**
     * Get an application audios directory
     *
     * @return string
     */
    public function getAppAudios() {
        return Path::join($this->web, $this->audios);
    }

    /**
     * Get an application audio
     *
     * @return string
     */
    public function getAppAudio($path = null) {
        return Path::join($this->web, $this->audios . $path);
    }

    /**
     * Get an application videos directory
     *
     * @return string
     */
    public function getAppVideos() {
        return Path::join($this->web, $this->videos);
    }

    /**
     * Get an application video
     *
     * @return string
     */
    public function getAppVideo($path = null) {
        return Path::join($this->web, $this->videos . $path);
    }

    /**
     * Get an application flashes directory
     *
     * @return string
     */
    public function getAppFlashes() {
        return Path::join($this->web, $this->flashes);
    }

    /**
     * Get an application flash
     *
     * @return string
     */
    public function getAppFlash($path = null) {
        return Path::join($this->web, $this->flashes . $path);
    }

    /**************************************************************************/

    /**
     * Get an application styles directory
     *
     * @return string
     */
    public function getAppStyles() {
        return Path::join($this->web, $this->styles);
    }

    /**
     * Get an application style
     *
     * @return string
     */
    public function getAppStyle($path = null) {
        return Path::join($this->web, $this->styles . $path);
    }

    /**
     * Get an application client-side scripts directory
     *
     * @return string
     */
    public function getAppScripts() {
        return Path::join($this->web, $this->scripts);
    }

    /**
     * Get an application client-side script
     *
     * @return string
     */
    public function getAppScript($path = null) {
        return Path::join($this->web, $this->scripts . $path);
    }

    /**************************************************************************/
    // Path
    /**************************************************************************/

    /**
     * Get application root directory path from $_SERVER['SCRIPT_FILENAME']
     * Return an application root directory path
     *
     * @return void
     */
    protected function initRoot() {
    //  $this->root = dirname($_SERVER['SCRIPT_FILENAME'], 2) . DIRECTORY_SEPARATOR;
        $this->root = dirname($_SERVER['SCRIPT_FILENAME'], 3) . DIRECTORY_SEPARATOR;
    }

    /**************************************************************************/

    /*
     * Return an absolute path by relative $path
     *
     * @param string $path
     * @return string
     */
//  protected function getFilePath($path) {
//      return Path::join($this->root, $path);
//  }

    /**************************************************************************/

    /*
     * Return an absolute value for $path
     *
     * @param string $path
     * @return string
     */
//  protected function getAbsolutePath($path) {
//      return Path::getAbsolutePath($this->root, $path);
//  }

    /*
     * Return an relative value for $path
     *
     * @param string $path
     * @return string
     */
//  protected function getRelativePath($path) {
//      return Path::getRelativePath($this->root, $path);
//  }

    /**************************************************************************/

    /*
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
//  protected function getAbsolutePathEx($path, $name, $ext) {
//      $path = $this->getAbsolutePath($path);
//      return Path::joinEx($path, $name, $ext);
//  }

    /*
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
//  protected function getRelativePathEx($path, $name, $ext) {
//      $path = $this->getRelativePath($path);
//      return Path::joinEx($path, $name, $ext);
//  }

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

    /*
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
//  protected function getClass($path, $name, $ext = '.php') {
//      return Path::joinEx($path, $name, $ext);
//  }

    /**************************************************************************/

    /*
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
     * Return an absolute views' module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppView($path) {
        return $this->getModule($this->appViews, $path, '.php');
    }

    /**
     * Return an absolute views' block module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppBlock($path) {
        return $this->getModule($this->appBlocks, $path, '.inc.php');
    }

    /**
     * Return an absolute views' layout module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppLayout($path) {
    //  return $this->getModule($this->appLayouts, $path, '.inc.php');
        return $this->getModule($this->appLayouts, $path, '.layout.php');
    }

    /**
     * Return an absolute views' template module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppTemplate($path) {
        return $this->getModule($this->appTemplates, $path, '.inc.php');
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
    public function getBlock($path) {
        return $this->getModule($this->blocks, $path, '.inc.php');
    }

    /**
     * Return an absolute views' layout module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getLayout($path) {
    //  return $this->getModule($this->layouts, $path, '.inc.php');
        return $this->getModule($this->layouts, $path, '.layout.php');
    }

    /**
     * Return an absolute views' template module path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getTemplate($path) {
        return $this->getModule($this->templates, $path, '.inc.php');
    }

    /**************************************************************************/

    /**
     * Return an absolute query path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getQuery($path) {
        return $this->getModule($this->queries, $path, '.sql');
    }

    /**
     * Return an absolute query path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppQuery($path) {
        return $this->getModule($this->appQueries, $path, '.sql');
    }

    /**************************************************************************/

    /**
     * Return an absolute model path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getModel($path) {
        return $this->getModule($this->models, $path, '.php');
    }

    /**
     * Return an absolute controller path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getController($path) {
        return $this->getModule($this->controllers, $path, '.php');
    }

    /**
     * Return an absolute class path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getClass($path) {
        return $this->getModule($this->classes, $path, '.php');
    }

    /**
     * Return an absolute model path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppModel($path) {
        return $this->getModule($this->appModels, $path, '.php');
    }

    /**
     * Return an absolute controller path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppController($path) {
        return $this->getModule($this->appControllers, $path, '.php');
    }

    /**
     * Return an absolute class path by relative $path
     *
     * @param string $path
     * @return string
     */
    public function getAppClass($path) {
        return $this->getModule($this->appClasses, $path, '.php');
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
    public function __construct($path = null)
    {
    //  parent::__construct();
        $this->app = &Registry::getApp();

        $this->initRoot();

        $this->loadDefault();
        $this->load($path);
    }

//  private function __clone() { }

//  private function __wakeup() { }

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
        // Check is admin mode or not

        $isCms                = $this->app->isCms();

        // Absolute paths for application, CMS and current

        $this->site           = $this->root.Application::APP_PATH.'/';
        $this->cms            = $this->root.Application::CMS_PATH.'/';
        $this->current        = $isCms ? $this->cms : $this->site;

        // Current

        $this->configs        = $this->current.'configs/';
        $this->config         = $this->configs.'config.txt';
        $this->vars           = $this->configs.'vars.json';
        $this->routes         = $this->configs.'routes.json';

        $this->controllers    = $this->current.'Controllers/';
        $this->models         = $this->current.'Models/';
        $this->classes        = $this->current.'Classes/';
        $this->queries        = $this->current.'queries/';

        $this->views          = $this->current.'views/';
        $this->layouts        =&$this->views;
        $this->blocks         =&$this->views;
        $this->templates      = $this->views.'templates/';

        // Application specific

        $this->appConfigs     = $this->site.'configs/';
        $this->appConfig      = $this->appConfigs.'config.txt';
        $this->appVars        = $this->appConfigs.'vars.json';
        $this->appRoutes      = $this->appConfigs.'routes.json';

        $this->appControllers = $this->site.'Controllers/';
        $this->appModels      = $this->site.'Models/';
        $this->appClasses     = $this->site.'Classes/';
        $this->appQueries     = $this->site.'queries/';

        $this->appViews       = $this->site.'views/';
        $this->appLayouts     =&$this->appViews;
        $this->appBlocks      =&$this->appViews;
        $this->appTemplates   = $this->appViews.'templates/';

        // Common

        $this->tmp            = $this->site.'tmp/';
        $this->cache          = $this->tmp.'cache/';
        $this->globals        = $this->tmp.'globals/';
        $this->logs           = $this->tmp.'logs/';
        $this->uploads        = $this->tmp.'uploads/';

        $this->web            = $this->site.'web/';

        // Relative paths fow web

        $this->assets         = './assets/';
        $this->styles         = $this->assets.'css/';
        $this->scripts        = $this->assets.'js/';
        $this->fonts          = $this->assets.'fonts/';
        $this->images         = $this->assets.'images/';
        $this->icons          = $this->assets.'icons/';
        $this->banners        = $this->assets.'banners/';
        $this->audios         = $this->assets.'audios/';
        $this->videos         = $this->assets.'videos/';
        $this->flashes        = $this->assets.'flashes/';

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
    protected function load($path = null)
    {
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
    public static function hasInstance()
    {
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