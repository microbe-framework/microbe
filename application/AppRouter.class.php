<?php
/*******************************************************************************
 *   Project: Microbe PHP Framework
 *   Version: 0.1.0
 *    Module: AppRouter.class.php
 *     Class: AppRouter
 *     About: AppRouter sample
 *     Begin: 2017/05/01
 *   Current: 2018/02/22
 *    Author: Microbe PHP Framework author <microbe-framework@protonmail.com>
 * Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>
 *   License: MIT license
 *    Source: https://github.com/microbe-framework/microbe/
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

class AppRouter extends RouterEx
{
    /**************************************************************************/
    // Filters
    /**************************************************************************/
    // Action MUST be valid filter action
    // WARNING:
    // If exists file '/config/routes.json'
    // then all those rules will be overriden
    
    protected $filters = array(
        // if ($_SERVER['REMOTE_ADDR'] == 108.177.8.1) then exit();
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_SERVER,            
                'regex' => '#^108.177.8.1$#',
                'param' => 'REMOTE_ADDR'
            ]],
            'rules' => [[
                'action' => self::FILTER_ACTION_EXIT,
                'flags' => self::FILTER_FLAG_EXIT
            ]],
        ],
        // $app->vars['ip'] = $_SERVER['REMOTE_ADDR']
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_SERVER,
                'param' => 'REMOTE_ADDR',
                'regex' => '#^(.*)$#',                
            ]],
            'rules' => [[
                'action' => self::FILTER_ACTION_ASSIGN,
                'target' => self::FILTER_TARGET_VAR,
                'param' => 'ip',
            ]],
        ],
        // Append 'microbe/' postfix after url
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_URI,            
                'regex' => '#^/(microbe/)#',
            ]],
            'rules' => [[
                'target' => self::FILTER_TARGET_URL,            
                'action' => self::FILTER_ACTION_APPEND,
                'param'  => 'microbe/'
            ]],
        ],
        // Remove 'microbe' prefix before uri
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_URI,            
                'regex' => '#^/(microbe/)#',
            ]],
            'rules' => [[
                'target' => self::FILTER_TARGET_URI,            
                'regex' => '#^/(microbe/)#',
                'action' => self::FILTER_ACTION_DELETE,
                'param'  => null
            ]],
        ],
        // Handle a '^/check$' in uri
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_URI,            
                'regex' => '#^/(check)$#',
            ]],
            'handlers' => [[
                'controller' => 'app',
                'action' => 'check',
                'params'  => ['name' => '${1}'],
            ]],
        ],
    );

    /**************************************************************************/
    // Rules
    /**************************************************************************/
    // Here override basic rules to Your custom
    // Controller name MUST begins from low case letter
    // Action name MUST begins from low case letter
    // Params (if exists) MUST be associative array
    // WARNING:
    // If exists file '/config/routes.json'
    // then all those rules will be overriden

    protected $routes = array(
    
        ////////////////////////////////////////////////////////////////////////

        // Index: /
        array(
            'regex' => '#^/$#',
            'controller' => 'app',
            'action' => 'page',
            'params' => ['page' => 'index']
        ),
        // About: /about
        array(
            'regex' => '#^/about$#',
            'controller' => 'app',
            'action' => 'page',
            'params' => ['page' => 'about']
        ),
        // Articles: /articles
        array(
            'regex' => '#^/articles$#',
            'controller' => 'app',
            'action' => 'page',
            'params' => ['page' => 'articles']
        ),
        // Article: /articles/100
        array(
            'regex' => '#^/articles/([0-9]{1,16})$#',
            'controller' => 'app',
            'action' => 'article',
            'params' => ['article' => '# ${1}']
        ),
        // Article: /100
        array(
            'regex' => '#^/([0-9]{1,16})$#',
            'controller' => 'app',
            'action' => 'article',
            'params' => ['article' => '# ${1}']
        ),
        // Contacts: /contacts
        array(
            'regex' => '#^/contacts$#',
            'controller' => 'app',
            'action' => 'page',
            'params' => ['page' => 'contacts']
        ),

        ////////////////////////////////////////////////////////////////////////
 
        // Redirect: /redirect
        array(
            'regex' => '#^/redirect$#',
            'controller' => 'app',
            'action' => 'redirect'
        ),
          
        ////////////////////////////////////////////////////////////////////////

        // Error 404: all other
        array(
            'regex' => '#^/.*$#',
            'controller' => 'app',
            'action' => 'error',
            'params' => ['error' => '404']
        ),

        ////////////////////////////////////////////////////////////////////////
    );

    /**************************************************************************/
    // Pre routing and post routing functions
    
    protected function before() {
        // Place Your code here
    }

    protected function after() {
        // Place Your code here
    }

    /**************************************************************************/
}

/******************************************************************************/