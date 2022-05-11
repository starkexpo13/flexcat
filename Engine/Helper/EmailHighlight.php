<?php

namespace Engine\Helper;

use Dotenv\Dotenv;

class EmailHighlight
{
    /**
     * @param string $text
     * @return mixed|string
     */
    public static function translate($text = '')
    {
        preg_match_all('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/', $text, $potentialEmails, PREG_SET_ORDER);
        $potentialEmailsCount = count($potentialEmails);
        for ($i = 0; $i < $potentialEmailsCount; $i++) {
            if (filter_var($potentialEmails[$i][0], FILTER_VALIDATE_EMAIL)) {
                $text = str_replace($potentialEmails[$i][0], '<a href="mailto:' . $potentialEmails[$i][0] . '">' . $potentialEmails[$i][0] . '</a>', $text);
            }
        }

        return $text;
    }

    /**
     * @param string $text
     * @return array
     * */
    public static function getEmails($text)
    {
        $pattern = '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/';

        preg_match_all($pattern, $text, $result);

        return $result[0];
    }

    /**
     * @param string $text
     * @return string
     */
    public static function toArray($text = '')
    {
        preg_match_all('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/', $text, $potentialEmails, PREG_SET_ORDER);
        $potentialEmailsCount = count($potentialEmails);
        $text = "";
        for ($i = 0; $i < $potentialEmailsCount; $i++) {
            if (filter_var($potentialEmails[$i][0], FILTER_VALIDATE_EMAIL)) {
                $text .= $potentialEmails[$i][0] . " ";
            }
        }

        return $text;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function domainCheck($email)
    {
        $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $config = $dotenv->load();

        $res = self::getEmails($email);

        if (strlen($res[0]) <= 1) {
            return false;
        }

        $arrayDomain = explode(',', trim($config['EMAIL_DOMAIN']));
        foreach ($arrayDomain as $item) {
            if (preg_match('/@' . trim($item) .'$/i', $email)) {
                return true;
            }
        }

        return false;
    }
}