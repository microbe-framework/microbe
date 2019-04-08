<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.2
 *    Module: NewsModel.php
 *     Class: NewsModel
 *     About: Application data model
 *     Begin: 2019/03/11
 *   Current: 2019/03/25
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

namespace App\Models;

class NewsModel extends \Microbe\Core\Model
{
    /**************************************************************************/
    // Place Your code here

//  public function __construct(&$app) {
//      parent::__construct($app);
//  }

    /**************************************************************************/
    // Place Your code here
    
    public function &queryNews() {
        $query = 'SELECT * FROM t_News ORDER BY f_NewsId DESC';
        return $this->query($query, false);
    }

    public function &fetchNews($news) {
        return $this->fetchAssoc($news, false);
    }

    public function queryNewsById($f_NewsId) {
        $query = 'SELECT f_News FROM t_News WHERE f_NewsId = '.$f_NewsId;
        return $this->queryString($query, false);
    }

    public function deleteNewsById($f_NewsId) {
        $query = 'DELETE FROM t_News WHERE f_NewsId = '.$f_NewsId;
        return $this->execute($query, false);
    }

    public function insertNews($f_News, $f_Url) {
        $query = 'INSERT INTO t_News
            (f_News, f_Url)
            VALUES
            ("'.$f_News.'", "'.$f_Url.'")';
        return $this->insert($query, false);
    }

    /**************************************************************************/
}

/*******************************************************************************/