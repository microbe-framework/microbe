<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Controller.class.php
 *     Class: Controller
 *     About: Controller
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/microbe-0.1.0/
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

class Controller
{
    /**************************************************************************/
    // Class variables

    private static $instance = null; 

    /**************************************************************************/
    // Instance variables

    protected $app = null;

//  protected $buffer = null;
    
    protected $router = null;
    
    protected $view = null;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    function __construct($app) {
    //  parent::__construct();
        $this->init($app);
    }

    /**************************************************************************/
    // Init

    public function init($app)
    {
        $this->app = $app;
        if ($this->app) {
        //  $this->buffer = $this->app->getBuffer();
            $this->router = $this->app->getRouter();
            $this->view = $this->app->getView();
        }
    }

    /**************************************************************************/
    // Redirect

    public function redirect($url, $code = false) {
    //  header('Location: '.$url);
    //  exit();
        Http::redirect($url, $code);
        return null; // <= never executes
    }

    /**************************************************************************/
    // Actions
    /**************************************************************************/

    public function defaultAction() {
        return null;
    }

    /**************************************************************************/
    // Singleton (unusable)
    /**************************************************************************/

    public static function create($app)
    {
        if (self::$instance == null) {
            self::$instance = new self($app);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/