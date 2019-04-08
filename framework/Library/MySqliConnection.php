<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: MySqliConnection.php
 *     Class: MySqliConnection
 *     About: MySqli connection handler
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

class MySqliConnection extends Connection
{
    /**************************************************************************/

    const DRIVER                        = 'mysqli';
    const PORT                          = 3306;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a MySqli database connection with specified parameters
     *
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return void
     */
    function __construct($host, $user, $pass, $base)
    {
        parent::__construct(self::DRIVER, $host, self::PORT, $user, $pass, $base);
    }

    /**************************************************************************/
    // Connect
    /**************************************************************************/

    /**
     * Connect to database
     * Return PHP MySqli connection object
     *
     * @return mixed
     */
    public function &connect() {

        $this->connection = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->base
        );

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
     *
     * @return void
     */
    public function disconnect() {
        if ($this->noConnected())
            return;

        mysqli_close($this->connection);
        
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

        $result = boolval(mysqli_query($this->connection, $query));

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
     * @return mysqli_result|boolean|null
     */
    public function &query($query, $debug = false) {
        if ($this->noConnected())
            return $this->nothing;

        $result = mysqli_query($this->connection, $query);

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

        return mysqli_insert_id($this->connection);
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

        return mysqli_num_rows($recordset);
    }

    /**************************************************************************/

    /**
     * Free a recordset $recordset
     *
     * @return void
     */
    public function free(&$recordset) {
        mysqli_free_result($recordset);
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
            mysqli_fetch_assoc($recordset)
            :
            mysqli_fetch_row($recordset);

    //  $result = mysqli_fetch_array(
    //      $recordset,
    //      $assoc ? MYSQLI_ASSOC : MYSQLI_NUM
    //  );

        return $result;
    }

    /**************************************************************************/
    //  From PHP manual:
    //  $finfo = mysqli_fetch_fields($result);
    //  foreach ($finfo as $val) {
    //      printf("Name:      %s\n",   $val->name);
    //      printf("Table:     %s\n",   $val->table);
    //      printf("Max. Len:  %d\n",   $val->max_length);
    //      printf("Length:    %d\n",   $val->length);
    //      printf("charsetnr: %d\n",   $val->charsetnr);
    //      printf("Flags:     %d\n",   $val->flags);
    //      printf("Type:      %d\n\n", $val->type);
    //  }

    /**
     * Return a recordset fields info array
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function &fetchFields(&$recordset) {
        if (empty($recordset))
            return $this->nothing;

        return mysqli_fetch_fields($recordset);
    }

    /**************************************************************************/
}

/******************************************************************************/