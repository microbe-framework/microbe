<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: View.class.php
 *     Class: View
 *     About: View
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
 
class View
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static View instance for single instance usage (singleton)
     * @var View
     */
    private static $instance            = null; 
    
    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     * @var Application
     */
    protected $app                      = null;

    /**************************************************************************/
    // Buffer
    // Name 'useBuffer' is questionable
    // buffered,bufferize,retain

    /**
     * Use or not current View an output buffer
     * @var boolean
     */
    protected $useBuffer                = false;

    /**
     * Current View or application output buffer
     * @var string
     */
    protected $buffer                   = null;

    /**************************************************************************/
    // Don't render all but layouts
    // Name 'plain' is questionable
    // render,rendered,include,usePlain

    /**
     * Defines how will render a source: as plain text (true) or php code (false)
     * False (php code) by default
     * @var boolean $plain
     */
    protected $plain                    = false;

    /**************************************************************************/
    // Level
    
    /**
     * Keep a current rendered file nesting level, initially equal 0
     * @var int $level
     */
    protected $level                    = 0;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Get framework facade class Application instance
     * @return Application
     */
    public function getApp() {
        return $this->app;
    }

    /**************************************************************************/

    /**
     * Get an application output buffer used or not
     * @return boolean
     */
    public function getUseBuffer() {
        return $this->useBuffer;
    }

    /**
     * Get an application output buffer
     * @return string
     */
    public function getBuffer() {
        return $this->buffer;
    }

    /**************************************************************************/
    // Plain/Render

    /**
     * Return true if source rendered as plain text, false otherwise
     * @return boolean
     */
    public function isPlain() {
        return $this->plain;
    }

    /**
     * Get source rendered scheme: as plain text (true) or php code (false)
     * @return boolean
     */
    public function getPlain() {
        return $this->plain;
    }

    /**
     * Defines how will render a source: as plain text (true) or php code (false)
     * @param boolean $plain
     * @return void
     */
    public function setPlain($plain) {
        $this->plain = $plain;
    }

    /**************************************************************************/
    // Level

    /**
     * Get a current rendered file nesting level
     * @return int
     */
    public function getLevel() {
        return $this->level;
    }

    /**
     * Check a current rendered file nesting level is top (true) or not (false)
     * @return int
     */
    public function isTopLevel() {
        return $this->level == 0;
    }

    /**
     * Check a current rendered file nesting level is top (false) or not (true)
     * @return int
     */
    public function noTopLevel() {
        return $this->level != 0;
    }

    /**
     * Reset a current rendered file nesting level to top (0)
     * @return int
     */
    public function resetLevel() {
        return $this->level = 0;
    }

    /**
     * Increment by one a current rendered file nesting level 
     * @return int
     */
    public function incLevel() {
        return $this->level = $this->level + 1;
    }

    /**
     * Decrement by one a current rendered file nesting level
     * Don't proceed if current level is a top (0)
     * @return int
     */
    public function decLevel() {
        return $this->level = ($this->level) ? ($this->level - 1) : $this->level;
    }

    /**************************************************************************/
    // Global application variables array access
    /**************************************************************************/

    /**
     * Application vars getter
     * @return Vars
     */
    public function getVars() {
        return $this->app->getVars();
    }
    
    /**************************************************************************/    

    /**
     * Get by name application vars value
     * @param string $name
     * @return mixed
     */
    public function getVar($name) {
        return $this->app->getVar($name);
    }

    /**
     * Get by name application vars value
     * @param string $name
     * @return mixed
     */
    public function get($name) {
        return $this->app->getVar($name);
    }

    /**************************************************************************/

    /**
     * Set by name application vars value
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setVar($name, $value) {
        return $this->app->setVar($name, $value);
    }

    /**
     * Set by name application vars value
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
     * @return Config
     */
    public function getConfig() {
        return $this->app->getConfig();
    }

    /**
     * Get by name application configuration parameter value
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
     * @return mixed[]|mixed|null
     */
    public function getParams() {
        return $this->app->getParams();
    }

    /**
     * Get router rule parameter value by name
     * @param string $name
     * @return mixed[]|mixed|null
     */
    public function getParamsValue($name) {
        return $this->app->getParamsValue($name);
    }

    /**************************************************************************/
    // Shortcuts
    /**************************************************************************/
 
    /**
     * Get an application object url
     * @param string $path null by default
     * @return string
     */
    protected function getUrl($path = null) {
        return $this->app->getUrl($path);
    }

    /**
     * Get an application object absolute url
     * @param string $path
     * @return string
     */
    protected function getAbsoluteUrl($path) {
        return $this->app->getAbsoluteUrl($path);
    }

    /**
     * Get an application object relative url
     * @param string $path
     * @return string
     */
    protected function getRelativeUrl($path) {
        return $this->app->getRelativeUrl($path);
    }

    /**************************************************************************/

    /**
     * Get a stylesheet file url
     * @param string $path
     * @return string
     */
    protected function getStyle($path) {
        $styles = $this->getConfig()->getStyles();
        return $this->getUrl($styles.$path);
    }

    /**
     * Get a stylesheet file absolute url
     * @param string $path
     * @return string
     */
    protected function getAbsoluteStyle($path) {
        $styles = $this->getConfig()->getStyles();
        return $this->getAbsoluteUrl($styles.$path);
    }

    /*
     * Get a stylesheet file relative url
     * @param string $path
     * @return string
     */
