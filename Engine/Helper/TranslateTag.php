<?php

namespace Engine\Helper;

class TranslateTag
{
    var $vars = array();
    var $content;

    public function set($name, $val)
    {
        $this->vars[$name] = $val;
    }

    public function out_content($message)
    {
        $this->content = $message;

        foreach ($this->vars as $key => $val) {
            $this->content = str_replace($key, $val, $this->content);
        }

        return $this->content;
    }
}