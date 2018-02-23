<?php
/********************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Globals.class.php
 *     Class: Globals
 *     About: Application shared variables array 
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/microbe/
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

class Globals implements ArrayAccess
{
    /**************************************************************************/
    // Class variables

    private static $instance            = null;

    /**************************************************************************/
    // Instance variables

    protected $path                     = null;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    private function __construct($app, $path) {
        $this->app = $app;
        $this->path = $path;
    }
    
    private function __clone() {
    }

    /**************************************************************************/
    // Accessor
    /**************************************************************************/

    public function getPath($name = null) {
        return ($name) ? Path::getPath($this->path, $name) : $this->path;
    }

    /**************************************************************************/
    // Basic actions
    /**************************************************************************/

    public function exists($name) {
        $path = $this->getPath($name);
        return file_exists($path);
    }

    public function get($name) {
        $path = $this->getPath($name);
        if (file_exists($path)) {
            return file_get_contents($path, LOCK_EX);
        }
        return null;
    }

    public function set($name, $value) {
        $path = $this->getPath($name);
        return file_put_contents($path, $value, LOCK_EX);
    }

    public function remove($name) {
        $path = $this->getPath($name);
        return unlink($path);
    }

    /**************************************************************************/

    public function clear() {
        if ($directory = dir($this->path)) {
            while (false !== ($entry = $directory->read())) {
                if (is_file($entry)) {
                    unlink($entry);
                }
            }
            $directory->close();
        }
    }

    /**************************************************************************/
    // Array access implementation
    /**************************************************************************/

    function offsetExists($offset) {
        return $this->exists($offset);
    }

    function offsetGet($offset) {
        return $this->get($offset);
    }

    function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    function offsetUnset($offset) {
        $this->remove($offset);
    }

    /**************************************************************************/
    // Singleton
    /**************************************************************************/

    public static function create($app, $path)
    {
        if (self::$instance == null) {
            self::$instance = new self($app, $path);
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/******************************************************************************/