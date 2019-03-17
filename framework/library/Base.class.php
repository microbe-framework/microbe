<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Base.class.php
 *     Class: Base
 *     About: Basic routines
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
 
class Base
{
    /**************************************************************************/

    /**
     * Return major part of php version or 0 if fail
     * @return int
     */
    public static function getVersionMajor() {
        $version = substr(phpversion(), 0, 1);
        return $version ? intval($version) : 0;
    }
  
    /**************************************************************************/
    // Safe access routines
    /**************************************************************************/

    /**
     * Safe get a value of $var if exists or null otherwise
     * @param mixed $var1
     * @param mixed $var1
     * @return mixed
     */
    public static function get($var) {
        return (isset($var)) ? $var : null;
    }

    /**
     * Return a $var2 if $var1 is empty
     * @param mixed $var1
     * @param mixed $var1
     * @return mixed
     */
    public static function coaleasce($var1, $var2) {
        return $var1 ? $var1 : $var2;
    }

    /**************************************************************************/
}

/******************************************************************************/