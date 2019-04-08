<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: PostgresConnection.php
 *     Class: PostgresConnection
 *     About: Postgres database connection class
 *     Begin: 2017/05/01
 *   Current: 2019/04/03
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

class PostgresConnection extends Connection
{
    /**************************************************************************/
    // Default database connection parameters

    const DRIVER                        = 'postgres';
    const PORT                          = 5432;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a database connection with specified parameters
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
    // Connection string builder
    /**************************************************************************/
    // Connection string sample:
    // 'host=localhost port=5432 dbname=database user=username password=password'

    /**
     * Make and return a parameter pair of $name and $value
     *
     * @param string $name
     * @param string $value
     * @param string $bool
     * @return string
     */
    protected function makeParam($name, $value, $bool)
    {
        if (empty($name) || empty($value))
            return null;

        $space = (empty($string)) ? null : ' ';

        return $space.$name.'='.$value;
    }

    /**
     * Create and return a database connection string with specified parameters
     *
     * @param string $host
     * @param string $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return string
     */
    protected function getConnectionString($host, $port, $user, $pass, $base)
    {
        $result  = null;
        $result .= $this->makeParam('host',     $host, empty($result));
        $result .= $this->makeParam('port',     $port, empty($result));
        $result .= $this->makeParam('dbname',   $base, empty($result));
        $result .= $this->makeParam('user',     $user, empty($result));
        $result .= $this->makeParam('password', $pass, empty($result));
        return $result;
    }

    /**************************************************************************/
    // Connect
    /**************************************************************************/

    /**
     * Connect to database, return $connection value
     *
     * @return mixed
     */
    public function &connect() 
    {

        $connectionString = $this->getConnectionString(
            $this->host, $this->port, $this->user, $this->pass, $this->base
        );

        // Create connection
        $this->connection = pg_connect($connectionString);

        // Make connection settings
    //  if ($this->connection) {
    //      db_tune($this->connection);
    //  }

        return $this->connection;
    }

    /**
     * Close a database connection
     *
     * @return void
     */
    public function disconnect() 
    {
        if ($this->noConnected())
            return;

        // Close a connection
        pg_close($this->connection);

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
    public function execute($query, $debug = false)
    {
        if ($this->noConnected())
            return false;

        $result = boolval(pg_query($this->connection, $query));

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
     * @return pg_result|boolean|null
     */
    public function &query($query, $debug = false)
    {
        if ($this->noConnected())
            return $this->nothing;

        $result = pg_query($this->connection, $query);

        if ($debug)
            $this->debug($query, $result);

        return $result;
    }

    /**************************************************************************/

    /**
     * Return last inserted row autoincremented identifier
     *
     * [?] Questionable
     * @return int
     */
    public function getInsertId()
    {
        if ($this->noConnected())
            return 0; // null;

        if ((($rows = pg_query($this->connection, 'SELECT lastval();')) == false)
            return 0; // null;

        if ((($row = pg_fetch_row($result)) == false)
            return 0; // null;

        return intval($row[0]);
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
    public function getRecordCount(&$recordset)
    {
        if (empty($recordset))
            return 0; // null;

        return pg_num_rows($recordset);
    }

    /**
     * Free a recordset $recordset
     *
     * @return void
     */
    public function free(&$recordset) {
        pg_free_result($recordset);
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
    public function &fetch(&$recordset, $assoc = false)
    {
        if (empty($recordset))
            return $this->nothing;

        $result = $assoc ?
            pg_fetch_assoc($recordset)
            :
            pg_fetch_row($recordset);

    //  $result = pg_fetch_array(
    //      $recordset,
    //      $assoc ? PGSQL_ASSOC : PGSQL_NUM
    //  );

        return $result;
    }

    /**************************************************************************/
    //  $i = pg_num_fields($recordset);
    //  for ($j = 0; $j < $i; ++$j) {
    //      echo "column $j\n";
    //      $fieldname = pg_field_name($res, $j);
    //      echo "fieldname: $fieldname\n";
    //      echo "printed length: " . pg_field_prtlen($res, $fieldname) . " characters\n";
    //      echo "storage length: " . pg_field_size($res, $j) . " bytes\n";
    //      echo "field type: " . pg_field_type($res, $j) . " \n\n";
    //  }

    /**
     * Return a recordset fields info array
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function &fetchFields(&$recordset) 
    {
        if (empty($recordset))
            return $this->nothing;

        $result = array();
        $count = pg_num_fields($recordset);
        for ($index = 0; $index < $count; $index++) {
        //  $result[]            = pg_field_name($recordset, $index);
            $field               = array();
            $field['name']       = pg_field_name($recordset, $index);
            $field['length']     = pg_field_prtlen($recordset, $index);
            $field['max_length'] = pg_field_size($recordset, $index);
            $field['type']       = pg_field_type($recordset, $index);
            $result[]            = $field;
        }

        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/