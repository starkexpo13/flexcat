<?php

namespace Engine\Helper;


class SearchFileFolder
{
    /**
     * @param $pathFolder
     * @param $fileKeyName
     * @param $fileType
     * @return bool|string
     */
    public static function find($pathFolder, $fileKeyName, $fileType)
    {
        if ($handle = opendir($pathFolder)) {
            while (false !== ($file = readdir($handle))) {
                $result =  preg_match('/.*' . $fileKeyName . '.*.'. $fileType .'?.*/i', $file);
                if ($result) {
                    return $pathFolder  . $file;
                }
            }
        }

        return false;
    }
}