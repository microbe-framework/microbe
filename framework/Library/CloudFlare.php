<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: CloudFlare.php
 *     Class: CloudFlare
 *     About: CloudFlare HTTP headers handler
 *     Begin: 2018/01/26
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

// https://www.cloudflare.com/technical-resources/#mod_cloudflare 

namespace Microbe\Library;

class CloudFlare
{
    /**************************************************************************/
    // https://www.cloudflare.com/ips-v4
    // https://www.cloudflare.com/ips-v6
    // 2018/01/26

    /**
     * CloudFlare's ip4 ranges array
     *
     * @var string[] $ip4s
     */
    public static $ip4s = array(
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '104.16.0.0/12',
        '108.162.192.0/18',
        '131.0.72.0/22',
        '141.101.64.0/18',
        '162.158.0.0/15',
        '172.64.0.0/13',
        '173.245.48.0/20',
        '188.114.96.0/20',
        '190.93.240.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
    );

    /**
     * CloudFlare's ip6 ranges array
     *
     * @var string[] $ip6s
     */
    public static $ip6s = array(
        '2400:cb00::/32',
        '2405:8100::/32',
        '2405:b500::/32',
        '2606:4700::/32',
        '2803:f800::/32',
        '2c0f:f248::/32',
        '2a06:98c0::/29',
    );

    /**************************************************************************/
    
    /**
     * Return ip of original request as a string
     *
     * @return string
     */
    public static function getIp() {
        return (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ?
            $_SERVER['HTTP_CF_CONNECTING_IP']
            :
            $_SERVER['REMOTE_ADDR'];
    }

    /**************************************************************************/
    // CloudFlare only
    
    /**
     * Return true if original request scheme is a HTTP
     * For CloudFlare requests only
     *
     * @return boolean
     */
    public static function isHttp() {
        return self::get('HTTP_CF_VISITOR') == '{"scheme":"http"}';
    }

    /**
     * Return true if original request scheme is a HTTPS
     * For CloudFlare requests only
     *
     * @return boolean
     */
    public static function isHttps() {
        return self::get('HTTP_CF_VISITOR') == '{"scheme":"https"}';
    }

    /**************************************************************************/

    /**
     * Return true if request source is CloudFlare
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return boolean
     */
    public static function isCloudFlare() {
        return isset($_SERVER["HTTP_CF_CONNECTING_IP"]);
    }

    /**
     * Return true if request source is CloudFlare
     * More correct routine then isCloudFlare
     *
     * @return boolean
     */
    public static function isCloudFlareEx() {
        return self::check();
    }

    /**************************************************************************/

    /**
     * Return true if key $name exists in $_SERVER array, false otherwise
     *
     * @param string $name
     * @return boolean
     */
    public static function has($name) {
        return (isset($_SERVER[$name]));
    }

    /**
     * Return value with key $name from $_SERVER array, false otherwise
     *
     * @param string $name
     * @return 
     */
    public static function get($name) {
        return (isset($_SERVER[$name])) ? $_SERVER[$name] : false;
    }

    /**************************************************************************/

    /**
     * Return real visitor ip address
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return mixed|boolean
     */
    public static function getConnectingIp() {
        return self::get('HTTP_CF_CONNECTING_IP');
    }

    /**
     * Return real visitor country if you have IP Geolocation enabled
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return mixed|boolean
     */
    public static function getIpCountry() {
        return self::get('HTTP_CF_IPCOUNTRY');
    }

    /**
     * Return CloudFlare client's session
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return mixed|boolean
     */
    public static function getRay() {
        return self::get('HTTP_CF_RAY');
    }

    /**
     * Return CloudFlare client's identifier
     * This can help You know if its http or https
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return mixed|boolean
     */
    public static function getVisitor() {
        return self::get('HTTP_CF_VISITOR');
    }

    /**************************************************************************/

    /**
     * Return true if all of 4 main CloudFlare's request parameters is set
     * Can produce an error
     * Some people can falsificate CloudFlare's headers
     *
     * @return boolean
     */
    public static function checkRequest() {
        return
            (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) &&
            (isset($_SERVER['HTTP_CF_IPCOUNTRY'])) &&
            (isset($_SERVER['HTTP_CF_RAY'])) &&
            (isset($_SERVER['HTTP_CF_VISITOR']));
    }

    /**************************************************************************/

    /**
     * Return true if request ip in CloudFlare ip's range, false otherwise
     * Reliable way to check request origination
     *
     * @return boolean
     */
    public static function checkIp4($ip = false) {
        $ip = ($ip) ? $ip : $_SERVER['REMOTE_ADDR'];
        foreach (self::$ip4s as &$range) {
            if (Net::ip4_in_range($ip, $range)) {
                return true;
            }
        }
        return false;
    }

    /**************************************************************************/

    /**
     * Return true if request source is CloudFlare
     * Check ip origination and 4 main CloudFlare's http headers
     * More correct routine then isCloudFlare
     *
     * @return boolean
     */
    public static function check() {
        return self::checkRequest() && self::checkIp4();
    }

    /**************************************************************************/
}

/******************************************************************************/