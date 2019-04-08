<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
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

    /***************************************************************************/
}

/*******************************************************************************/