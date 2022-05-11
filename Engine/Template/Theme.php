<?php

namespace Engine\Template;

class Theme
{
    const RULES_NAME_FILE = [
        'header' => 'header-%s',
        'footer' => 'footer-%s',
        'sidebar' => 'sidebar-%s'
    ];

    const URL_THEME_MASK = 'View/Theme/%s';

    public $url = '';
    protected $data = [];

    public static function getUrl()
    {

    }

    /**
     * @param null $name
     * @throws \Exception
     */
    public function header($name = null, $data = '')
    {
        $name = (string)$name;
        $file = 'header';

        if ($name !== '') {
            $file = sprintf(self::RULES_NAME_FILE['header'], $name);
        }

        $this->loadTemplateFile($file, $data);
    }

    /**
     * @param string $name
     * @throws \Exception
     */
    public function footer($name = '')
    {
        $name = (string)$name;
        $file = 'footer';

        if ($name !== '') {
            $file = sprintf(self::RULES_NAME_FILE['footer'], $name);
        }

        $this->loadTemplateFile($file);
    }

    /**
     * @param string $name
     * @throws \Exception
     */
    public function sidebar($name = '')
    {
        $name = (string)$name;
        $file = 'sidebar';

        if ($name !== '') {
            $file = sprintf(self::RULES_NAME_FILE['sidebar'], $name);
        }

        $this->loadTemplateFile($file);
    }

    /**
     * @param string $name
     * @param array $data
     * @throws \Exception
     */
    public function block($name = '', $data = [])
    {
        $name = (string)$name;

        if ($name !== '') {
            $this->loadTemplateFile($name, $data);
        }
    }

    /**
     * @param $nameFile
     * @param array $data
     * @throws \Exception
     */
    private function loadTemplateFile($nameFile, $data = [])
    {
        if (ENV == 'cms') {
            $pathDir = '/cms/Main/View/';
        } else {
            $pathDir = '/Main/View/';
        }

        $templateFile = ROOT_DIR . $pathDir . $nameFile . '.php';

        if (is_file($templateFile)) {
            extract($data);

            require $templateFile;
        } else {
            throw new \Exception(
                sprintf('View file %s does not exist!', $templateFile)
            );
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}