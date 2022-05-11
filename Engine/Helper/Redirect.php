<?php


namespace Engine\Helper;


class Redirect
{
    public static function reload($link)
    {
        $url = \Core_LinkProxy::getLink() . $link;

        echo "<script>
                    window.location.href = '". $url ."';
              </script>";
    }
}