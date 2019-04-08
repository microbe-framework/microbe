<?php
/********************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Globals.php
 *     Class: Globals
 *     About: Application shared file-variables array
 *     Begin: 2017/05/01
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

use \Microbe\Library\Path;

class Globals implements ArrayAccess
{
    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     *
     * @var Application $app
     */
    protected $app                      = null;

    /**
     * Path to directory with global variables
     *
     * @var string $path
     */
    protected $path                     = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Return application facade instance
     *
     * @return Application
     */
    public function &getApp() {
        return $this->app;
    }

    /**
     * Return a path to directory with global variables
     * If variable $path not initialized return null
     *
     * @return string|null
     */
    public function getPath() {
        return $this->path;
    }

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a Vars instance
     * Vars are application variables
     *
     * @param Application $app
     * @param string $path
     * @return Globals
     */
    public function __construct(&$app, $path)
    {
        $this->app  = &$app;
        $this->path = $path;
    }
    
    /**************************************************************************/
    // Path
    /**************************************************************************/

    /**
     * Return a path to file with global file variable $name
     *
     * @param string $name
     * @return string
     */
    public function getVarPath($name) {
        return Path::getPath($this->path, $name);
    }

    /**************************************************************************/
    // Basic actions
    /**************************************************************************/

    /**
     * Return true if file variable with $name exists, false otherwise
     *
     * @param string $name
     * @return string
     */
    public function exists($name)
    {
        $path = $this->getVarPath($name);
        return file_exists($path);
    }

    /**
     * Return value of file variable with $name if exists, null otherwise
     *
     * @param string $name
     * @return string
     */
    public function get($name
    {
        $path = $this->getVarPath($name);
        if (file_exists($path)) {
            return file_get_contents($path, LOCK_EX);
        }
        return null;
    }

    /**
     * Set value of file variable with $name to $file
     * Return true if file variable successfully written, false otherwise
     *
     * @param string $name
     * @return string
     */
    public function set($name, $value)
    {
        $path = $this->getVarPath($name);
        return file_put_contents($path, $value, LOCK_EX);
    }

    /**
     * Remove file variable with $name if exists
     * Return true if file variable successfully unlibked, false otherwise
     *
     * @param string $name
     * @return boolean
     */
    public function remove($name)
    {
        $path = $this->getVarPath($name);
        return unlink($path);
    }

    /**************************************************************************/

    /**
     * Remove all file variables in Globals
     *
     * @return vod
     */
    public function clear()
    {
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

    /**
     * Return true if element with $offset exists, false otherwise
     *
     * @param int $offset
     * @return mixed
     */
    public function offsetExists($offset) {
        return $this->exists($offset);
    }

    /**
     * Return value of element with $offset, null if can't
     *
     * @param int $offset
     * @return mixed
     */
    public function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * Set element with $offset to $value
     *
     * @param int $offset
     * @return void
     */
    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    /**
     * Unset element with $offset
     *
     * @param int $offset
     * @return void
     */
    public function offsetUnset($offset) {
        $this->remove($offset);
    }

    /**************************************************************************/
}

/******************************************************************************/