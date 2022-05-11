<?php


namespace Engine\Components;


use Engine\Form\BuilderInterface;

class Form
{
    private $fields = [];
    public $models = [];
    private $title;
    private $colors = [
        'blue' => 'primary',
        'green' => 'success',
        'red' => 'danger',
        'yellow' => 'warning',
        'lightBlue' => 'info',
        'gray' => 'secondary',
        'default' => 'default'
    ];
    private $color = 'gray';
    private $ownLink;
    public $description = '&nbsp;';
    private $method = 'post';
    public $customForm = '';
    public $customJS = '';


    /**
     * Form constructor.
     * @param $config
     */
    public function __construct($config)
    {
        if (isset($config['fields'])) {
            $this->fields = $config['fields'];
        }
        if (isset($config['title'])) {
            $this->title = $config['title'];
        }
        if (isset($config['color']) && strlen($config['color']) > 0) {
            $this->color = $config['color'];
        }
        if (isset($config['ownLink'])) {
            $this->ownLink = $config['ownLink'];
        }
    }

    /**
     * show
     */
    public function render()
    {
        $this->header();
        $this->form();;
        $this->footer();
        $this->renderScript();
    }

    /**
     * form builder
     */
    public function form()
    {
        echo '<form action="/' . mb_strtolower(ENV) . $this->ownLink . 'update/" method="' . $this->method . '" class="form-horizontal" style="margin: 0;"><div class="card-body">';
        $buttons = '';

        foreach ($this->fields['interface'] as $field) {
            $label = '';
            if (strlen($field['options']['label']) > 1) {
                $label = '<label for="' . $field['name'] . '_id">' . $field['options']['label'] . '</label>';
            }
            if (strlen($field['options']['placeholder']) > 0) {
                $placeholder = ' placeholder="' . $field['options']['placeholder'] . '"';
            } else {
                $placeholder = '';
            }
            if (strlen($field['options']['disabled'] == 'true')) {
                $disabled = ' disabled';
            } else {
                $disabled = '';
            }
            if (strlen($field['options']['readonly'] == 'true')) {
                $readonly = ' readonly';
            } else {
                $readonly = '';
            }
            if ($field['options']['class']) {
                $class = $field['options']['class'];
            } else {
                $class = ' ';
            }
            $value = '';
            $fieldName = $field['name'];
            if (isset($this->models->{$fieldName}) && strlen($this->models->{$fieldName}) > 0) {
                $value = $this->models->{$fieldName};
            }
            if ($field['options']['numericOnly'] == true) {
                $numericOnly = ' numericOnly ';
            } else {
                $numericOnly = '';
            }
            if ($field['options']['required'] == true) {
                $required = ' required';
                $requiredLabel = '*';
            } else {
                $required = '';
                $requiredLabel = '';
            }


            if ($field['type'] == 'text') {
                echo '<div class="form-group">' .$requiredLabel . $label .
                    '<input type="text" name="' . $field['name'] . '" class="form-control ' . $numericOnly . $class . '" id="' . $field['name'] . '_id" ' . $placeholder . $disabled . $readonly . ' value="' . $value . '" '. $required .'></div>';
            }
            if ($field['type'] == 'button' || $field['type'] == 'submit' || $field['type'] == 'reset') {
                if (strlen($field['options']['color']) > 0) {
                    $buttonColor = $this->colors[$field['options']['color']];
                } else {
                    $buttonColor = 'default';
                }
                $buttons .= '<button type="' . $field['type'] . '" name="' . $field['name'] . '" class="btn btn-' . $buttonColor . ' mr-1 ' . $class . '" ' . $disabled . $readonly . '>' . $field['options']['label'] . '</button>';
            }
            if ($field['type'] == 'switch') {
                if ($value == '1') {
                    $switchCheked = ' checked="checked"';
                } else {
                    $switchCheked = '';
                }
                echo '<div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="' . $field['name'] . '" class="custom-control-input ' . $class . '" id="' . $field['name'] . '_id" ' . $disabled . $readonly . $switchCheked . ' value="1">
                      <label class="custom-control-label" for="' . $field['name'] . '_id">' . $field['options']['label'] . '</label>
                    </div>
                  </div>';
            }
            if ($field['type'] == 'select') {
                $optionsHtml = '';
                if (isset($field['options']['value'])) {
                    foreach ($field['options']['value'] as $keyOption => $option) {
                        if (isset($field['options']['default']) && $field['options']['default'] == $keyOption) {
                            $selected = ' selected="selected"';
                        } else {
                            $selected = '';
                        }
                        if (intval($value) == intval($keyOption)) {
                            $selected = ' selected="selected"';
                        }

                        $optionsHtml .= '<option value="' . $keyOption . '" ' . $selected . '>' . $option . '</option>';
                    }
                }
                if (strlen($field['options']['placeholder']) > 0) {
                    $placeholder = '<option>' . $field['options']['placeholder'] . '</option>';
                }
                echo '<div class="form-group">
                        ' . $label . '
                        <select name="' . $field['name'] . '" class="custom-select ' . $class . '" ' . $disabled . '>
                           ' . $placeholder . '
                          ' . $optionsHtml . '                       
                        </select>
                      </div>';
            }
            if ($field['type'] == 'hidden') {
                if (isset($field['options']['value']) && strlen($field['options']['value']) > 0) {
                    $value = $field['options']['value'];
                }
                echo '<input type="hidden" name="' . $field['name'] . '" value="' . $value . '">';
            }
        }

        echo $this->customForm;
        if (strlen($buttons) > 0) {
            echo '</div><div class="card-footer" >' . $buttons . '<a href="' . \Core_LinkProxy::getLink() . '/admin' . $this->ownLink . 'listing/' . '" type="button" class="btn btn-default float-right">Отмена</a>
                </div>';
        } else {
            echo '</div>';
        }
        echo '</form>';
    }

    /**
     * header
     */
    protected function header()
    {
        echo '<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>' . $this->title . '</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="' . \Core_LinkProxy::getLink() . '/admin">Главная</a></li>
                        <li class="breadcrumb-item active">' . $this->title . '</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-' . $this->colors[$this->color] . '">
                        <div class="card-header">
                            <h3 class="card-title">' . $this->description . '</h3>
                        </div>';
    }

    /**
     * footer
     */
    protected function footer()
    {
        echo '</div>
                </div>
            </div>
        </div>
    </section>
</div>';
    }

    /**
     * render JS
     */
    protected function renderScript()
    {
        $scriptRender = '';

        echo '
    <script src="/admin/Assets/plugins/jquery/jquery.min.js"></script>
    <script src="/admin/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/Assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/admin/Assets/dist/js/adminlte.min.js"></script>
    <script src="/admin/Assets/dist/js/demo.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            
            ' . $scriptRender . '
            
            jQuery.fn.ForceNumericOnly =
            function (sdrer) {
                return this.each(function () {
                    $(this).keydown(function (e) {
                        var key = e.charCode || e.keyCode || 0;
                        // Разрешаем backspace, tab, delete, стрелки, обычные цифры и цифры на дополнительной клавиатуре
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 46 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                    });
                });
            };
            
            $(".numericOnly").ForceNumericOnly();
        });
    </script>';
        echo $this->customJS;
    }
}