<?php
$this->load->view('templates/header');
?>
<div class="row">
    <div class="col-lg-12">
        <h1>Import/Upload Excel file into MySQL using Codeigniter</h1>        
        
<a class="pull-right btn btn-info btn-xs" style="margin: 2px" href="<?php echo HTTP_UPLOAD_IMPORT_PATH;?>upload.xlsx"><i class="fa fa-file-excel-o"></i> Download Format</a>  
<a class="pull-right btn btn-primary btn-xs" style="margin: 2px" href="http://techarise.com/import-excel-file-mysql-codeigniter/"><i class="fa fa-mail-reply"></i> Tutorial</a>          
    </div>
</div><!-- /.row -->
<?php
$output = '';
$output .= form_open_multipart('index.php/Import/save');
$output .= '<div class="row">';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$output .= form_label('Choose file', 'image');
$data = array(
    'name' => 'userfile',
    'id' => 'userfile',
    'class' => 'form-control filestyle',
    'value' => '',
    'data-icon' => 'false'
);
$output .= form_upload($data);
$output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span></div>';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary',
    'value' => 'Import',
);
$output .= form_submit($data, 'Import Data');
$output .= '</div>
                        </div></div>';
$output .= form_close();
echo $output;
?>
<?php
$this->load->view('templates/footer');
?>
