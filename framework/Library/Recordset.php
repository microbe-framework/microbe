<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Recordset.php
 *     Class: Recordset
 *     About: Recordset data source
 *     Begin: 2019/03/09
 *   Current: 2019/04/02
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

namespace Microbe\Library;

//class Recordset implements ArrayAccess, IteratorAggregate
class Recordset extends Collection
{
    /**************************************************************************/

    /**
     * Null varuable
     *
     * @var null $nothing
     */
    protected $nothing                  = null;

    /**************************************************************************/

    /**
     * Create a Recordset instance with php connection 
     *
     * @var mixed $connection
     */
    protected $connection               = null;

    /**
     * Recordset
     *
     * @var Recordset $recordset
     */
    protected $recordset                = null;

    /**
     * Recordset fields info array
     *
     * @return mixed[]|null $fields
     */
//  protected $fields                   = null;
    public $fields                      = null;

    /**************************************************************************/
    // Problematic variables

    /**
     * Current active row of $items or $recordset as mixed array
     *
     * @return mixed[]|null $row
     */
//  protected $row                      = null;
    public $row                         = null;

    /**
     * Current active record of $items or $recordset as Record object
     *
     * [!] Experimental
     * @return Record|null $record
     */
//  protected $record                    = null;
    public $record                       = null;

    /**************************************************************************/
    
    /**
     * Create a Recordset instance with php connection $connection
     *
     * [!] $recordset MUST BE &$recordset
     * @param mixed $connection
     * @param mixed $recordset
     * @return Recordset
     */
    function __construct(&$connection, $recordset = null) {
    //  parent::__construct();
        $this->connection = &$connection;
        $this->recordset  = &$recordset;
    }
    
    /**************************************************************************/
    // Checkers
     
    /**
     * Return true if has connection and false otherwise
     *
     * @return boolean
     */
    public function hasConnection() {
        return !empty($this->connection);
    }

    /**
     * Return true if has recordset and false otherwise
     *
     * @return boolean
     */
    public function hasRecordset() {
        return !empty($this->recordset);
    }

    /**
     * Return true if has recordset and false otherwise
     *
     * [!] Experimental
     * @return boolean
     */
    public function hasRows() {
    //  return is_array($this->items) && (count($this->items) > 0);
        return $this->getCount();
    }

    /**
     * Return true if has active row and false otherwise
     *
     * @return boolean
     */
    public function hasRow() {
        return !empty($this->row);
    }

    /**
     * Return true if has active record and false otherwise
     *
     * [!] Experimental
     * @return boolean
     */
    public function hasRecord() {
        return !empty($this->record);
    }

    /**************************************************************************/
    // Accessors

    /**
     * Return BaseConnection class successors or instance $connection
     *
     * @return mixed|null
     */
    public function &getConnection() {
        return $this->connection;
    }

    /**
     * Return recordset or null if not have not connected
     *
     * @return mixed[]|null
     */
    public function &getRecordset() {
        return $this->recordset;
    }
    
    /**
     * Return records or null if not have not connected
     *
     * [!] Experimental
     * @return mixed[]|null
     */
    public function &getRows() {
        return $this->items;
    }

    /**
     * Return recorset's active row if exists or null otherwise
     *
     * @return mixed[]|null
     */
    public function &getRow() {
        return $this->row;
    }

    /**
     * Return recorset's active record if exists or null otherwise
     *
     * [!] Experimental
     * @return Record|null
     */
    public function &getRecord() {
        return $this->record;
    }
    
    /**************************************************************************/
    // Better to use static ProxyConnection::recordCount

    /**
     * Return recorset's records count
     *
     * @return int
     */
    public function getRecordCount() {
 
        $connection = &$this->connection;
        if (empty($connection))
            return 0;

    //  return Connection::getRecordCount($this->recordset);
        return $connection->getRecordCount($this->recordset);
    }

    /**************************************************************************/
    // Fetch
    /**************************************************************************/
    // Row or record
        
    /**
     * Fetch next active record from a recordset to array
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     *
     * @param boolean $assoc
     * @return mixed[]|null
     */
    public function &fetch($assoc = false) {

        $connection = &$this->connection;
        if (empty($connection))
            return $this->nothing;

        return $connection->fetch($this->recordset, $assoc);
    }

    /**
     * Fetch next active record from a recordset to array
     * Return a result
     * @return mixed[]|null
     */
    public function &fetchArray() {
        return $this->fetch(false);
    }

    /**
     * Fetch next active record from a recordset to associative array
     * Return a result
     * @return mixed[]|null
     */
    public function &fetchAssoc() {
        return $this->fetch(true);
    }

    /**
     * Fetch next active record from a recordset to Record object
     * Return a result
     *
     * @return Record|null
     */
    public function &fetchRecord() {

        $connection = &$this->connection;
        if (empty($connection))
            return $this->nothing;

        return $connection->fetchRecord(true);
    }

    /**************************************************************************/
    // Fetch fields
        
    /**
     * Fetch next active record from a recordset to array
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     *
     * * [?] Use connection->fetchFields($this->recordset)
     * @param boolean $assoc
     * @return mixed[]|null
     */
    public function &fetchFields() {

        $connection = &$this->connection;
        if (empty($connection))
            return $this->nothing;

        return $connection->fetchFields($this->recordset);
    }

    /**************************************************************************/
    // Fetch rows

    /**
     * Fetch all records from a recordset to records
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     *
     * [?] Use connection->fetchRows($this->recordset, $assoc)
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function &fetchRows($assoc = false) {

        $connection = &$this->connection;
        if (empty($connection))
            return $this->nothing;

        if (empty($this->recordset))
            return $this->nothing;

        $rows = array();

        while ($row = &$this->fetch($assoc)) {
            $rows[] = &$row;
        }

        $this->items = &$rows;

        return $this->items;
    }

    /**
     * Fetch all records from a recordset to records
     * Return a result
     *
     * @return mixed[][]|null
     */
    public function &fetchRowsArray() {
        return $this->fetchRows(false);
    }

    /**
     * Fetch all records from a recordset to associative records
     * Return a result
     *
     * @return mixed[][]|null
     */
    public function &fetchRowsAssoc() {
        return $this->fetchRows(true);
    }

    /**************************************************************************/  
}

/******************************************************************************/