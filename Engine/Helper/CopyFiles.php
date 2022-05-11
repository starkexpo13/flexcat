<?php


namespace Engine\Helper;


class CopyFiles
{
    /**
     * @param $pathFrom
     * @param $pathTo
     * @param $arrayTypes
     * @return array|bool
     */
    public static function copy($pathFrom, $pathTo, $arrayTypes)
    {
        $pathUploadFolder = $pathTo;
        if (!is_dir($pathUploadFolder)) {
            mkdir($pathUploadFolder, 0777, true);
        }

        if ($handle = opendir($pathFrom)) {
            $dataFiles = [];

            while (false !== ($file = readdir($handle))) {
                if ($file !== '.' && $file !== '..') {
                    $fileType = self::getTypeFile($file);

                    if (in_array($fileType, $arrayTypes)) {
                        $dataFiles[] = $file;
                        $newFile = $pathUploadFolder . $file;
                        $from = $pathFrom . $file;

                        copy($from, $newFile);
                        unlink($from);
                    }
                }
            }
            closedir($handle);
        }

        return count($dataFiles) > 0 ? $dataFiles : false;
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public static function getTypeFile($fileName)
    {
        return end(explode(".", $fileName));
    }

    /**
     * @param $string
     * @return array|bool
     */
    public static function getArrayInStingFiles($string)
    {
        $resultArray = [];
        $arrayString = explode(";", $string);

        foreach ($arrayString as $item) {
            if (strlen($item) > 1) {
                $key = self::getTypeFile($item);
                $resultArray[$key] = $item;
            }
        }
        return count($arrayString) > 0 ? $resultArray : false;
    }
}