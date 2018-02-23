<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Base.class.php
 *     Class: Base
 *     About: Basic routines
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license 
 *    Source: https://github.com/microbe-framework/0.1/
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
 
/******************************************************************************/

class Base
{
    /**************************************************************************/
    // Type-strong empty values checking
    /**************************************************************************/    

    public static function emptyBoolean($var) {
        return is_bool($var) && empty($var);
    }

    public static function emptyInteger($var) {
        return is_integer($var) && empty($var);
    }

    public static function emptyFloat($var) {
        return is_float($var) && empty($var);
    }

    public static function emptyNumeric($var) {
        return is_numeric($var) && empty($var);
    }

    public static function emptyString($var) {
        return is_string($var) && empty($var);
    }

    public static function emptyArray($var) {
        return is_array($var) && empty($var);
    }

    /**************************************************************************/
    // Nonsensical type check routines    
    /**************************************************************************/    

    public static function isInteger($var, $min = FALSE, $max = FALSE)
    {
        if (!is_int($var)) return FALSE;

        if ($min !== FALSE && $var < $min) return FALSE;
        if ($max !== FALSE && $var > $max) return FALSE;

        return TRUE;
    }

    public static function noInteger($var, $min = FALSE, $max = FALSE)
    {
        return self::isInteger($var, $min, $max) == FALSE;
    }

    /**************************************************************************/

    public static function isFloat($var, $min = FALSE, $max = FALSE)
    {
        if (!is_float($var)) return FALSE;

        if ($min !== FALSE && $var < $min) return FALSE;
        if ($max !== FALSE && $var > $max) return FALSE;

        return TRUE;
    }

    public static function noFloat($var, $min = FALSE, $max = FALSE)
    {
        return self::isFloat($var, $min, $max) == FALSE;
    }

    /**************************************************************************/

    public static function isNumeric($var, $min = FALSE, $max = FALSE)
    {
        if (!is_numeric($var)) return FALSE;

        if ($min !== FALSE && $var < $min) return FALSE;
        if ($max !== FALSE && $var > $max) return FALSE;

        return TRUE;
    }

    public static function noNumeric($var, $min = FALSE, $max = FALSE)
    {
        return self::isNumeric($var, $min, $max) == FALSE;
    }

    /**************************************************************************/

    public static function isString($var, $min = FALSE, $max = FALSE)
    {
        if (!is_string($var)) return FALSE;

        $length = strlen($var);
        if ($min !== FALSE && $length < $min) return FALSE;
        if ($max !== FALSE && $length > $max) return FALSE;

        return TRUE;
    }

    public static function noString($var, $min = FALSE, $max = FALSE)
    {
        return self::isString($var, $min, $max) == FALSE;
    }

    /**************************************************************************/

    public static function isArray($var, $min = FALSE, $max = FALSE)
    {
        if (!is_array($var)) return FALSE;

        $count = count($var);
        if ($min !== FALSE && $count < $min) return FALSE;
        if ($max !== FALSE && $count > $max) return FALSE;

        return TRUE;
    }

    public static function noArray($var, $min = FALSE, $max = FALSE)
    {
        return self::isArray($var, $min, $max) == FALSE;
    }

    /**************************************************************************/

    public static function isFunction($var) {
      return
          (is_string($var) && function_exists($var))
          ||
          (is_object($var) && ($var instanceof Closure));
    }

    public static function noFunction($var)
    {
        return self::isFunction($var) == FALSE;
    }

    /**************************************************************************/
    // Nonsensical type conversion routines
    /**************************************************************************/    

    public static function toBoolean($var)
    {
        return (bool)(is_bool($var) ? $var : is_scalar($var) ? $var : FALSE);
    }

    /**************************************************************************/

    public static function toInteger($var, $min = FALSE, $max = FALSE)
    {
        $var = is_int($var) ? $var : (int)(is_scalar($var) ? $var : 0);
        if ($min !== FALSE && $var < $min)
            return $min;
        elseif ($max !== FALSE && $var > $max)
            return $max;
        return $var;
    }

    /**************************************************************************/

    public static function toFloat($var, $min = FALSE, $max = FALSE)
    {
        $var = is_float($var) ? $var : (float)(is_scalar($var) ? $var : 0);
        if ($min !== FALSE && $var < $min)
            return $min;
        elseif ($max !== FALSE && $var > $max)
            return $max;
        return $var;
    }

