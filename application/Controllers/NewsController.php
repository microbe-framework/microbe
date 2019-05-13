<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.3
 *    Module: NewsController.php
 *     Class: NewsController
 *     About: AppController controller sample
 *     Begin: 2019/03/25
 *   Current: 2019/03/29
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

use \Microbe\Core\Registry;

class NewsController extends \Microbe\Core\Controller
{
    /**************************************************************************/
    // Actions
    /**************************************************************************/

    public function insertAction($params)
    {
        if (is_array($params) == false)
            return;

        $f_News = Arrays::getStringSafe2($params, 'f_News');
        $f_Url  = Arrays::getStringSafe2($params, 'f_Url');

        if (empty($f_News) && empty($f_Url))
            return;

    //  (new NewsModel($this->app))->insertNews($f_News, $f_Url);
        Registry::getObject('\App\Models\NewsModel')->insertNews($f_News, $f_Url);
    }

    /**************************************************************************/

    public function deleteAction($params) {
        if (is_array($params) == false)
            return;

    //  $f_NewsId = Arrays::getInteger($params, 'f_NewsId');
        $f_NewsId = Arrays::getInteger($params, 'id');

        if (empty($f_NewsId))
            return;

    //  (new NewsModel($this->app))->deleteNewsById($f_NewsId);
        Registry::getObject('\App\Models\NewsModel')->deleteNewsById($f_NewsId);
    }

    /**************************************************************************/
}

/*******************************************************************************/