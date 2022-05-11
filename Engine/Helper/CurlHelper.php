<?php


namespace Engine\Helper;


class CurlHelper
{
    private $url;
    private $header;

    public function __construct()
    {

    }

    public function request($jsonDecode = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $return = curl_exec($ch);

        if(curl_exec($ch) === false)
        {
            echo 'Ошибка: ' . curl_error($ch);
        }

        curl_close($ch);

        if ($jsonDecode === true) {
            return json_decode($return, true);
        } else {
            return $return;
        }
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function setJSONHeader($token = null)
    {
        $header = [
            'Content-Type: application/json',
        ];

        if ($token !== null) {
            $header[] = 'Authorization: '.$token;
        }

        $this->setHeader($header);

    }

    public function getTokenCode()
    {
        return str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
    }
}