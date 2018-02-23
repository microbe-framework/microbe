<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Url.class.php
 *     Class: Url
 *     About: Url helper 
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
 
/******************************************************************************/

class Url extends Path
{
    /**************************************************************************/
    // URL protocols
    /**************************************************************************/

    public static $protocols = array(
        'http',
        'https',
        'ftp'
    );

    /**************************************************************************/
    // URL construction
    /**************************************************************************/
    // Absolute url starts with: 'http://', 'https://', 'ftp://'

    public static function isAbsolute($url) {

        if (!is_string($url))
            return false;

        foreach (self::$protocols as $protocol) {
            $prefix = $protocol.'://';
        //  if (preg_match('#^https?://#i', $url) === 1) {
            if (strncmp($url, $prefix, strlen($prefix)) === 0)
                return true;
        }
        return false;
    }

    public static function isRelative($url) {
        return Url::isAbsolute($url) == false;
    }

    /**************************************************************************/

    public static function getUrl($url, $path) {
        return self::join($url, $path);
    }

    /**************************************************************************/

    public static function getAbsoluteUrl($url, $path) {
        if (Url::isAbsolute($path))
            return $path;
        return self::getUrl($url, $path);
    }

    public static function getRelativeUrl($url, $path) {
        if (Url::isRelative($path))
            return $path;
        return ltrim($path, $url);
    }

    /**************************************************************************/
}

/******************************************************************************/