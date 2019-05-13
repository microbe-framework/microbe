<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Model.php
 *     Class: Model
 *     About: Data model
 *     Begin: 2019/03/11
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

class Model extends \Microbe\Library\ProxyConnection
{
    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     *
     * @var Application
     */
    protected $app                      = null;

    /**
     * Application configuration class instance
     *
     * @var Config $config
     */
    protected $config                   = null;

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
    public function __construct()
    {
        $this->connection = null;

    //  $this->app        = &$app;
        $this->app        = &Registry::getApp();

    //  $config           = &$this->app->getConfig();
        $this->config     = &Registry::getConfig();

        $config           = &$this->config;

        $driver           = $config->get('database.driver');
        $host             = $config->get('database.host');
        $port             = $config->get('database.port');
        $user             = $config->get('database.user');
        $pass             = $config->get('database.pass');
        $base             = $config->get('database.base');

        parent::__construct($driver, $host, $port, $user, $pass, $base);
    }

    /**************************************************************************/

    /**
     * Execute the named query $queryName and return a result
     *
     * @param  string $queryName
     * @return mixed
     */
    public function run($queryName)
    {
        $queryFile = $this->config->getQuery($queryName);
        return $this->queryFile($queryFile);
    }

    /**************************************************************************/
}

/*******************************************************************************/