//  protected function getRelativeStyle($path) {
//      $styles = $this->app->getConfig()->etStyles();
//      return $this->getRelativeUrl($styles.$path);
//  }

    /**************************************************************************/

    /**
     * Get a script file url
     * @param string $path
     * @return string
     */
    protected function getScript($path) {
        $scripts = $this->getConfig()->getScripts();
        return $this->getUrl($scripts.$path);
    }

    /**
     * Get a script file absolute url
     * @param string $path
     * @return string
     */
    protected function getAbsoluteScript($path) {
        $scripts = $this->getConfig()->getScripts();
        return $this->getAbsoluteUrl($scripts.$path);
    }

    /*
     * Get a script file relative url
     * @param string $path
     * @return string
     */
//  protected function getRelativeScript($path) {
//      $scripts = $this->app->getConfig()->getScripts();
//      return $this->getRelativeUrl($scripts.$path);
//  }

    /**************************************************************************/

    /**
     * Get an image file url
     * @param string $path
     * @return string
     */
    protected function getImage($path) {
        $images = $this->getConfig()->getImages();
        return $this->getUrl($images.$path);
    }

    /**
     * Get an image file absolute url
     * @param string $path
     * @return string
     */
    protected function getAbsoluteImage($path) {
        $images = $this->getConfig()->getImages();
        return $this->getAbsoluteUrl($images.$path);
    }

    /*
     * Get an image file relative url
     * @param string $path
     * @return string
     */
 // protected function getRelativeImage($path) {
 //     $images = $this->app->getConfig()->getImages();
 //     return $this->getRelativeUrl($images.$path);
 // }

    /**************************************************************************/

    /**
     * Get an icon file url
     * @param string $path
     * @return string
     */
    protected function getIcon($path) {
        $images = $this->getConfig()->getIcons();
        return $this->getUrl($images.$path);
    }

    /**
     * Get an icon file absolute url
     * @param string $path
     * @return string
     */
    protected function getAbsoluteIcon($path) {
        $images = $this->getConfig()->getIcons();
        return $this->getAbsoluteUrl($images.$path);
    }

    /*
     * Get an icon file relative url
     * @param string $path
     * @return string
     */
 // protected function getRelativeIcon($path) {
 //     $images = $this->app->getConfig()->getIcons();
 //     return $this->getRelativeUrl($images.$path);
 // }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a View instance
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    public function __construct($app, $useBuffer = true) {
    //  parent::__construct();
        $this->init($app, $useBuffer);
    }

//  private function __clone() { }

