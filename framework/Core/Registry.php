<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Registry.php
 *     Class: Registry
 *     About: Registry class for application objects storage
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

// class Registry extends \Microbe\Library\Collection
class Registry
{
    /**************************************************************************/
    // Variables

    /**
     * Null varuable
     *
     * @var null $nothing
     */
    protected static $nothing           = null;

    /**
     * Application objects collection
     *
     * @var Collection $objects
     */
    protected static $objects           = array();

    /**
     * Application instance
     *
     * @var Application $app
     */
    protected static $app               = null;

    /**
     * Application configuration
     *
     * @var Config $config
     */
    protected static $config            = null;

    /**
     * Application log
     *
     * @var Log $log
     */
    protected static $log               = null;

    /**
     * Application global variables
     *
     * @var Collection $globals
     */
    protected static $globals           = null;

    /**
     * Application variables
     *
     * @var Collection $vars
     */
    protected static $vars              = array();

    /**
     * Application parameters
     *
     * @var Collection $params
     */
    protected static $params            = array();

    /**************************************************************************/
    // Accessors

    /**
     * Return application instance
     *
     * @return Application
     */
    public static function &getApp()
    {
        return self::$app;
    }

    /**
     * Assign application instance
     *
     * @param  Application $app
     * @return none
     */
    public static function setApp(&$app)
    {
        self::$app = &$app;
    }

    /**
     * Return application configuration
     *
     * @return Config
     */
    public static function &getConfig()
    {
        return self::$config;
    }

    /**
     * Assign application configuration
     *
     * @param  Config $config
     * @return none
     */
    public static function setConfig(&$config)
    {
        self::$config = &$config;
    }

    /**
     * Return application log
     *
     * @return Log
     */
    public static function &getLog()
    {
        return self::$log;
    }

    /**
     * Assign application log
     *
     * @param  Log $log
     * @return none
     */
    public static function setLog(&$log)
    {
        self::$log = &$log;
    }

    /**
     * Return application global variables object
     *
     * @return Globals
     */
    public static function &getGlobals()
    {
        return self::$globals;
    }

    /**
     * Assign application globals variables object
     *
     * @param  Globals $globals
     * @return none
     */
    public static function setGlobals(&$globals)
    {
        self::$globals = &$globals;
    }

    /**
     * Return application variables
     *
     * @return Vars
     */
    public static function &getVars()
    {
        return self::$vars;
    }

    /**
     * Assign application variables
     *
     * @param  Vars $vars
     * @return none
     */
    public static function setVars(&$vars)
    {
        self::$vars = &$vars;
    }

    /**
     * Return application parameters
     *
     * @return Params
     */
    public static function &getParams()
    {
        return self::$params;
    }

    /**
     * Assign application parameters
     *
     * @param  Params $params
     * @return none
     */
    public static function setParams(&$params)
    {
        self::$params = &$params;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Registry instance
     *
     * @param Application $app The application instance
     * @return Registry
     */
    public function __construct(&$app) {
    //  $this->app    = &$app;
        self::$app    = &$app;
    //  self::$config = $app->getConfig();
    //  self::$vars   = $app->getVars();
    }

    /**************************************************************************/

    /**
     * Return exists element with $key or not
     *
     * @param  mixed $className
     * @return boolean
     */
    public static function has($className)
    {
        return array_key_exists($className, self::$objects);
    }

    /**
     * Set element with $key to $value
     *
     * @param  mixed $className
     * @return mixed|null
     */
    public static function get($className)
    {
    //  return (self::has($className)) ? self::$objects[$className] : null;
        return (array_key_exists($className, self::$objects)) ? self::$objects[$className] : null;
    }

    /**
     * Set element with $key to $value
     *
     * [!] PHP automatically assign objects by reference
     * @param  mixed $className
     * @param  mixed $instance
     * @return void
     */
    public static function set($className, $instance)
    {
        self::$objects[$className] = &$instance;
    }

    /**
     * Set element with $key to $value
     *
     * [!] PHP automatically assign objects by reference
     * @param  mixed $className
     * @param  mixed $instance
     * @return void
     */
    public static function _setRef($className, &$instance)
    {
        self::$objects[$className] = &$instance;
    }

    /**************************************************************************/

    /**
     * Set element with $key to $value by reference
     *
     * [!] PHP automatically assign objects by reference
     * @param  mixed $className
     * @param  mixed $instance
     * @return mixed
     */
    public static function &setObject($className, $instance)
    {
        self::$objects[$className] = &$instance;
        return $instance;
    }

    /**
     * Set element with $key to $value by reference
     *
     * [!] PHP automatically assign objects by reference
     * @param  mixed $className
     * @param  mixed $instance
     * @return mixed
     */
    public static function &_setObjectRef($className, &$instance)
    {
        self::$objects[$className] = &$instance;
        return $instance;
    }

    /**
     * Return existing or create new class instance by $className
     *
     * @param string $className
     * @return mixed
     */
    public static function &getObject($className)
    {
        if ($instance = self::get($className)) {
            return $instance;
        }
    //  $instance = new $className(self::$app);
    //  self::setObject($className, $instance);
    //  return $instance;
        return self::setObject($className, new $className());
    }

    /**************************************************************************/
}

/******************************************************************************/