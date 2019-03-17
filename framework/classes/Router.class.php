<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Router.class.php
 *     Class: Router
 *     About: Router based on URI regex routes
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

class Router
{
    /**************************************************************************/
    // Class variables (unused)
    /**************************************************************************/

    /**
     * Static Router instance for single instance usage (singleton)
     * @var Router
     */
    private static $instance            = null;

    /**************************************************************************/
    // Instance variables
    /**************************************************************************/

    /**
     * Application facade instance
     * @var Application
     */
    protected $app                      = null;
    
    /**************************************************************************/
    // In
    // Url always ends with '/'
    // Uri always begins with '/'

    /**
     * Request scheme: http or https
     * @return string $scheme
     */
    protected $scheme                   = null;

    /**
     * Request host
     * @return string $host
     */
    protected $host                     = null;

    /**
     * Request port
     * @return string|int $port
     */
    protected $port                     = 0;

    /**************************************************************************/
    // In
    // Calculated

    /**
     * Request uri
     * @return string $uri
     */
    protected $uri                      = null;

    /**
     * Request url
     * @return string $url
     */
    protected $url                      = null;

    /**************************************************************************/
    // URI items

    /**
     * Parsed array of request uri parts splitted by slash '/'
     * @var string[]
     */
    protected $items                    = null;

    /**************************************************************************/
    // Out

    /**
     * Defined by routing rules controller name
     * @var string $controller
     */
    protected $controller               = null;

    /**
     * Defined by routing rules controller's action name
     * @var string $controller
     */
    protected $action                   = null;

    /**
     * Defined by routing rules layout name
     * @var string $controller
     */
    protected $layout                   = null;

    /**
     * Defined by routing rules template name
     * @var string $controller
     */
    protected $template                 = null;

    /**
     * Defined by routing rules http response code
     * @var string $controller
     */
    protected $code                     = null;

    /**
     * Defined by routing rules parameters
     * @var mixed[]|mixed|null $params
     */
    protected $params                   = null;

    /**************************************************************************/
    // Prefixes
    /**************************************************************************/

    /**
     * An application url prefix after server's 'document_root' if exists or null
     * @var string $prefix
     */
    protected $prefix = null;
//  protected $prefixes = array(); // Obsolete

    /**************************************************************************/
    // Filters (stub) !!!
    /**************************************************************************/

    /**
     * Routing filters
     * Don't used in this class
     * Overriden by configuration routing rules file (high priority)
     * Can be overriden by successors: RouterEx, AppRouter etc (low priority)
     * @var string[][] $filters
     */
    protected $filters = array();

    /**************************************************************************/
    // Rules
    /**************************************************************************/
    
    /**
     * Routing rules
     * Practically not used
     * Overriden by configuration routing rules file (high priority)
     * Can be overriden by successors: RouterEx, AppRouter etc (low priority)
     * Controller name MUST begin from low case letter
     * Action name MUST begin from low case letter
     * Params (if exists) MUST be associative array
     * @var string[][] $routes
     */
    protected $routes = array(
        // Empty
        array(
            'regex' => '#^.*$#',
        //  'match' => 'index',            
            'controller' => 'app',
            'action' => 'default',            
        //  'layout' => null,
        //  'action' => 'render',
        //  'template' => null,
        //  'action' => 'include',
        //  'code' => 200,
            'params' => ['name' => 'value']
        ),
    );

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Get framework facade class Application instance
     * @return Application
     */
    public function getApp() {
    //  return Application::getInstance();
        return $this->app;
    }

    /**************************************************************************/

    /**
     * Get request scheme
     * @return string
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     * Get requested hostname
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * Get request port
     * @return int
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * Get requested uri
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * Convert local path to application url
     * @param string $path Local path to requested object, null by default
     * @return string
     */
    public function getUrl($path = null) {
        return $path ? Url::getUrl($this->url, $path) : $this->url;
    }

    /**************************************************************************/

    /**
     * An application url prefix after server's 'document_root' if exists
     * @return string|null
     */
    public function getPrefix() {
        return $this->prefix;
    }

//  public function getPrefixes() {
//      return $this->prefixes;
//  }

    /**************************************************************************/

    /**
     * Get splitted by slash '/' request uri parts array
     * @return string[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Get true if splitted by slash '/' request uri parts array has elements
     * @return boolean
     */
    public function hasItems() {
        return is_array($this->items);
    }

    /**
     * Get count of splitted by slash '/' request uri parts array elements
     * @return int
     */
    public function getItemsCount() {
        return is_array($this->items) ? count($this->items) : 0;
    }

    /**
     * Get by name value of splitted by slash '/' request uri parts array element
     * @return mixed
     */
    public function getItem($index) {
        return isset($this->items[$index]) ? $this->items[$index] : null;
    }

    /**************************************************************************/

    /**
     * Get value of 'controller' parameter of router rule if exists
     * Same as getControllerName()
     * @return string|null
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * Get value of 'controller' parameter of router rule if exists
     * Same as getController()
     * @return string|null
     */
    public function getControllerName() {
        return $this->controller;        
    }
    
