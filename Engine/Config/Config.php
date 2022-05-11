<?php

namespace Engine\Config;

class Config
{
    public static function item($key, $group = 'main')
    {
        $groupItems = self::file($group);

        return isset($groupItems[$key]) ? $groupItems[$key] : null;
    }

    public static function file($group)
    {
        $path = $_SERVER['DOCUMENT_ROOT']. '/Config/' . $group . '.php';

        if (file_exists($path)) {
            $item = require $path;

            if (!empty($item)) {
                return $item;
            } else {
                throw new \Exception(
                    sprintf('Config file <strong>%s</strong> is not valid array.', $path)
                );
            }
        } else {
            throw new \Exception(
                sprintf('Cannot load config from file, file <strong>%s</strong> does not exist.', $path)
            );
        }

        return false;
    }
}