<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.3
 *    Module: AuthController.php
 *     Class: AuthController
 *     About: AuthController controller sample
 *     Begin: 2019/03/25
 *   Current: 2019/05/04
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

namespace App\Controllers;

use \Microbe\Library\Arrays;
use \Microbe\Library\Random;
use \Microbe\Library\Http;

class AuthController extends \Microbe\Core\Controller
{
    /**************************************************************************/
    // Actions
    /**************************************************************************/

    public static function auth() {
        if (isset($_COOKIE['sid']) == false)
            return false;

        $sid = $_COOKIE['sid'];
    //  echo $sid;
    //  $host = $this->app->getRequest()->getHost();
    //  setcookie('sid', $sid, time() + (24*60*60), '/', $host);
        setcookie('sid', $sid, time() + (24*60*60), '/');
    //  Http::redirect($this->app->getCmsUrl());
        return true;
    }

    /**************************************************************************/

    public function login() {
        $sid = Random::getString(16);
    //  echo $sid;
    //  $host = $this->app->getRequest()->getHost();
    //  setcookie('sid', $sid, time() + (24*60*60), '/', $host);
        setcookie('sid', $sid, time() + (24*60*60), '/');
        Http::redirect($this->app->getUrl());
    }

    /**************************************************************************/

    public function logout($params) {
    //  $host = $this->app->getRequest()->getHost();
    //  setcookie('sid', null, time() - (24*60*60), '/', $host);
        setcookie('sid', null, time() - (24*60*60), '/');
    //  Http::redirect($this->app->getUrl());
    }

    /**************************************************************************/

    public function loginAction($params) {
        
        if (is_array($params) == false)
            return;

        $user = Arrays::getString($params, 'user');
        $pass = Arrays::getString($params, 'pass');

        if (empty($user) || empty($pass))
            return;

        // check for valid chars

        $config = $this->app->getConfig();

        if ($config->get('auth.enable') == false)
            return;

        if ($user != $config->get('auth.user'))
            return;

        if ($pass != $config->get('auth.pass'))
            return;

        $this->login();
    }

    /**************************************************************************/

    public function logoutAction() {
        $this->logout();
    }

    /**************************************************************************/

    public function authAction() {
    //  $this->app->setUser();
    }

    /**************************************************************************/
}

/*******************************************************************************/