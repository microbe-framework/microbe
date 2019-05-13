<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Loader.php
 *     Class: Loader
 *     About: Classes loader (PSR-4 incompatible)
 *     Begin: 2019/03/11
 *   Current: 2019/05/01
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

class Loader
{
    /**************************************************************************/
    // CMS

    const CMS_URI                       = 'cms';

    const CMS_PATH                      = 'cms';

    const APP_PATH                      = 'application';

    /**************************************************************************/

    /*
     * CMS
     *
     * @var boolean $cms
     */
//  public static $cms                  = false;

    /**
     * Application entry point directory
     *
     * @var string $root
     */
    public static $root                 = null;

    /**************************************************************************/

    /**
     * Associative array with namespaces as keys and paths to directories
     *
     * @var string[] $namespaces
     */
    public static $namespaces = array(
        'Microbe' => './framework/',
        'Vendor'  => './vendor/',
        'App'     => './' . self::APP_PATH . '/',
        'Cms'     => './' . self::CMS_PATH . '/',
    );

    /**************************************************************************/

    /**
     * Load a $class by name
     * Return null if file with $class not found
     *
     * [!] require() faster then require_once()
     * [!] absolute path faster then relative
     * @param string $class
     * @return boolean|null
     */
    public static function main($class) {

        $prefix = './application/';

        if ($pos = strpos($class, '\\')) {
            $vendor = substr($class, 0, $pos);
            if (isset(self::$namespaces[$vendor])) {
                $prefix = self::$namespaces[$vendor];
                $class  = substr($class, $pos + 1);
            }
        }

        $prefix = ltrim($prefix, '.');
        $class  = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        $path   = self::$root . $prefix . $class . '.php';
    //  echo $path.'<br>';
        return require($path);
    }

    /**************************************************************************/
    // [-] Unused
    // [-] Marked to deletion

    /*
     * Detect an CMS mode
     *
     * @return void
     */
/*  protected static function detectCms()
    {
        // Request URI
        $uri = $_SERVER['REQUEST_URI'];

        // Remove uri tail from ?
        if (($tail = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $tail);
        }

        $count = strlen(self::CMS_URI);
        $b = boolval(substr($uri,   -1 * $count) =='/' . self::CMS_URI);
        $a = boolval(substr($uri, 0, 1 + $count) =='/' . self::CMS_URI . '/');

        self::$cms = ($a || $b);

        // App namespace calls divert to CMS
        if (self::$cms) {
            self::$namespaces['App'] = './' . self::CMS_PATH . '/';
        }

    //  var_dump(self::$namespaces);
    }

    /**************************************************************************/

    /**
     * Adds to $namespaces the $namespace as key with path to directory
     *
     * @param string $namespace
     * @param string $path
     * @return void
     */
    public static function set($namespace, $path) {
        self::$namespaces[$namespace] = $path;
    }

    /**************************************************************************/

    /**
     * Register global class loader function Loader::main
     *
     * @return void
     */
    public static function register() {
        spl_autoload_register('Microbe\Loader::main');
    }

    /**************************************************************************/

    /**
     * Unregister global class loader function Loader::main
     *
     * @return void
     */
    public static function unregister() {
        spl_autoload_unregister('Microbe\Loader::main');
    }

    /**************************************************************************/

    /**
     * Init Loader class
     * Register global class loader function Loader::main
     *
     * [!] application entry point is './web/index.php'
     * @return void
     */
    public static function init() {
    //  self::detectCms();
        self::$root = dirname($_SERVER['SCRIPT_FILENAME'], 3);
        self::register();
    }

    /**************************************************************************/
}

/*******************************************************************************/

Loader::init();

/******************************************************************************/