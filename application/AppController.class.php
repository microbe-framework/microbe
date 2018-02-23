<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.0
 *    Module: AppController.class.php
 *     Class: AppController
 *     About: AppController controller sample
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

class AppController extends Controller
{
    /**************************************************************************/
    // Actions
    /**************************************************************************/

    public function defaultAction() {
        return null;
    }


    public function indexAction($sina = null) {
        return $this->view->renderFile(
            './index.html',
            ['page' => $index]
        );
    }

    public function pageAction($page) {
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
        return $this->redirect('redirect.html');
    }

    public function errorAction($error = 404) {
        return $this->view->renderTemplate(
            'error',
            ['error' => $error]
        );
    }

    /**************************************************************************/
}

/*******************************************************************************/