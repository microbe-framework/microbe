<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: View.class.php
 *     Class: View
 *     About: View
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/0.1/
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
 
class View
{
    /**************************************************************************/
    // Class variables

    private static $instance            = null; 
    
    /**************************************************************************/
    // Instance variables

    protected $app                      = null;

    protected $router                   = null;

    /**************************************************************************/
    // Buffer
    
    protected $useBuffer                = false;

    protected $buffer                   = null;

    /**************************************************************************/
    // Level
    
    protected $level                    = 0;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    public function getUseBuffer() {
        return $this->useBuffer;
    }

    public function getBuffer() {
        return $this->buffer;
    }

    /**************************************************************************/
    // Level

    public function getLevel() {
        return $this->level;
    }

    public function isTopLevel() {
        return $this->level == 0;
    }

    public function noTopLevel() {
        return $this->level != 0;
    }

    public function resetLevel() {
        return $this->level = 0;
    }

    public function incLevel() {
        return $this->level = $this->level + 1;
    }

    public function decLevel() {
        return $this->level = ($this->level) ? ($this->level - 1) : $this->level;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/
    // For singleton usage:
    //   private function __construct
    //   private __clone()

    function __construct($app, $useBuffer = true) {
    //  parent::__construct();
        $this->init($app, $useBuffer);
    }

    /**************************************************************************/
    // Init

    public function init($app, $useBuffer = true)
    {
        $this->app = $app;
        if ($this->app) {
        //  $this->buffer = $this->app->getBuffer();
            $this->router = $this->app->getRouter();
        }

        $this->useBuffer = $useBuffer;
        if ($this->useBuffer) {
            ob_start();
        }
    }

    /**************************************************************************/
    // Done

    public function done() {
        $this->buffer = $this->useBuffer ? ob_get_clean() : null;
    }

    /**************************************************************************/
    // Show

    public function show() {
        if ($this->buffer) {
            echo $this->buffer;
        }
    }

    /**************************************************************************/
    // Render basic
    /**************************************************************************/

    public function readFile($path) {  
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
    
    public function render(
        $render_buffer,
        $render_params,
        $render_flags = self::RENDER_FLAG_NONE
    )
    {
        $render_result = null;
    
        $this->incLevel();

        $_ = $render_params;
        $app = $this->app;
        
        $render_vars = $this->app->getVars();
        if (is_array($render_vars)) {
            foreach ($render_vars as $render_name => $render_value) {
                echo $$render_name = $render_value;
            }
            unset($render_name);
            unset($render_value);
        }
    
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

    public function renderBuffer($path, $params = null) {  
        $this->render($buffer, $params, self::RENDER_FLAG_NONE);
    }

    public function renderFile($path, $params = null) {  
        $this->render($path, $params, self::RENDER_FLAG_FILE);
    }

    public function renderBlock($name, $params = null) {  
        $path = $this->app->getBlock($name);
        $this->renderFile($path, $params);
    }

    public function renderLayout($name, $params = null) {  
        $path = $this->app->getLayout($name);
        $this->renderFile($path, $params);
    }

    public function renderTemplate($name, $params = null) {  
        $path = $this->app->getTemplate($name);
        $this->renderFile($path, $params);
    }

    /**************************************************************************/
    // Include as text without evaluation
    // Have not parameters

    public function includeBuffer($buffer) {
        echo $buffer;
    }

    public function includeFile($path) {
        echo $this->readFile($path);
    }

    public function includeBlock($name) {
        $path = $this->app->getBlock($name);
        $this->includeFile($path);
    }

    public function includeTemplate($name) {
        $path = $this->app->getTemplate($name);
        $this->includeFile($path);
    }

    /**************************************************************************/
    // Shortcuts
    /**************************************************************************/
    
    protected function getUrl($path) {
    //  return $this->router->getAbsoluteUrl($path);    
        return $this->router->getUrl($path);
    }

    protected function getAbsoluteUrl($path) {
        return $this->router->getAbsoluteUrl($path);
    }

    protected function getRelativeUrl($path) {
        return $this->router->getRelativeUrl($path);
    }
  
    /**************************************************************************/    
    // Render: include and evaluation

    // !!! Find a good name: eval,exec,script,code,render
    protected function eval($buffer, $params = null) {
        $this->renderBuffer($buffer, $params);
    }

    // Danger to use !!!
    protected function file($path, $params = null) {
        $this->renderFile($path, $params);
    }

    protected function block($name, $params = null) {
        $this->renderBlock($name, $params);
    }

    protected function layout($name, $params = null) {
        $this->renderLayout($name, $params);
    }
    
    protected function template($name, $params = null) {
        $this->renderTemplate($name, $params);
    }

    /**************************************************************************/
    // Singleton (Unused)
    /**************************************************************************/

    public static function create($app, $useBuffer = true)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $useBuffer);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/