<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Loader.php
 *     Class: Loader
 *     About: Classes loader (PSR-4 incompatible)
 *     Begin: 2019/03/11
 *   Current: 2019/04/08
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

    /**
     * Application entry point directory
     *
     * @var string $root
     */
    public static $root = null;

    /**************************************************************************/

    /**
     * Associative array with namespaces as keys and paths to directories
     *
     * @var string[] $namespaces
     */
    public static $namespaces = array(
        'Microbe' => './framework/',
        'Vendor'  => './vendor/',
        'App'     => './application/'
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
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        $path = self::$root . $prefix . $class . '.php';

        return require($path);
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
     * [!] application entry point is 'index.php'
     * @return void
     */
    public static function init() {
        $root = $_SERVER['SCRIPT_FILENAME'];
    //  self::$root = substr($root, 0, strlen($root) - strlen('/web/index.php'));
        self::$root = substr($root, 0, strlen($root) - 14);
        self::register();
    }

    /**************************************************************************/
}

/*******************************************************************************/

Loader::init();

/******************************************************************************/