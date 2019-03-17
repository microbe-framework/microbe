<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Net.class.php
 *     Class: Net
 *     About: Net helper
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

class Net
{
    /**************************************************************************/
    // ip4

    /**
     * Convert integer $ip ip4 address to string
     * When conversion error occurs return the string '0.0.0.0'
     * @param int $ip
     * @return string
     */
    public static function int2ip($ip) {
        $result = long2ip($ip);
        if (($result == -1) || ($result == false)) $result = '0.0.0.0';
        return $result;
    }

    /**
     * Convert string ip4 address $ip to integer
     * When conversion error occurs return 0
     * @param string $ip
     * @return int
     */
    public static function ip2int($ip) {
        $result = ip2long($ip);
        if ($result == false) $result = 0;
        return $result;
    }

    /**************************************************************************/

    /**
     * Check for string ip4 address $ip in range $range
     * $range is in IP/CIDR format, eg 127.0.0.1/24
     * Return true if address in range and false if not
     * @param string $ip
     * @return boolean
     */
    public static function ip4_in_range($ip, $range) {

        if (strpos($range, '/') === false)
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