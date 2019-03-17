<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Recordset.class.php
 *     Class: Recordset
 *     About: Recordset data source
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

//class Recordset implements ArrayAccess, IteratorAggregate
class Recordset extends Collection
{
    /**************************************************************************/

    /**
     * Create a Recordset instance with php connection 
     * @var mixed $connection
     */
    public $connection = null;

    /**
     * Recordset
     * @var Recordset $recordset
     */
    public $recordset = null;

    /**
     * Current active record of $records or $recordset
     * @param mixed $record
     * @return mixed[]
     */
    public $record = null;
    
    /**************************************************************************/
    
    /**
     * Create a Recordset instance with php connection $connection
     * @param mixed $connection
     * @return Recordset
     */
    function __construct($connection, $recordset = null) {
    //  parent::__construct();
        $this->init($connection, $recordset);
    }
    
    /**************************************************************************/

    /**
     * Initialize a Recordset instance variables with php connection $connection
     * @param mixed $connection
     * @return void
     */
    function init($connection, $recordset = null) {
        $this->connection = $connection;
        $this->recordset = $recordset;
    }

    /**************************************************************************/
     
    /**
     * Return true if has connection and false otherwise
     * @return boolean
     */
    public function hasConnection() {
        return !empty($this->connection);
    }

    /**
     * Return true if has recordset and false otherwise
     * @return boolean
     */
    public function hasRecordset() {
        return !empty($this->recordset);
    }

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
     * Return BaseConnection class successors or instance $connection
     * @return mixed|null
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Return recordset or null if not have not connected
     * @return mixed[]|null
     */
    public function getRecordset() {
        return $this->recordset;
    }
    
    /**
     * Return records or null if not have not connected
     * @return mixed[]|null
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
    // Better to use static ProxyConnection::recordCount

    /**
     * Return recorset's records count
     * @return int
     */
    public function getRecordCount() {
 
        $connection = $this->connection;
        if (empty($connection))
            return 0;

    //  return Connection::getRecordCount($this->recordset);
        return $connection->getRecordCount($this->recordset);
    }

    /**************************************************************************/
    // Queries
    /**************************************************************************/

    /**
     * Execute a query $query
     * Return a result
     * @param string $query
     * @return mixed[]|mixed|null
     */
    public function execute($query) {
        return $this->connection ? $this->connection->execute($query) : null;
    }

    /**************************************************************************/
    
    /**
     * Execute a query $query and save result to $recordset
     * Return a result
     * @param string $query
     * @return mixed[]|mixed|null
     */
    public function query($query) {
        return $this->recordset = $this->connection
            ?
            $this->connection->query($query)
            :
            null;
    }

    /**************************************************************************/
    // Traverse
    /**************************************************************************/

    /**
     * Return a current active record
     * @return mixed[]|null
     */
    public function read() {
        if (key($this->items) === null)
            return $this->record = null;

        return $this->record = new Collection(current($this->items));
    }

    /**************************************************************************/
        
    /**
     * Fetch next active record from a recordset to array
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param boolean $assoc
     * @return mixed[]|null
     */
    public function fetch($assoc = false) {

        $connection = $this->connection;
        if (empty($connection)) {
            return null;
        }

        $recordset = $this->recordset;
        if (empty($recordset)) {
            return null;
        }

    //  $this->record = $assoc ?
        $record = $assoc ?
            $connection->fetchAssoc($recordset)
            :
            $connection->fetch($recordset);

        return $this->record = $record ? new Record($record) : null;
    }

    /**
     * Fetch next active record from a recordset to array
     * Return a result
     * @return mixed[]|null
     */
    public function fetchArray() {
        return $this->fetch(false);
    }

    /**
     * Fetch next active record from a recordset to associative array
     * Return a result
     * @return mixed[]|null
     */
    public function fetchAssoc() {
        return $this->fetch(true);
    }

    /**************************************************************************/
        
    /**
     * Fetch all records from a recordset to records
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function fetchAll($assoc = false) {

        $connection = $this->connection;
        if (empty($connection))
            return null;

        if (empty($this->recordset)) {
            return null;
        }

        $records = array();

        while ($record = $this->fetch($assoc)) {
            $records[] = $record;
        }

        return $this->items = $records;
    }

    /**
     * Fetch all records from a recordset to records
     * Return a result
     * @return mixed[][]|null
     */
    public function fetchArrayAll() {
        return $this->fetchAll(false);
    }

    /**
     * Fetch all records from a recordset to associative records
     * Return a result
     * @return mixed[][]|null
     */
    public function fetchAssocAll() {
        return $this->fetchAll(true);
    }

    /**************************************************************************/
    
    /**
     * Execute a query and fetch all result to records
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param string $query
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function load($query, $assoc = false) {

        if (empty($this->connection)) {
            return null;
        }

        $this->query($query);
        $this->fetchAll($assoc);

        return $this->items;
    }

    /**
     * Execute a query and fetch all result to records
     * Return a result
     * @param string $query
     * @return mixed[][]|null
     */
    public function loadArray($query) {
        return $this->load($query, false);
    }

    /**
     * Execute a query and fetch all result to associative records
     * Return a result
     * @param string $query
     * @return mixed[][]|null
     */
    public function loadAssoc($query) {
        return $this->load($query, true);
    }
    
    /**************************************************************************/  
}

/******************************************************************************/