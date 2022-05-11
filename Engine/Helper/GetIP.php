<?php


namespace Engine\Helper;


class GetIP
{
    /**
     * @return string
     */
    public static function ip()
    {
            $keys = [
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'REMOTE_ADDR'
            ];

            foreach ($keys as $key) {
                if (!empty($_SERVER[$key])) {
                    $ip = trim(end(explode(',', $_SERVER[$key])));
                    if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        return $ip;
                    }
                }
            }

       return $ip;
    }


    /**
     * @return mixed
     */
    public static function clientIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        return $ip;
    }
}