<?php


namespace Engine\Helper;


class GetNameClass
{
    public static function class_basename($namespace)
    {
        $temp = explode('\\', $namespace); //  разделяем строку по символу "\"
        $class_name = end($temp);

        return $class_name;
    }
}