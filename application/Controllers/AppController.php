<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.3
 *    Module: AppController.php
 *     Class: AppController
 *     About: AppController controller sample
 *     Begin: 2017/05/01
 *   Current: 2019/04/03
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

use \Microbe\Library\Url as Url;

class AppController extends \Microbe\Core\Controller
{
    /**************************************************************************/
    // Actions
    /**************************************************************************/

    // Unused
    public function defaultAction() {
        return null;
    }

    // Used only for test purposes
    public function indexAction($page, $hello = null) {
        return $this->view->renderFile(
            './views/main.layout.php',
            ['page' => 'index', 'hello' => $hello.', world!']
        );
    }

    public function pageAction($page) {
        // $page is URI then remove first left '/'
        $page = Url::adjustLeft($page);
        return $this->view->renderLayout(
            'main',
            ['layout' => 'main', 'page' => $page]
        );
    }

    public function handbookAction($page) {
        // $page is URI then remove first left '/'
        $page = Url::adjustLeft($page);
        return $this->view->renderLayout(
            'main',
            ['layout' => 'main', 'page' => './handbook/'.$page]
        );
    }

    public function articleAction($article) {
        // $article is URI then remove first left '/'
        $article = Url::adjustLeft($article);
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