<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.3
 *    Module: Images.php
 *     Class: Images
 *     About: Images handler
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

class Images
{
    /**************************************************************************/

    /**
     * Image file type unknown or not defined
     *
     * @var int TYPE_NONE
     */
    const TYPE_NONE                     = 0;

    /**
     * Image file type is JPEG
     *
     * @var int TYPE_JPG
     */
    const TYPE_JPG                      = 1;

    /**
     * Image file type is PNG
     *
     * @var int TYPE_PNG
     */
    const TYPE_PNG                      = 2;    

    /**
     * Image file type is GIF
     *
     * @var int TYPE_GIF
     */
    const TYPE_GIF                      = 3;

    /**
     * Image file type is BMP
     *
     * @var int TYPE_BMP
     */
    const TYPE_BMP                      = 4;


    /**
     * Image file types array
     *
     * @var mixed[] $types
     */
    public static $types = array(
        array(self::TYPE_NONE, null),
        array(self::TYPE_JPG, 'jpg', array('jpg', 'jpeg', 'pjpeg'),
        array(self::TYPE_PNG, 'png'),
        array(self::TYPE_GIF, 'gif'),
        array(self::TYPE_BMP, 'bmp'),
    );

    /**************************************************************************/

    /**
     * Get image type constant by file extention or MIME type
     *
     * @param string $type
     * @return int
     */
    public static function getImageType($type) {

        if (empty($type)) return TYPE_NONE;
        
        foreach (self::$types as &$a) {
            if (!strcasecmp($type, $a[1])) return $a[0];
            if (count($type) > 2) {
                foreach ($types[2] as &$b) {
                    if (!strcasecmp($type, $b)) return $a[0];
                }
            }
        }

    //  if (!strcasecmp($type, "jpeg")) return TYPE_JPG;
    //  if (!strcasecmp($type, "jpg")) return TYPE_JPG;
    //  if (!strcasecmp($type, "pjpeg")) return TYPE_JPG;
    //  if (!strcasecmp($type, "png")) return TYPE_PNG;
    //  if (!strcasecmp($type, "gif")) return TYPE_GIF;
    //  if (!strcasecmp($type, "bmp")) return TYPE_BMP;
        return TYPE_NONE;
    }

    /**************************************************************************/

    /**
     * Get image file extention by image type constant
     *
     * @param int $type
     * @return string
     */
    public static function getImageExt($type) {
        return ($type < count(self::$types)) ? self::$types[1] : null;
    //  switch (getImageType($type)) {
    //      case TYPE_JPG: return "jpg";
    //      case TYPE_PNG: return "png";
    //      case TYPE_GIF: return "gif";
    //      case TYPE_BMP: return "bmp";
    //  }
    //  return null;
    }

    /**************************************************************************/

    /**
     * Scale $width and $height to fit $widthMax and $heightMax
     * Return array of two integer values $width and $height
     *
     * @param int $width
     * @param int $height
     * @param int $widthMax
     * @param int $heightMax
     * @return int[2]
     */
    public static function fit($width, $height, $widthMax, $heightMax) {
        if ($width > $widthMax) {
            $scale = $widthMax / $width;
            $width = $widthMax;
            $height = $height * $scale;
        }
        if ($height > $heightMax) {
            $scale = $heightMax / $height;
            $height = $heightMax;
            $width = $width * $scale;
        }
        return array($width, $height);
    }

    /**************************************************************************/

    /**
     * Resample without cat JPEG image from file $src to file $dst
     * to fit dimensions $dstWidth and $dstHeight
     * with defined in percent $quality from 0 to 100, default is 100
     * Return true if success and false if fail
     *
     * @param string $src
     * @param string $dst
     * @param int $dstHeight
     * @param int $dstWidth
     * @param int $quality
     * @return boolean
     */
    public static function jpegResample($src, $dst, $dstWidth, $dstHeight, $quality = 100)
    {
        if (!function_exists('imagecreatefromjpeg')) return false;
        if (!file_exists($src)) return false;

        list($srcWidth, $srcHeight) = getimagesize($src);

        if ($dstWidth && ($srcWidth < $srcHeight)) {
            $dstWidth = ($dstHeight / $srcHeight) * $srcWidth;
        } else {
            $dstHeight = ($dstWidth / $srcWidth) * $srcHeight;
        }

        // Resample
        $srcImage = imagecreatefromjpeg($src);
        $dstImage = imagecreatetruecolor($dstWidth, $dstHeight);

        imagecopyresampled(
            $dstImage, $srcImage,
            0, 0,
            0, 0,
            $dstWidth, $dstHeight,
            $srcWidth, $srcHeight
        );

        // Output
        if ($dst) {
            if (file_exists($dst)) unlink($dst);
            imagejpeg($dstImage, $dst, $quality);
        } else {
            header('Content-Type: image/jpeg');
            imagejpeg($dstImage, null, $quality);
        }

        // Exit
        return true;
    }

    /**************************************************************************/

    /**
     * Cat and resample JPEG image from file $src to file $dst
     * to fit dimensions $dstWidth and $dstHeight
     * with defined in percent $quality from 0 to 100, default is 100
     * Return true if success and false if fail
     *
     * @param string $src
     * @param string $dst
     * @param int $dstHeight
     * @param int $dstWidth
     * @param int $quality
     * @return boolean
     */
    public static function jpegMiniature($src, $dst, $dstWidth, $dstHeight, $quality = 100)
    {
        if (!function_exists('imagecreatefromjpeg')) return false;
        if (!file_exists($src)) return false;

        $srcX = 0;
        $srcY = 0;
        list($srcWidth, $srcHeight) = getimagesize($src);

        $dstRatio = $dstWidth / $dstHeight;
        $srcRatio = $srcWidth / $srcHeight;

        if ($srcRatio > $dstRatio) {
            $srcWidthNew = $srcHeight * $dstRatio;
            $srcX = ($srcWidth - $srcWidthNew) / 2;
            $srcWidth = $srcWidthNew;
        } else if ($srcRatio < $dstRatio) {
            $srcHeightNew = $srcWidth / $dstRatio;
            $srcY = ($srcHeight - $srcHeightNew) / 2;
            $srcHeight = $srcHeightNew;
        }

        // Resample
        $srcImage = imagecreatefromjpeg($src);
        $dstImage = imagecreatetruecolor($dstWidth, $dstHeight);

        imagecopyresampled(
            $dstImage, $srcImage,
            0, 0,
            $srcX, $srcY,
            $dstWidth, $dstHeight,
            $srcWidth, $srcHeight
        );

        // Output
        if ($dst) {
            if (file_exists($dst)) unlink($dst);
            imagejpeg($dstImage, $dst, $quality);
        } else {
            header('Content-Type: image/jpeg');
            imagejpeg($dstImage, null, $quality);
        }

        // Exit
        return true;
    }

    /**************************************************************************/
}

/******************************************************************************/