<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Strings.php
 *     Class: Strings
 *     About: Strings routines
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

class Strings
{
    /**************************************************************************/
    // Safe string first and last character checker
    // $match is character

    /**
     * Return true if string $var begins with character $match and false otherwise
     *
     * @param string $var
     * @param char $match
     * @return boolean
     */
    public static function firstIs(&$var, $match) {
        return is_string($var) && (strlen($var) > 0) && ($var[0] == $match);
    }

    /**
     * Return true if string $var ends with character $match and false otherwise
     *
     * @param string $var
     * @param char $match
     * @return boolean
     */
    public static function lastIs(&$var, $match) {
        return is_string($var) && (strlen($var) > 0) && ($var[strlen($var) - 1] == $match);
    }

    /**************************************************************************/
    // Safe match string routines

    /**
     * Return true if string $var begins with string $match and false otherwise
     *
     * @param string $var
     * @param string $match
     * @return boolean
     */
    public static function isMatch(&$var, $match) {
        if (!is_string($var) || !is_string($match))
            return false;

        $varLength = strlen($var);
        $matchLength = strlen($match);
        return ($varLength >= $matchLength)
            &&
            (strncmp($var, $match, $matchLength) === 0);
    }

    /**
     * Return true if string $var begins with string $match and false otherwise
     * This checking routine ignore letter case
     *
     * @param string $var
     * @param string $match
     * @return boolean
     */
    public static function isIMatch(&$var, $match) {
        if (!is_string($var) || !is_string($match))
            return false;

        $varLength = strlen($var);
        $matchLength = strlen($match);
        return ($varLength >= $matchLength)
            &&
        //  (strncasecmp(strtolower($var), strtolower($match), $matchLength) === 0);
            (strncasecmp($var, $match, $matchLength) === 0);
    }

    /**
     * Return true if string $var ends with string $match and false otherwise
     *
     * @param string $var
     * @param string $match
     * @return boolean
     */
    public static function isRMatch(&$var, $match) {
        if (!is_string($var) || !is_string($match))
            return false;

        $varLength = strlen($var);
        $matchLength = strlen($match);
        return ($varLength >= $matchLength)
            &&
            (substr_compare($var, $match, $varLength - $matchLength, $matchLength) === 0);
    }

    /**************************************************************************/
    // Search and remove C-style comments like /* */ and //
    
    /**
     * Search and remove C-style comments from string $var
     *
     * @param string $var
     * @return string
     */
    public static function removeComments(&$var) {
        return preg_replace(
            "#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#",
            '',
            $var
        );
    }

    /**************************************************************************/

    /**
     * Return a file extension
     *
     * @param string $var
     * @return string
     */
    public static function getExtension(&$var) {
        return preg_replace("/.*?\./", '', $var);
    }

    /**************************************************************************/
    // Checkers

    /**
     * Return true if string $var is correct email and false otherwise
     *
     * @param string $var
     * @return boolean
     */
    public static function checkMail(&$var) {
        return preg_match("/[^(\w)|(\@)|(\.)|(\-)]/", $var);
    }

    /**
     * Return true if string $var is correct filename and false otherwise
     *
     * @param string $var
     * @return boolean
     */
    public static function checkFilename(&$var) {
        return preg_match("/(^[a-zA-Z\_0-9]+([a-zA-Z\_0-9\.-]*))$/", $var);
    }

    /**************************************************************************/

