<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Upload.php
 *     Class: Upload
 *     About: Uploads handler
 *     Begin: 2019/03/09
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

class Upload
{
    /**************************************************************************/
    // <input type="hidden" name="MAX_FILE_SIZE" value="30000">

//  const maxSize = 1048576;

//  const maxImageWidth = 640;
//  const maxImageHeight = 640;
//  const maxImageSize = 1048576;

//  public $maxSize = 1048576;
//  public $types = null;
//  public $path = null;

    /**************************************************************************/

    /**
     * Upload a file from http request $_FILES array element with name a $var
     * Store file on the server with $filename
     * Don't upload a file if filesize greater then $maxSize if it is defined
     * Don't upload a file if filetype not in $types array if it defined
     * Change linux/unix access rights for file to to 0666
     * Rewrite file if exists
     * Return filename if success or null otherwise
     *
     * @param string $var
     * @param string $filename
     * @param int|boolean $maxSize
     * @param string[]|string|boolean $types
     * @return string|null
     */
    public static function uploadFile($var, $filename, $maxSize = false, $types = false)
    {
        if (empty($var)) return null;
        if (empty($_FILES[$var]['name'])) return null;

        $result = null;

        $name  = $_FILES[$var]['name'];
        $type  = $_FILES[$var]['type'];
        $size  = $_FILES[$var]['size'];
        $temp  = $_FILES[$var]['tmp_name'];
        $error = $_FILES[$var]['error'];
        $ext = substr($name, 1 + strrpos($name, '.'));

        if (!is_uploaded_file($temp)) return null;

        if (!empty($maxSize)) {
            if ($size > $maxSize) return null;
        }

/*      if (!empty($types)) {
            if (is_array($types)) {
                if (!in_array($ext, $types)) return null;
            } else if (is_string($type)) {
                if (strcasecmp($ext, $types)) return null;
            } else {
                return null;
            }
        }*/

        if (!empty($types)) {
            if (is_array($types)) {
                if (!in_array($type, $types)) return null;
            } else if (is_string($type)) {
                if (strcasecmp($type, $types)) return null;
            } else {
                return null;
            }
        }

        if (empty($filename)) $filename = $name;

        if (file_exists($filename)) unlink($filename);

        if (move_uploaded_file($temp, $filename)) {
            $result = $filename;
            chmod($filename, 0666);
          //echo "<font color=blue>".$filename." - OK</font><br>";
        } else {
         //echo "<font color=red>".$filename." - SHIT</font><br>";
        }

        return $result;
    }

    /**************************************************************************/

    /**
     * Upload a image file from http request $_FILES array element with name a $var
     * Store file on the server with $filename
     * Don't upload a file if filesize greater then $maxSize if it is defined
     * Don't upload a file if filetype not in $types array if it defined
     * Change linux/unix access rights for file to to 0666
     * Rewrite file if exists
     * Return filename if success or null otherwise
     *
     * [?] Same as uploadFile routine
     * @param string $var
     * @param string $filename
     * @param int|boolean $maxSize
     * @param string[]|string|boolean $types
     * @return string|null
     */
    public static function uploadImage($var, $filename, $maxSize = false, $types = false)
    {
        if (empty($var)) return null;
        if (empty($_FILES[$var]['name'])) return null;

        $result = null;

        $name  = $_FILES[$var]['name'];
        $type  = $_FILES[$var]['type'];
        $size  = $_FILES[$var]['size'];
        $temp  = $_FILES[$var]['tmp_name'];
        $error = $_FILES[$var]['error'];
        $ext = substr($name, 1 + strrpos($name, '.'));

        if (!is_uploaded_file($temp)) return null;

        if (!empty($maxSize)) {
            if ($size > $maxSize) return null;
        }

/*      if (!empty($types)) {
            if (is_array($types)) {
                if (!in_array($ext, $types)) return null;
            } else if (is_string($type)) {
                if (strcasecmp($ext, $types)) return null;
            } else {
                return null;
            }
        }*/

       if (!empty($types)) {
            if (is_array($types)) {
                if (!in_array($type, $types)) return null;
            } else if (is_string($type)) {
                if (strcasecmp($type, $types)) return null;
            } else {
                return null;
            }
        }

        if (empty($filename)) $filename = $name;

        list($width, $height, $ext, $attr) = getimagesize($temp);

        if (file_exists($filename)) unlink($filename);

        if (move_uploaded_file($temp, $filename)) {
            $result = $filename;
            chmod($filename, 0666);
          //echo "<font color=blue>".$filename." - OK</font><br>";
        } else {
          //echo "<font color=red>".$filename." - SHIT</font><br>";
        }

        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/