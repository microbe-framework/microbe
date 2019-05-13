<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Random.php
 *     Class: Random
 *     About: Random helper
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
 
namespace Microbe\Library;

class Random
{
    /**************************************************************************/

    /**
     * Return a random float value in range between $min and $max if specified
     * Otherwise return result in range from 0 to 1
     *
     * @param float|int $min
     * @param float|int $max
     * @return float
     */
    public static function getFloat($min = 0, $max = 1) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    /**************************************************************************/

    const CHARSET_DIGITS = '0123456789';
    const CHARSET_HEX_LOWER = '0123456789abcdef';
    const CHARSET_HEX_UPPER = '0123456789ABCDEF';
    const CHARSET_ALPHA_LOWER = 'abcdefghijklmnopqrstuvwxuz';
    const CHARSET_ALPHA_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CHARSET_ALPHA = 'abcdefghijklmnopqrstuvwxuzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CHARSET_ALNUM = '0123456789abcdefghijklmnopqrstuvwxuzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Return a random string with letters from string $chars
     * By default used alpha numeric characterss [0-1a-zA-Z]
     *
     * @param int $count
     * @param string $chars
     * @return string
     */
    public static function getString($count, $chars = self::CHARSET_ALNUM) {
        $max = strlen($chars);
        $result = '';
        for ($i = 0; $i < $count; $i++)
            $result .= $chars[mt_rand(0, $max - 1)];
        return $result;
    }

    /**************************************************************************/

    /**
     * Return a random hexadecimal UID XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
     *
     * @return string
     */
    public static function getUuid() {
        return sprintf(
          "%04x%04x-%04x-%04x-%04x-%04x%04x%04x",
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0x0fff) | 0x4000,
          mt_rand(0, 0x3fff) | 0x8000,
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff)
       );
    }
  
    /**************************************************************************/
}

/******************************************************************************/