    /**************************************************************************/

    /**
     * Get value of 'layout' parameter of router rule if exists
     * Same as getLayoutName()
     * @return string|null
     */
    public function getLayout() {
        return $this->layout;
    }

    /**
     * Get value of 'layout' parameter of router rule if exists
     * Same as getLayout()
     * @return string|null
     */
    public function getLayoutName() {
        return $this->layout;
    }

    /**************************************************************************/

    /**
     * Get value of 'template' parameter router rule if exists
     * Same as getTemplateName()
     * @return string|null
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Get value of 'template' parameter router rule if exists
     * Same as getTemplate()
     * @return string|null
     */
    public function getTemplateName() {
        return $this->template;
    }

    /**************************************************************************/

    /**
     * Get value of 'action' parameter router rule if exists
     * Same as getActionName()
     * @return string|null
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Get value of 'action' parameter router rule if exists
     * Same as getAction()
     * @return string|null
     */
    public function getActionName() {
        return $this->action;    
    }

    /**************************************************************************/
    
    /**
     * Get value of 'code' parameter router rule if exists
     * Same as getAction()
     * @return int|null
     */
    public function getCode() {
        return $this->code;
    }

    /**************************************************************************/

    /**
     * Get value of 'params' parameter router rule if exists
     * @return mixed[]|mixed|null
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Get true if value of 'params' parameter router rule exists and is array
     * @return boolean
     */
    public function hasParams() {
        return is_array($this->params);
    }

    /**
     * Get array of values of 'params' parameter router rule or empty array
     * This method is safe to use because always return an array type value
     * @return mixed[]
     */
    public function getParamsArray() {
        return is_array($this->params) ? $this->params : [];
    }

    /**************************************************************************/
    // URL construction

    // !!! Don't remove this code !!!
    // Mixed with same name accessor
    /*
     * Get an application object url
     * @param string $path null by default
     * @return string
     */
//  public function getUrl($path) {
//      return Url::getUrl($this->url, $path);
//  }

    /**
     * Get an application object absolute url
     * @param string $path null by default
     * @return string
     */
    public function getAbsoluteUrl($path) {
        return Url::getAbsoluteUrl($this->url, $path);
    }

    /**
     * Get an application object relative url
     * @param string $path null by default
     * @return string
     */
    public function getRelativeUrl($path) {
        return Url::getRelativeUrl($this->url, $path);
    }

    /**************************************************************************/
    // Server variables
    /**************************************************************************/
    
