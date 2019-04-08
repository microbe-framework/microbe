<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: View.php
 *     Class: View
 *     About: Application view's renderer
 *     Begin: 2017/05/01
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
 
class View extends \Microbe\Library\Render
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static View instance for single instance usage (singleton)
     *
     * @var View
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
    // Buffer

    /**
     * Use or not current View an output buffer
     *
     * [?] Name 'useBuffer' is questionable
     * [?] Possible better to use: buffered, bufferize, retain
     * @var boolean
     */
    protected $useBuffer                = false;

    /**
     * Current View or application output buffer
     *
     * @var string
     */
    protected $buffer                   = null;

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
     * Get an application output buffer used or not
     *
     * @return boolean
     */
    public function getUseBuffer() {
        return $this->useBuffer;
    }

    /**
     * Get an application output buffer
     *
     * @return string
     */
    public function &getBuffer() {
        return $this->buffer;
    }

    /**************************************************************************/
    // Global application variables array access
    /**************************************************************************/

    /**
     * Application vars getter
     *
     * @return Vars
     */
    public function &getVars() {
        return $this->app->getVars();
    }
    
    /**************************************************************************/    

    /**
     * Get by name application vars value
     *
     * @param string $name
     * @return mixed
     */
    public function getVar($name) {
        return $this->app->getVar($name);
    }

    /**
     * Get by name application vars value
     *
     * @param string $name
     * @return mixed
     */
    public function get($name) {
        return $this->app->getVar($name);
    }

    /**************************************************************************/

    /**
     * Set by name application vars value
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setVar($name, $value) {
        return $this->app->setVar($name, $value);
    }

    /**
     * Set by name application vars value
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set($name, $value) {
        return $this->app->setVar($name, $value);
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
        return $this->app->getConfig();
    }

    /**
     * Get by name application configuration parameter value
     *
     * @param string $name
     * @return string|mixed
     */
    public function getConfigValue($name) {
        return $this->app->getConfigValue($name);
    }

    /**************************************************************************/
    // Params proxy
    /**************************************************************************/

    /**
     * Get router rule parameters
     *
     * @return mixed[]|mixed|null
     */
    public function &getParams() {
        return $this->app->getParams();
    }

    /**
     * Get router rule parameter value by name
     *
     * @param string $name
     * @return mixed[]|mixed|null
     */
    public function getParam($name) {
        return $this->app->getParam($name);
    }

    /**************************************************************************/
    // Shortcuts
    /**************************************************************************/
 
    /**
     * Get an application object url
     *
     * @param string $path null by default
     * @return string
     */
    protected function getUrl($path = null) {
        return $this->app->getUrl($path);
    }

    /**
     * Get an application object absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteUrl($path) {
        return $this->app->getAbsoluteUrl($path);
    }

    /**
     * Get an application object relative url
     *
     * @param string $path
     * @return string
     */
    protected function getRelativeUrl($path) {
        return $this->app->getRelativeUrl($path);
    }

    /**************************************************************************/

    /**
     * Get a stylesheet file url
     *
     * @param string $path
     * @return string
     */
    protected function getStyle($path)
    {
        $styles = $this->getConfig()->getStyles();
        return $this->getUrl($styles.$path);
    }

    /**
     * Get a stylesheet file absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteStyle($path)
    {
        $styles = $this->getConfig()->getStyles();
        return $this->getAbsoluteUrl($styles.$path);
    }

    /*
     * Get a stylesheet file relative url
     *
     * @param string $path
     * @return string
     */
//  protected function getRelativeStyle($path)
//  {
//      $styles = $this->app->getConfig()->getStyles();
//      return $this->getRelativeUrl($styles.$path);
//  }

    /**************************************************************************/

    /**
     * Get a script file url
     *
     * @param string $path
     * @return string
     */
    protected function getScript($path)
    {
        $scripts = $this->getConfig()->getScripts();
        return $this->getUrl($scripts.$path);
    }

    /**
     * Get a script file absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteScript($path)
    {
        $scripts = $this->getConfig()->getScripts();
        return $this->getAbsoluteUrl($scripts.$path);
    }

    /*
     * Get a script file relative url
     *
     * @param string $path
     * @return string
     */
//  protected function getRelativeScript($path)
//  {
//      $scripts = $this->app->getConfig()->getScripts();
//      return $this->getRelativeUrl($scripts.$path);
//  }

    /**************************************************************************/

    /**
     * Get an image file url
     *
     * @param string $path
     * @return string
     */
    protected function getImage($path)
    {
        $images = $this->getConfig()->getImages();
        return $this->getUrl($images.$path);
    }

    /**
     * Get an image file absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteImage($path)
    {
        $images = $this->getConfig()->getImages();
        return $this->getAbsoluteUrl($images.$path);
    }

    /*
     * Get an image file relative url
     *
     * @param string $path
     * @return string
     */
 // protected function getRelativeImage($path)
//  {
 //     $images = $this->app->getConfig()->getImages();
 //     return $this->getRelativeUrl($images.$path);
 // }

    /**************************************************************************/

    /**
     * Get an icon file url
     *
     * @param string $path
     * @return string
     */
    protected function getIcon($path)
    {
        $images = $this->getConfig()->getIcons();
        return $this->getUrl($images.$path);
    }

    /**
     * Get an icon file absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteIcon($path)
    {
        $images = $this->getConfig()->getIcons();
        return $this->getAbsoluteUrl($images.$path);
    }

    /*
     * Get an icon file relative url
     *
     * @param string $path
     * @return string
     */
 // protected function getRelativeIcon($path)
