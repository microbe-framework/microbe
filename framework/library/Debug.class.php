<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Debug.class.php
 *     Class: Debug
 *     About: Debug helper
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license 
 *    Source: https://github.com/microbe-framework/0.1/
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

class Debug
{
    /**************************************************************************/

    public static $enabled              = false;
    
    public static $stack                = array();

    /**************************************************************************/
    // Debug enabled status

    public static function getEnabled() {
        return self::$enabled;
    }

    public static function isEnable() {
        return self::$enabled;
    }
    
    public static function isDisable() {
        return !self::$enabled;
    }

    public static function setEnabled($enable) {
        return self::$enabled = $enable;
    }

    public static function enable() {
        return self::$enabled = true;
    }
    
    public static function disable() {
        return self::$enabled = false;
    }

    /**************************************************************************/
    // Save/restore debug enabled status

    public static function push() {
        $stack[] = self::$enabled;
        return self::$enabled;
    }
    
    public static function pop() {
        if (count($stack) > 0) {
            self::$enabled = array_pop($stack);
        }
        return self::$enabled;
    }

    /**************************************************************************/
    // Dump prototype

    protected static function _dump($var) {
        echo '<br>';
        var_dump($var);
        echo '<br>';
    }
    
    /**************************************************************************/
    // Dump always

    public static function dump($var) {
        self::_dump($var);
    }

    public static function dumpOnce($var) {
        self::_dump($var);
    }

    /**************************************************************************/
    // Conditional dump

    public static function dumpIf($var, $enabled = true) {
        if (!$enabled)
            return;

        self::_dump($var);
    }

    /**************************************************************************/
    // Dump section

    public static function dumpBegin($var, $enabled = true) {
        self::setEnabled($enabled);
        self::_dump($var);
    }

    public static function dumpNext($var) {
        if (self::isDisable())
            return;

        self::_dump($var);
    }

    public static function dumpEnd($var) {
        self::_dump($var);    
        self::disable();
    }

    /**************************************************************************/
}

/******************************************************************************/