    /**************************************************************************/

    public static function toString($var, $length = FALSE)
    {
        if ($length !== FALSE && is_int($length) && $length > 0)
            return substr(trim(is_string($var)
            ? $var
            : (is_scalar($var) ? $var : "")), 0, $length);
        return trim(
            is_string($var)
            ? $var
            : (is_scalar($var) ? $var : ""));
    }

    /**************************************************************************/

    public static function toArray($var)
    {
        return is_array($var)
            ? $var
            : (is_scalar($var) && $var)
            ? array($var)
            : is_object($var) ? (array)$var : array();
    }

    /**************************************************************************/

    public static function toObject($var)
    {
        return is_object($var)
            ? $var
            : (is_scalar($var) && $var)
            ? (object)$var
            : is_array($var) ? (object)$var : (object)NULL;
    }

    /**************************************************************************/
    // Arrays
    /**************************************************************************/

    public static function has($vars, $key) {
        return (is_array($vars) && isset($vars[$key]));
    }

    public static function get($vars, $key) {
        return self::has($vars, $key) ? $vars[$key] : null;
    }

    public static function set($vars, $key, $value) {
        return $vars[$key] = $value;
    }
    
    public static function count($vars) {
        return is_array($vars) ? count($vars) : 0;
    }

    /**************************************************************************/

    public static function getValue($vars, $key) {
        return self::has($vars, $key) ? $vars[$key] : null;
    }

    public static function getString($vars, $key) {
        return self::has($vars, $key) ? strval($vars[$key]) : '';
    }

    public static function getBoolean($vars, $key) {
        // boolval: PHP 5 >= 5.5.0, PHP 7
    //  return self::has($vars, $key) ? boolval($vars[$key]) : false;
        return self::has($vars, $key) ? (intval($vars[$key]) != 0) : false;
    }

    public static function getInteger($vars, $key) {
        return self::has($vars, $key) ? intval($vars[$key]) : 0;
    }

    public static function getFloat($vars, $key) {
        return self::has($vars, $key) ? floatval($vars[$key]) : 0.0;
    }

    /**************************************************************************/
    // Walk an array and call a function    
    // !!! Just equal array_walk

    public function apply(&$vars, $function) {

        if (!is_callable($function)) return;
    //  if (!is_object($vars)) return;
    //  if (!is_array($vars)) return;

        foreach ($vars as &$var)
            $function($var);
    }

    /**************************************************************************/
    // Walk a tree and call a function

    public function tree(&$vars, $function) {

        if (!is_callable($function)) return;
    //  if (!is_object($vars)) return;
    //  if (!is_array($vars)) return;

        foreach ($vars as &$var) {
            if (is_array($var) == false) {
                $var = $function($var);
            } else {
                self::tree($var, $function);
            }
        }
    }

    /**************************************************************************/
    // Parameters substitution
    /**************************************************************************/
    
    const PARAM_STYLE_NONE              = 0;
    const PARAM_STYLE_NOTHING           = 0;
    const PARAM_STYLE_PERCENT           = 1; // %name%
    const PARAM_STYLE_PHP               = 2; // ${name}
    const PARAM_STYLE_JS                = 3; // {{name}}
    const PARAM_STYLE_DEFAULT           = self::PARAM_STYLE_PERCENT;

    public static function decorate($name, $style = self::PARAM_STYLE_DEFAULT) {
        switch ($style) {
            case self::PARAM_STYLE_PERCENT: {
                $name = '%'.$name.'%';
                 break;
            }                
            case self::PARAM_STYLE_PHP: {
                $name = '${'.$name.'}';
                break;
            }
            case self::PARAM_STYLE_JS: {
                $name = '{{'.$name.'}}';
                break;                    
            }
        }
        return $name;            
    }

    public static function setParams(
        $var,
        $params,
        $style = self::PARAM_STYLE_DEFAULT
    ) {
        if (!is_string($var)) return null;

        if ($style != self::PARAM_STYLE_NONE) {
            while (list($name, $value) = each($params)) {
                $name = self::decorate($name, $style);
                $var = str_replace($name, $value, $var);
            }
        }

        return $var;
    }

    /**************************************************************************/
}

/******************************************************************************/