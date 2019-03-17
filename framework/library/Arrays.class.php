<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Arrays.class.php
 *     Class: Arrays
 *     About: Arrays routines
 *     Begin: 2017/05/01
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

class Arrays
{
    /**************************************************************************/
    // Arrays
    /**************************************************************************/

    /**
     * Return true if value with $key exists in array $var, false otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return boolean
     */
    public static function has($vars, $key) {
        return (is_array($vars) && isset($vars[$key]));
    }

    /**
     * Return value with $key from array $vars if exists, null otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return mixed
     */
    public static function get($vars, $key) {
        return self::has($vars, $key) ? $vars[$key] : null;
    }

    /**
     * Set $value for $key in array $var
     * @param mixed[] $vars
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public static function set($vars, $key, $value) {
    //  return $vars[$key] = $value;
        if (is_array($vars)) $vars[$key] = $value;
    }
    
    /**
     * Counts the number of items in the provided array $vars
     * @param mixed[] $vars
     * @return int
     */
    public static function count($vars) {
        return is_array($vars) ? count($vars) : 0;
    }

    /**************************************************************************/

    /**
     * Return value with $key from array $vars if exists, null otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return mixed
     */
    public static function getValue($vars, $key) {
        return self::has($vars, $key) ? $vars[$key] : null;
    }

    /**
     * Return value with $key from array $vars as boolean if exists, false otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return boolean
     */
    public static function getBoolean($vars, $key) {
        // boolval: PHP 5 >= 5.5.0, PHP 7
    //  return self::has($vars, $key) ? boolval($vars[$key]) : false;
        return self::has($vars, $key) ? (intval($vars[$key]) != 0) : false;
    }

    /**
     * Return value with $key from array $vars as integer if exists, 0 otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return int
     */
    public static function getInteger($vars, $key) {
        return self::has($vars, $key) ? intval($vars[$key]) : 0;
    }

    /**
     * Return value with $key from array $vars as float if exists, 0.0 otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return float
     */
    public static function getFloat($vars, $key) {
        return self::has($vars, $key) ? floatval($vars[$key]) : 0.0;
    }

    /**
     * Return value with $key from array $vars as string if exists, '' otherwise
     * @param mixed[] $vars
     * @param mixed $key
     * @return string
     */
    public static function getString($vars, $key) {
        return self::has($vars, $key) ? strval($vars[$key]) : '';
    }

    /**************************************************************************/

    /**
     * Apply $function to all elements of array $vars
     * Same as php routine array_walk
     * @param mixed[] $vars
     * @param callable $function
     * @return void
     */
    public static function apply(&$vars, $function) {

        if (!is_callable($function)) return;
    //  if (!is_object($vars)) return;
    //  if (!is_array($vars)) return;

        foreach ($vars as &$var)
            $function($var);
    }

    /**************************************************************************/

    /**
     * Apply $function to all elements of array $vars recursively
     * If the array element is array also, then apply $function to it
     * @param mixed[] $vars
     * @param callable $function
     * @return void
     */
    public static function tree(&$vars, $function) {

        if (!is_callable($function)) return;
    //  if (!is_object($vars)) return;
    //  if (!is_array($vars)) return;

        foreach ($vars as &$var) {
            if (is_array($var) == false) {
                $var = $function($var);
            } else {
                self::tree($var, $function);
            }
        }
    }

    /**************************************************************************/
}

/******************************************************************************/