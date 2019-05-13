<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Connection.php
 *     Class: Connection
 *     About: Basic connection class
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

abstract class Connection
{
    /**************************************************************************/
    // Default database connection parameters

    const DRIVER                        = null;
    const HOST                          = 'localhost';
    const PORT                          = 0;
    const USER                          = null;
    const PASS                          = null;
    const BASE                          = null;
    const CHARSET                       = null; // utf8
    const COLLATION                     = null; // 'utf8_unicode_ci'

    /**************************************************************************/

    /**
     * Debug mode switch
     * Can be true or false
     *
     * @var boolean $debugMode
     */
    public static $debugMode            = false;

    /**************************************************************************/

    /**
     * Null varuable
     *
     * @var null $nothing
     */
    protected $nothing                  = null;

    /**************************************************************************/

    /**
     * PHP database connection object
     *
     * @var mixed $connection
     */
    protected $connection;

    /**
     * References to BaseConnection instances count
     * Used for shared proxy connections
     * Set to one when object was created
     *
     * @var int $refCount
     */
    protected $refCount;

    /**
     * Database connection driver name $driver
     *
     * @var string $driver
     */
    protected $driver;

    /**
     * Database connection $host
     *
     * @var string $host
     */
    protected $host;

    /**
     * Database connection $port
     *
     * @var int $port
     */
    protected $port;

    /**
     * Database connection login/username $user
     *
     * @var string $driver
     */
    protected $user;

    /**
     * Database connection password $pass
     *
     * @var string $pass
     */
    protected $pass;

    /**
     * Database connection database name $base
     *
     * @var string $base
     */
    protected $base;

    /**
     * Database charset
     *
     * @var string $charset
     */
    protected $charset;

    /**
     * Database string collation charset
     *
     * @var string $collation
     */
    protected $collation;

    /**************************************************************************/

