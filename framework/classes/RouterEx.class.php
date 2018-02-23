<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: RouterEx.class.php
 *     Class: RouterEx
 *     About: Router with extended filtration possibilies 
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

class RouterEx extends Router
{
    /**************************************************************************/
    // Class valiables
    /**************************************************************************/

    private static $instance            = null;

    /**************************************************************************/
    // Class constants
    /**************************************************************************/
    // Filter targets

    const FILTER_TARGET_NONE            = 0;
    const FILTER_TARGET_NOTHING         = 0;

    const FILTER_TARGET_SERVER          = 1;
    const FILTER_TARGET_COOKIE          = 2;
    const FILTER_TARGET_GET             = 3;
    const FILTER_TARGET_POST            = 4;

    const FILTER_TARGET_VAR             = 5;

    const FILTER_TARGET_PROTOCOL        = 6;
    const FILTER_TARGET_HOST            = 7;    
    const FILTER_TARGET_URI             = 8;
    const FILTER_TARGET_URL             = 9;
    
    /**************************************************************************/
    // Filter actions

    const FILTER_ACTION_NONE            = 0;
    const FILTER_ACTION_NOTHING         = 0;

    // Modification action
    const FILTER_ACTION_ASSIGN          = 0x01;
    const FILTER_ACTION_DELETE          = 0x02;
    const FILTER_ACTION_REPLACE         = 0x03;
    const FILTER_ACTION_APPEND          = 0x04;
    const FILTER_ACTION_PREPEND         = 0x05;

    // Terminal action
    const FILTER_ACTION_EXIT            = 0x11;
    const FILTER_ACTION_REDIRECT        = 0x12;

    /**************************************************************************/
    // Filter flags

    const FILTER_FLAG_NONE              = 0;
    const FILTER_FLAG_NOTHING           = 0;

    // Condition ???
//  const FILTER_FLAG_CONDITION         = 0x01;

    // Call a controller/action ???
//  const FILTER_FLAG_HANDLE            = 0x02;

    // Exit filter chain
    const FILTER_FLAG_BREAK             = 0x04;

    // Exit all filter chains
    const FILTER_FLAG_EXIT              = 0x08;
    
    // Skip flags
    const FILTER_FLAG_SKIP              = 0x10;    
    const FILTER_FLAG_SKIP_ONCE         = 0x11;
    const FILTER_FLAG_SKIP_BLOCK        = 0x12;
    const FILTER_FLAG_SKIP_BEGIN        = 0x14;
    const FILTER_FLAG_SKIP_END          = 0x18;

    /**************************************************************************/
    // Filters (samples)
    /**************************************************************************/
    