//  {
 //     $images = $this->app->getConfig()->getIcons();
 //     return $this->getRelativeUrl($images.$path);
 // }

    /**************************************************************************/

    /**
     * Get a font file url
     *
     * @param string $path
     * @return string
     */
    protected function getFont($path)
    {
        $styles = $this->getConfig()->getFonts();
        return $this->getUrl($styles.$path);
    }

    /**
     * Get a font file absolute url
     *
     * @param string $path
     * @return string
     */
    protected function getAbsoluteFont($path)
    {
        $styles = $this->getConfig()->getFonts();
        return $this->getAbsoluteUrl($styles.$path);
    }

    /*
     * Get a font file relative url
     *
     * @param string $path
     * @return string
     */
//  protected function getRelativeFont($path)
//  {
//      $styles = $this->app->getConfig()->getFonts();
//      return $this->getRelativeUrl($styles.$path);
//  }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a View instance
     *
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    public function __construct(&$app, $useBuffer = true)
    {
    //  parent::__construct();
        $this->init($app, $useBuffer);
    }

//  private function __clone() { }

//  private function __wakeup() { }

    /**************************************************************************/
    // Init

    /**
     * View instance variables initializer
     *
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    protected function init(&$app, $useBuffer = true)
    {
        $this->app = &$app;

        if ($this->useBuffer = $useBuffer) {
            ob_start();
        }
    }

    /**************************************************************************/
    // Done

    /**
     * View instance finalizer
     * Get and clean a content of php buffer if used
     *
     * @return void
     */
    public function done()
    {
        // Flash a buffer
        if ($this->useBuffer) {
            echo ob_get_clean();
        }
        // Assign null to buffer
        $this->buffer = null;
    }

    /**************************************************************************/
    // Render basic
    /**************************************************************************/

    /**
     * Render a buffer to string
     * Use $render_params and $render_flags
     * Inject in $render_params application Vars variables
     * $render_flags can be combination of:
     * - RENDER_FLAG_NONE
     * - RENDER_FLAG_FILE
     * - RENDER_FLAG_BUFFER
     *
     * @param string $render_buffer
     * @param mixed[] $render_params
     * @param int $render_flags Default value RENDER_FLAG_NONE
     * @return string
     */
    protected function &render(
        &$render_buffer,
        &$render_params,
        $render_flags = self::RENDER_FLAG_NONE
    )
    {
        // Get application variables as array
        $vars = $this->getVars() ? $this->getVars()->getItems() : null;

        // Inject Vars
        if (is_array($vars) && is_array($render_params)) {
            $render_params = array_merge($vars, $render_params);
        //  $render_params = array_merge(
        //      array('Coca' => 'Cola', 'Ja' => 'va'),
        //      $render_params
        //  );
        } else if (is_array($vars)) {
            $render_params = $vars;
        } else if (is_array($render_params) == false) {
            $render_params = [];
        }

        // Inject application and renderer
        $render_params['me']  = &$this;
        $render_params['app'] = &$this->app;
    //  $render_params['req'] = &$this->app->getRequest();

        return parent::render($render_buffer, $render_params, $render_flags);
    }

    /**************************************************************************/

    /**
     * Render as php code a block by name with $params
     *
     * @param string $name
     * @param mixed[]]$params
     * @return string
     */
    public function renderBlock($name, $params = null)
    {
        $path = $this->app->getBlock($name);
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a layout by name with $params
     *
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    public function renderLayout($name, $params = null)
    {
        $path = $this->app->getLayout($name);
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a template by name with $params
     *
     * @param string $name
     * @param mixed[]params
     * @return string
     */
    public function renderTemplate($name, $params = null)
    {
        $path = $this->app->getTemplate($name);
        $this->renderFile($path, $params);
    }

    /**************************************************************************/
    // Include as text without evaluation
    // Have not parameters

    /**
     * Include in plain render output a block
     *
     * @param string $name
     * @return void
     */
    public function includeBlock($name)
    {
        $path = $this->app->getBlock($name);
        $this->includeFile($path);
    }

    /**
     * Include in plain render output a template
     *
     * @param string $name
     * @return void
     */
    public function includeTemplate($name)
    {
        $path = $this->app->getTemplate($name);
        $this->includeFile($path);
    }

    /**************************************************************************/
    // Include with evaluation
    // Use parameters

    /**
     * Render as php code a string $buffer with $params
     *
     * @param string|mixed $buffer
     * @param mixed[] $params
     * @return string
     */
    protected function eval(&$buffer, $params = null)
    {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderBuffer($buffer, $params);
    }

    /**
     * Render as php code a file with $params
     *
     * [!] Danger to use! Potentially get access to filesystem
     * @param string $path
     * @param mixed[] $params
     * @return string
     */
    protected function file($path, $params = null)
    {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a block by name with $params
     *
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function block($name, $params = null)
    {
        if ($params === null) {
            global $_;
            $params = $_;
        }
        $this->renderBlock($name, $params);
    }

    /**
     * Render as php code a layout by name with $params
     *
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function layout($name, $params = null)
    {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderLayout($name, $params);
    }
    
    /**
     * Render as php code a template by name with $params
     *
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function template($name, $params = null)
    {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderTemplate($name, $params);
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return instantiated View or not
     *
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single View instance creation method
     * For correct usage make method __construct private
     *
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    public static function getInstance(&$app, $useBuffer = true)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $useBuffer);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/