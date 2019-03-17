<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Loader.class.php
 *     Class: Loader
 *     About: Classes loader
 *     Begin: 2019/03/11
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

class Loader
{
    /**************************************************************************/

    /**
     * Associative array with classnames as keys and paths to files with classes
     * @var string[] $classes
     */
    public static $classes = array(

        // Library classes
        'Microbe\Arrays' => './framework/library/Arrays.class.php',
        'Microbe\Base' => './framework/library/Base.class.php',
        'Microbe\BaseConnection' => './framework/library/BaseConnection.class.php',
        'Microbe\CloudFlare' => './framework/library/CloudFlare.class.php',
        'Microbe\Collection' => './framework/library/Collection.class.php',
        'Microbe\Debug' => './framework/library/Debug.class.php',
        'Microbe\Http' => './framework/library/Http.class.php',
        'Microbe\HttpRequest' => './framework/library/HttpRequest.class.php',
        'Microbe\Images' => './framework/library/Images.class.php',
        'Microbe\Mail' => './framework/library/Mail.class.php',
        'Microbe\MySqliConnection' => './framework/library/MySqliConnection.class.php',
        'Microbe\Net' => './framework/library/Net.class.php',
        'Microbe\Params' => './framework/library/Params.class.php',
        'Microbe\Path' => './framework/library/Path.class.php',
        'Microbe\ProxyConnection' => './framework/library/ProxyConnection.class.php',
        'Microbe\Random' => './framework/library/Random.class.php',
        'Microbe\Record' => './framework/library/Record.class.php',
        'Microbe\Records' => './framework/library/Records.class.php',
        'Microbe\Recordset' => './framework/library/Recordset.class.php',
        'Microbe\Sitemap' => './framework/library/Sitemap.class.php',
        'Microbe\Strings' => './framework/library/Strings.class.php',
        'Microbe\Types' => './framework/library/Types.class.php',
        'Microbe\Upload' => './framework/library/Upload.class.php',
        'Microbe\Url' => './framework/library/Url.class.php',
//      '' => './framework/library/.class.php',

        // Framework classes
        'Microbe\Application' => './framework/classes/Application.class.php',
        'Microbe\Config' => './framework/classes/Config.class.php',
        'Microbe\Controller' => './framework/classes/Controller.class.php',
        'Microbe\Globals' => './framework/classes/Globals.class.php',
        'Microbe\Loader' => './framework/classes/Loader.class.php',
        'Microbe\Model' => './framework/classes/Model.class.php',
        'Microbe\Registry' => './framework/classes/Registry.class.php',
        'Microbe\Router' => './framework/classes/Router.class.php',
        'Microbe\RouterEx' => './framework/classes/RouterEx.class.php',
        'Microbe\Vars' => './framework/classes/Vars.class.php',
        'Microbe\View' => './framework/classes/View.class.php',
//      '' => './framework/classes/.class.php',

    );

    /**************************************************************************/

    /**
     * Adds to $classes item with $class as key and $path to file with this class
     * @param string $class
     * @param string $path
     * @return void
     */
    public static function set($class, $path) {
        self::$classes[$class] = $path;
    }

    /**************************************************************************/

    /**
     * Load a $class by name
     * Return null if file with $class not found
     * @param string $class
     * @return boolean|null
     */
    public static function main($class) {
        $value = isset(self::$classes[$class]) ? self::$classes[$class] : null;
        if (($value === null) || (file_exists($value) == false))
            return null;

        return require_once($value);
    }

    /**************************************************************************/

    /**
     * Register global class loader function Loader::main
     * @return void
     */
    public static function register() {
        spl_autoload_register('Microbe\Loader::main');
    }

    /**************************************************************************/

    /**
     * Unregister global class loader function Loader::main
     * @return void
     */
    public static function unregister() {
        spl_autoload_unregister('Microbe\Loader::main');
    }

    /**************************************************************************/

    /**
     * Init Loader class
     * Register global class loader function Loader::main
     * @return void
     */
    public static function init() {
        self::register();
    }

    /**************************************************************************/
}

/*******************************************************************************/

Loader::init();

/******************************************************************************/