    /**
     * Database connection parameters array
     *
     * @var string[] $params
     */
    protected $params;

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
        $this->init($driver, $host, $port, $user, $pass, $base);
        $this->connect();
    }

    /**************************************************************************/

    /**
     * Initialize BaseConnection instance variables
     * Store database connection parameters
     *
     * @param string $driver
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return void
     */
    protected function init($driver, $host, $port, $user, $pass, $base)
    {
        $this->connection = null;
        $this->refCount   = 1;
        $this->driver     = $driver;
        $this->host       = $host;
        $this->port       = $port;
        $this->user       = $user;
        $this->pass       = $pass;
        $this->base       = $base;
    }

    /**************************************************************************/
    
    /**
     * Print html-colored $text to output
     * If $bool is true set color to red, use blue color otherwise
     * Used for debug purposes only
     *
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function debug($text, $bool = false) {
        echo '<span style="color: ', ($bool ? '#00f' : '#f00'), ';"><pre>', $text, '</pre></span>';
    }

    /**
     * Set static class variable debugMode to true
     * Used for debug purposes only
     *
     * @param string $text
     * @return mixed
     */
    public static function on() {
        self::$debugMode = true;
    }

    /**
     * Set static class variable debugMode to true
     * Used for debug purposes only
     *
     * @param string $text
     * @return mixed
     */
    public static function off() {
        self::$debugMode = false;
    }

     /**************************************************************************/

    /**
     * Return instance is connetcted to database or not
     * Return true if connected, false otherwise
     *
     * @return boolean
     */
    public function isConnected() {
        return !empty($this->connection);
    }

    /**
     * Return instance is connetcted to database or not
     * Return true if not connected, false otherwise
     *
     * @return boolean
     */
    public function noConnected() {
        return empty($this->connection);
    }

    /**
     * Return php database connection object
     *
     * @return mixed[]
     */
    public function &getConnection() {
        return $this->connection;
    }

    /**
     * Set php database connection object $connection
     *
     * @param mixed[] $connection
     * @return void
     */
    public function setConnection(&$connection) {
        $this->connection = &$connection;
    }
  
    /**************************************************************************/
    // Connect
    /**************************************************************************/

    /**
     * Connect to database, return $connection value
     *
     * @return mixed
     */
    abstract public function &connect();

    /**
     * Close a database connection
     *
     * @return void
     */
    abstract public function disconnect();

    /**************************************************************************/
    // Data accessors 
    /**************************************************************************/

    /**
     * Execute a $query and return true if success or false otherwise
     * Print debug output if $debug is set to true
     *
     * [!] Save as abstract, that is totally diferent with query()
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    abstract public function execute($query, $debug = false);
  
    /**************************************************************************/

    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[][]|boolean|null
     */
    abstract public function &query($query, $debug = false);

    /**
     * Return a stored in file $filename query result
     * Print debug output if $debug is set to true
     * Return null if file not found
     *
     * @param string $filename
     * @param boolean $debug
     * @return mixed[][]|boolean|null
     */
    public function &queryFile($filename, $debug = false) {

        if ($this->noConnected())
            return $this->nothing;

        if (file_exists($filename)) {
            $query = file_get_contents($filename);
            return $this->query($query, $debug);
        }

        if ($debug)
            $this->debug($filename, true);

        return $this->nothing;
    }

    /**************************************************************************/
    // What if not auto increment field in table ???

    /**
     * Make insert database query
     * Return last inserted row autoincremented identifier or 0 if fail
     *
     * @param string $query
     * @param boolean $debug
     * @return int
     */
    public function insert($query, $debug = false) {
        if ($this->noConnected())
            return 0;            

        if ($this->query($query, $debug)) {
            $result = $this->getInsertId();
        } else {
            $result = 0;
        }

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
    abstract public function getInsertId();

    /**************************************************************************/
    // Recordset
    /**************************************************************************/

    /**
     * Return records number in $recordset
     *
     * @param mixed[] $recordset
     * @return int
     */
    abstract public function getRecordCount(&$recordset);

    /**
     * Free a recordset $recordset
     *
     * @return void
     */
    abstract public function free(&$recordset);

    /**************************************************************************/
    // Fetch
    /**************************************************************************/

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array
     * Stub, doing nothing, always null
     *
     * [?] Possible better name is fetchRow
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    abstract public function &fetch(&$recordset, $assoc = false);

    /**
     * Return a record from $recordset as array and go to the next record
     *
     * @param mixed[] $recordset
     * @return null
     */
    public function &fetchArray(&$recordset) {
        return $this->fetch($recordset, false);
    }

    /**
     * Return a record from $recordset as associative array and go to the next record
     *
     * @param mixed[] $recordset
     * @return null
     */
    public function &fetchAssoc(&$recordset) {
        return $this->fetch($recordset, true);
    }

    /**
     * Fetch next active record from a recordset to Record object
     * Return a result
     *
     * @param mixed[] $recordset
     * @return Record|null
     */
    public function &fetchRecord(&$recordset) {
        if ($row = &$this->fetch($recordset, true))
            return $this->nothing;

        return new Record($row);
    }

    /**************************************************************************/

    /**
     * Return a recordset fields info array
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    abstract public function &fetchFields(&$recordset);

    /**
     * Return a recordset fields info as Fieldset object
     *
     * [!] DRAFT
     * @param mixed[] $recordset
     * @return Fieldset|null
     */
    public function &fetchFieldset(&$recordset) {
        return $this->nothing;
    }

    /**************************************************************************/
    // Fetch all
    /**************************************************************************/

    /**
     * Fetch all records from a recordset
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     *
     * [?] Possible better name is fetchRows
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function &fetchRows(&$recordset, $assoc = false) {

        if (empty($recordset))
            return $this->nothing;;

        $rows = array();

        while ($row = &$this->fetch($recordset, $assoc)) {
            $rows[] = &$row;
        }

        $this->items = &$rows;

        return $this->items;
    }

    /**
     * Fetch all records from a recordset as array
     * Return a result
     *
     * [?] Possible better name is fetchRowsToArray
     * @return mixed[][]|null
     */
    public function &fetchRowsArray(&$recordset) {
        return $this->fetchRows($recordset, false);
    }

    /**
     * Fetch all records from a recordset as an associative array
     * Return a result
     *
     * [?] Possible better name is fetchRowsToAssoc
     * @return mixed[][]|null
     */
    public function &fetchRowsAssoc(&$recordset) {
        return $this->fetchRows($recordset, true);
    }

    /**************************************************************************/
    // Query and fetch
    /**************************************************************************/
    
    /**
     * Return a $query result
     * If query return empty result set return null
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed|null
     */
    public function &queryValue($query, $debug = false) {

        if ($this->noConnected())
            return $this->nothing;

        $result = null;

        if ($recordset = &$this->query($query, $debug)) {
            if ($row = &$this->fetch($recordset, false)) {
                if (count($row) > 0) {
                    $result = $row[0];
                }
            }
            $this->free($recordset);
        }

        return $result;
    }

    /**************************************************************************/
    
    /**
     * Return a $query result as boolean
     * If query return empty result set return false
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    public function queryBoolean($query, $debug = false) {
        return boolval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as int
     * If query return empty result set return 0
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return int
     */
    public function queryInteger($query, $debug = false) {
        return intval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as float
     * If query return empty result set return 0.0
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return float
     */
    public function queryFloat($query, $debug = false) {
        return floatval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as string
     * If query return empty result set return ''
     * Boolean false converts to ''
     * Null converts to ''
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return string
     */
    public function queryString($query, $debug = false) {
        return strval($this->queryValue($query, $debug));
    }

    /**************************************************************************/

    /**
     * Return a first row of a result recordset for $query
     * If $assoc is true then return an associative array     
     * Return null if fail
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function &queryRow($query, $assoc = false, $debug = false) {

        if ($this->noConnected())
            return $this->nothing;

        if ($recordset = &$this->query($query, $debug)) {
            return $this->fetch($recordset, $assoc);
        }

        return $this->nothing;
    }

    /**
     * Return a first row of a result recordset for $query
     * Return null if fail
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function &queryRowArray($query, $debug = false) {
        return $this->queryRow($query, false, $debug);
    }

    /**
     * Return a first row of a result recordset for $query as associative array
     * Return null if fail
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function &queryRowAssoc($query, $debug = false) {
        return $this->queryRow($query, true, $debug);
    }

    /**
     * Return a first row of a result recordset for $query as Record object
     * Return null if fail
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return Record|null
     */
    public function &queryRecord($query, $debug = false) {
        if ($row = &$this->queryRow($query, $debug))
            return new Record($row);
        
        return $this->nothing;
    }

    /**************************************************************************/
    // Query and fetch all
    /**************************************************************************/
    
    /**
     * Execute a query and fetch all results to array of rows
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     *
     * @param string $query
     * @param boolean $assoc
     * @param boolean $debug
     * @return mixed[][]|null
     */
    public function &queryRows($query, $assoc = false, $debug = false) {
        if (empty($this->connection))
            return $this->nothing;
 
        if ($recordset = &$this->query($query, $debug))
            return $this->fetchRows($recordset, $assoc);

        return $this->nothing;
    }

    /**
     * Execute a query and fetch all results to array of rows
     * Return a result
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[][]|null
     */
    public function &queryRowsArray($query, $debug = false) {
        return $this->queryRows($query, false, $debug);
    }

    /**
     * Execute a query and fetch all results to array of associative rows
     * Return a result
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[][]|null
     */
    public function &queryRowsAssoc($query, $debug = false) {
        return $this->queryRows($query, true, $debug);
    }

    /**************************************************************************/
    // Create objects
    /**************************************************************************/

    /**
     * Execute a query and fetch all results to Microbe\Recordset object
     * Return a result
     *
     * @param string $query
     * @param boolean $debug
     * @return Microbe\Recordset|null
     */
    public function &queryRecordset($query, $debug = false) {
        if ($recordset = &$this->query($query, $debug))
            return new Recordset($this, $recordset);

        return $this->nothing;
    }

    /**************************************************************************/

    /**
     * Execute a query and fetch all results to Microbe\Records
     * If $assoc is true then return an associative array
     * Parameter $assoc is true by default
     * Return a result
     *
     * @param string $query
     * @param boolean $assoc
     * @param boolean $debug
     * @return Microbe\Records|null
     */
    public function &queryRecords($query, $assoc = true, $debug = false) {
        if ($rows = &$this->queryRows($query, $assoc, $debug))
            return new Records($rows);

        return $this->nothing;
    }

    /**************************************************************************/
}

/******************************************************************************/