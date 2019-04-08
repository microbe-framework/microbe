<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Application.php
 *     Class: Log
 *     About: Log class
 *     Begin: 2019/03/25
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

class Log
{
    /**************************************************************************/
    // Variables
    
    /**
     * Path to log directory
     *
     * @var string $path
     */
    protected $path                     = null;

    /**
     * Path to current log file
     *
     * @var string $filepath
     */
    protected $filepath                 = null;

    /**
     * Buffer
     *
     * @var string $buffer
     */
    protected $buffer                   = null;

    /**
     * Use buffer or not
     *
     * @var boolean $useBuffer
     */
    protected $useBuffer                = true;

    /**************************************************************************/
    // Constructor

    /**
     * Create a Log instance
     *
     * @param string $path
     * @return void
     */
    public function __construct($path) {
    	$this->init($path);
    }

    /**************************************************************************/

    /**
     * Init a Log with $path
     *
     * @param string $path
     * @return void
     */
	protected function init(&$path) {
		$path = Path::adjustRight($path);
    	if (is_file($path)) {
    		$this->filepath = $path;
    		$this->path = dirname($filepath);
    	} else if (is_dir($path)) {
    		$this->path = $path;
    		$this->filepath = $this->path.'/'.$this->getFileName();
    	} else {
    		$this->path = null;
    		$this->filepath = null;
    	}
        $this->begin();
    }

    /**************************************************************************/

    /**
     * Done a Log ang flush buffer
     *
     * @return void
     */
	public function done() {
        $this->end();
    	$this->write();
    }
    
    /**************************************************************************/

    /**
     * Return log file name for current date
     *
     * @return string
     */
    public function getFileName() {
        return date('Ymd', time()).'.log';
    }

    /**************************************************************************/

    /**
     * Return a log directory path
     *
     * @return string
     */
    public function getPath() {
        return $path;
    }

    /**
     * Return a log file path
     *
     * @return string
     */
    public function getFilepath() {
        return $filepath;
    }

    /**************************************************************************/

    /**
     * Return a line with $text and linebreak at the end
     *
     * @param string $text
     * @return string
     */
    public function getLine($text = null) {
        return $text.PHP_EOL;
    }

    /**
     * Return a current unix time
     *
     * @param string $text
     * @return int
     */
    public function getUnixTime() {
        return time();
    }

    /**
     * Return a current date as string like '2018/12/31'
     *
     * @return string
     */
    public function getDate() {
        return date('Y/m/d', time());
    }

    /**
     * Return a current time as string like '11:59:59'
     *
     * @return string
     */
    public function getTime() {
       return date('H:i:s', time());
    }

    /**
     * Return a current date and time as string like '2018/12/31 11:59:59'
     *
     * @return string
     */
    public function getDateTime() {
        return date('Y/m/d H:i:s', time());
    }

    /**************************************************************************/

    /**
     * Write to buffer a line with $text
     *
     * @param string $text
     * @return void
     */
    public function log($text) {
    	$this->buffer .= $text;
	}

    /**
     * Write to buffer a line with $text and linebreak at the end
     *
     * @param string $text
     * @return void
     */
    public function logLine($text = null) {
    	$this->buffer .= ($text.PHP_EOL);
	}

    /**
     * Write to buffer a parameter with $name and $value and linebreak at the end
     *
     * @param string $text
     * @return void
     */
    public function logParam($name, $value) {
        $this->buffer .= ($name.': '.$value.PHP_EOL);
    }

    /**************************************************************************/

    /**
     * Write a buffer to file
     *
     * @return void
     */
    public function write() {
    	if (is_string($this->filepath) == false)
    		return false;
    	if (is_string($this->buffer) == false)
    		return false;

        return file_put_contents($this->filepath, $this->buffer, FILE_APPEND | LOCK_EX);
	}

	/**************************************************************************/

    /**
     * Call at start
     *
     * @return void
     */
    public function begin() {
    }

    /**
     * Main log procedure
     *
     * @return void
     */
    public function main() {
    }

    /**
     * Call before done
     *
     * @return void
     */
    public function end() {
    }

    /**************************************************************************/
}

/*******************************************************************************/