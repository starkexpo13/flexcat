<?php

namespace Engine\Template;

use Engine\Template\Theme;

class View
{
    protected $theme;

    const MASK_VIEW_ENTITY = '\%s\%s\View';

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->theme = new Theme();

    }

    /**
     * @param $template
     * @param array $vars
     * @throws \Exception
     */
    public function render($template, $vars = [])
    {
        $templatePath = $this->getTemplatePatch($template, ENV);

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(
                sprintf('View "%s" not found in "%s"', $template, $templatePath)
            );
        }

        $this->theme->setData($vars);
        extract($vars);

        ob_start();
        ob_implicit_flush(0);

        try {
            require $templatePath;

        } catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        echo ob_get_clean();
    }

    /**
     * @param $template
     * @param null $env
     * @return string
     */
    private function getTemplatePatch($template, $env = null)
    {
        $explode = explode('/', $template);

        if (ENV == 'cms') {
            $pathDir = '/cms/' . $explode[0] . '/View/' . $explode[1];
        } else {
            $pathDir =  "/" . $explode[0] . '/View/' . $explode[1];
        }

        return ROOT_DIR . $pathDir  . '.php';
    }
}