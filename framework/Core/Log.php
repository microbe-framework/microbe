<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Application.php
 *     Class: MainLog
 *     About: Main application log class
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

namespace Microbe\Core;

use \Microbe\Library\CloudFlare;

class Log extends \Microbe\Core\Library\Log
{
    /**************************************************************************/
    // Instance variables

    /**
     * Application facade instance
     *
     * @var Application
     */
    protected $app                      = null;

    /**************************************************************************/
    // Accessors
    /**************************************************************************/

    /**
     * Get framework facade class Application instance
     *
     * @return Application
     */
    public function &getApp() {
        return $this->app;
    }

    /**************************************************************************/
    // Constructor

    /**
     * Create an logger instance by specified $path
     *
     * @param Application $app The application instance
     * @param string $path
     * @return void
     */
    public function __construct(&$app, $path)
    {
    	parent::__construct($path);
    	$this->app     = &$app;
    //  $this->request = &$this->app->getRequest(); // ???
    //  $this->timer   = &$this->app->getTimer();   // ???
    }

	/**************************************************************************/

    /**
     * Return true if user agent match with $math and false otherwise
     *
     * @param string $match
     * @return boolean
     */
    public function isUserAgentMatch($match)
    {
    	$userAgent = $this->app->getRequest()->getUserAgent();
        return (strpos($userAgent, $match) !== false);
    }

	/**************************************************************************/

    /**
     * Return true if request origin is CloudFlare and false otherwise
     *
     * [?] Unused
     * @return boolean
     */
    public function specific()
    {
        $this->isCloudFlare = CloudFlare::isCloudFlare();
        $this->ip           = CloudFlare::getIp();
        $this->isYandexBot  = $this->isUserAgentMatch('yandex.com');
    }

	/**************************************************************************/
    //  $text  = $this->logIp2();
    //  $text .= $this->logDateTime('TIME');
    //  $text .= $this->log('REQUEST_URI');
    //  $text .= $this->log('HTTP_HOST');
    //  $text .= $this->log('HTTP_REFERER');
    //  $text .= $this->log('HTTP_USER_AGENT');
    //  $text .= $this->log('HTTP_ACCEPT_LANGUAGE');
    //  $text .= $this->log('HTTP_ACCEPT_ENCODING');
    //  $text .= $this->logLine();

    /**
     * Write request and script data to log buffer
     * Override this in Your own loggers
     *
     * @return void
     */
    public function end()
    {
    	$request = $this->app->getRequest();
        $timer   = $this->app->getTimer();
    //	$router  = $this->app->getRouter();

        $this->logParam('IP',      $request->getIp());
        $this->logParam('URI',     $request->getUri());
		$this->logParam('UA',      $request->getUserAgent());
		$this->logParam('Referer', $request->getReferer());
        $this->logParam('Begin',   $timer->getStartTimeEx());
    //  $this->logParam('End',     intval($this->app->getEndTime());
        $this->logParam('Time',    $timer->getTotalMicroseconds().' microseconds');
        $this->logLine();
    }

    /**************************************************************************/
}

/*******************************************************************************/