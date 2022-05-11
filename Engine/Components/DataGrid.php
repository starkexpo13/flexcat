<?php


namespace Engine\Components;


class DataGrid
{
    private $headTitles = [];
    private $fields = [];
    public $models = [];
    private $title;
    private $buttons = 'off';
    public $description;
    private $ownLink;
    private $actions;
    private $filter = 'off';
    public $filterData;
    private $filterLink;
    private $filterTitle;
    private $filterDefault;
    public $customJS = '';

    /**
     * DataGrid constructor.
     * @param $config
     */
    public function __construct($config)
    {
        if (isset($config['headTitles'])) {
            $this->headTitles = $config['headTitles'];
        }
        if (isset($config['fields'])) {
            $this->fields = $config['fields'];
        }
        if (isset($config['title'])) {
            $this->title = $config['title'];
        }
        if (isset($config['buttons'])) {
            $this->buttons = $config['buttons'];
        }
        if (isset($config['ownLink'])) {
            $this->ownLink = $config['ownLink'];
        }
        if (isset($config['actions'])) {
            $this->actions = $config['actions'];
        }
        if (isset($config['filter'])) {
            $this->filter = $config['filter'];
        }
        if (isset($config['filterData'])) {
            $this->filterData = $config['filterData'];
        }
        if (isset($config['filterLink'])) {
            $this->filterLink = $config['filterLink'];
        }
        if (isset($config['filterTitle'])) {
            $this->filterTitle = $config['filterTitle'];
        }
        if (isset($config['filterDefault'])) {
            $this->filterDefault = $config['filterDefault'];
        }
    }

    /**
     * show
     */
    public function render()
    {
        $this->header();
        $this->grid();
        $this->footer();
        $this->renderScript();
    }

    /**
     * table grid
     */
    protected function grid()
    {
        echo '<div class="card">';
        $this->handler();

        echo '<div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead><tr>';

        foreach ($this->fields as $keyHead => $field) {
            $thWidth = '';
            foreach ($this->headTitles as $head) {
                if ($head['field'] == $keyHead && isset($head['width'])) {
                    $thWidth = ' width="' . $head['width'] . '"';
                }
            }
            echo '<th ' . $thWidth . ' >' . $field . '</th>';
        }

        foreach ($this->actions as $action) {
            if (isset($action['action'])) {
                echo '<th width="20"></th>';
            }
        }


        echo '</tr></thead>
                   <tbody>';

        foreach ($this->models as $model) {
            $tr = '';
            $tr .= '<tr>';
            $fieldTrue = false;
            foreach ($this->fields as $keyHead => $field) {
                if (strlen($model->{$keyHead})) {
                    $tr .= '<td>' . $model->{$keyHead} . '</td>';
                    $fieldTrue = true;
                }
            }

            foreach ($this->actions as $action) {
                if (isset($action['action'])) {
                    $achtionHTML = '<a href="/admin' . $this->ownLink . $action['action'] . '/' . $model->id .
                        '" title="' . $action['title'] .
                        '" class="buttonData '. $action['class'] .'" style="' . $action['style'] .
                        '"'. $action['data'] .'><i class="' . $action['icon'] . '"></i></a>';

                    $tr .= '<td width="20">' . $achtionHTML . '</td>';
                }
            }

            $tr .= '</tr>';

            if ($fieldTrue === true) {
                echo $tr;
            }
        }


        echo '</tbody>                                  
                                </table>
                            </div>                           
                        </div>';
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
                    <div class="col-12">';
    }

    /**
     * toolbar
     */
    protected function handler()
    {
        if (strlen($this->description) > 0 || $this->filter == 'on') {
            echo '<div class="card-header"><div class="row">';
            if (strlen($this->description) > 0) {
                echo '<div class="col-md-8">' . $this->description . '</div>';
            }

            if ($this->filter == 'on' && count($this->filterData) > 0) {
                $filterOption = '';
                $selected = '';
                foreach ($this->filterData as $key => $item) {
                    if ($this->filterLink . $key == $this->filterLink . $this->filterDefault) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = '';
                    }
                    $filterOption .= '<option value="' . $this->filterLink . $key . '" ' . $selected . '>' . $item . '</option>';
                }

                echo '<div class="col-md-4"><div class="form-group">
                  <label>' . $this->filterTitle . '</label>
                  <select class="form-control select2" style="width: 100%;">
                    ' . $filterOption . '                   
                  </select>
                </div></div>';
            }
            echo '</div></div>';
        }
    }


    /**
     * footer
     */
    protected function footer()
    {
        echo '</div>                  
              </div>                
            </div>          
        </section></div>';
    }

    /**
     * render JS
     */
    protected function renderScript()
    {
        $scriptRender = '';
        if ($this->buttons == 'on') {
            $scriptRender .= ' $("#example1").DataTable().buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)"); ';
        }

        if ($this->filter == 'on') {
            $scriptRender .= ' $(".select2").select2({
                theme: "bootstrap4"
            }); ';

            $scriptRender .= ' $(".select2").on("change", function () {
               window.location.href =  $(this).val();
            }); ';
        }

        echo '
    <script src="/admin/Assets/plugins/jquery/jquery.min.js"></script>
    <script src="/admin/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/Assets/plugins/select2/js/select2.full.min.js"></script>

    <script src="/admin/Assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/Assets/plugins/jszip/jszip.min.js"></script>
    <script src="/admin/Assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/admin/Assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/admin/Assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/Assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   
    <script src="/admin/Assets/dist/js/adminlte.min.js"></script>
    <script src="/admin/Assets/dist/js/demo.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "language": {
                    "info": "Страница _PAGE_ из _PAGES_",                                                    
                    "infoEmpty": "0 страниц",
                    "search":         "Поиск:",
                    "zeroRecords":    "Ничего не найдено",
                    "infoFiltered":   "(отфильтровано из  _MAX_ записей)",
                    "paginate": {
                        "first":      "Первая",
                        "last":       "Последняя",
                        "next":       "Следующая",
                        "previous":   "Предидущая"
                    }
                }
            });                                           
            
            ' . $scriptRender . '
            
            /*$("#example2").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });*/
            
                       
        });        
    </script>';
        echo $this->customJS;
    }
}