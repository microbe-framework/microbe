<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: View.php
 *     Class: Render
 *     About: Render
 *     Begin: 2019/03/24
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
 
class Render
{
    /**************************************************************************/
    // Render basic
    /**************************************************************************/

    const RENDER_FLAG_NONE              = 0;    
    const RENDER_FLAG_FILE              = 1;
    const RENDER_FLAG_BUFFER            = 2;

    /**************************************************************************/
    
    /**
     * Keep a current rendered file nesting level, initially equal 0
     *
     * @var int $level
     */
    protected $level                    = 0;

    /**
     * Defines how will render a source: as plain text (true) or php code (false)
     * False (php code) by default
     * Don't render all but layouts
     * Name 'plain' is questionable
     * render,rendered,include,usePlain
     *
     * @var boolean $plain
     */
    protected $plain                    = false;

    /**************************************************************************/
    // Level

    /**
     * Get a current rendered file nesting level
     *
     * @return int
     */
    public function getLevel() {
        return $this->level;
    }

    /**
     * Check a current rendered file nesting level is top (true) or not (false)
     *
     * @return int
     */
    public function isTopLevel() {
        return $this->level == 0;
    }

    /**
     * Check a current rendered file nesting level is top (false) or not (true)
     *
     * @return int
     */
    public function noTopLevel() {
        return $this->level != 0;
    }

    /**
     * Reset a current rendered file nesting level to top (0)
     *
     * @return int
     */
    public function resetLevel() {
        return $this->level = 0;
    }

    /**
     * Increment by one a current rendered file nesting level 
     *
     * @return int
     */
    public function incLevel() {
        return $this->level = $this->level + 1;
    }

    /**
     * Decrement by one a current rendered file nesting level
     * Don't proceed if current level is a top (0)
     *
     * @return int
     */
    public function decLevel() {
        return $this->level = ($this->level) ? ($this->level - 1) : $this->level;
    }

    /**************************************************************************/
    // Plain/Render

    /**
     * Return true if source rendered as plain text, false otherwise
     *
     * @return boolean
     */
    public function isPlain() {
        return $this->plain;
    }

    /**
     * Get source rendered scheme: as plain text (true) or php code (false)
     *
     * @return boolean
     */
    public function getPlain() {
        return $this->plain;
    }

    /**
     * Defines how will render a source: as plain text (true) or php code (false)
     *
     * @param boolean $plain
     * @return void
     */
    public function setPlain($plain) {
        $this->plain = $plain;
    }

    /**************************************************************************/

    /**
     * Get content of a file or null if file not exists
     * COMMENT: nonsensical but convinient routine
     *   for php >= 5.6 can use this construction:
     *   use function file_get_contents as readFile;
     *
     * @param string $path
     * @return string
     */
    protected function &readFile($path) {  
        return file_get_contents($path);
    }

    /**************************************************************************/
    // Render a buffer use eval without output
    // Reserved variables: $this, $app, $_
    // Local variables: $render_params, $render_vars
    // Local variables: $render_name,   $render_value
    // Local variables: $render_buffer, $render_flags, $render_result

    /**
     * Render a buffer to string
     * Use $render_params and $render_flags
     * $render_flags can be combination of:
     * - RENDER_FLAG_NONE
     * - RENDER_FLAG_FILE
     * - RENDER_FLAG_BUFFER
     *
     * @param string $render_buffer
     * @param mixed[] $render_params
     * @param int $render_flags Default value RENDER_FLAG_NONE
     * @return string
     */
    protected function &render(
        &$render_buffer,
        &$render_params,
        $render_flags = self::RENDER_FLAG_NONE
    )
    {
        $render_result = null;

        // 2019/03/24 {
        // Check for file exists
        if (($render_flags & self::RENDER_FLAG_FILE) != 0) {
            if (file_exists($render_buffer) === false)
                return $render_result;
        }
        // } 2019/03/24

        $this->incLevel();

    //  $app = $this->app;
        $_ = $render_params;
    //  var_dump($render_params);
        if (is_array($render_params)) {
            foreach ($render_params as $render_name => &$render_value) {
                $$render_name = $render_value;
            }
            unset($render_name);
            unset($render_value);
        }

        if (($render_flags & self::RENDER_FLAG_BUFFER) != 0)
            ob_start();

        if (($render_flags & self::RENDER_FLAG_FILE)   != 0)
            include($render_buffer);

        if (($render_flags & self::RENDER_FLAG_FILE)   == 0)
            eval('?>'.$render_buffer);

        if (($render_flags & self::RENDER_FLAG_BUFFER) != 0)
            $render_result = ob_get_clean();

        $this->decLevel();
        
        return $render_result;
    }

    /**************************************************************************/
    // Render
    // Include and evaluate

    /**
     * Render as php code a string $buffer by reference with $params
     *
     * @param string|mixed $buffer
     * @param mixed[] $params
     * @return string
     */
    public function renderBuffer(&$buffer, $params = null) {
        $this->render($buffer, $params, self::RENDER_FLAG_NONE);
    }

    /**
     * Render as php code a string $string by value with $params
     *
     * @param string|mixed $string
     * @param mixed[] $params
     * @return string
     */
    public function renderString($string, $params = null) {
        $this->render($string, $params, self::RENDER_FLAG_NONE);
    }

    /**
     * Render as php code a file with $params
     *
     * @param string $path
     * @param mixed[] $params
     * @return string
     */
    public function renderFile($path, $params = null) {
        $this->render($path, $params, self::RENDER_FLAG_FILE);
    }

    /**************************************************************************/
    // Include

    /**
     * Include in plain render output a string $buffer by reference
     *
     * @param string|mixed $buffer
     * @return string
     */
    public function includeBuffer(&$buffer) {
        echo $buffer;
    }

    /**
     * Include in plain render output a string $string by value
     *
     * @param string|mixed $string
     * @return string
     */
    public function includeString($string) {
        echo $string;
    }

    /**
     * Include in plain render output a file
     *
     * @param string $path
     * @return string
     */
    public function includeFile($path) {
        echo $this->readFile($path);
    }

    /**************************************************************************/
}

/******************************************************************************/