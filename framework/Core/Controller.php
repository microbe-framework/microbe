<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Controller.php
 *     Class: Controller
 *     About: Controller
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

use \Microbe\Library\Http;

class Controller
{
    /**************************************************************************/
    // Class variables

    /**
     * Static Controller instance for single instance usage (singleton)
     *
     * @var Controller
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

//  protected $buffer = null;

    /**
     * Application router instance
     *
     * @var Router|RouterEx|AppRouter
     */
    protected $router                   = null;

    /**
     * Application view class instance
     *
     * @var View|AppView
     */
    protected $view                     = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /*
     * Get application router instance
     *
     * @return Router|RouterEx|AppRouter
     */
//  protected function &getRouter() {
    //  return $this->getApp()->getRouter();
//      return $this->router;
//  }
    
    /*
     * Get application view instance
     *
     * @return View|AppView
     */
//  protected function &getView() {
    //  return $this->getApp()->getView();
//      return $this->view;        
//  }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Controller instance
     *
     * @param Application $app The application instance
     * @return Controler
     */
    function __construct()
    {
    //  $this->app    = &$app;
        $this->app    = &Registry::getApp();
    //  $this->buffer = $this->app->getBuffer();
        $this->router = &$this->app->getRouter();
        $this->view   = &$this->app->getView();
    }

    /**************************************************************************/
    // Redirect

    /**
     * Immediately redirection to specified $url with http code $code
     *
     * @param string $url Where to redirect
     * @param int|false Http code of redirection, false by default (301)
     * @return null
     */
    public function redirect($url, $code = false)
    {
        Http::redirect($url, $code);
        return null; // <= never executes
    }

    /**************************************************************************/
    // Actions
    /**************************************************************************/

    /**
     * Default controller action
     * Doing nothing
     *
     * @return null
     */
    public function defaultAction()
    {
        return null;
    }

    /**************************************************************************/
    // Singleton (unusable)
    /**************************************************************************/

    /**
     * Return instantiated Controller or not
     *
     * @return boolean
     */
    public static function hasInstance()
    {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Controller instance creation method
     * For correct usage make method __construct private
     *
     * @param Application $app The application instance
     * @return Controler
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/