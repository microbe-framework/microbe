<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Types.class.php
 *     Class: Types
 *     About: Basic types conversions routines
 *     Begin: 2019/03/14
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

class Types
{
    /**************************************************************************/
    // Type-strong empty values checking
    /**************************************************************************/    

    /**
     * Return true if $var is boolean and false, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyBoolean($var) {
        return is_bool($var) && empty($var);
    }

    /**
     * Return true if $var is integer and equal to 0, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyInteger($var) {
        return is_integer($var) && empty($var);
    }

    /**
     * Return true if $var is float and equal to 0.0, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyFloat($var) {
        return is_float($var) && empty($var);
    }

    /**
     * Return true if $var is numeric and equal to 0, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyNumeric($var) {
        return is_numeric($var) && empty($var);
    }

    /**
     * Return true if $var is string and empty, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyString($var) {
        return is_string($var) && empty($var);
    }

    /**
     * Return true if $var is array and empty, false otherwise
     * @param mixed
     * @return boolean
     */
    public static function emptyArray($var) {
        return is_array($var) && empty($var);
    }

    /**************************************************************************/
    // Nonsensical type check routines    
    /**************************************************************************/    

    /**
     * Return true if $var is an integer
     * Must have value between $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function isInteger($var, $min = false, $max = false) {
        if (!is_int($var)) return false;

        if ($min !== false && $var < $min) return false;
        if ($max !== false && $var > $max) return false;

        return true;
    }

    /**
     * Return false if $var not an integer
     * Must have value outside the interval $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function noInteger($var, $min = false, $max = false) {
        return self::isInteger($var, $min, $max) === false;
    }

    /**************************************************************************/

    /**
     * Return true if $var is a float
     * Must have value between $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min float|boolean
     * @param $max float|boolean
     * @return boolean
     */
    public static function isFloat($var, $min = false, $max = false) {
        if (!is_float($var)) return false;

        if ($min !== false && $var < $min) return false;
        if ($max !== false && $var > $max) return false;

        return true;
    }

    /**
     * Return true if $var not a float
     * Must have value outside the interval $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min float|boolean
     * @param $max float|boolean
     * @return boolean
     */
    public static function noFloat($var, $min = false, $max = false) {
        return self::isFloat($var, $min, $max) === false;
    }

    /**************************************************************************/

    /**
     * Return true if $var is numeric
     * Must have value between $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function isNumeric($var, $min = false, $max = false) {
        if (!is_numeric($var)) return false;

        if ($min !== false && $var < $min) return false;
        if ($max !== false && $var > $max) return false;

        return true;
    }

    /**
     * Return true if $var not a numeric
     * Must have value outside the interval $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|float|boolean
     * @param $max int|float|boolean
     * @return boolean
     */
    public static function noNumeric($var, $min = false, $max = false) {
        return self::isNumeric($var, $min, $max) === false;
    }

    /**************************************************************************/

    /**
     * Return true if $var is a string
     * Must have length between $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function isString($var, $min = false, $max = false) {
        if (!is_string($var)) return false;

        $length = strlen($var);
        if ($min !== false && $length < $min) return false;
        if ($max !== false && $length > $max) return false;

        return true;
    }

    /**
     * Return true if $var not a string
     * Must have length outside the interval $min and $max if they are defined
     * Return false otherwise
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function noString($var, $min = false, $max = false) {
        return self::isString($var, $min, $max) === false;
    }

    /**************************************************************************/

    /**
     * Return true if $var is an array
     * Must have number of elements between $min and $max if they are defined
     * Return false otherwise
     * @param mixed[] $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function isArray($var, $min = false, $max = false) {
        if (!is_array($var)) return false;

        $count = count($var);
        if ($min !== false && $count < $min) return false;
        if ($max !== false && $count > $max) return false;

        return true;
    }

    /**
     * Return true if $var not an array
     * Must have number of elements outside the interval $min and $max if they are defined
     * Return false otherwise
     * @param mixed[] $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return boolean
     */
    public static function noArray($var, $min = false, $max = false) {
        return self::isArray($var, $min, $max) === false;
    }

    /**************************************************************************/

    /**
     * Return true if $var is function or existing function name string
     * Return false otherwise
     * @param mixed $var
     * @return boolean
     */
    public static function isFunction($var) {
      return
          (is_string($var) && function_exists($var))
          ||
          (is_object($var) && ($var instanceof Closure));
    }

    /**
     * Return true if $var not a function
     * Return false otherwise
     * @param mixed $var
     * @return boolean
     */
    public static function noFunction($var) {
        return self::isFunction($var) === false;
    }

    /**************************************************************************/
    // Nonsensical type conversion routines
    /**************************************************************************/    

    /**
     * Convert $var to boolean
     * @param mixed $var
     * @return boolean
     */
    public static function toBoolean($var) {
        return (bool)(is_bool($var) ? $var : is_scalar($var) ? $var : false);
    }

    /**************************************************************************/

    /**
     * Convert $var to integer
     * Bounds a result between $min and $max if they are defined
     * @param mixed $var
     * @param $min int|boolean
     * @param $max int|boolean
     * @return int
     */
    public static function toInteger($var, $min = false, $max = false) {
        $var = is_int($var) ? $var : (int)(is_scalar($var) ? $var : 0);
        if ($min !== false && $var < $min)
            return $min;
        elseif ($max !== false && $var > $max)
            return $max;
        return $var;
    }

    /**************************************************************************/

    /**
     * Convert $var to float
     * Bounds a result between $min and $max if they are defined
     * @param mixed $var
     * @param $min float|boolean
     * @param $max float|boolean
     * @return float
     */
    public static function toFloat($var, $min = false, $max = false) {
        $var = is_float($var) ? $var : (float)(is_scalar($var) ? $var : 0);
        if ($min !== false && $var < $min)
            return $min;
        elseif ($max !== false && $var > $max)
            return $max;
        return $var;
    }

    /**************************************************************************/

    /**
     * Convert $var to string
     * If $length defined, truncute a result
     * @param mixed $var
     * @param int|boolean $length
     * @return int
     */
    public static function toString($var, $length = false) {
        if ($length !== false && is_int($length) && $length > 0)
            return substr(trim(
                is_string($var) ? $var : (is_scalar($var) ? $var : '')),
                0,
                $length
            );
        return trim(is_string($var) ? $var : (is_scalar($var) ? $var : ''));
    }

    /**************************************************************************/

    /**
     * Convert $var to array
     * @param mixed $var
     * @return mixed[]
     */
    public static function toArray($var) {
        return is_array($var)
            ? $var
            : (is_scalar($var) && $var)
            ? array($var)
            : is_object($var) ? (array)$var : array();
    }

    /**************************************************************************/

    /**
     * Convert $var to object
     * @param mixed $var
     * @return object
     */
    public static function toObject($var) {
        return is_object($var)
            ? $var
            : (is_scalar($var) && $var)
            ? (object)$var
            : is_array($var) ? (object)$var : (object)null;
    }

    /**************************************************************************/
}

/******************************************************************************/