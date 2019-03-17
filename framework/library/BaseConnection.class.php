<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: BaseConnection.class.php
 *     Class: BaseConnection
 *     About: Basic connection class
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

class BaseConnection
{
    /**************************************************************************/
    // Default database connection parameters

    const DRIVER                        = null;
    const HOST                          = 'localhost';
    const PORT                          = 0;
    const USER                          = null;
    const PASS                          = null;
    const BASE                          = null;
    const CHARSET                       = null;

    /**************************************************************************/

    /**
     * PHP database connection object
     * @var mixed $connection
     */
    protected $connection;

    /**
     * References to BaseConnection instances count
     * Used for shared proxy connections
     * Set to one when object was created
     * @var int $refCount
     */
    protected $refCount;

    /**
     * Database connection driver name $driver
     * @var string $driver
     */
    protected $driver;

    /**
     * Database connection $host
     * @var string $host
     */
    protected $host;

    /**
     * Database connection $port
     * @var int $port
     */
    protected $port;

    /**
     * Database connection login/username $user
     * @var string $driver
     */
    protected $user;

    /**
     * Database connection password $pass
     * @var string $pass
     */
    protected $pass;

    /**
     * Database connection database name $base
     * @var string $base
     */
    protected $base;

    /**
     * Database charset
     * @var string $charset
     */
    protected $charset;

    /**************************************************************************/

    /**
     * Database connection parameters array
     * @var string[] $params
     */
    protected $params;

    /**************************************************************************/

    /**
     * Create a database connection with specified parameters
     * @param string $driver
     * @param string $host
     * @param int $port
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
     * @param string $driver
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return void
     */
    protected function init($driver, $host, $port, $user, $pass, $base)
    {
        $this->connection = null;
        $this->refCount = 1;
        $this->driver = $driver;
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->base = $base;
    }

    /**************************************************************************/
    
    /**
     * Print html-colored $text to output
     * If $bool is true set color to red, use blue color otherwise
     * Used for debug purposes only
     * @param string $text
     * @param boolean $bool
     * @return void
     */
    public static function debug($text, $bool = false) {
        echo "<span style=\"color: ".($bool ? "#00f" : "#f00").";\"><pre>".$text."</pre></span>";
    }

    /**************************************************************************/

    /**
     * Return instance is connetcted to database or not
     * Return true if connected, false otherwise
     * @return boolean
     */
    public function isConnected() {
        return !empty($this->connection);
    }

    /**
     * Return instance is connetcted to database or not
     * Return true if not connected, false otherwise
     * @return boolean
     */
    public function noConnected() {
        return empty($this->connection);
    }

    /**
     * Return php database connection object
     * @return mixed[]
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Set php database connection object $connection
     * @param mixed[] $connection
     * @return void
     */
    public function setConnection($connection) {
        $this->connection = $connection;
    }
  
    /**************************************************************************/
    
    /**
     * Connect to database
     * Stub, doing nothing, return $connection value
     * @return mixed
     */
    public function connect() {
    //  if ($this->isConnected())
    //      return $this->connection;

        return $this->connection;
    }

    /**
     * Close a database connection
     * Stub, doing nothing
     * @return void
     */
    public function disconnect() {
        if ($this->noConnected())
            return;

        $this->connection = null;
    }

    /**************************************************************************/
    // Data accessors 
    /**************************************************************************/

    /**
     * Execute a $query and return true if success or false otherwise
     * Print debug output if $debug is set to true
     * Stub, always false
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    public function execute($query, $debug = false) {
        return false;
    }
  
    /**************************************************************************/

    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     * Stub, always null
     * @param string $query
     * @param boolean $debug
     * @return null
     */
    public function query($query, $debug = false) {
        return null;
    }

    /**
     * Return a stored in file $filename query result
     * Print debug output if $debug is set to true
     * Return null if file not found
     * @param string $filename
     * @param boolean $debug
     * @return mixed[]|mixed|null
     */
    public function queryFile($filename, $debug = false) {
        if ($this->noConnected())
            return null;

        if (file_exists($filename)) {
            $query = file_get_contents($filename);
            return $this->query($query, $debug);
        } else {
            if ($debug)
                $this->debug($filename, true);
                
            return null;
        }
    }

    /**************************************************************************/
    // What if not auto increment field in table ???

    /**
     * Make insert database query
     * Stub, doing nothing, always 0
     * @param string $query
     * @param boolean $debug
     * @return int
     */
    public function insert($query, $debug = false) {
        return 0;            
    }

    /**************************************************************************/   

    /**
     * Return last inserted row autoincremented identifier
     * Stub, doing nothing, always 0
     * @return int
     */
    public function getInsertId() {
        return 0;
    }

    /**************************************************************************/

