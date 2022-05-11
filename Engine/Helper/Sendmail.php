<?php

namespace Engine\Helper;

class Sendmail
{
    public static function send($params, $emails)
    {
//        $subject = $params['title']; //Заголовок письма
        $subject = "Message info";

        $message = str_replace(array("\r\n", "\r", "\n"), '<br>', $params['message']); //Тестовое сообщение;
        $emailAdminFrom = $emails[count($emails) - 1];

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: От кого письмо <$emailAdminFrom>\r\n";
        $headers .= "Reply-To: $emailAdminFrom\r\n";

        $emlList = '';
        foreach ($emails as $email) {
            $emlList .= $email;
        }

            mail($emlList, $subject, $message, $headers);
    }

}