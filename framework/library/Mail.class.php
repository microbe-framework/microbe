<?php
/*******************************************************************************
 *   Project: Microbe PHP framework
 *   Version: 0.1.0
 *    Module: Mail.class.php
 *     Class: Mail
 *     About: Trivial SMTP mailer
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

class Mail
{
    /**************************************************************************/

    public static function send($mail, $subject, $message) {
        $headers  = "From: MailRobot\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        mail($mail, $subject, $message, $headers);
    }

    /**************************************************************************/

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
        $headers  .= "From: $mailFrom\nReply-To: $mailFrom\n";
    //  $header   .= "Content-Type: multipart/mixed; boundary=\"$bound\"";
        $headers  .= "Content-Type: multipart/mixed; boundary=\"$separator\"";

        if ($filepath && file_exists($filepath)) {
            // Message
            $body  = "--$separator\n";
            $body .= "Content-type: text/html; charset='utf-8'\n";
            $body .= "Content-Transfer-Encoding: quoted-printable";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($filepath))."?=\n\n";
            $body .= $message."\n";
            // File
            $body .= "--$separator\n";
            $file  = fopen($filepath, "r");
            $data  = fread($file, filesize($filepath));
            fclose($file);
            $body .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode(basename($filepath))."?=\n";
            $body .= "Content-Transfer-Encoding: base64\n";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($filepath))."?=\n\n";
            $body .= chunk_split(base64_encode($data))."\n";
            // Finalize
            $body .= "--".$separator ."--\n";
        } else {
            $body  = $message;
        }
    
        $result = mail($mailTo, $subject, $body, $headers);

        return $result;
    }

    /**************************************************************************/
}

/******************************************************************************/