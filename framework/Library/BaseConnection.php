<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: BaseConnection.php
 *     Class: BaseConnection
 *     About: Real database connection template class
 *     Begin: 2017/05/01
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

class BaseConnection extends Connection
{
    /**************************************************************************/
    // Default database connection parameters

    const DRIVER                        = null;
    const PORT                          = 0;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a database connection with specified parameters
     *
     * @param string $driver
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return void
     */
    function __construct($driver, $host, $port, $user, $pass, $base)
    {
        parent::__construct(self::DRIVER, $host, self::PORT, $user, $pass, $base);
    }

    /**************************************************************************/
    // Connect
    /**************************************************************************/

    /**
     * Connect to database, return $connection value
     *
     * [!] Stub, doing nothing
     * @return mixed
     */
    public function &connect() {

        // Create connection
        $this->connection = db_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->base
        );

        // Make connection settings
        if ($this->connection) {
            db_tune($this->connection);
        }

        return $this->connection;
    }

    /**
     * Close a database connection
     *
     * [!] Stub, always false
     * @return void
     */
    public function disconnect() {
        if ($this->noConnected())
            return;

        // Close a connection
        db_close($this->connection);

        $this->connection = null;
    }

    /**************************************************************************/
    // Queries 
    /**************************************************************************/

    /**
     * Execute a $query and return true if success or false otherwise
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    public function execute($query, $debug = false) {
        if ($this->noConnected())
            return false;

        $result = boolval(db_query($this->connection, $query));

        if ($debug)
            $this->debug($query, $result);

        return $result;
    }
  
    /**************************************************************************/

    /**
     * If connection not established return null    
     * Return a $query result or true if success, false otherwise
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return db_result|boolean|null
     */
    public function &query($query, $debug = false) {
        if ($this->noConnected())
            return $this->nothing;

        $result = db_query($this->connection, $query);

        if ($debug)
            $this->debug($query, $result);

        return $result;
    }

    /**************************************************************************/

    /**
     * Return last inserted row autoincremented identifier
     *
     * @return int
     */
    public function getInsertId() {
        if ($this->noConnected())
            return 0; // null;

        return db_insert_id($this->connection);
    }

    /**************************************************************************/
    // Recordset
    /**************************************************************************/

    /**
     * Return records number in $recordset
     *
     * @param mixed[] $recordset
     * @return int
     */
    public function getRecordCount(&$recordset) {
        if (empty($recordset))
            return 0; // null;

        return db_num_rows($recordset);
    }

    /**
     * Free a recordset $recordset
     *
     * @return void
     */
    public function free(&$recordset) {
        db_free_result($recordset);
    }

    /**************************************************************************/
    // Fetch
    /**************************************************************************/

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function &fetch(&$recordset, $assoc = false) {
        if (empty($recordset))
            return $this->nothing;

        $result = $assoc ?
            db_fetch_assoc($recordset)
            :
            db_fetch_row($recordset);

        return $result;
    }

    /**************************************************************************/

    /**
     * Return a recordset fields info array
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function &fetchFields(&$recordset) {
        if (empty($recordset))
            return $this->nothing;

        return db_fetch_fields($recordset);
    }

    /**************************************************************************/
}

/******************************************************************************/