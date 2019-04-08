<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Model.php
 *     Class: Model
 *     About: Data model
 *     Begin: 2019/03/11
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

class Model extends \Microbe\Library\ProxyConnection
{
    /**************************************************************************/
    // Class variables (unused)

    /**
     * Static Model instance for single instance usage (singleton)
     *
     * @var Model
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
    // Accessors
    /**************************************************************************/

    /**
     * Get framework facade class Application instance
     *
     * @return Application
     */
    public function &getApp()
    {
        return $this->app;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/
    // All code executes here

    /**
     * Create a Model instance with use application configuration parameters
     * If 'database.driver' parameter is set trying to connect to database
     * If parameters are correct get a database connection
     *
     * @param Application $app The application instance
     * @param boolean $connect Connect to database or not, false by default
     * @return Model
     */
    public function __construct(&$app)
    {

        $this->connection = null;

        $this->app        = &$app;

        $config           = &$this->app->getConfig();

        $driver           = $config->get('database.driver');
        $host             = $config->get('database.host');
        $port             = $config->get('database.port');
        $user             = $config->get('database.user');
        $pass             = $config->get('database.pass');
        $base             = $config->get('database.base');

        parent::__construct($driver, $host, $port, $user, $pass, $base);
    }

    /**************************************************************************/
    // Singleton (unused)
    /**************************************************************************/

    /**
     * Return true if Model is instantiated or false otherwise
     *
     * @return boolean
     */
    public static function hasInstance()
    {
        return (self::$instance != null);
    }

    /**************************************************************************/

    /**
     * Single Model instance creation method
     * For correct usage make method __construct private
     *
     * @param Application $app The application instance
     * @param boolean $connect Connect to database or not, false by default
     * @return Model
     */
    public static function getInstance(&$app)
    {
        if (self::$instance == null) {
            self::$instance = new self($app);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/*******************************************************************************/