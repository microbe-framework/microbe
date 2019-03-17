<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Records.class.php
 *     Class: Records
 *     About: Buffered in Collection Recordset records
 *     Begin: 2019/03/09
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

class Records extends Collection
{
    /**************************************************************************/

    /**
     * Current active record
     * @var Record
     */
    public $record = null;

    /**************************************************************************/

    /**
     * Return true if has recordset and false otherwise
     * @return boolean
     */
    public function hasRecords() {
        return is_array($this->items) && (count($this->items) > 0);
    }

    /**
     * Return true if has record and false otherwise
     * @return boolean
     */
    public function hasRecord() {
        return !empty($this->record);
    }

    /**************************************************************************/

    /**
     * Return records or null if not have not connected
     * @return mixed[][]|null
     */
    public function getRecords() {
        return $this->items;
    }

    /**
     * Return recorset's active record if exists or null otherwise
     * @return mixed[]|null
     */
    public function getRecord() {
        return $this->record;
    }
    
    /**************************************************************************/

    /**
     * Fetch and return a current active record
     * @return mixed[]|null
     */
    public function read() {
        if (key($this->items) === null)
            return $this->record = null;

        return $this->record = new Collection(current($this->items));
    }

    /**************************************************************************/  
}

/******************************************************************************/