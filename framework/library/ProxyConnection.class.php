<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: ProxyConnection.class.php
 *     Class: ProxyConnection
 *     About: Proxy connection to different databases
 *     Begin: 2019/03/11
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

class ProxyConnection extends BaseConnection
{
    /**************************************************************************/
    // Proxies list

    /**
     * Share proxies or not, true (share) by default
     * @var boolean $shared
     */
    public static $shared               = true;

    /**
     * Proxies
     * @var mixed[] $proxies
     */
    public static $proxies              = array();

    /**************************************************************************/
    // Proxy

    /**
     * Proxified PHP connection object
     * @var mixed $proxy
     */
    protected $proxy                    = null;

    /**************************************************************************/
    // Constructor
    /**************************************************************************/

    /**
     * Create a database connection with specified parameters
     * @param string $driver
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return ProxyConnection
     */
    function __construct($driver, $host, $port, $user, $pass, $base)
    {
        parent::__construct($driver, $host, $port, $user, $pass, $base);
        
        if ($proxy = self::getProxyBy($driver, $host, $port, $user, $pass, $base)) {
            $this->proxy = $proxy;
            $this->proxy->refCount++;
            $this->connection = $this->proxy->connection;
        } else {
            if ($driver == 'mysqli') {
                $this->proxy = new MySqliConnection(
                    $host,
                    $user,
                    $pass,
                    $base
                );
            }

            // Get a connection
            if ($this->proxy)
                $this->connection = $this->proxy->connection;

            // Push a proxy for shared connections
            // No matter if $this->proxy is null
            if (self::$shared)
                array_push(self::$proxies, $this->proxy);
        }
        
    //  echo $this->proxy->refCount;
    }

    /**************************************************************************/
    
    /**
     * Return proxified PHP connection object
     * @return mixed
     */
    public function getProxy() {
        return $this->proxy;
    }

    /**************************************************************************/

    /**
     * Return proxified connection object
     * from array $proxies of all opened connections
     * by connection parameters
     * @param string $driver
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return mixed
     */
    public function getProxyBy($driver, $host, $port, $user, $pass, $base) {
        // Exit if not in shared mode
        if (self::$shared == false)
            return null;

        // Case sensitive !!!
        foreach (self::$proxies as $proxy) {
            if (
                ($proxy->driver == $driver)
                &&
                ($proxy->host == $host)
                &&
                ($proxy->port == $port)
                &&
                ($proxy->user == $user)
                &&                
                ($proxy->pass == $pass)
                &&                
                ($proxy->base == $base)
            ) {
                return $proxy;
            }
        }
        return null;
    }

    /**************************************************************************/
    // Proxy of BaseConnection
    /**************************************************************************/

    /**
     * Connect to database
     * Return PHP connection object
     * Stub for BaseConnection compatibility
     * Not recommend to use
     * Connection must be established in constructor
     * @return mixed
     */
    public function connect() {
        return $this->connection = $this->proxy ? $this->proxy->connect() : null;
    }

    /**
     * Close a proxified database connection if their $refCount = 1
     * Set PHP connection object $connection to null if their $refCount = 1
     * Decrement $refCount by one
     * Disconnect of one connection twice can cause an error
     * Not recommend to use
     * Disconnection must be automatic when script ends
     * @return void
     */    
    public function disconnect() {

        $proxy = $this->proxy;
        
        if (empty($proxy))
            return;

        if ($proxy->refCount > 0)
            $proxy->refCount--;

        if ($proxy->refCount == 0)
            $proxy->disconnect();
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
        return $this->proxy ? $this->proxy->execute($query, $debug) : null;
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
        return $this->proxy ? $this->proxy->query($query, $debug) : null;
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
        return $this->proxy ? $this->proxy->insert($query, $debug) : 0;
    }

    /**************************************************************************/
    
    /**
     * Return last inserted row autoincremented identifier
     * @return int
     */
    public function getInsertId() {
        return $this->proxy ? $this->proxy->getInsertId() : null;
    }

    /**************************************************************************/

    /**
     * Return records number in $recordset
     * @param mixed[] $recordset
     * @return int
     */
    public function getRecordCount($recordset) {
        return $this->proxy ? $this->proxy->getRecordCount($recordset) : null;
    }

    /**************************************************************************/

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array     
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function fetch($recordset, $assoc = false) {
        return $this->proxy ? $this->proxy->fetch($recordset, $assoc) : null;
    }

    /**************************************************************************/

    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     * @param string $query
     * @param boolean $debug
     * @return mixed|null
     */
    public function queryValue($query, $debug = false) {
        return $this->proxy ? $this->proxy->queryValue($query, $debug) : null;    
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
        return $this->proxy ? $this->proxy->queryRecord($query, $assoc, $debug) : null;
    }

    /**************************************************************************/
}

/******************************************************************************/