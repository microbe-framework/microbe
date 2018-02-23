<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Router.class.php
 *     Class: Router
 *     About: Router based on URI regex routes 
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
 
/******************************************************************************/

class Router
{
    /**************************************************************************/
    // Class variables
    /**************************************************************************/

    private static $instance            = null;

    /**************************************************************************/
    // Instance variables
    /**************************************************************************/

    protected $app                      = null;
    
    /**************************************************************************/
    // In

    protected $host                     = null;
    protected $protocol                 = null;
    protected $uri                      = null;
    protected $url                      = null;

    /**************************************************************************/
    // URI items

    protected $items                    = null;
    
    /**************************************************************************/
    // Out
    
    protected $controller               = null;
    protected $action                   = null;
    protected $params                   = null;

    /**************************************************************************/
    // Rules
    /**************************************************************************/
    // Controller name MUST begin from low case letter
    // Action name MUST begin from low case letter
    // Params (if exists) MUST be associative array
    
    protected $routes = array(
        // Empty
        array(
            'regex' => '#^.*$#',
            'controller' => 'app',
            'action' => 'default',
            'params' => ['name' => 'value']
        ),
    );

    /**************************************************************************/
    // Accessors
    /**************************************************************************/
   
    public function getHost() {
        return $this->host;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function getUri() {
        return $this->uri;
    }

//  public function getUrl() {
//      return $this->url;
//  }
    
    public function getUrl($path = null) {
        return ($path) ? Url::getUrl($this->url, $path) : $this->url;
    }

    /**************************************************************************/

    public function getItems() {
        return $this->items;
    }

    public function hasItems() {
        return is_array($this->items);
    }

    public function getItemsCount() {
        return is_array($this->items) ? count($this->items) : 0;
    }

    public function getItem($index) {
        return isset($this->items[$index]) ? $this->items[$index] : null;
    }

    /**************************************************************************/

    public function getController() {
        return $this->controller;
    }

    // Naming convention
    public function getControllerName() {
        return $this->controller ? $this->controller.'Controller' : null;
    }
    
    /**************************************************************************/

    public function getAction() {
        return $this->action;
    }

    // Naming convention
    public function getActionName() {
        return $this->action ? $this->action.'Action' : null;
    }

    /**************************************************************************/

    public function getParams() {
        return $this->params;
    }

    public function hasParams() {
        return is_array($this->params);
    }

    public function getParamsArray() {
        return is_array($this->params) ? $this->params : [];
    }

    /**************************************************************************/
    // URL construction

//  public function getUrl($path) {
//      return Url::getUrl($this->url, $path);
//  }

    public function getAbsoluteUrl($path) {
        return Url::getAbsoluteUrl($this->url, $path);
    }
    
    public function getRelativeUrl($path) {
        return Url::getRelativeUrl($this->url, $path);
    }

    /**************************************************************************/
    // Server variables
    /**************************************************************************/
    
    protected function getServerString($name) {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/
    // All code executes here

    function __construct($app, $path = null) {
    //  parent::__construct();
        $this->init($app, $path);
        $this->main();
    }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    protected function init($app, $path = null)
    {
        $this->app = $app;
        
        if (file_exists($path)) {

            $json = file_get_contents($path);

            // Search and remove C-style comments like /* */ and //
            $json = preg_replace(
                "#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#",
                '',
                $json
            );

        //  echo '<br><br>';            
        //  var_dump($json);
            $routes = json_decode($json, TRUE);
        //  echo '<br><br>';
        //  var_dump($this->routes);
            $this->routes = $routes['routes'];
        //  echo '<br><br>';    
        //  var_dump($this->routes);
        //  $this->filters = $routes['filters'];  
        }

        // In
        $this->host = $this->getServerString('HTTP_HOST');
        $this->protocol = $this->getServerString('REQUEST_SCHEME');
        $this->uri = $this->getServerString('REQUEST_URI');

        // Url
        $this->url = $this->protocol.'://'.$this->host.'/';
        
        // Default
        $this->controller = null;
        $this->action = null;
        $this->params = null;
    }

    /**************************************************************************/
    // Rules
    /**************************************************************************/

    protected function isMatch($route, $value)
    {
        $regex = $route['regex'];
        if (preg_match($regex, $value, $matches)) {
            return $matches;
        }
        return false;
    }

    /**************************************************************************/
    // Replace all occurences of ${N} in params to regex match with number N
    // ${1} = matches[1]; ${2} = matches[2]; ...

    protected function updateParams($params, $values)
    {
        // Assert $parrams is an array
        if (!is_array($params)) {
            return $params;
        }
        
        // Create regexes array by matches
        $index = 0;
        $regexes = array();
        foreach ($values as $value) {
            $regexes[] = '/\$\{'.($index++).'\}/';
        }

        // Traverse $params
        foreach ($params as $key => $value) {
            $params[$key] = preg_replace($regexes, $values, $value);
        }

        return $params;
    }

    /**************************************************************************/
    // If can't find a match then return a last route

    protected function getRoute($value)
    {
        foreach ($this->routes as $route) {
            if ($matches = $this->isMatch($route, $value)) {
                if (isset($route['params'])) { // && is_array($route['params'])) {
                    $route['params'] = $this->updateParams($route['params'], $matches);
                }
                break;
            }
        }
        return $route;
    }

    /**************************************************************************/
    // Router
    /**************************************************************************/

    protected function router()
    {
        // Explode
        $this->items = explode('/', $this->uri);

        // Parse URI
        if ($route = $this->getRoute($this->uri)) {
            $this->controller = $route['controller'];
            $this->action = $route['action'];
            $this->params = isset($route['params']) ? $route['params'] : null;
        }
    }

    /**************************************************************************/
    // Filter
    /**************************************************************************/

    protected function filter() {
    }

    /**************************************************************************/    
    // User routines
    /**************************************************************************/

    protected function before() {
    }

    protected function after() {
    }

    /**************************************************************************/
    // Main
    /**************************************************************************/

    protected function main() {
        $this->before();
        $this->filter();
        $this->router();
        $this->after();
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    public static function create()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/******************************************************************************/