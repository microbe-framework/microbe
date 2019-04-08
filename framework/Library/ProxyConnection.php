<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: ProxyConnection.php
 *     Class: ProxyConnection
 *     About: Proxy connection to different databases
 *     Begin: 2019/03/11
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

class ProxyConnection extends Connection
{
    /**************************************************************************/
    // Proxies list

    /**
     * Share proxies or not, true (share) by default
     *
     * @var boolean $shared
     */
    public static $shared               = true;

    /**
     * Registry of opened proxies
     *
     * @var mixed[] $proxies
     */
    public static $proxies              = array();

    /**************************************************************************/
    // Proxy

    /**
     * Proxified PHP connection object
     *
     * @var mixed $proxy
     */
    protected $proxy                    = null;

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
     * @return ProxyConnection
     */
    function __construct($driver, $host, $port, $user, $pass, $base)
    {
        parent::__construct($driver, $host, $port, $user, $pass, $base);

        if ($proxy = &self::getProxyBy($driver, $host, $port, $user, $pass, $base)) {
            $this->proxy = &$proxy;
        //  $this->proxy->refCount++;
          ++$this->proxy->refCount;
            $this->connection = &$this->proxy->connection;
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
                $this->connection = &$this->proxy->connection;

            // Push a proxy for shared connections
            // No matter if $this->proxy is null
            if (self::$shared)
                array_push(self::$proxies, $this->proxy);
        }
        
    //  echo $this->proxy->refCount;
    }

    /**************************************************************************/
    // Proxy
    /**************************************************************************/
    
    /**
     * Return proxified PHP connection object
     *
     * @return mixed
     */
    public function &getProxy() {
        return $this->proxy;
    }

    /**************************************************************************/
    
    /**
     * Remove proxified PHP connection object from $proxies
     *
     * @param BaseConnection $proxy
     * @return void
     */
    public static function removeProxy($proxy) {
        $key = array_search($proxy, self::$proxies);
        if ($key !== false) {
            unset(self::$proxies[$key]);
        }
    }

    /**************************************************************************/

    /**
     * Return proxified connection object
     * from array $proxies of all opened connections
     * by connection parameters
     *
     * @param string $driver
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $pass
     * @param string $base
     * @return mixed
     */
    protected function &getProxyBy($driver, $host, $port, $user, $pass, $base) {
        // Exit if not in shared mode
        if (self::$shared == false)
            return $this->nothing;

        // Case sensitive !!!
        foreach (self::$proxies as &$proxy) {
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
        return $this->nothing;
    }

    /**************************************************************************/
    // Connect
    /**************************************************************************/

    /**
     * Connect to database
     * Return PHP connection object
     * Stub for BaseConnection compatibility
     * Not recommend to use
     * Connection must be established in constructor
     *
     * [!] Unused
     * @return mixed
     */
    public function &connect() {
        $this->connection = $this->proxy ? $this->proxy->connect() : null;
        return $this->connection;
    }

    /**
     * Close a proxified database connection if their $refCount = 1
     * Set PHP connection object $connection to null if their $refCount = 1
     * Decrement $refCount by one
     * Disconnect of one connection twice can cause an error
     * Not recommend to use
     * Disconnection must be automatic when script ends
     *
     * @return void
     */
    public function disconnect() {

        $proxy = &$this->proxy;

        if (empty($proxy))
            return;

        if ($proxy->refCount > 0)
            $proxy->refCount--;

        if ($proxy->refCount > 0)
            return;

        $proxy->disconnect();

        if (self::$shared) {
            self::removeProxy($proxy);
        }
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
    //  return $this->proxy ? $this->proxy->execute($query, $debug) : null;
        return $this->proxy->execute($query, $debug);
    }

    /**************************************************************************/

    /**
     * Return a $query result
     * Print debug output if $debug is set to true
     *
     * @param string $query
     * @param boolean $debug
     * @return mixed[]|mixed|null
     */
    public function &query($query, $debug = false) {
    //  $result = $this->proxy ? $this->proxy->query($query, $debug) : null;
        return $this->proxy->query($query, $debug);
    }

    /**************************************************************************/

    /**
     * Return last inserted row autoincremented identifier
     *
     * @return int
     */
    public function getInsertId() {
    //  return $this->proxy ? $this->proxy->getInsertId() : 0;
        return $this->proxy->getInsertId();
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
    //  return $this->proxy ? $this->proxy->getRecordCount($recordset) : 0;
        return $this->proxy->getRecordCount($recordset);
    }

    /**************************************************************************/

    /**
     * Free a recordset $recordset
     *
     * @return void
     */
    public function free(&$recordset) {
    //  if ($this->proxy) $this->proxy->free($recordset);
        $this->proxy->free($recordset);
    }

    /**************************************************************************/
    // Fetch
    /**************************************************************************/

    /**
     * Return a record from $recordset and go to the next record
     * If $assoc is true then return an associative array
     *
     * @param mixed[] $recordset
     * @param boolean $assoc
     * @return mixed[]|null
     */
    public function &fetch(&$recordset, $assoc = false) {
    //  return $this->proxy ? $this->proxy->fetch($recordset, $assoc) : null;
        return $this->proxy->fetch($recordset, $assoc);
    }

    /**************************************************************************/

    /**
     * Return a recordset fields info array*
     *
     * @param mixed[] $recordset
     * @return mixed[]|null
     */
    public function &fetchFields(&$recordset) {
    //  return $this->proxy ? $this->proxy->fetchFields($recordset) : null;
        return $this->proxy->fetchFields($recordset);
    }

    /**************************************************************************/
}

/******************************************************************************/