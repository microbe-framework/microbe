<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Http.class.php
 *     Class: Http
 *     About: Http routines 
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license 
 *    Source: https://github.com/microbe-framework/microbe-0.1.0/
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

class Http
{
    /***************************************************************************/
    // 301, 303, 304

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