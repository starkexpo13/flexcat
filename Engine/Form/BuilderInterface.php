<?php


namespace Engine\Form;


use Engine\DI\DI;

abstract class BuilderInterface
{
    private $interface = [];
    protected $attributes = [];
    protected $form;

    protected $textType = 'text'; //
    protected $checkboxType = 'checkbox';
    protected $textareaType = 'textarea';
    protected $selectType = 'select'; //
    protected $selectMultipleType = 'selectMultiple';
    protected $radioType = 'radio';
    protected $switchType = 'switch';//
    protected $hidden = 'hidden';
    protected $button = 'button';//
    protected $reset = 'reset';//
    protected $file = 'file';
    protected $submit = 'submit';//

    protected $service;


    /**
     * BuilderInterface constructor.
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }


    /**
     * @param $name
     * @param $type
     * @param array $options
     * @param array $data
     */
    public function add($name, $type, $options = [], $data = [])
    {
        if (strlen($name) > 0 && strlen($type) > 0) {
            $this->interface[] = [
                'name' => $name,
                'type' => $type,
                'options' => $options,
                'data' => $data
            ];
        }
    }

    /**
     * @return array
     */
    public function getInterface()
    {
        return [
            'interface' => $this->interface,
            'attributes' => $this->attributes
        ];
    }
}