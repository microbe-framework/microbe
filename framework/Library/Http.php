<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Http.php
 *     Class: Http
 *     About: Http routines 
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

class Http
{
    /***************************************************************************/
    // 301, 303, 304

    /**
     * Immediately HTTP redirect to specified by $url address
     * Set HTTP response code by $httpCode if defined
     * Otherwise default HTTP response code will be 301
     *
     * @param string $url
     * @param int|boolean $httpCode
     * @return void
     */
    public static function redirect($url, $httpCode = false)
    {
        if ($httpCode) {
            header('Location: '.$url, true, $httpCode);
        } else {
            header('Location: '.$url);
        }
        exit();
    }

//  public static function redirectCode($url, $httpCode = 303)
//  {
//      header('Location: '.$url, true, $httpCode);
//      die();
//  }

    /**************************************************************************/

    public static function response($contentType, $content, $httpCode = 200)
    {
        header('Content-Type: ' . $contentType);
        http_response_code($httpCode);
        echo $content;
        return exit();
    }

    public static function htmlResponse($content, $httpCode = 200)
    {
        return self::response('text/html', $content, $httpCode);
    }

    public static function textResponse($content, $httpCode = 200)
    {
        return self::response('text/plain', $content, $httpCode);
    }

    public static function cssResponse($content, $httpCode = 200)
    {
        return self::response('text/css', $content, $httpCode);
    }

    public static function jsonResponse($content, $httpCode = 200)
    {
        return self::response('application/json', $content, $httpCode);
    }

    public static function jsonpResponse($content, $httpCode = 200)
    {
        return self::response('application/javascript', $content, $httpCode);
    }

    public static function jpegResponse($content, $httpCode = 200)
    {
        return self::response('image/jpeg', $content, $httpCode);
    }

    public static function pngResponse($content, $httpCode = 200)
    {
        return self::response('image/png', $content, $httpCode);
    }

    /**************************************************************************/

    public static function download($contentType, $content, $fileName, $httpCode = 200)
    {
        header('Content-Type: ' . $contentType);
    //  header('Content-Length: ' . strlen($content));
        if ($fileName)
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
        http_response_code($httpCode);
        echo $content;
        return exit();
    }

    /***************************************************************************/
}

/*******************************************************************************/