    /**
     * Remove carriage return (\r) symbols from string $var
     * Make linux-style end of lines with line feed (\n) only
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function validateLines(&$var) {
        return str_replace("\r", '', $var);
    }
  
    /**
     * Reduce count of repeating spaces to one space in string $var
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function validateSpaces(&$var) {
        return str_replace('  ', ' ', $var);
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

    /**
     * Decorate from both sides string $name use $style
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_PERCENT
     * Return a result
     * Same as Params::decorate
     *
     * [?] rename to: embrace, ...
     * @param string $name
     * @param int $style
     * @return string
     */
    public static function decorate(
        $name,
        $style = self::PARAM_STYLE_DEFAULT
    ) {
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
     * Replace decorated parameters with their values
     * Takes name/value pair from array $params
     * Used decoration styles:
     * - PARAM_STYLE_PERCENT           %name%
     * - PARAM_STYLE_PHP               ${name}
     * - PARAM_STYLE_JS                {{name}}
     * Default style is PARAM_STYLE_PERCENT
     * Return a result
     *
     * [!] Same as Params::replace
     * @param string $var
     * @param mixed[] $params
     * @param int $style
     * @return string
     */
    public static function setParams(
        $var,
        &$params,
        $style = self::PARAM_STYLE_DEFAULT
    ) {
        if (!is_string($var))
            return null;

        if ($style != self::PARAM_STYLE_NONE) {
        //  while (list($name, $value) = each($params)) {
            foreach ($params as $name => &$value) {
                $name = self::decorate($name, $style);
                $var = str_replace($name, $value, $var);
            }
        }

        return $var;
    }

    /*************************************************************************/

//  public static function unquote($var) {
//      if (preg_match("/^\".*\"$/", $var) || preg_match("/^'.*'$/", $var)) {
//          return mb_substr($var, 1, mb_strlen($var) - 2);
//      }
//      return $var;
//  }

    // Added 2017/09/23
    // Faster then obsolete version of unquote
    /**
     * Trims single (') and double (") quotes from both sides of string $vars
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function unquote(&$var) {
        if (!is_string($var))
            return '';

        $len = mb_strlen($var);

        if ($len < 2)
            return $var;
      
        $c1 = $var[0];
        $c2 = $var[$len-1];
    
        if ((($c1 === '"') || ($c1 === '\'')) && ($c1 === $c2) ) {
            return mb_substr($var, 1, $len-2);
        }
    
        return $var;
    }

    /**************************************************************************/

    /**
     * Truncate string $vars to $count letters
     * Appends $appendix when length of string greater then $count
     * Return a result
     *
     * @param string $var
     * @param int $count
     * @param string $appendix
     * @return string
     */
    public static function trunc(&$var, $count, $appendix = '...') {
        if (!is_string($var))
            return null;

        $result = mb_substr($var, 0, $count);
        if (strlen($var) > $count) {
            $result .= $appendix;
        }
        return $result;
    }

    /**************************************************************************/

    /**
     * Truncate string $var by first occurence of string $match
     * For first paragraph extraction use $match = '\r'
     * Then truncate remainder by $limit if $limit is set
     * If string was trancated by $limit appends '...'
     * Return a result string
     *
     * @param string $var
     * @param string $match
     * @param int $limit By default set to 0
     * @return string
     */
    public static function getParagraph(&$var, $match, $limit = 0) {

        $result = '';
        $length = mb_strpos($var, $match);
        $isMatch = ($length != FALSE);

        if ($isMatch == FALSE)
            $length = mb_strlen($var);

        $isLimit = (($limit) && ($length > $limit));
    
        if ($isLimit || $isMatch) {
            $result = mb_substr($var, 0, $isLimit ? $limit : $length);
            if ($isLimit) {
                $result .= '...';
            }
        } else {
            $result = $var;
        }

        return $result;
    }

    /**************************************************************************/

    /**
     * Replace html special chars in $var
     * - & (ampersand)     &amp;
     * - " (double quote)  &quot;, unless ENT_NOQUOTES is set
     * - ' (single quote)  &#039;
     *     (for ENT_HTML401) or &apos;
     *     (for ENT_XML1, ENT_XHTML or ENT_HTML5),
     *     but only when ENT_QUOTES is set
     * - < (less than)     &lt;
     * - > (greater than)  &gt;
     * Return a result
     *
     * @param string $key
     * @return string
     */
    public static function safe(&$var) {
        return htmlspecialchars($var);
    }

    /**
     * Replace html special chars in $var without ampersand:
     * - " (double quote)  &quot;
     * - ' (single quote)  &#039;
     * - < (less than)     &lt;
     * - > (greater than)  &gt;
     *
     * Return a result
     * @param string $key
     * @return string
     */
    public static function safe2(&$var) {
        return str_replace(
            array('>', '<', '"', '\''),
            array('&gt;', '&lt;', '&quot;', '&#039;'), // '&apos;'
            $var
        );
    }

    /**************************************************************************/

    /**
     * Replace single (') and double (") quotes in $var to &laquo; &raquo; («»)
     * Then replace html special chars
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function validateQuotes(&$var) {
        $var = self::utf8_safe_quotes($var);
        return htmlspecialchars($var);
    }

    /**************************************************************************/
 
    /**
     * Replace single (') and double (") quotes in $var to &laquo; &raquo; («»)
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function utf8_safe_quotes(&$var) {

        $result = '';
        $l = strlen($var);
  
        $q = 0;
        $level = 0;
        $levels = array();

        for ($i = 0; $i < $l; $i++) {
            $c = $var[$i];
            if ($c == "\"" || $c == "'") {
                if (($level != 0) && ($levels[$level-1] === $c)) {
            //  if ($q === $c) {
                //  echo 'c='.$c.' == q='.$q.'<br>';
                    $q = 0;
                    if ($level) $level--;
                    $c = "\u{00BB}"; // » &raquo; &#171;
                } else {
                //  echo 'c='.$c.' != q='.$q.'<br>';
                    $q = $c;
                    $levels[$level++] = $c;
                    $c = "\u{00AB}"; // « &laquo; &#171;
                }
            }
            $result .= $c;
        }

        return $result;
    }

    /**************************************************************************/

    /**
     * Convert string $var to html
     * Return a result
     *
     * [?] use str_replace or preg_replace
     * @param string $var
     * @return string
     */
    public static function toHtml(&$var) {
        $l = strlen($var);
        $result = '';

        for ($i = 0; $i < $l; $i++) {
            $c = $var[$i];
            $d = ord($c);

            if ($d == 0x20) {
                if ($a == ' ') {
                    $a = '&nbsp;';
                } else {
                    $a = ' ';
                }
            } else if ($d == 0x09) {
                $a = '&nbsp;&nbsp;&nbsp;&nbsp;';
            } else if ($d == 0x0D) {
                $a = '<br>';
            } else if ($d == 0x0A) {
                if ($a == '<br>') $a = '';
            } else if ($d == 0x22 || $d == 0x27 || $d == 0x60) {
            //  || $d == 0x84 || $d == 0x91 || $d == 0x92 || $d == 0x93 || $d == 0x94 
            //  || $d == 0xab || $d == 0xbb || $d == 0xb4)
                $a = '"';
            } else {
                $a = $c;
            }
                $result .= $a;
            //  echo $c.'=>'.$d.'=>'.$a.'<br>';
        }
    //  if (strlen($a)) $result .= $a;

        return $result;
    }

    /**************************************************************************/
    // bbcode

    /**
     * Convert string $var to bbcode
     * Return a result
     *
     * @param string $var
     * @return string
     */
    public static function bbcode(&$var) {

        $result = $var;

        // Media Extensions
        $result = str_replace('[amp]', '&', $result);
        $result = preg_replace('/\[amp=(.*?)\]/', '&${1};', $result);
      
        // Basic
        $result = str_replace('[b]', '<span style="font-weight: bold;">', $result);
        $result = str_replace('[/b]', '</span>', $result);
      
        $result = str_replace('[i]', '<span style="font-style: italic;">', $result);
        $result = str_replace('[/i]', '</span>', $result);

        $result = str_replace('[u]', '<span style="text-decoration: underline;">', $result);
        $result = str_replace('[/u]', '</span>', $result);

        $result = str_replace('[s]', '<span style="text-decoration: line-through;">', $result);
        $result = str_replace('[/s]', '</span>', $result);

        $result = str_replace('[code]', '<code style="white-space: pre;">', $result);
        $result = str_replace('[/code]', '</code>', $result);

        $result = str_replace('[quote]', '<blockquote><p>', $result);
        $result = str_replace('[/quote]', '</p></blockquote>', $result);

    //  [img=https://en.wikipedia.org]text[/img]
        $result = preg_replace(
            '/\[img\](.*?)\[\/img\]/',
            '<img src="${1}" alt="" />',
            $result
        );

    //  [url=https://en.wikipedia.org]text[/url]
        $result = preg_replace(
            '/\[url\](.*?)\[\/url\]/',
            '<a href="${1}" target="_blank">${1}</a>',
            $result
        );

    //  [url]https://en.wikipedia.org[/url]      
        $result = preg_replace(
            '/\[url=(.*?)\](.*?)\[\/url\]/',
            '<a href="${1}" target="_blank">${2}</a>',
            $result
        );
      
    //  [color=red]text[/color]
    //- [color="#ff0000"]text[/color]
    //- [style color=#ff0000]text[/style]
        $result = preg_replace(
            '/\[color=(.*?)\](.*?)\[\/color\]/',
            '<span style="color: ${1}">${2}</span>',
            $result
        );

    //  [size=15]text[/size]
    //- [size="15px"]text[/size]
        $result = preg_replace(
            '/\[size=(.*?)\](.*?)\[\/size\]/',
            '<span style="font-size: ${1}">${2}</span>',
            $result
        );

        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/