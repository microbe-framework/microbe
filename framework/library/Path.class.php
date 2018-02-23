<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Path.class.php
 *     Class: Path
 *     About: Path helper (linux/unix only)
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

class Path
{
    /**************************************************************************/
    // Path construction
    /**************************************************************************/

    public static function isAbsolute($path) {
        return is_string($path) && (strpos($path, '/') === 0);
    }

    public static function isRelative($path) {
        return self::isAbsolute($path) == false;
    }

    /**************************************************************************/

    public static function adjustLeft($path) {
    //  $path = ltrim($path, "./\\"); <= Can't handle './.htacces'
        $path = ltrim($path, '.');
        $path = ltrim($path, '/');
        $path = ltrim($path, '\\');
        return $path;
    }

    public static function adjustRight($path) {
    //  $path = rtrim($path, "./\\");    
        $path = rtrim($path, '/');
        $path = rtrim($path, '\\');
        return $path;
    }

    /**************************************************************************/

    public static function join($left, $right) {
        $left = self::adjustRight($left);
        $right = self::adjustLeft($right);
        return $left.'/'.$right;
    }

    /**************************************************************************/

    public static function getPath($root, $path) {
        return self::join($root, $path);
    }
    
    /**************************************************************************/

    public static function getAbsolutePath($root, $path) {
        if (self::isAbsolute($path))
            return $path;
        return self::join($root, $path);
    }

    public static function getRelativePath($root, $path) {
        if (self::isRelative($path))
            return $path;
        return ltrim($path, $root);
    }

    /**************************************************************************/

    // If filename hav't any extention, then append it
    public static function setExtention($name, $ext) {
        $lastDot = intval(strrpos($name, '.'));
        $lastSlash = intval(strrpos($name, '/'));
        if (($lastDot == 0) || ($lastDot <= $lastSlash)) {
            $name .= $ext;
        }
        return $name;
    }

    public static function joinEx($path, $name, $ext) {
        $name = self::setExtention($name, $ext);
        return self::join($path, $name);
    }

    /**************************************************************************/
}

/******************************************************************************/