<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Collection.php
 *     Class: Collection
 *     About: Collection is php build-in array object wrapper
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

class Collection implements \ArrayAccess, \IteratorAggregate
{
    /**************************************************************************/

    /**
     * Collection items array
     *
     * @var mixed[] $items
     */
    protected $items                    = array();

    /**************************************************************************/

    /**
     * Create a Collection instance
     *
     * @param mixed[] $items
     * @return Collection
     */
    function __construct($items = null) {
        if (is_array($items)) {
            $this->items = $items;
        }
    }
    
    /**************************************************************************/

    /**
     * Create a Collection from array $items
     *
     * @param mixed[] $items
     * @return Collection
     */
    public static function &createFromArray(&$items) {
        $result = new Collection();
        $result->items = &$items;
        return $result;
    }

    /**************************************************************************/

    /**
     * Return true if $items not null, false otherwise
     *
     * @return boolean
     */
    public function isActive() {
        return is_array($this->items);
    }

    /**
     * Return true if $items is null, false otherwise
     *
     * @return boolean
     */
    public function noActive() {
        return $this->isActive() == false;
    }

    /**************************************************************************/

    /**
     * Return true if $items not null and hasn't elements, false otherwise
     *
     * @return boolean
     */
    public function isEmpty() {
        return (is_array($this->items) == false) || (count($this->items) == 0);
    }

    /**
     * Return true if $items not null and has elements, false otherwise
     *
     * @return boolean
     */
    public function noEmpty() {
        return $this->isEmpty() == false;
    }


    /**************************************************************************/

    /**
     * Return $items
     *
     * @return mixed[]
     */
    public function &getItems() {
        return $this->items;
    }

    /**
     * Return number of $items elements
     *
     * @return int
     */
    public function getCount() {
    //  return Arrays::getCount($this->items);
        return is_array($this->items) ? count($this->items) : 0;
    }

    /**************************************************************************/
    // !!! required for implements ArrayAccess

    /**
     * Return true value if $items has element with $key, false otherwise
     *
     * @param mixed $key
     * @return boolean
     */
    public function has($key) {
    
        if ($this->noActive()) return false;

        return isset($this->items[$key]);
    }

    /**
     * Return value of $items element with $key, null otherwise
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function get($key) {
    
        if ($this->noActive()) return null;
        
    //  if (!array_key_exists($key, $this->items)) return null;
        if (isset($this->items[$key]) == false) return null;

        return $this->items[$key];
    }

    /**
     * Return true if set $items element with $key to $value, false otherwise
     *
     * @param mixed $key
     * @param mixed $value
     * @return boolean
     */
    public function set($key, $value) {
    
        if ($this->noActive()) return false;

        if (isset($this->items[$key]) == true) {
        //  throw new Exception('Unable to set var `' . $key . '`. Already set.');
            return false;
        }

        $this->items[$key] = $value;

        return true;
    }

    /**************************************************************************/

    /**
     * Return value of $items element with $key as boolean
     * Return false if $items element with $key not found
     *
     * @param mixed $key
     * @return boolean
     */
    public function getBoolean($key) {
        return boolval($this->get($key));
    }

    /**
     * Return value of $items element with $key as integer
     * Return 0 if $items element with $key not found
     *
     * @param mixed $key
     * @return int
     */
    public function getInteger($key) {
        return intval($this->get($key));
    }

    /**
     * Return value of $items element with $key as float
     * Return 0.0 if $items element with $key not found
     *
     * @param mixed $key
     * @return float
     */
    public function getFloat($key) {
        return floatval($this->get($key));
    }

    /**
     * Return value of $items element with $key as string
     * Return '' if $items element with $key not found
     *
     * @param mixed $key
     * @return string
     */
    public function getString($key) {
        return strval($this->get($key));
    }

    /**************************************************************************/

    /**
     * Return value of $items element with $key as trimmed string
     * Return '' if $items element with $key not found
     *
     * @param mixed $key
     * @return string
     */
    public function getStringTrim($key) {
        return trim(strval($this->get($key)));
    }

    /**
     * Return value of $items element with $key as html safe string
     * Return '' if $items element with $key not found
     *
     * @param mixed $key
     * @return string
     */
    public function &getStringSafe($key) {
        $result = strval($this->get($key));
        $result = htmlspecialchars($result);
    //  $result = str_replace(
    //      array('>', '<', '"', '\'', '&'),
    //      array('&gt;', '&lt;', '&quot;', '&#039;', '&amp;'), // '&apos;'
    //      $result
    //  );
        return $result;
    }

    /**
     * Return value of $items element with $key as html safe string
     * Return '' if $items element with $key not found
     *
     * @param mixed $key
     * @return string
     */
    public function &getStringSafe2($key) {
        $result = strval($this->get($key));
        $result = str_replace(
            array('>', '<', '"', '\''),
            array('&gt;', '&lt;', '&quot;', '&#039;'), // '&apos;'
            $result
        );
        return $result;
    }

    /**************************************************************************/

    /**
     * Return value of variable with key $key
     * If $name not found in config then return $value
     * In php > 7.0 use ?: or ??
     *
     * [?] Rename to coalesce
     * @param mixed $key
     * @param mixed $value
     * @return mixed
     */
    public function getCoalesce($key, $value) {
        return $this->has($key) ? $this->get($key) : $value;
    }