//  private function __wakeup() { }

    /**************************************************************************/
    // Init

    /**
     * View instance variables initializer
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    protected function init($app, $useBuffer = true)
    {
        $this->app = $app;

        $this->useBuffer = $useBuffer;
        if ($this->useBuffer) {
            ob_start();
        }
    }

    /**************************************************************************/
    // Done

    /**
     * View instance finalizer
     * Get and clean a content of php buffer if used
     * @return void
     */
    public function done() {
        $this->buffer = $this->useBuffer ? ob_get_clean() : null;
    }

    /**************************************************************************/
    // Show

    /**
     * If a buffer is used send it to response with help 'echo' routine
     * @return void
     */
    public function show() {
        if ($this->buffer) {
            echo $this->buffer;
        }
    }

    /**************************************************************************/
    // Render basic
    /**************************************************************************/

    /**
     * Get content of a file or null if file not exists
     * COMMENT: nonsensical but convinient routine
     * @param string $path
     * @return string
     */
    protected function readFile($path) {  
        return file_get_contents($path);
    }
    
    /**************************************************************************/
    // Render a buffer use eval without output
    // Reserved variables: $this, $app, $_
    // Local variables: $render_params, $render_vars
    // Local variables: $render_name,   $render_value
    // Local variables: $render_buffer, $render_flags, $render_result

    const RENDER_FLAG_NONE              = 0;    
    const RENDER_FLAG_FILE              = 1;
    const RENDER_FLAG_BUFFER            = 2;

    /**
     * Render a buffer to string
     * Use $render_params and $render_flags
     * $render_flags can be combination of:
     * - RENDER_FLAG_NONE
     * - RENDER_FLAG_FILE
     * - RENDER_FLAG_BUFFER
     * @param string $render_buffer
     * @param mixed[] $render_params
     * @param int $render_flags Default value RENDER_FLAG_NONE
     * @return string
     */
    protected function render(
        $render_buffer,
        $render_params,
        $render_flags = self::RENDER_FLAG_NONE
    )
    {
        $render_result = null;

        $this->incLevel();

        $app = $this->app;
        $_ = $render_params;

        $render_vars = $this->getVars()->getItems();
    //  var_dump($render_vars);
        if (is_array($render_vars)) {
            foreach ($render_vars as $render_name => $render_value) {
            //  echo $render_name.' = '.$render_value;
                $$render_name = $render_value;
            }
            unset($render_name);
            unset($render_value);
        }
    //  var_dump($render_params);
        if (is_array($render_params)) {
            foreach ($render_params as $render_name => $render_value) {
                $$render_name = $render_value;
            }
            unset($render_name);
            unset($render_value);
        }

        if (($render_flags & self::RENDER_FLAG_BUFFER) != 0)
            ob_start();

        if (($render_flags & self::RENDER_FLAG_FILE)   != 0)
            include($render_buffer);

        if (($render_flags & self::RENDER_FLAG_FILE)   == 0)
            eval('?>'.$render_buffer);

        if (($render_flags & self::RENDER_FLAG_BUFFER) != 0)
            $render_result = ob_get_clean();

        $this->decLevel();
        
        return $render_result;
    }

    /**************************************************************************/
    // Render
    // Include and evaluate

    /**
     * Render as php code a string $buffer with $params
     * @param string|mixed $buffer
     * @param mixed[] $params
     * @return string
     */
    public function renderBuffer($buffer, $params = null) {
        $this->render($buffer, $params, self::RENDER_FLAG_NONE);
    }

    /**
     * Render as php code a file with $params
     * @param string $path
     * @param mixed[] $params
     * @return string
     */
    public function renderFile($path, $params = null) {
        $this->render($path, $params, self::RENDER_FLAG_FILE);
    }

    /**************************************************************************/

    /**
     * Render as php code a block by name with $params
     * @param string $name
     * @param mixed[]]$params
     * @return string
     */
    public function renderBlock($name, $params = null) {
        $path = $this->app->getBlock($name);
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a layout by name with $params
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    public function renderLayout($name, $params = null) {
        $path = $this->app->getLayout($name);
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a template by name with $params
     * @param string $name
     * @param mixed[]params
     * @return string
     */
    public function renderTemplate($name, $params = null) {
        $path = $this->app->getTemplate($name);
        $this->renderFile($path, $params);
    }

    /**************************************************************************/
    // Include as text without evaluation
    // Have not parameters

    /**
     * Include in plain render output a string buffer
     * @param string|mixed $buffer
     * @return string
     */
    public function includeBuffer($buffer) {
        echo $buffer;
    }

    /**
     * Include in plain render output a file
     * @param string $path
     * @return string
     */
    public function includeFile($path) {
        echo $this->readFile($path);
    }

    /**
     * Include in plain render output a block
     * @param string $name
     * @return void
     */
    public function includeBlock($name) {
        $path = $this->app->getBlock($name);
        $this->includeFile($path);
    }

    /**
     * Include in plain render output a template
     * @param string $name
     * @return void
     */
    public function includeTemplate($name) {
        $path = $this->app->getTemplate($name);
        $this->includeFile($path);
    }

    /**************************************************************************/
    // Include with evaluation
    // Use parameters

    /**
     * Render as php code a string $buffer with $params
     * @param string|mixed $buffer
     * @param mixed[] $params
     * @return string
     */
    protected function eval($buffer, $params = null) {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderBuffer($buffer, $params);
    }

    /**
     * Render as php code a file with $params
     * NOTE: Danger to use !!! Potentially get access to filesystem
     * @param string $path
     * @param mixed[] $params
     * @return string
     */
    protected function file($path, $params = null) {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderFile($path, $params);
    }

    /**
     * Render as php code a block by name with $params
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function block($name, $params = null) {
        if ($params === null) {
            global $_;
            $params = $_;
        }
        $this->renderBlock($name, $params);
    }

    /**
     * Render as php code a layout by name with $params
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function layout($name, $params = null) {
        if ($params === null) {
            global $_;        
            $params = $_;
        }
        $this->renderLayout($name, $params);
    }
    
    /**
     * Render as php code a template by name with $params
     * @param string $name
     * @param mixed[] $params
     * @return string
     */
    protected function template($name, $params = null) {
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
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single View instance creation method
     * For correct usage make method __construct private
     * @param Application $app The application instance
     * @param boolean $useBuffer Use an output buffer or not, true by default
     * @return View
     */
    public static function getInstance($app, $useBuffer = true)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $useBuffer);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/