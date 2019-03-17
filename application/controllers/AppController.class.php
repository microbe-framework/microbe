<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.1
 *    Module: AppController.class.php
 *     Class: AppController
 *     About: AppController controller sample
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

class AppController extends Microbe\Controller
{
    /**************************************************************************/
    // Actions
    /**************************************************************************/

    // Unused
    public function defaultAction() {
        return null;
    }

    // Unused
    public function indexAction($page, $hello = null) {
        return $this->view->renderFile(
            './views/layouts/main.inc.php',
            ['page' => 'index', 'hello' => $hello.', world!']
        );
    }

    public function pageAction($page) {
        if ($this->app->getConfigValue('database.active') == 1) {
        //  $appModel = new AppModel($this->app);
            $userModel = new UserModel($this->app);
        }
        return $this->view->renderLayout(
            'main',
            ['layout' => 'main', 'page' => $page]
        );
    }

    public function articleAction($article) {
        return $this->view->renderLayout(
            'main',
            ['layout' => 'main', 'page' => './articles/'.$article]
        );
    }

    public function redirectAction() {
        return $this->redirect('redirect_to_any_unexisting_page');
    }

    // Unused
    public function errorAction($error = 404) {
        return $this->view->renderTemplate(
            'error',
            ['error' => $error]
        );
    }

    /**************************************************************************/
}

/*******************************************************************************/