    /**************************************************************************/

    /**
     * Remove $items element with $key and return true
     * Return false if $items not initialized and equal null
     *
     * @param mixed $key
     * @return boolean
     */
    public function remove($key) {
    
        if ($this->noActive()) return false;

        unset($this->items[$key]);

        return true;
    }

    /**************************************************************************/

    /**
     * Return $items element with $offset
     * Return null if can't
     *
     * @param int $offset
     * @return mixed|null
     */
//  public function fetch($offset = 1) {
    public function move($offset = 1) {
    
        if ($this->noActive()) return null;

        $item = current($this->items);
        if ($item === false) return null;

        if ($offset == 1) {
            $this->next();
        } else if ($offset == -1) {
            $this->prev();
        }

        return $item;
    }

    /**************************************************************************/

    /**
     * Return $items sorted with help $callback routine
     * Return false if can't
     *
     * @param callable $callback
     * @return mixed[]|boolean
     */
    public function sort($callback) {
    
        if ($this->noActive()) return false;

        return uasort($this->items, $callback);
    }

    /**************************************************************************/

    /**
     * Apply $callback routine to all $items and return a result
     * Return false if can't
     *
     * @param callable $callback
     * @return mixed[]|boolean
     */
    public function apply($callback) {

        if ($this->noActive()) return false;

        return array_walk($this->items, $callback);
    }

    /**************************************************************************/
    // create new array

    /**
     * Reverse $items and return a result as new array
     * Return null if can't
     *
     * @return mixed[]|null
     */
    public function reverse() {

        if ($this->noActive()) return null;

        return array_reverse($this->items, $callback);
    }

    /**************************************************************************/
    // create new array

    /**
     * Filter $items with $callback and return a result as new array
     * Return null if can't
     *
     * @param callable $callback
     * @return mixed[]|null
     */
    public function filter($callback) {

        if ($this->noActive()) return null;

        return array_filter($this->items, $callback);
    }

    /**************************************************************************/

    /**
     * Return value of $items element with key equal $match, null otherwise
     * Case sensitive if $case set to true, default case insensitive
     *
     * @param mixed $match
     * @param boolean $case
     * @return mixed|null
     */
    public function getCase($match, $case = false) {

        if ($this->noActive()) return null;

        foreach ($this->items as $key => &$value) {
            if ($case) {
                if (strcmp($key, $match) == 0) return $value;
            } else {
                if (strcasecmp($key, $match) == 0) return $value;
            }
        }

        return null;
    }

    /**************************************************************************/
    // http://www.pixelcom.crimea.ua/ispolzovanie-spl-iteratory.html
    // IteratorAggregate implementation
    // !!! Also You can use RecursiveArrayIterator($array);

    /**
     * Create and return an ArrayIterator for $items
     *
     * @return ArrayIterator
     */
    public function getIterator() {
        return new \ArrayIterator($this->items);
    }

    /**************************************************************************/
    // http://www.pixelcom.crimea.ua/ispolzovanie-spl-iteratory.html
    // Iterator implementation
    // !!! unused
    // !!! use IteratorAggregate

    /**
     * Return key of current iteration element or null if can't
     *
     * @return mixed
     */
    public function key() {

        if ($this->noActive()) return null;

        list($key, $value) = current($this->items);

        return $key;
    }

    /**
     * Return current iteration element or null if can't
     *
     * @return mixed
     */
    public function valid() {
    
        if ($this->noActive()) return null;

        return current($this->items);
    }

    /**
     * Rewind to start and return first iteration element or null if can't
     *
     * @return mixed
     */
    public function rewind() {

        if ($this->noActive()) return null;

        return reset($this->items);
    }

    /**
     * Return current iteration element or null if can't
     *
     * @return mixed
     */
    public function current() {

        if ($this->noActive()) return null;

        return current($this->items);
    }

    /**
     * Return next iteration element or null if can't
     *
     * @return mixed
     */
    public function next() {

        if ($this->noActive()) return null;

        return next($this->items);
    }

    /**
     * Return previous iteration element or null if can't
     *
     * @return mixed
     */
    public function prev() {

        if ($this->noActive()) return null;

        return prev($this->items);
    }

    /**
     * Return first iteration element or null if can't
     *
     * @return mixed
     */
    public function first() {

        if ($this->noActive()) return null;

        return reset($this->items);
    }

    /**
     * Return last iteration element or null if can't
     *
     * @return mixed
     */
    public function last() {

        if ($this->noActive()) return null;

        return end($this->items);
    }

    /**************************************************************************/
    // ArrayAccess implementation

    /**
     * Return true if $items element with $offset exists, false otherwise
     *
     * @param int $offset
     * @return mixed
     */
    function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    /**
     * Return value of $items element with $offset, null if can't
     *
     * @param int $offset
     * @return mixed
     */
    function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * Set $items element with $offset to $value
     *
     * @param int $offset
     * @return void
     */
    function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    /**
     * Unset $items element with $offset
     *
     * @param int $offset
     * @return void
     */
    function offsetUnset($offset) {
         unset($this->items[$offset]);
    }

    /**************************************************************************/
}

/******************************************************************************/