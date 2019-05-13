<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.3
 *    Module: FileSystem.php
 *     Class: FileSystem
 *     About: FileSystem routines
 *     Begin: 2019/04/19
 *   Current: 2019/04/22
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

class FileSystem
{
    /**************************************************************************/
    // Constants
    /**************************************************************************/

    const FLAG_NONE                     = 0;
    const FLAG_FILE                     = 1;
    const FLAG_DIR                      = 2;
    const FLAG_HIERARCHY                = 4;
    const FLAG_ALL                      = (self::FLAG_FILE | self::FLAG_DIR);

    /**************************************************************************/
    // Directories
    /**************************************************************************/

    /**
     * Recursively scans directory $dir
     * Return array of results
     *
     * @param  string $dir
     * @param integer $depth
     * @param integer $flags
     * @param  string $result
     * @return string[]
     */
    public static function &readDir($dir, $depth, $flags = self::FLAG_ALL, &$result = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => &$value) {

            if ($value === '.' || $value === '..')
                continue;

            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (is_dir($path)) {
                if ($flags & self::FLAG_DIR)
                    $result[] = $path . DIRECTORY_SEPARATOR;
                if ($depth != 1)
                    if ($flags & self::FLAG_HIERARCHY)
                        $result[$path] = self::readDir($path, $depth ? $depth - 1 : 0, $flags);
                    else
                        self::readDir($path, $depth ? $depth - 1 : 0, $flags, $result);
            } else {
                if ($flags & self::FLAG_FILE)
                    $result[] = $path;
            }
        }

        return $result;
    }

    /**************************************************************************/

    /**
     * Recursively filter directories array with $regex
     * Remove left $dir
     * Return array of results
     *
     * @param  string[] $paths
     * @param  string   $dir
     * @param  string   $regex
     * @return string[]
     */
    public static function &regex(&$paths, $dir, $regex)
    {
        $result = array();

        $length = $dir ? strlen($dir) : 0;

        foreach ($paths as &$path) {
            $count = $regex ? preg_match($regex, $path, $matches) : 1;
            if ($count == 0)
                continue;

            $temp = ($count > 1) ? $matches[1] : $path;
            $result[] = substr($temp, $length);
        }

        return $result;
    }

    /**************************************************************************/

    /**
     * Recursively filter directories array with $regex
     * Remove left $dir
     * Return array of results
     *
     * @param  string[] $paths
     * @param  string   $dir
     * @param  string   $regex
     * @return string[]
     */
    public static function &chop($path, $char = DIRECTORY_SEPARATOR)
    {
        $length = strlen($path) - 1;

        if (($length >= 0) && ($path[$length] == $char)) {
            $path = substr($path, 0, $length);
        }
        return $path;
    }

    /**************************************************************************/
}

/*******************************************************************************/