    protected $filters = array(
        // If $_SERVER['REMOTE_ADDR'] == '127.0.0.1'
        // then replace in URL '127.0.0.1' to 'localhost'
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_SERVER,
                'param'  => 'REMOTE_ADDR',
                'regex'  => '/^127.0.0.1$/',
            ]],
            'rules' => [[
                'target' => self::FILTER_TARGET_URL,
                'regex'  => '/(127.0.0.1)$/',
                'action' => self::FILTER_ACTION_REPLACE,
                'param'  => 'localhost'
            ]],
        ],
        // If uri == '/'
        // appController->indexAction()
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_URI,
                'regex' => '/^\/$/',
            ]],
            'handlers' => [[
                'controller' => 'app',
                'action' => 'index',
            ]],
        ],        
        // Error handler
        // appController->errorAction(error = 404, uri = uri)
        [
            'conditions' => [[
                'target' => self::FILTER_TARGET_URI,
                'regex' => '/^(\/.*)$/',
            ]],
            'handlers' => [[
                'controller' => 'app',
                'action' => 'error',
                'params' => ['error' => '404', 'uri' => '${1}']
            ]],
        ],
        // Final unconditional handler
        // appController->errorAction(error = 404, uri = '')
        [
            'handlers' => [[
                'controller' => 'app',
                'action' => 'error',
                'params' => ['error' => '404', 'uri' => '']
            ]],
        ],
    );

    /**************************************************************************/
    // Flags
    /**************************************************************************/
    
    protected function isFlag($rule, $flag) {
        $flags = Base::getInteger($rule, 'flags');
        return $flags & $flag;
    }

    /**************************************************************************/

    protected function isFlagMask($rule, $mask) {
        $flags = Base::getInteger($rule, 'flags');
        return ($flags & $mask) === $mask;
    }
  
    /**************************************************************************/

    protected function isFlagCondition($rule) {
        return $this->isFlag($rule, self::FILTER_FLAG_CONDITION);
    }

    protected function isFlagHandle($rule) {
        return $this->isFlag($rule, self::FILTER_FLAG_HANDLE);
    }

    protected function isFlagExit($rule) {
        return $this->isFlag($rule, self::FILTER_FLAG_EXIT);
    }    
    
    protected function isFlagBreak($rule) {
        return $this->isFlag($rule, self::FILTER_FLAG_BREAK);
    }

    /**************************************************************************/
    // Targets
    /**************************************************************************/

    protected function getTarget($filter) {
        $target = Base::get($filter, 'target');
        $param  = Base::get($filter, 'param');
        switch ($target) {
            case self::FILTER_TARGET_SERVER: {
                return Base::get($_SERVER, $param);
            }
            case self::FILTER_TARGET_COOKIE: {
                return Base::get($_COOKIE, $param);
            }
            case self::FILTER_TARGET_GET: {
                return Base::get($_GET, $param);
            }
            case self::FILTER_TARGET_POST: {
                return Base::get($_POST, $param);
            }
            case self::FILTER_TARGET_VAR: {
                return $this->app->getVar($param);
            }            
            case self::FILTER_TARGET_PROTOCOL: {
                return $this->protocol;
            }
            case self::FILTER_TARGET_HOST: {
                return $this->host;
            }
            case self::FILTER_TARGET_URI: {
                return $this->uri;
            }
            case self::FILTER_TARGET_URL: {
                return $this->url;
            }
        }
        return null;
    }

    /**************************************************************************/

    protected function setTarget($filter, $value) {
        $target = Base::get($filter, 'target');
        $param  = Base::get($filter, 'param');
        switch ($target) {
            case self::FILTER_TARGET_SERVER: {
                return $_SERVER[$param] = $value;
            }
            case self::FILTER_TARGET_COOKIE: {
                return $_COOKIE[$param] = $value;
            }
            case self::FILTER_TARGET_GET: {
                return $_GET[$param] = $value;
            }
            case self::FILTER_TARGET_POST: {
                return $_POST[$param] = $value;
            }
            case self::FILTER_TARGET_VAR: {
                return $this->app->setVar($param, $value);
            }            
            case self::FILTER_TARGET_PROTOCOL: {
                return $this->protocol = $value;
            }
            case self::FILTER_TARGET_HOST: {
                return $this->host = $value;
            }
            case self::FILTER_TARGET_URI: {
                return $this->uri = $value;
            }
            case self::FILTER_TARGET_URL: {
                return $this->url = $value;
            }
        }
        return null;
    }

    /**************************************************************************/
    // Conditions
    /**************************************************************************/

    protected function checkCondition($condition) {
        $value = $this->getTarget($condition);
        $matches = $this->isMatch($condition, $value);
        return $matches;
    }
    
    /**************************************************************************/

    protected function checkConditions($filter) {

        $conditions = Base::get($filter, 'conditions');

        // If unconditional rule
        // Then match success, apply rules and handlers
        if (!$conditions) {
            return [];
        }

        // OR / AND = one of / all ???
    //  $or = Base::get($conditions, 'or');

        foreach ($conditions as $condition) {
            if (($matches = $this->checkCondition($condition)) == false)
                return false;
        }

        return $matches;
    }

    /**************************************************************************/
    // Rules
    /**************************************************************************/
    
    protected function applyRule($rule, $matches) {
    
        $new_value = null;      
        $value  = $this->getTarget($rule);
 
        $action = Base::get($rule, 'action');
        $params = Base::get($rule, 'params');
        $param  = Base::get($rule, 'param');                

        $regex  = Base::get($rule, 'regex');
        if ($regex) { // ???
            if ($matches2 = $this->isMatch($rule, $value)) {
                  $matches = $matches2;
            }
        }

    //  $regexes = array();
    //  if (is_array($matches)) {
    //      foreach ($matches as $match) {
    //          $regexes[] = '/'.$match.'/';
    //      }
    //  }
            
        switch ($action) {
            case self::FILTER_ACTION_ASSIGN: {
                $match = Base::get($matches, 1);                
                $new_value = $match;
                break;
            }
            case self::FILTER_ACTION_DELETE: {
                $match = Base::get($matches, 1);                
                $new_value = str_replace($match, '', $value);
                break;
            }
            case self::FILTER_ACTION_REPLACE: {
                $match = Base::get($matches, 1);                
                $new_value = str_replace($match, $param, $value);
                break;
            }
            case self::FILTER_ACTION_PREPEND: {
                $new_value = $param.$value;
                break;
            }
            case self::FILTER_ACTION_APPEND: {
                $new_value = $value.$param;
                break;
            }
            case self::FILTER_ACTION_REDIRECT: {
                header('Location', $param);
                exit();
                break; // <= never executes
            }
            case self::FILTER_ACTION_EXIT: {
                exit();
                break; // <= never executes
            }
        }

        if ($new_value) {
            $this->setTarget($rule, $new_value);
        }

        return $this->isFlagExit($rule);
    }

    /**************************************************************************/
    // Return true if rule is terminal
    // Rules must be an array

    protected function applyRules($filter, $matches) {
        if ($rules = Base::get($filter, 'rules'))
            foreach ($rules as $rule)
                if ($this->applyRule($rule, $matches))
                    return true;
        return false;
    }

    /**************************************************************************/
    // Handlers
    /**************************************************************************/

    protected function applyHandler($handler, $matches) {

        $this->controller = Base::get($handler, 'controller');
        $this->action = Base::get($handler, 'action');

        $params = Base::get($handler, 'params');
        if ($params) { // && is_array($rule['params'])) {
            $params = $this->updateParams($params, $matches);
        }
        $this->params = $params;

        /* Handle it on the fly   
        // If You want to render any output and
        // If View will be called from controller        
        // Then View MUST be initiate before Router
        $this->app->handleAction(
            $this->controller,
            $this->action,
            $this->params
        );*/

        return $this->isFlagExit($handler);
    }
            
    /**************************************************************************/
    // Return true if handler is terminal
    // Handlers must be an array

    protected function applyHandlers($filter, $matches) {
        if ($handlers = Base::get($filter, 'handlers'))
            foreach ($handlers as $handler)
                if ($this->applyHandler($handler, $matches))
                    return true;
        return false;
    }

    /**************************************************************************/
    // Filter
    /**************************************************************************/

    protected function applyFilters() {
        foreach ($this->filters as $filter) {
            if ($matches = $this->checkConditions($filter)) {
                // Apply rules
                if ($this->applyRules($filter, $matches))
                    break;
                // Apply handlers
                if ($this->applyHandlers($filter, $matches))
                    break;
            }
        }
    }

    /**************************************************************************/

    protected function filter() {
        $this->applyFilters();
    }

    /**************************************************************************/
    // Singleton
    /**************************************************************************/

    public static function create()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**************************************************************************/
}

/******************************************************************************/