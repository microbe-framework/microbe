<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: HttpRequest.php
 *     Class: HttpRequest
 *     About: HTTP request parameters handling
 *     Begin: 2019/03/16
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
 
class HttpRequest
{
    /**************************************************************************/

    /**
     * Create a Recordset instance with php connection 
     *
     * @var Collection $gets
     */
    public $gets                        = null;

    /**
     * Create a Recordset instance with php connection 
     *
     * @var Collection $posts
     */
    public $posts                       = null;

    /**
     * Create a Recordset instance with php connection 
     *
     * @var Collection $cookies
     */
    public $cookies                     = null;

    /**
     * Create a Recordset instance with php connection 
     *
     * @var Collection $servers
     */
    public $servers                     = null;

    /**
     * Create a Recordset instance with php connection 
     *
     * @var Collection $files
     */
    public $files                      = null;

    /**************************************************************************/

    /**
     * Create an HttpRequest instance
     *
     * @return HttpRequest
     */
    function __construct() {
        $this->gets    = new Collection($_GET);
        $this->posts   = new Collection($_POST);
        $this->cookies = new Collection($_COOKIE);
        $this->servers = new Collection($_SERVER);
    //  $this->files   = new Collection($_FILES);
    }

    /**************************************************************************/

    /**
     * Return file element with $key from $_FILES array if exists, null otherwise
     *
     * @param string $key
     * @return mixed[]
     */
    public static function getFile($key) {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    /**************************************************************************/
    
    /**
     * Get a http server variable by name
     *
     * @param string $name
     * @return string
     */
    protected static function getServerString($name) {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
    }

    /**************************************************************************/

    /**
     * Return true for HTTP request from localhost (127.0.0.1), false otherwise
     *
     * @return boolean
     */
    public static function isLocal() {
        $ip = self::getServerString('REMOTE_ADDR');
        return ($ip == '127.0.0.1');
    }

    /**
     * Return HTTP request remote ip4 address as string
     * Same as getIp
     *
     * @return string
     */
    public static function getRemoteAddr() {  
        return self::getServerString('REMOTE_ADDR');
    }

    /**
     * Return HTTP request remote ip4 address as string
     * Same as getRemoteAddr
     *
     * @return string
     */
    public static function getIp() {  
        return self::getRemoteAddr();
    }

    /**
     * Return HTTP request remote ip4 address as integer value
     * Use Net class
     *
     * @return int
     */
    public static function getIp2Int() {  
        $result = self::getRemoteAddr();
    //  return ip2long($result);
        return Net::ip2int($result);
    }

    /**
     * Return HTTP request remote port as a string
     *
     * @return string
     */
    public static function getRemotePort() {  
        return self::getServerString('REMOTE_PORT');
    }

    /**
     * Return HTTP request remote port as a string
     *
     * @return string
     */
    public static function getPort() {  
        return self::getRemotePort();
    }

    /**
     * Return HTTP request scheme
     *
     * @return string
     */
    public static function getScheme() {  
        return self::getServerString('REQUEST_SCHEME');
    }

    /**
     * Return HTTP request scheme is HTTP
     *
     * @return string
     */
    public static function isHttp() {  
        return self::getServerString('REQUEST_SCHEME') == 'http';
    }

    /**
     * Return HTTP request scheme is HTTPS
     *
     * @return string
     */
    public static function isHttps() {  
        return self::getServerString('REQUEST_SCHEME') == 'https';
    }

    /**
     * Return HTTP request host
     *
     * @return string
     */
    public static function getHost() {  
        return self::getServerString('HTTP_HOST');
    }

    /**
     * Return HTTP request query string
     *
     * @return string
     */
    public static function getQueryString() {  
        return self::getServerString('QUERY_STRING');
    }

    /**
     * Return HTTP request URI
     *
     * @return string
     */
    public static function getUri() {  
        return self::getServerString('REQUEST_URI');
    }

    /**
     * Return HTTP request host
     *
     * @return string
     */
    public static function getUserAgent() {  
        return self::getServerString('HTTP_USER_AGENT');
    }

    /**
     * Return HTTP request method: GET, POST etc*
     *
     * @return string
     */
    public static function getMethod() {  
        return self::getServerString('REQUEST_METHOD');
    }

    /**
     * Return HTTP request cookies
     *
     * @return string
     */
    public static function getCookies() {  
        return self::getServerString('HTTP_COOKIE');
    }

    /**
     * Return HTTP server document's root
     *
     * @return string
     */
    public static function getRoot() {  
        return self::getServerString('DOCUMENT_ROOT');
    }

    /**
     * Return script path
     *
     * @return string
     */
    public static function getScript() {  
        return self::getServerString('SCRIPT_FILENAME');
    }

    /**
     * Return HTTP request unix time
     *
     * @return string
     */
    public static function getTime() {
        return self::getServerString('REQUEST_TIME');
    }

    /**
     * Return HTTP request referer
     *
     * @return string
     */
    public static function getReferer() {  
        return self::getServerString('HTTP_REFERER');
    }

    /**************************************************************************/
}

/******************************************************************************/