<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Path.class.php
 *     Class: Path
 *     About: Path helper (linux/unix only)
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

class Path
{
    /**************************************************************************/
    // Path construction
    /**************************************************************************/

    /**
     * Return true if $path is absolute, false otherwise
     * @param string $path
     * @return string
     */
    public static function isAbsolute($path) {
        return is_string($path) && (strpos($path, '/') === 0);
    }

    /**
     * Return true if $path is relative, false otherwise
     * @param string $path
     * @return string
     */
    public static function isRelative($path) {
        return self::isAbsolute($path) == false;
    }

    /**************************************************************************/

    /**
     * Return left trimmed $path
     * Removes left spaces, slashes, backslashes and dots
     * @param string $path
     * @return string
     */
    public static function adjustLeft($path) {
    //  $path = ltrim($path, "./\\"); <= Can't handle './.htacces'
        $path = ltrim($path, ' ');
        $path = ltrim($path, '.');
        $path = ltrim($path, '/');
        $path = ltrim($path, '\\');
        return $path;
    }

    /**
     * Return right trimmed $path
     * Removes right spaces, slashes, backslashes
     * @param string $path
     * @return string
     */
    public static function adjustRight($path) {
    //  $path = rtrim($path, "./\\");
        $path = rtrim($path, ' ');
    //  $path = ltrim($path, '.');
        $path = rtrim($path, '/');
        $path = rtrim($path, '\\');
        return $path;
    }

    /**
     * Return trimmed $path
     * Removes left and right spaces, slashes, backslashes and dots
     * @param string $path
     * @return string
     */
    public static function adjust($path) {
    //  $path = self::adjustLeft($path);
    //  $path = self::adjustRight($path);
        $path = trim($path, ' ');
        $path = trim($path, '.');
        $path = trim($path, '/');
        $path = trim($path, '\\');
        return $path;
    }

    /**************************************************************************/

    /**
     * Return accurately joined path $left with path $right
     * Do slashes count correction in $left and $right joint
     * @param string $left
     * @param string $right
     * @return string
     */
    public static function join($left, $right) {
        $left = self::adjustRight($left);
        $right = self::adjustLeft($right);
        return $left.'/'.$right;
    }

    /**************************************************************************/

    /**
     * Return accurately joined path $root with $path
     * Do slashes count correction in $root and $path joint
     * @param string $root
     * @param string $path
     * @return string
     */
    public static function getPath($root, $path) {
        return self::join($root, $path);
    }
    
    /**************************************************************************/

    /**
     * Return accurately joined absolute path $root with $path
     * Do slashescount correction in $root and $path joint
     * @param string $root
     * @param string $path
     * @return string
     */
    public static function getAbsolutePath($root, $path) {
        if (self::isAbsolute($path))
            return $path;
        return self::join($root, $path);
    }

    /**
     * Return accurately joined relative path $root with $path
     * Do slashes count correction in $root and $path joint
     * @param string $root
     * @param string $path
     * @return string
     */
    public static function getRelativePath($root, $path) {
        if (self::isRelative($path))
            return $path;
        $len = strlen($root);
        return (strncmp($path, $root, $len) === 0) ? substr($path, $len) : $path;
    }

    /**************************************************************************/

    /**
     * Append string $ext to filename $name if filename hav't any extention
     * Do slashes and dots count correction
     * @param string $name
     * @param string $ext
     * @return string
     */
    public static function setExtention($name, $ext) {
        $lastDot = intval(strrpos($name, '.'));
        $lastSlash = intval(strrpos($name, '/'));
        if (($lastDot == 0) || ($lastDot <= $lastSlash)) {
            $name .= $ext;
        }
        return $name;
    }

    /**
     * If filename $name hav't any extention, then append $ext to $name    
     * Then join $path with $name
     * Do slashes and dots count correction
     * @param string $path
     * @param string $name
     * @param string $ext
     * @return string
     */
    public static function joinEx($path, $name, $ext) {
        $name = self::setExtention($name, $ext);
        return self::join($path, $name);
    }

    /**************************************************************************/
}

/******************************************************************************/