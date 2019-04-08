<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.2
 *    Module: AppModel.php
 *     Class: AppModel
 *     About: Application data model
 *     Begin: 2019/03/11
 *   Current: 2019/03/18
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
 
class UserModel extends \Microbe\Core\Model
{
    /**************************************************************************/
    // Place Your code here

//  public function __construct(&$app) {
//     parent::__construct($app);
//  }

    /**************************************************************************/
    // Place Your code here
    
    public function &queryUsers() {
        $query = 'SELECT * from t_Users';
        return $this->query($query, false);
    }

    public function &fetchUser($users) {
        return $this->fetchAssoc($users);
    }

    public function &queryUserById($id) {
        $query = 'SELECT f_User FROM t_Users WHERE f_UserId = '.$id;
        return $this->queryString($query, false);
    }

    /**************************************************************************/
}

/*******************************************************************************/