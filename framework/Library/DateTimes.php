<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: DateTimes.php
 *     Class: DateTimes
 *     About: Date and time helper
 *   Comment: This class unnecessary at all 8)
 *     Begin: 2017/03/25
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
 
class DateTimes
{
    /**************************************************************************/

    /**
     * Seconds count per one day
     *
     * @var int DAY_IN_SECONDS
     */
    const DAY_IN_SECONDS                = (24*60*60);

    /**************************************************************************/

    /**
     * Date format string for this module
     * Sample: 'Y/m/d' => 'YYYY/MM/DD' => '2019/03/25'
     *
     * @var string $fmtDate
     */
    public static $fmtDate              = 'Y/m/d';

    /**
     * Time format string for this module
     * Sample: 'H:i:s' => 'HH:MM:SS' => '07:30:25'
     *
     * @var string $fmtDate
     */
    public static $fmtTime              = 'H:i:s';

    /**
     * Date and time format string for this module
     * Sample: 'Y/m/d H:i:s' => 'YYYY/MM/DD HH:MM:SS' => '2019/03/25 07:30:25'
     *
     * @var string $fmtDate
     */
    public static $fmtDateTime          = 'Y/m/d H:i:s';

    /**************************************************************************/

    /**
     * Array with english month names
     *
     * @var string[] $monthNames
     */
    public static $monthNames = array(
        '',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    );

    /**
     * Array with english month short names
     *
     * @var string[] $monthNamesShort
     */
    public static $monthNamesShort = array(
        '',
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
    );

    /**************************************************************************/

    /**
     * Array with english weekday names
     *
     * @var string[] $weekdayNames
     */
    public static $weekdayNames = array(
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednsday',
        'Thursday',
        'Friday',
        'Saturday'
    );

    /**
     * Array with english weekday short names
     *
     * @var string[] $weekdayNames
     */
    public static $weekdayNamesShort = array(
        'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
    );

    /**************************************************************************/
    // Unix date and time
    /**************************************************************************/

    /**
     * Return year of timestamp $datetime
     * Return current year if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getYear($datetime = false) {
        return idate('Y', $datetime ? $datetime : time());
    }

    /**
     * Return month of timestamp $datetime
     * Return current month if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getMonth($datetime = false) {
        return idate('m', $datetime ? $datetime : time()); // n
    }

    /**
     * Return day of timestamp $datetime
     * Return current day if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getDay($datetime = false) {
        return idate('d', $datetime ? $datetime : time()); // j
    }

    /**
     * Return weekday of timestamp $datetime
     * Return current weekday if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getWeekday($datetime = false) {
        return idate('w', $datetime ? $datetime : time()); // N
    }

    /**
     * Return hour of timestamp $datetime
     * Return current hour if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getHour($datetime = false) {
        return idate('H', $datetime ? $datetime : time());
    }

    /**
     * Return minute of timestamp $datetime
     * Return current minute if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getMinute($datetime = false) {
        return idate('i', $datetime ? $datetime : time());
    }

    /**
     * Return second of timestamp $datetime
     * Return current second if $datetime not defined
     *
     * @param int $datetime
     * @return int
     */
    public static function getSecond($datetime = false) {
        return idate('s', $datetime ? $datetime : time());
    }

    /**************************************************************************/

    /**
     * Return a timestamp by $year $month $day
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return int
     */
    public static function makeDate($year, $month, $day) {
        return mktime(0, 0, 0, $month, $day, $year);
    }

    /**************************************************************************/

    /**
     * Return a zero time timestamp
     *
     * @param int $datetime
     * @return int
     */
    public static function getDate($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      $year  = self::getYear($datetime);
      $month = self::getMonth($datetime);
      $day   = self::getDay($datetime);
      return mktime(0, 0, 0, $month, $day, $year);
    }

    /**
     * Return a previous day zero time timestamp*
     *
     * @param int $datetime
     * @return int
     */
    public static function getDatePrev($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      return self::getDate($datetime - self::DAY_IN_SECONDS);
    }

    /**
     * Return a next day zero time timestamp
     *
     * @param int $datetime
     * @return int
     */
    public static function getDateNext($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      return self::getDate($datetime + self::DAY_IN_SECONDS);
    }

    /**************************************************************************/

    /**
     * Return date as array for timestamp $datetime
     *
     * @param int $datetime
     * @return int[]
     */
    public static function getDateRec($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      $year    = self::getYear($datetime);
      $month   = self::getMonth($datetime);
      $day     = self::getDay($datetime);
      $hour    = self::getHour($datetime);
      $minute  = self::getMinute($datetime);
      $second  = self::getSecond($datetime);
      $weekday = self::getWeekday($datetime);
      $date    = mktime(0, 0, 0, $month, $day, $year);
      return array(
          'time' => $datetime,
          'date' => $date,
          'weekday' => $weekday,
          'year' => $year, 'month' => $month, 'day' => $day,
          'hour' => $hour, 'minute' => $minute, 'second' => $second
      );
    }

    /**
     * Return previous day date as array for timestamp $datetime
     *
     * @param int $datetime
     * @return int[]
     */
    public static function getDateRecPrev($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      return self::getDateRec($datetime - self::DAY_IN_SECONDS);
    }

    /**
     * Return next day date as array for timestamp $datetime
     *
     * @param int $datetime
     * @return int[]
     */
    public static function getDateRecNext($datetime = false) {
      if ($datetime === false) {
        $datetime  = time();
      }
      return self::getDateRec($datetime + self::DAY_IN_SECONDS);
    }

    /**************************************************************************/   

    /**
     * Return date as string formatted with $fmtDate
     * If timestamp $datetime not defined return result for now
     *
     * @param int $datetime
     * @return string
     */
    public static function getDateString($datetime = false) {
        return date(self::$fmtDate, $datetime ? $datetime : time());
    }

    /**
     * Return time as string formatted with $fmtTime
     * If timestamp $datetime not defined return result for now
     *
     * @param int $datetime
     * @return string
     */
    public static function getTimeString($datetime = false) {
        return date(self::$fmtTime, $datetime ? $datetime : time());
    }

    /**
     * Return date and time as string formatted with $fmtDateTime
     * If timestamp $datetime not defined return result for now
     *
     * @param int $datetime
     * @return string
     */
    public static function getDateTimeString($datetime = false) {
        return date(self::$fmtDateTime, $datetime ? $datetime : time());
    }

    /**************************************************************************/   
}

/******************************************************************************/