<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Debug.class.php
 *     Class: Debug
 *     About: Debug helper
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

// This class is totally bereft of reason, but useful for debugging
class Debug
{
    /**************************************************************************/
    // Messages
    /**************************************************************************/

    /**
     * Print html-colored $text to output
     * If $bool is true set color to red, use blue color otherwise
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function write($text, $bool = false) {
        $color = $bool ? '#f00' : '#00f';
        echo '<span style="color: '.$color.'"><pre>'.$text.'</pre></span>';
    }

    /**************************************************************************/

    /**
     * Print bold html-colored $text to output
     * Color specified by $color value, used black by default
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function _write($text, $color = '#000') {
        echo '<span style="color: '.$color.'; font-weight: bold;">'.$text.'</span>';
    }

    /**
     * Print bold black html-colored $text to output
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function info($text) {
        self::_write($text, '#000');
    }

    /**
     * Print bold blue html-colored $text to output
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function message($text) {
        self::_write($text, '#00f');
    }

    /**
     * Print bold green html-colored $text to output
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function warning($text) {
        self::_write($text, '#0f0');
    }

    /**
     * Print bold red html-colored $text to output
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function alert($text) {
        self::_write($text, '#f00');
    }

    /**************************************************************************/
    
    /**
     * Print bold red html-colored $text to output and exit
     * Used for debug purposes only
     * @param string $text
     * @return void
     */
    public static function brk($text) {
        self::alert($text);
        exit();
    }

    /**************************************************************************/
}

/******************************************************************************/