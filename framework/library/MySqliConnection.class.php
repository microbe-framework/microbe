<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: MySqliConnection.class.php
 *     Class: MySqliConnection
 *     About: MySqli connection handler
 *     Begin: 2017/05/01
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

class MySqliConnection extends BaseConnection
{
    /**************************************************************************/

    const DRIVER                        = 'mysqli';
    const HOST                          = 'localhost';
    const PORT                          = 3306;

    /**************************************************************************/

    /**
     * Create a MySqli database connection with specified parameters
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return void
     */
    function __construct($host, $user, $pass, $base) {
        $this->init(self::DRIVER, $host, self::PORT, $user, $pass, $base);
        $this->connect();
    }

    /**************************************************************************/

    /**
     * Connect to database
     * Return PHP MySqli connection object
     * @return mixed
     */
    public function connect() {
        $result = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->base
        );

        $this->connection = $result ? $result : null;

        // Problematic place
        if ($this->connection && $this->charset) {
        //  mysqli_set_charset($this->connection, 'utf8');
            mysqli_set_charset($this->connection, $this->charset);
        }

        return $this->connection;
    }

    /**
     * Close a database connection
     * Set PHP MySqli connection object $connection to null
     * @return void
     */
    public function disconnect() {
        if ($this->noConnected())
            return;

        mysqli_close($this->connection);
        
        $this->connection = null;
    }
  
    /**************************************************************************/

    /**
     * Execute a $query and return true if success or false otherwise
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    public function execute($query, $debug = false) {
        if ($this->noConnected())
            return false;

        $result = mysqli_query($this->connection, $query);
        $result = $result ? true : false;

        if ($debug)
            $this->debug($query, $result);
        
        return $result;
    }

    /**************************************************************************/

    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|mixed|null
     */
    public function query($query, $debug = false) {
        if ($this->noConnected())
            return null;

        $result = mysqli_query($this->connection, $query);

        if ($debug)
            $this->debug($query, $result);
        
        return $result;
    }

    /**************************************************************************/
    // What if not auto increment field in table ???

    /**
     * Make insert database query
     * Return last inserted row autoincremented identifier or 0 if fail
     * @param string $query
     * @param boolean $debug
     * @return int
     */
    public function insert($query, $debug = false) {
        if ($this->noConnected())
            return 0;            

        $result = mysqli_query($this->connection, $query);
        $result = $result ? mysqli_insert_id($this->connection) : 0;

        if ($debug)
            $this->debug($query, $result);

        return $result;
    }

    /**************************************************************************/

    /**
     * Return last inserted row autoincremented identifier
     * @return int
     */
    public function getInsertId() {
        if ($this->noConnected())
            return 0; // null;
        
        return mysqli_insert_id($this->connection);
    }

    /**************************************************************************/

    /**
     * Return records number in $recordset
     * @param mixed[] $recordset
     * @return int
     */
    public function getRecordCount($recordset) {
        if (empty($recordset))
            return 0; // null;
        
        return mysqli_num_rows($recordset);
    }

    /**************************************************************************/

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function fetch($recordset, $assoc = false) {
        if (empty($recordset))
            return null;

        return $assoc ?
            mysqli_fetch_assoc($recordset)
            :
            mysqli_fetch_row($recordset);
    }

    /**************************************************************************/

    /**
     * Return a $query result or null if fail
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return mixed|null
     */
    public function queryValue($query, $debug = false) {
        if ($this->noConnected())
            return null;

        if ($recordset = $this->query($query, $debug)) {
            if ($row = mysqli_fetch_row($recordset)) {
                $result = $row[0];
                mysqli_free_result($recordset);
                return $result;
            }
        }
    //  if ($recordset) mysqli_free_result($link, $recordset);
        return null;
    }

    /**************************************************************************/ 

    /**
     * Return a first row of a result recordset for $query
     * If $assoc is true then return an associative array     
     * Return null if fail
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function queryRecord($query, $assoc = false, $debug = false) {
        if ($this->noConnected())
            return null;

        if ($recordset = $this->query($query, $debug)) {
            if ($assoc) {
                if ($record = mysqli_fetch_assoc($recordset))
                    return $record;
            } else {
                if ($record = mysqli_fetch_row($recordset))
                    return $record;
            }
        }

        return null;
    }

    /**************************************************************************/
}

/******************************************************************************/