    /**
     * Return records number in $recordset
     * Stub, doing nothing, always 0
     * @param mixed[] $recordset
     * @return int
     */
    public function getRecordCount($recordset) {
        return 0;
    }

    /**************************************************************************/   

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array     
     * Stub, doing nothing, always null
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function fetch($recordset, $assoc = false) {
        return null;
    }

    /**
     * Return a record from $recordset as array and go to the next record
     * Stub, doing nothing, always null
     * @param mixed[] $recordset
     * @return null
     */
    public function fetchArray($recordset) {
        return $this->fetch($recordset, false);
    }

    /**
     * Return a record from $recordset as associative array and go to the next record
     * Stub, doing nothing, always null
     * @param mixed[] $recordset
     * @return null
     */
    public function fetchAssoc($recordset) {
        return $this->fetch($recordset, true);
    }
    
    /**************************************************************************/   
    
    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     * Stub, doing nothing, always null
     * @param string $query
     * @param boolean $debug
     * @return null
     */
    public function queryValue($query, $debug = false) {
        return null;
    }
    
    /**************************************************************************/
    
    /**
     * Return a $query result as boolean
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return boolean
     */
    public function queryBoolean($query, $debug = false) {
        return boolval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as int
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return int
     */
    public function queryInteger($query, $debug = false) {
        return intval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as float
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return float
     */
    public function queryFloat($query, $debug = false) {
        return floatval($this->queryValue($query, $debug));
    }

    /**
     * Return a $query result as string
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return string
     */
    public function queryString($query, $debug = false) {
        $result = $this->queryValue($query, $debug);
        return $result ? $result : '';
    //  return strval($this->queryValue($query, $debug));
    }

    /**************************************************************************/ 

    /**
     * Return a first row of a result recordset for $query
     * If $assoc is true then return an associative array     
     * Return null if fail
     * Print debug output if $debug is set to true
     * Stub, doing nothing, always null
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function queryRecord($query, $assoc = false, $debug = false) {
        return null;
    }

    /**
     * Return a first row of a result recordset for $query
     * Return null if fail
     * Print debug output if $debug is set to true
     * Stub, doing nothing, always null
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function queryArray($query, $debug = false) {
        return $this->queryRecord($query, false, $debug);
    }

    /**
     * Return a first row of a result recordset for $query as associative array
     * Return null if fail
     * Print debug output if $debug is set to true
     * Stub, doing nothing, always null
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|null
     */
    public function queryAssoc($query, $debug = false) {
        return $this->queryRecord($query, true, $debug);
    }

    /**************************************************************************/

    /**
     * Fetch all records from a recordset
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function fetchAll($recordset, $assoc = false) {

        if (empty($recordset)) {
            return null;
        }

        $records = array();

        while ($record = $this->fetch($recordset, $assoc)) {
            $records[] = $record;
        }

        return $this->items = $records;
    }

    /**
     * Fetch all records from a recordset as array
     * Return a result
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function fetchArrayAll($recordset) {
        return $this->fetchAll($recordset, false);
    }

    /**
     * Fetch all records from a recordset as an associative array
     * Return a result
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function fetchAssocAll($recordset) {
        return $this->fetchAll($recordset, true);
    }

    /**************************************************************************/
    
    /**
     * Execute a query and fetch all results to records
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param string $query
     * @param boolean $assoc
     * @return mixed[][]|null
     */
    public function load($query, $assoc = false, $debug = false) {

        if (empty($this->connection)) {
            return null;
        }

        $recordset = $this->query($query, $debug);
        $records = $recordset ? $this->fetchAll($assoc, $recordset) : null;

        return $records;
    }

    /**
     * Execute a query and fetch all results to records
     * Return a result
     * @param string $query
     * @return mixed[][]|null
     */
    public function loadArray($query, $debug = false) {
        return $this->load($query, false, $debug);
    }

    /**
     * Execute a query and fetch all results to associative records
     * Return a result
     * @param string $query
     * @return mixed[][]|null
     */
    public function loadAssoc($query, $debug = false) {
        return $this->load($query, true, $debug);
    }

    /**************************************************************************/

    /**
     * Execute a query and fetch all results to Recordset
     * Return a result
     * @param string $query
     * @param boolean $assoc
     * @return Recordset|null
     */
    public function getRecordset($query, $debug = false) {
        $recordset = $this->query($query, $debug);
        return new Recordset($this, $recordset);
    }

    /**************************************************************************/

    /**
     * Execute a query and fetch all results to Records
     * If $assoc is true then return an associative array
     * Parameter $assoc is false by default
     * Return a result
     * @param string $query
     * @param boolean $assoc
     * @return Records|null
     */
    public function getRecords($query, $assoc = false, $debug = false) {
        $recordset = $this->query($query, $debug);
        $records = $this->fetchAll($recordset, $assoc);
        return new Records($records);
    }
    
    /**************************************************************************/
}

/******************************************************************************/