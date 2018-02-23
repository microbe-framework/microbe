<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Params.class.php
 *     Class: Params
 *     About: Params collection
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

class Params extends Collection
{
    /**************************************************************************/
    // Parameters substitution
    /**************************************************************************/
    
    const PARAM_STYLE_NONE              = 0;
    const PARAM_STYLE_NOTHING           = 0;
    const PARAM_STYLE_PERCENT           = 1; // %name%
    const PARAM_STYLE_PHP               = 2; // ${name}
    const PARAM_STYLE_JS                = 3; // {{name}}
    const PARAM_STYLE_DEFAULT           = self::PARAM_STYLE_PERCENT;

    public static function decorate($name, $style = self::PARAM_STYLE_DEFAULT)
    {
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

    public static function replace($var, $style = self::PARAM_STYLE_DEFAULT)
    {
        if (!is_string($var)) return null;

        if ($style != self::PARAM_STYLE_NONE) {
            while (list($name, $value) = each($this->items)) {
                $name = self::decorate($name, $style);
                $var = str_replace($name, $value, $var);
            }
        }

        return $var;
    }

    public function replaceAll(&$var, $style = self::PARAM_STYLE_DEFAULT)
    {
        if (!is_array($var)) {
            $var = $this->replace($var, $style);
        } else {
            foreach ($var as &$v)
                $this->replaceAll($var, $style);
        }
    }

    /**************************************************************************/
    // Load
    /**************************************************************************/

    protected static function _isseparator($value)
    {
        if (!is_string($value))
            return false;

        $l = strlen($value);
        if ($l < 1)
            return false;

        $q = $value[0];
        if (($q != '=') || ($q != ':'))
            return false;

        return $q;
    }
    
    protected static function _unseparate($value) {
        return ltrim(substr($value, 1));
    }

    protected static function _isquoted($value)
    {
        if (!is_string($value))
            return false;

        $l = strlen($value);
        if ($l < 2)
            return false;

        $q = $value[0];
        if (($q != '\'') || ($q != '"'))
            return false;

        if ($value[$l - 1] != $q)
            return false;

        return $q;
    }

    protected static function _unquote($value) {
        return substr($value, 1, -1);
    }

    /**************************************************************************/

    public function loadFromBuffer(
        $buffer,
        $style = self::PARAM_STYLE_NONE
    )
    {
        $lines = explode(PHP_EOL, $buffer);

        foreach ($lines as $line) {
        
            $line = trim($line);

            // Skip empty lines
            if (empty($line))
                continue;

            // Skip comments
            if ($line[0] == '#')
                continue;

            if (preg_match('/^([A-Za-z_]?[A-Za-z0-9_]+).*$/', $line, $matches)) {
                $name = $matches[1];
                $value = trim(substr($line, strlen($name)));
                if ($q = self::_isseparator($value)) {
                //  $value = trim(substr($line, 1));                
                //  $value = ltrim(substr($line, 1));                
                    $value = _unseparate($value);
                }
                if ($q = self::_isquoted($value)) {
                    $value = self::_unquote($value);
                }
                if (($style != self::PARAM_STYLE_NONE) && ($q != '\'')) {
                    $value = $this->replace($value, $style);
                }
                $this->set($name, $value);
            }
        }
    }

    /**************************************************************************/

    public function loadFromFile(
        $path,
        $style = self::PARAM_STYLE_NONE
    )
    {
        if (file_exists($path)) {
            $buffer = file_get_contents($path);
            $this->loadFromBuffer($buffer, $style);
        }
    }

    /**************************************************************************/
}

/******************************************************************************/