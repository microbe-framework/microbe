<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Collection.class.php
 *     Class: Collection
 *     About: Collection is php build-in array object wrapper
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/microbe-0.1.0/
 ******************************************************************************/

/******************************************************************************
 *            This file is part of the Microbe PHP Framework.                 *
 *                                                                            *
 *         Copyright (c) 2017-2018 Microbe PHP Framework author               *
 *                  <microbe-framework@protonmail.com>                        *
 *                                                                            *
 *            For the full copyright and license information,                 *
 *                     please view the LICENSE file                           *
 *              that was distributed with this source code.                   *
 ******************************************************************************/

class Collection implements ArrayAccess, IteratorAggregate
{
    /**************************************************************************/

    public $items = array();

    /**************************************************************************/

    public function isActive() {
        return is_array($this->items);
    }

    public function noActive() {
        return $this->isActive() == false;
    }

    /**************************************************************************/

    public function isEmpty() {
        return is_array($this->items) == false || count($this->items) == 0;
    }

    public function noEmpty() {
        return $this->isEmpty() == false;
    }

    /**************************************************************************/
    // !!! required for implements ArrayAccess

    public function set($key, $value) {
    
        if ($this->noActive()) return false;

        if (isset($this->items[$key]) == true) {
        //  throw new Exception('Unable to set var `' . $key . '`. Already set.');
            return false;
        }

        $this->items[$key] = $value;

        return true;
    }

    public function get($key) {
    
        if ($this->noActive()) return null;
        
    //  if (!array_key_exists($key, $this->items)) return null;
        if (isset($this->items[$key]) == false) return null;

        return $this->items[$key];
    }

    /**************************************************************************/

    public function getInteger($key) {
        return intval($this->get($key));
    }

    public function getFloat($key) {
        return floatval($this->get($key));
    }

    public function getString($key) {
        return strval($this->get($key));
    }

    /**************************************************************************/

    public function getItems() {
        return $this->items;
    }

    public function getCount() {
        return Base::getCount($this->items);
    }

    /**************************************************************************/

    public function remove($key) {
    
        if ($this->noActive()) return false;

        unset($this->items[$key]);

        return true;
    }

    /**************************************************************************/

    public function fetch($offset = 1) {
    
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

    public function sort($callback) {
    
        if ($this->noActive()) return false;

        return uasort($this->items, $callback);
    }

    /**************************************************************************/

    public function apply($callback) {

        if ($this->noActive()) return false;

        return array_walk($this->items, $callback);
    }

    /**************************************************************************/
    // create new array

    public function reverse() {

        if ($this->noActive()) return null;

        return array_reverse($this->items, $callback);
    }

    /**************************************************************************/
    // create new array

    public function filter($callback) {

        if ($this->noActive()) return null;

        return array_filter($this->items, $callback);
    }

    /**************************************************************************/

    public function getCase($match, $case = false) {

        if ($this->noActive()) return null;

        foreach ($this->items as $key => $value) {
            if ($case) {
                if (strcmp($key, $match) == 0) return $item;
            } else {
                if (strcasecmp($key, $match) == 0) return $item;
            }
        }

        return null;
    }

    /**************************************************************************/
    // http://www.pixelcom.crimea.ua/ispolzovanie-spl-iteratory.html
    // IteratorAggregate implementation
    // !!! Also You can use RecursiveArrayIterator($array);

    public function getIterator() {
        return new ArrayIterator($this->items);
    }

    /**************************************************************************/
    // http://www.pixelcom.crimea.ua/ispolzovanie-spl-iteratory.html
    // Iterator implementation
    // !!! unused
    // !!! use IteratorAggregate

    public function key() {

        if ($this->noActive()) return null;

        list($key, $value) = current($this->items);

        return $key;
    }

    public function valid() {
    
        if ($this->noActive()) return null;

        return current($this->items);
    }

    public function rewind() {

        if ($this->noActive()) return null;

        return reset($this->items);
    }

    public function current() {

        if ($this->noActive()) return null;

        return current($this->items);
    }

    public function next() {

        if ($this->noActive()) return null;

        return next($this->items);
    }

    public function prev() {

        if ($this->noActive()) return null;

        return prev($this->items);
    }

    public function first() {

        if ($this->noActive()) return null;

        return reset($this->items);
    }

    public function last() {

        if ($this->noActive()) return null;

        return end($this->items);
    }

    /**************************************************************************/
    // ArrayAccess implementation

    function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    function offsetGet($offset) {
        return $this->get($offset);
    }

    function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    function offsetUnset($offset) {
         unset($this->items[$offset]);
    }

    /**************************************************************************/
}

/******************************************************************************/