    /**
     * Get a http server variable by name
     * @param string $name
     * @return string
     */
    protected function getServerString($name) {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/
    // All code executes here

    /**
     * Create a Router instance
     * @param Application $app The application instance
     * @param string $path Path to file with routing rules, null by default
     * @return Router
     */
    public function __construct($app, $path = null) {
    //  parent::__construct();
        $this->init($app, $path);
        $this->main();
    }

    /**************************************************************************/
    // Init
    /**************************************************************************/

    /**
     * Router instance variables initializer
     * @param Application $app The application instance
     * @param string $path Path to file with routing rules, null by default
     * @return void
     */
    protected function init($app, $path = null)
    {
        $this->app = $app;

        if (file_exists($path)) {

            $json = file_get_contents($path);
            $json = Strings::removeComments($json);

            $routes = json_decode($json, TRUE);
        //  $this->prefixes = $routes['prefixes']; // Obsolete
            $this->routes = $routes['routes'];
        }

        // Detect Url and Uri
        $this->url = $this->detectUrl();
        $this->uri = $this->detectUri();
        
        // Handle prefixes: update Url and Uri if needs
        $this->prefix = $this->detectPrefix();
        $this->handlePrefix($this->prefix);
    //  $this->handlePrefixes(); // Obsolete

        // Default
        $this->layout     = null;
        $this->template   = null;           
        $this->controller = null;
        $this->action     = null;
        $this->code       = null;
        $this->params     = null;
    }
    

    /**************************************************************************/
    // Handle URL

    /**
     * Detect an application url
     * @return string
     */
    public function detectUrl() {
        // In
        $host = $this->getServerString('HTTP_HOST');
        $scheme = $this->getServerString('REQUEST_SCHEME');
        $port = $this->getServerString('SERVER_PORT');

        // Url
        if (
            (($scheme == 'http') && ($port != 80))
            ||
            (($scheme == 'https') && ($port != 443))
        ) {
            $url = $scheme.'://'.$host.':'.$port.'/';
        } else {
            $url = $scheme.'://'.$host.'/';
        }

        // Out
        $this->host = $host;
        $this->scheme = $scheme;
        $this->port = $port;

        return $this->url = $url;
    }

    /**************************************************************************/
    // Handle URI

    /**
     * Detect an application uri
     * @return string
     */
    public function detectUri() {
        $uri = $this->getServerString('REQUEST_URI');
        if (($length = strpos($uri, '?')) !== false)
            $uri = substr($uri, 0, $length);
        return $this->uri = $uri;
    }

    /**************************************************************************/
    // Handle prefixes

    // 2019/03/07 {
    // Prefix autodetection

    /**
     * Detect an application url prefix after server's 'document_root' if exists
     * @return string
     */
    public function detectPrefix()
    {
    //  echo $_SERVER['SCRIPT_FILENAME'].'<br>';
    //  echo $_SERVER['DOCUMENT_ROOT'].'<br>';
        $document_root = $this->getServerString('DOCUMENT_ROOT');
        $script_filename = $this->getServerString('SCRIPT_FILENAME');
        $result = substr($script_filename, strlen($document_root));
        $result = substr($result, 0, -1 * strlen('/index.php'));
        return $result;
    }

    /**
     * Correct an $uri and $url by url prefix if $prefix not empty
     * @param string $prefix
     * @return boolean
     */
    protected function handlePrefix($prefix)
    {
        if ($prefix) {
            $prefix = '/'.Url::adjust($prefix);
            $length = strlen($prefix);
            if (strncmp($this->uri, $prefix, $length) === 0) {
                $this->uri = substr($this->uri, $length);
                $this->url = Url::join($this->url, $prefix).'/';
                return true;
            }
        }
        return false;
    }
    // } 2019/03/07

    // Obsolete
    // From 2019/03/07 prefix autodetected
//  protected function handlePrefixes()
//  {
//      if (is_array($this->prefixes)) {
//          foreach ($this->prefixes as $prefix) {
//              if ($this->handlePrefix($prefix))
//                  break;
//          }
//      }
//  }

    /**************************************************************************/
    // Rules
    /**************************************************************************/

    /**
     * Check match rule for http request uri or not
     * Return a last rule of rules if not find or null if rules not defined
     * @param mixed[] $route Route to check
     * @param string $value Uri
     * @return boolean
     */
    protected function isMatch($route, $value)
    {
        // Match
        $match = Arrays::get($route, 'match');
        if ($match) {
            $match = '/'.Url::adjustLeft($match);
            if ($value === $match) {
                $matches = array();
                $matches[] = $match;
                $matches[] = $match;                
            //  echo 'Match<br><br>';
            //  var_dump($matches);
                return $matches;
            }
        }

        // Regex
        $regex = Arrays::get($route, 'regex');
        if ($regex) {        
            if (preg_match($regex, $value, $matches)) {
            //  echo 'Regex<br><br>';
            //  var_dump($matches);
                return $matches;
            }
        }

        return false;
    }

    /**************************************************************************/

    /**
     * Replace all occurences of ${N} in params to regex match with number N
     * ${1} = matches[1]; ${2} = matches[2]; ...
     * @param mixed[] $params Params to check
     * @param mixed[] $values Values for substitution
     * @return mixed[]
     */
    protected function updateParams($params, $values)
    {
        // Assert $parrams is an array
        if (!is_array($params))
            return $params;

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

    //  echo 'Params<br><br>';
    //  var_dump($params);
        return $params;
    }

    /**************************************************************************/

    /**
     * Find a matching routing rule for http request uri
     * Return a last rule if not find the match or null if routes not defined
     * @param string $value
     * @return mixed[]|null Routing rule as array of mixed parameters
     */
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

    /**
     * Parse http request uri and find a matching rule
     * Set http response code by 'code' parameter of rule if exists
     * @return mixed[]|null Routing rule as array of mixed parameters or null
     */
    protected function router()
    {
        // Explode
        $this->items = explode('/', $this->uri);

        // Parse URI
        if ($route = $this->getRoute($this->uri)) {
            $this->controller = Arrays::get($route, 'controller');
            $this->action     = Arrays::get($route, 'action');
            $this->layout     = Arrays::get($route, 'layout');
            $this->template   = Arrays::get($route, 'template');
            $this->code       = Arrays::get($route, 'code');
            $this->params     = Arrays::get($route, 'params');
        }

        // 2019/03/07 {
        // Here we set response code by routing rule parameter 'code'
        if ($this->code) {
            $code = intval($this->code);
            http_response_code($code);
        }
        // } 2019/03/07

        return $route;
    }

    /**************************************************************************/
    // Filter
    /**************************************************************************/

    /**
     * Apply filter rules before routing
     * Doing nothing
     * @return void
     */
    protected function filter() {
    }

    /**************************************************************************/    
    // User routines
    /**************************************************************************/

    /**
     * Actions before routing
     * Doing nothing
     * @return void
     */
    protected function before() {
    }

    /**
     * Actions after routing
     * Doing nothing
     * @return void
     */
    protected function after() {
    }

    /**************************************************************************/
    // Main
    /**************************************************************************/

    /**
     * Apply filter and routing rules
     * @return void
     */
    protected function main() {
        $this->before();
        $this->filter();
        $this->router();
        $this->after();
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return Router if instantiated or null if not
     * @return boolean
     */
    public static function hasInstance() {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Router instance creation method
     * For correct usage make method __construct private
     * @param Application $app The application instance
     * @param string $path Path to file with routing rules, null by default
     * @return Router
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

/******************************************************************************/