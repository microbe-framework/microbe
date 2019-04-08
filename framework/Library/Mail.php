<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.2
 *    Module: Mail.php
 *     Class: Mail
 *     About: Trivial SMTP mailer
 *     Begin: 2017/05/01
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

class Mail
{
    /**************************************************************************/

    /**
     * Send an email to address $mailTo from $mailFrom with $subject
     * Return true if success and false otherwise
     *
     * @param string $mailTo
     * @param string $mailFrom
     * @param string $subject
     * @param string $message
     * @return boolean
     */
    public static function send(
        $mailTo,
        $mailFrom,
        $subject,
        $message
    ) {
        $headers  = "From: $mailFrom\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        return mail($mailTo, $subject, $message, $headers);
    }

    /**************************************************************************/

    /**
     * Send an email to address $mailTo from $mailFrom with $subject
     * Attach a file if specified
     * Return true if success and false otherwise
     *
     * @param string $mailTo
     * @param string $mailFrom
     * @param string $subject
     * @param string $message
     * @param string $filepath
     * @return boolean
     */
    public static function sendFile(
        $mailTo,
        $mailFrom,
        $subject,
        $message,
        $filepath
    ) {
    //  $bound     = "simple boundary"; // ???
        $separator = "---";

        $headers   = "MIME-Version: 1.0\r\n";
        $headers  .= "From: $mailFrom\r\nReply-To: $mailFrom\r\n";
    //  $header   .= "Content-Type: multipart/mixed; boundary=\"$bound\"";
        $headers  .= "Content-Type: multipart/mixed; boundary=\"$separator\"";

        if ($filepath && file_exists($filepath)) {
            // Encode filepath to base64
            $filepath_base64 = base64_encode(basename($filepath));
            // Message
            $body  = "--$separator\r\n";
            $body .= "Content-type: text/html; charset='utf-8'\r\n";
            $body .= "Content-Transfer-Encoding: quoted-printable\r\n";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".$filepath_base64."?=\r\n\r\n";
            $body .= $message."\r\n";
            // File
            $body .= "--$separator\r\n";
            $file  = fopen($filepath, "r");
            $data  = fread($file, filesize($filepath));
            fclose($file);
            $body .= "Content-Type: application/octet-stream; name==?utf-8?B?".$filepath_base64."?=\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".$filepath_base64."?=\r\n\r\n";
            $body .= chunk_split(base64_encode($data))."\r\n";
            // Finalize
            $body .= "--".$separator ."--\r\n";
        } else {
            $body  = $message;
        }
    
        $result = mail($mailTo, $subject, $body, $headers);

        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/