<?php


namespace Engine\Helper;


class SimpleCSV
{
    /**
     * @param $pathFile
     * @return array|bool
     */
    public static function getData($pathFile)
    {
        $dataList = [];
        $i = 0;

        if (file_exists($pathFile)) {
            if (($fp = fopen($pathFile, "r")) !== false) {

                while (($data = fgetcsv($fp, 0, ";")) !== false) {
                    if ($i <= 0) {
                        $arrayKey = [];

                        foreach ($data as $val) {
                            $arrayKey[] = $val;
                        }
                    } else {
                        $dataTMP = [];

                        for ($j = 0; $j < count($arrayKey); $j++) {
                            $key = $arrayKey[$j];
                            $dataTMP[$key] = $data[$j];

                            $dataTMP[$key] = str_replace( "&#59", ';', $dataTMP[$key]);
                        }

                        $dataList[] = $dataTMP;
                        unset($dataTMP);
                    }
                    $i++;
                }
                fclose($fp);
            }
        }

        return is_array($dataList) ? $dataList : false;
    }
}