<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Record.class.php
 *     Class: Record
 *     About: Buffered in Collection Recordset record
 *     Begin: 2019/03/16
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

namespace Microbe;

class Record extends Collection
{
    /**************************************************************************/

    /**
     * Return true if has recordset and false otherwise
     * @return boolean
     */
    public function hasFields() {
        return is_array($this->items) && (count($this->items) > 0);
    }

    /**************************************************************************/

    /**
     * Return records or null if not have not connected
     * @return mixed[]|null
     */
    public function getFields() {
        return $this->items;
    }

    /**************************************************************************/  
}

/******************************************************************************/