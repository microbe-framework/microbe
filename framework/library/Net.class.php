<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Net.class.php
 *     Class: Net
 *     About: Net helper
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

class Net
{
    /**************************************************************************/
    // ip4

    public static function int2ip($ip) {
        $result = long2ip($ip);
        if (($result == -1) || ($result == false)) $result = '0.0.0.0';
        return $result;
    }

    public static function ip2int($ip) {
        $result = ip2long($ip);
        if ($result == false) $result = 0;
        return $result;
    }

    /**************************************************************************/
    // $range is in IP/CIDR format eg 127.0.0.1/24

    public static function ip4_in_range($ip, $range) {

        if (strpos($range, '/') == false)
            $range .= '/32';

        list($range, $netmask) = explode('/', $range, 2);
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~ $wildcard_decimal;

        return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
    }

    /**************************************************************************/
}

/******************************************************************************/