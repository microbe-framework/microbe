<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Url.php
 *     Class: Url
 *     About: Url helper 
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
 
namespace Microbe\Library;

class Url extends Path
{
    /**************************************************************************/
    // URL protocols
    /**************************************************************************/

    /**
     * Used in module Url web protocol's prefixes:
     * - http
     * - https
     * - ftp
     * @var string[] $protocols
     */
    public static $protocols = array(
        'http',
        'https',
        'ftp'
    );

    /**************************************************************************/

    /**
     * Return true if $var starts with $match
     * Case insensitive
     * Same with Strings::isIMatch
     * @param string $var
     * @param string $match
     * @return string
     */
    private static function _isIMatch($var, $match) {
        return strncasecmp($var, $match, strlen($match)) === 0;
    }

    /**
     * Doing nothing if $url starts with: 'http://', 'https://'
     * Otherwise add $prefix before $url
     * Case insensitive
     * Return a result
     * @param string $url
     * @param string $prefix
     * @return string
     */
    public static function adjustUrl($url, $prefix) {
        return (
            (self::_isMatch($url, 'https://'))
            ||
            (self::_isMatch($url, 'http://'))
        ) ? $url : $prefix.$url;
    }

    /**************************************************************************/
    // URL construction
    /**************************************************************************/

    /**
     * Return true if $url is absolute, false otherwise
     * Absolute url starts with: 'http://', 'https://', 'ftp://'
     * Case sensitive
     * @param string $url
     * @return string
     */
    public static function isAbsolute($url) {

        if (!is_string($url))
            return false;

        foreach (self::$protocols as &$protocol) {
            $prefix = $protocol.'://';
        //  if (preg_match('#^https?://#i', $url) === 1) {
            if (strncmp($url, $prefix, strlen($prefix)) === 0)
                return true;
        }
        return false;
    }

    /**
     * Return true if $url is relative, false otherwise
     * Absolute url starts with: 'http://', 'https://', 'ftp://'
     * @param string $url
     * @return string
     */
    public static function isRelative($url) {
        return Url::isAbsolute($url) == false;
    }

    /**************************************************************************/

    /**
     * Return accurately joined url $url with $path
     * Do slashes count correction in $url and $path joint
     * @param string $url
     * @param string $path
     * @return string
     */
    public static function getUrl($url, $path) {
        return self::join($url, $path);
    }

    /**************************************************************************/

    /**
     * Return accurately joined absolute url $url with $path
     * Do slashes count correction in $url and $path joint
     * @param string $url
     * @param string $path
     * @return string
     */
    public static function getAbsoluteUrl($url, $path) {
        if (Url::isAbsolute($path))
            return $path;
        return self::getUrl($url, $path);
    }

    /**
     * Return accurately joined relative url $url with $path
     * Do slashes count correction in $url and $path joint
     * @param string $url
     * @param string $path
     * @return string
     */
    public static function getRelativeUrl($url, $path) {
        if (Url::isRelative($path))
            return $path;
        return ltrim($path, $url);
    }

    /**************************************************************************/
}

/******************************************************************************/