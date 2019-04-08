<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Sitemap.php
 *     Class: Sitemap
 *     About: Sitemap creator
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

class Sitemap
{
    /**************************************************************************/

    /**
     * Website url
     *
     * @var string $url
     */
    private $url;
    
    /**
     * Sitemap text buffer
     *
     * @var string $text
     */
    private $text;
    
    /**************************************************************************/
 
    /**
     * Create Sitemap constructor instance and open an output
     * Can designate an url with help $url parameter (null by default)
     *
     * @param string $url
     * @return void
     */
    function __construct($url = null) {
        $this->url = $url;
        $this->open();
    }

    /**************************************************************************/

    /**
     * Write to $text a sitemap header
     *
     * @return void
     */
    public function open() {
        $this->text = self::_open();
    }
    
    /**
     * Adds an $url and write it to $text
     *
     * @param string $url
     * @param string $lastmod
     * @param string $changefreq
     * @param string $priority
     * @return void
     */
    public function addUrl($url, $lastmod, $changefreq, $priority) {
        $this->text .= self::_add($url, $lastmod, $changefreq, $priority);
    }
    
    /**
     * Adds an $uri and write it to $text
     *
     * @param string $uri
     * @param string $lastmod
     * @param string $changefreq
     * @param string $priority
     * @return void
     */
    public function addUri($uri, $lastmod, $changefreq, $priority) {
        $this->text .= self::_add($this->url.$uri, $lastmod, $changefreq, $priority);
    }

    /**
     * Adds an $url or $uri and write it to $text
     *
     * @param string $url
     * @param string $lastmod
     * @param string $changefreq
     * @param string $priority
     * @return void
     */
    public function add($url, $lastmod, $changefreq, $priority) {
        $this->text .= self::_add(
            self::_isUrl($url) ? $url : $this->url.$url,
            $lastmod,
            $changefreq,
            $priority
        );
    }

    /**
     * Write to $text a sitemap footer
     *
     * @return void
     */
    public function close() {
        $this->text .= self::_close();
        return $this->text;
    }

    /**************************************************************************/
    
    /**
     * Return $text as XML
     *
     * @return string
     */
    public function getXml() {
        return $this->text;
    }

    /**
     * Return $text as text
     *
     * @return string
     */
    public function getText() {
        return self::_toText($this->text);
    }
    
    /**
     * Save $text to $filepath
     *
     * @param string $filepath
     * @return string
     */
    public function save($filepath) {
        return file_put_contents($filepath, $this->text);
    }

    /**************************************************************************/

    /**
     * Return true if $url is correct url and false if not
     *
     * @param string $url
     * @return boolean
     */
    public static function _isUrl($url) {
        return ((substr($url, 0, 5) === 'http:') || (substr($url, 0, 6) === 'https:'));
    }

    /**
     * Get a sitemap header as string
     *
     * @return string
     */
    public static function _open() {
        $result  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $result .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        return $result;
    }

    /**
     * Get a sitemap footer as string
     *
     * @return string
     */
    public static function _close() {
        return "</urlset>\n";
    }

    /**
     * Return an $url or $uri sitemap entity as string
     *
     * @param string $url
     * @param string $lastmod
     * @param string $changefreq
     * @param string $priority
     * @return string
     */
    public static function _add($url, $lastmod, $changefreq, $priority) {
    
        $lastmod = ($lastmod) ? $lastmod : time();
        $lastmod = date('Y-m-d', $lastmod); // 1970-01-01

        $result  = "  <url>\n";
        $result .= "    <loc>$url</loc>\n";
        
        if ($lastmod)
            $result .= "    <lastmod>$lastmod</lastmod>\n";
        if ($changefreq)
            $result .= "    <changefreq>$changefreq</changefreq>\n";
        if ($priority)
            $result .= "    <priority>$priority</priority>\n";
        
        $result .= "  </url>\n";
        return $result;
    }
    
    /**
     * Get a string $buffer and return a string converted to text (no HTML tags)
     *
     * @param string $buffer
     * @return string
     */
    public static function _toText(&$buffer) {
        $result = str_replace(
            array(' ', '<', '>', "\n"),
            array('&nbsp;', '&lt;', '&gt;', '<br>'),
            $buffer
        );
        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/