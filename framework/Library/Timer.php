<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Timer.php
 *     Class: Timer
 *     About: Timer for debug purposes
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
 
class Timer
{
    /**************************************************************************/

    /**
     * Start time
     *
     * @var float $startTime
     */
    protected $startTime                = null;

    /**
     * Stop time
     *
     * @var float $stopTime
     */
    protected $stopTime                 = null;

    /**************************************************************************/
    // Construct
    /**************************************************************************/

    /**
     * Create an Application instance
     *
     * @return Application
     */
    public function __construct($start = true) {
    	if ($start) {
        	$this->start();
    	}
    }

    /**************************************************************************/

    /**
     * Start a timer
     *
     * @return void
     */
    public function start() {
        $this->startTime = microtime(true);
        $this->stopTime = null;
    }

    /**
     * Stop a timer
     *
     * @return void
     */
    public function stop() {
    	if ($this->startTime) {
    		$this->stopTime = microtime(true);
    	}
    }

    /**
     * Stop and reset
     *
     * @return void
     */
    public function reset() {
        $this->startTime = null;
        $this->stopTime = null;
    }

    /**************************************************************************/

    /**
     * Return start time
     *
     * @return float
     */
    public function getStartTime() {
        return $this->startTime;
    }

    /**
     * Return start time * $multiplier as integer
     *
     * @return float
     */
    public function getStartTimeEx($multiplier = 1) {
        return intval($this->startTime * $multiplier);
    }

    /**
     * Return stop time
     *
     * @return float
     */
    public function getStopTime() {
        return $this->stopTime;
    }

    /**
     * Return stop time * $multiplier as integer
     *
     * @return float
     */
    public function getStopTimeEx($multiplier = 1) {
        return intval($this->stopTime * $multiplier);
    }

    /**************************************************************************/

    /**
     * Return true if timer has been started, false otherwise
     *
     * @return boolean
     */
    public function isStarted() {
        return boolval($this->startTime);
    }

    /**
     * Return true if timer has been stopped, false otherwise
     *
     * @return boolean
     */
    public function isStopped() {
        return boolval($this->stopTime);
    }

    /**************************************************************************/

    /**
     * Return time from start to current time
     *
     * @return float
     */
    protected function _getTime() {
        return (microtime(true) - $this->startTime);
    }

    /**
     * Return time from start to current time * $multiplier as integer
     *
     * @return float
     */
    protected function _getTimeEx($multiplier = 1) {
        return intval((microtime(true) - $this->startTime) * $multiplier);
    }

    /**************************************************************************/

    /**
     * Return time from start to current time
     *
     * @return float
     */
    public function getTime() {
        return $this->startTime ? $this->_getTime() : null;
    }

    /**
     * Return time from start to current time * $multiplier
     * $multiplier = 1          => seconds
     * $multiplier = 1000       => milliseconds
     * $multiplier = 1000000    => microseconds
     * $multiplier = 1000000000 => nanoseconds
     *
     * @param int $multiplier
     * @return int
     */
    public function getTimeEx($multiplier = 1) {
        return $this->startTime ? $this->_getTimeEx($multiplier) : null;
    }

    /**
     * Return time from start to current time in seconds
     *
     * @return int
     */
    public function getSeconds() {
        return $this->getTimeEx(1);
    }

    /**
     * Return time from start to current time in milliseconds
     *
     * @return int
     */
    public function getMilliSeconds() {
        return $this->getTimeEx(1000);
    }

    /**
     * Return time from start to current time in microseconds
     *
     * @return int
     */
    public function getMicroSeconds() {
        return $this->getTimeEx(1000000);
    }

    /**************************************************************************/

    /**
     * Return time from start to stop
     *
     * @return float
     */
    protected function _getTotalTime() {
        return ($this->stopTime - $this->startTime);
    }

    /**
     * Return time from start to stop * $multiplier as integer
     *
     * @return int
     */
    protected function _getTotalTimeEx($multiplier = 1) {
        return intval(($this->stopTime - $this->startTime) * $multiplier);
    }

    /**************************************************************************/

    /**
     * Return time from start to stop
     * @return float
     */
    public function getTotalTime() {
        return $this->stopTime ? $this->_getTotalTime() : null;
    }

    /**
     * Return time from start to stop * $multiplier
     * $multiplier = 1          => seconds
     * $multiplier = 1000       => milliseconds
     * $multiplier = 1000000    => microseconds
     * $multiplier = 1000000000 => nanoseconds
     *
     * @param int $multiplier
     * @return int
     */
    public function getTotalTimeEx($multiplier = 1) {
        return $this->stopTime ? $this->_getTotalTimeEx($multiplier) : null;
    }

    /**
     * Return time from start to stop in seconds
     *
     * @return int
     */
    public function getTotalSeconds() {
        return $this->getTotalTimeEx(1);
    }

    /**
     * Return time from start to stop in milliseconds
     *
     * @return int
     */
    public function getTotalMilliSeconds() {
        return $this->getTotalTimeEx(1000);
    }

    /**
     * Return time from start to stop in microseconds
     *
     * @return int
     */
    public function getTotalMicroSeconds() {
        return $this->getTotalTimeEx(1000000);
    }

    /**************************************************************************/
}

/*******************************************************************************/