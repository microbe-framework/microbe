<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.1
 *    Module: Params.class.php
 *     Class: Params
 *     About: Params collection
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

    /**
     * Decorate from both sides string $name use $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_PERCENT
     * Return a result
     * Same as Strings::decorate
     * @param string $name
     * @param int $style
     * @return string
     */
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

    /**
     * Replace decorated parameters in string $var with their values
     * Takes name/value pair from array $items
     * Used decoration styles:
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_PERCENT
     * Return a result
     * @param string $var
     * @param int $style
     * @return string
     */
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

    /**
     * Replace decorated parameters in string $var with their values
     * Performs this action if element is array too
     * Takes name/value pair from array $items
     * Used decoration styles:
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_PERCENT
     * Return a result
     * @param string $var
     * @param int $style
     * @return string
     */
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

    /**
     * Check if $value first letter is parameter's separator = or :
     * @param string $value
     * @return string
     */
    protected static function _isseparator($value)
    {
        if (!is_string($value))
            return false;

        $l = strlen($value);
        if ($l < 1)
            return false;

        $q = $value[0];
        if (($q != '=') && ($q != ':'))
            return false;

        return $q;
    }
    
    /**
     * If first letter of $value is parameter's separator (=) or (:) remove it
     * Then trim blank spaces from left
     * Return a result
     * @param string $value
     * @return string
     */
    protected static function _unseparate($value) {
        return ltrim(substr($value, 1));
    }

    /**
     * Check if $value is quoted with single or double quotes
     * Return used quotes character or false if $value not quoted
     * @param string $value
     * @return char|boolean
     */
    protected static function _isquoted($value)
    {
        if (!is_string($value))
            return false;

        $l = strlen($value);
        if ($l < 2)
            return false;

        $q = $value[0];
        if (($q != '\'') && ($q != '"'))
            return false;

        if ($value[$l - 1] != $q)
            return false;

        return $q;
    }

    /**
     * If string $value is quoted unquote it
     * Return a result
     * @param string $value
     * @return string
     */
    protected static function _unquote($value) {
        return substr($value, 1, -1);
    }

    /**************************************************************************/

    /**
     * Parse lines from $buffer to name/value parameters
     * Substitute parameter values using $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_NONE
     * Store result to Params instance $items
     * Same as Strings::decorate
     * @param string $buffer
     * @param int $style
     * @return void
     */
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
            if (preg_match('/^([A-Za-z_]+[A-Za-z0-9_.]*).*$/', $line, $matches)) {
        //  if (preg_match('/^([A-Za-z_]+((\.[A-Za-z0-9_]+)|([A-Za-z0-9_]*))).*$/', $line, $matches)) {
                $name = $matches[1];
            //  echo $name.'<br>';
                $value = trim(substr($line, strlen($name)));
                if ($q = self::_isseparator($value)) {
                //  $value = trim(substr($line, 1));                
                //  $value = ltrim(substr($line, 1));                
                    $value = self::_unseparate($value);
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

    /**
     * Parse lines from file $path to name/value parameters
     * Substitute parameter values using $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_NONE
     * Store result to Params instance $items
     * Same as Strings::decorate
     * @param string $buffer
     * @param int $style
     * @return void
     */
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

    /**
     * Parse json file $path to name/value parameters
     * Substitute parameter values using $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_NONE
     * Store result to Params instance $items
     * Same as Strings::decorate
     * @param string $buffer
     * @param int $style
     * @return void
     */
    public function loadFromJson(
        $path,
        $style = self::PARAM_STYLE_NONE
    )
    {
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $json = Strings::removeComments($json);
            $this->items = json_decode($json, TRUE);
        }
    }

    /**************************************************************************/

    /**
     * Parse lines from file or from json file $path to name/value parameters
     * Autodetect json file by extension 'json'
     * Substitute parameter values using $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_NONE
     * Store result to Params instance $items
     * Same as Strings::decorate
     * @param string $buffer
     * @param int $style
     * @return void
     */
    public function loadFromFileEx(
        $path,
        $style = self::PARAM_STYLE_NONE
    )
    {
        if (!file_exists($path))
            return;

        if (Strings::isRMatch($this->config, ".json")) {
            $this->loadFromJson($this->config);
        } else {
            $this->loadFromFile($this->config, $style);
        }
    }

    /**************************************************************************/
}

/******************************************************************************/