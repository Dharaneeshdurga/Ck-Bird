<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Incubation Details</title>

    <!-- Base Css Files -->
    <link href="<?php echo asset_url();?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="<?php echo asset_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="<?php echo asset_url();?>css/animate.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>css/response_table.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="<?php echo asset_url();?>css/waves-effect.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="<?php echo asset_url();?>css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet" type="text/css" />
    <!-- sweet alerts -->
    <link href="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
    <style>
    .dataTables_filter {
        float: right;
    }

    table {
        width: 100% !important;
    }

    .btn-group {
        margin-top: 15px;
    }

    @media only screen and (max-width: 600px) {
        .btn-group {
            margin-bottom: 5px !important;
            display: inline-grid !important;
            margin-left: 5px;

        }

        .hide_t {
            display: none !important;

        }
    }

    .buttons-columnVisibility {
        display: block;
        padding: 6px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }

    .dt-button-collection {

        max-height: 250px;
        overflow: auto;
        /* overflow-y: hidden; */
        margin: 0 auto;
        white-space: nowrap
    }

    .dt-button-collection>a.active {
        background-color: #38bbf7;
        color: #ffff;
        margin-bottom: 1px;
    }
    .form-horizontal .form-group{
        margin-left: unset;
    }
    @media screen
{
    .noPrint{}
    .visible{display:none;}
}

@media print
{
    .noPrint{display:none;}
    #incub_printtb{display:block;}
}
    </style>
</head>



<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('application/views/layouts/topbar.php'); ?>

        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->

        <?php include('application/views/layouts/sidebar.php'); ?>

        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Incubation Details</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Incubation/add_incubation_details">Add Incubation
                                        Details</a></li>
                                <li class="active">Incubation Details</li>
                            </ol>
                        </div>
                    </div>
                    <?php $message = $this->session->flashdata('message'); ?>
                                <?php $error = $this->session->flashdata('error'); ?>
                                    <?php if (!empty($message)): ?>
                                        <div class="alert alert-success" style="clear:both;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="fa fa-check-circle fa-fw fa-lg"></i>
                                            <strong></strong> <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
            
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger" style="clear:both;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
                                            <i class="fa fa-times-circle fa-fw fa-lg"></i>
                                            <strong></strong><?php echo $error; ?>
                                        </div>              
                                    <?php endif; ?>
                                     <!-- start: alert Message -->
<!-- move to handfeeding modal -->      <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">MOVE</h4> 
                                            </div> 
                                            <form name="move_form" id="move_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label>
                                                            <div id="getid"></div>
                                                             <input type="hidden" name="auto_id" id="auto_id" class="form-control" value="<?php //$last_id=$last_id['id']+1; echo "A00".$last_id; ?>"> 
                                                            <input type="text" name="move_date" id="move_date" class="form-control" value="<?php echo date("d-m-Y");  ?>"> 
                                                     </div>
                                                   <div class="form-group">
                                                            <label for="brooder" class="control-label">SELECT BR0ODER</label>
                                                        <select name="brooder" id="brooder_select" class="select2 form-control" required>
                                                            <option value="">Select brooder</option>
                                                        </select>
                                                        </div> 
                                                    </div> 
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Move</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
                                <div id="weightloss-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="weightloss_export" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                   <div id="weightloss_id"></div>
                                                  
                                                <th>Group Name</th>
                                                <th>Species</th>
                                                <th>Avairy</th>
                                                <th>Cage</th>
                                                <th>Egg no</th>
                                                <th>Weight of Egg</th>
                                                <th>Weight loss percentage</th>
                                                <th>Date of Incubation</th> 
                                            <th>Incubation Period</th>
                                            <th>Pip Date</th>
                                            <th>Hatch Date</th>
                                            <th>Weight Loss Pecentage per day</th>
                                            <th>Total Weight to be Lost</th>
                                            <th>Egg Weight on Hatch Day</th>
                                            <th>Egg weight to be lost per day</th>
                                           
                                           
                                         </tr>
                                            </thead>
                                            <tbody>
                                               <tr>
                                               <td id="group_name"></td>
                                               <td id="species"></td>
                                               <td id="avairy"></td>
                                               <td id="cage"></td>
                                               <td id="eggno"><?php echo 'test';?></td>
                                               <td id="weight_egg"></td>
                                               <td id="weightloss_percent">14% <br> 15%</td>
                                               <td id="date_incubation"></td>
                                               <td id="period_incubation">24</td>
                                               <td id="pip_date"></td>
                                               <td id="hatch_date"></td>
                                               <td id="loss_perday"></td>
                                               <td id="to_lost">1.31 <br> 1.49</td>
                                               <td id="hatch_weight"></td>
                                               <td id="tobe_weight">0.05</td>
                                               </tr>
                                         </tbody> 

                                         <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 5%"><input type="checkbox" name="select_all" id="select_all"></th>
                                                    <th rowspan="2" style="width: 10%">Date</th>
                                                    <th colspan="3" style="width: 25%" scope="colgroup">Weight</th>
                                                    <th rowspan="2" style="width: 10%">Heart Beat</th>
                                                    <th rowspan="2" style="width: 17%">Incubation Name</th>
                                                    <th rowspan="2" style="width: 10%">Humidity</th>
                                                    <th rowspan="2" style="width: 10%">Air Cell Density</th>
                                                    <th rowspan="2" style="width: 13%">Checked By</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">14.00%</th>
                                                    <th scope="col">16.00%</th>
                                                    <th scope="col">Actual</th>
                                                </tr>

                                            </thead>
                                            <tbody id="incub_history_tbody">
                                                
                                         </table> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <!--button type="submit" class="btn btn-info waves-effect waves-light">Move</button--> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->




                    <!-- /.modal -->








                    <div id="brooder_modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="brooder_title"></h4>
                                </div>
                                <form name="incub_status_form" id="incub_status_form" class="form-horizontal form-bordered"
                                    action="<?php echo base_url('index.php/Masters/add_aviary'); ?>" 
                                    data-parsley-validate method="post" autocomplete="off">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="brooder_type" class="control-label">Brooder Type</label>
                                                    <select name="brooder_type" id="brooder_type" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="brooder_33">33 Brooder</option>
                                                        <option value="brooder_34">34 Brooder</option>
                                                        <option value="brooder_35">35 Brooder</option>
                                                        <option value="brooder_36">36 Brooder</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">
                                            Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                        
                                <div class="panel-heading">
                                    <h3 class="panel-title">Incubation Details</h3>
                                </div>
                                <div class="panel-body">
                                <div class="row">
                                     <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>index.php/Incubation/add_incubation_details"><button
                                            class="btn btn-primary waves-effect waves-light">Add Incubation</button></a>
                                   
</div>         
<div class="col-md-2">
                                         <!-- <a href="<?php //echo base_url('index.php/Download_sample/incubation_Download'); ?>" class="btn btn-info waves-effect waves-light" ><i class="fa fa-pencil-square-o"></i>Download Sample</a> -->
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <form id="incub_sample" action="<?php echo base_url("index.php/Download_sample/incubation_upload") ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                              <div class="col-md-3">  
                                                 <button class="btn btn-sm btn-success" style="font-size: 14px;"> <input type="file"  name="uploadFile" /></button>
                                                 </div>
                                                <div class="col-md-3">             
                                                    <input type="submit" name="submit"  style="font-size: 14px; margin-left:20px;"  class="btn btn-sm btn-success" value="Upload" />
                                                   </div>
                                             </div>
                                          </form> -->
                                       </div>                             
                                    </div>

<div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                            <table class="visible table table-striped table-bordered" id="incub_printtb">
                                                    <thead>
                                                        <tr>
                                                        <th>S.no</th>
                                                            <th>Group</th>
                                                            <th>Bird Species</th>
                                                            <th>Avairy</th>
                                                            <th>Cage</th>
                                                            <th>Male Parent Ring No</th>
                                                            <th>Female Parent Ring No</th>
                                                            <th>Egg No</th>
                                                            <th>DOI</th>
                                                            <th>Health Status</th>
                                                            <th>Egg Weight</th>
                                                            <th>Fertile Type</th>
                                                            <th>DOF</th>
                                                            <th>Remark</th>
                                                            <th>Pip weight</th>
                                                            <th>Pip date</th>
                                                            <th>Hatch Weight</th>
                                                            <th>Hatch Date</th>
                                                            <th>Shell Weight</th>
                                                            <th>Hatch type</th>
                                                            <th>Shell Thick</th>
                                                            <th>DIS Type</th>
                                                           <th>DIS Date</th>
                                                         
                                                            <!--my code-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>
                                                </table>
                                            
                                            
                                            <table class="table table-striped table-bordered" id="incub_tb">
                                                    <thead>
                                                        <tr>
                                                            <th class="noExport">#</th>
                                                            <th>Sno</th>
                                                            <th>Group</th>
                                                            <th>Bird Species</th>
                                                            <th>Avairy</th>
                                                            <th>Cage</th>
                                                            <th>Male Parent Ring No</th>
                                                            <th>Female Parent Ring No</th>
                                                            <th>Egg No</th>
															<th>Standard Egg weight</th>
                                                            <th>Egg Weight</th>
															<th>Standard Hatch weight</th>
															<th>Hatch Weight</th>
															<th>Fertile Type</th>
															<th>Date(Egg type)</th>
															<th>Remark</th>
															<th>PIP Weight</th>
															<th>PIP Date</th>
															<th>DOI</th>
															<th>Hatch Date</th>
															<th>Shell Weight</th>
															<th>Hatch Type</th>
															<th>Shell Thick</th>
															<th>DIS Type</th>
															<th>DIS Date</th>
															<th>Egg Length</th>
															<th>Egg Breadth</th>
															<th>Egg index</th>
															<th>Shell layer</th>
															<th>Hatch Time</th>
															<th>Moved_time</th>
															<th>Bos Date</th>
															<th>Lay to pip hatch weight</th>
															<th>Health Status</th>
                                                            <th class="noExport">Action</th>
                                                            <th class="noExport">Weight Loss History</th>
                                                            <th>Cltuch No</th>
                                                            <th>Egg No In Clutch</th>
															<th>Bos Findings</th>
                                                            <!--my code-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>
                                                </table>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->
					<div id="health-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 					<div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Change Health Status</h4> 
                                            </div> 
                                            <form name="health_form" id="health_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label><br>
                                                            <div id="health_id"></div>
                                                            <input type = "date"  name="hs_date" class="form-control" id="hs_date" required />	
                                                     </div>
                                                     <div class="form-group"> 
                                                            <label for="Date" class="control-label">Status</label><br>
                                                            <div id="pid"></div>
                                                            <select name="health_status" class="form-control" id="health_status" required >	
                                                            <option value="">Select Status</option>
															<option>Healthy chick</option>
															<option>Low hatch weight chick</option>
															<option>Unabsorbed yolk sac</option>
															<option>Yolk sac infection chick</option>
															<option>Splayed leg chick</option>
															<option>Wry neck chick</option>
                                                               </select>
                                                     </div>
                                                    
                                                    </div> 
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Change</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->

                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('application/views/layouts/footer.php'); ?>


        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <?php include('application/views/layouts/right_sidebar.php'); ?>

        <!-- /Right-bar -->


    </div>
    <!-- END wrapper -->

    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url();?>js/waves.js"></script>
    <script src="<?php echo asset_url();?>js/wow.min.js"></script>
    <script src="<?php echo asset_url();?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo asset_url();?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo asset_url();?>jquery-detectmobile/detect.js"></script>
    <script src="<?php echo asset_url();?>fastclick/fastclick.js"></script>
    <script src="<?php echo asset_url();?>jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo asset_url();?>jquery-blockui/jquery.blockUI.js"></script>

    <!--Data Tables js-->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
 <!-- Notification -->
 <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
        <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
        <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
    <!-- CUSTOM JS -->
    <script src="<?php echo asset_url();?>js/jquery.app.js"></script>
    <script src="<?php echo base_url();?>assets/pro_js/incub_list.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";

    $(document).ready(function() {
        $('#weightloss_export').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
        $('.btn-group button').removeClass('btn-outline-primary');
        $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

        var page = "incubation";

        if (page == "incubation") {
            $('.incubation_m').click();
            // $('.incubation_li a').addClass('subdrop');

            $(".add_incubation_m").addClass("active");
        }

    });
    $('#move_form').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/move_handfeeding', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Successfully Moved to Handfeeding..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL +data.url;
                    }, 
                2000);
                    
            }
            else{
                $.Notification.autoHideNotify(
                    'danger', 
                    'top right', 
                    'Request Failed..! Try Again..!',
                    ''
                );
            }
                    
        }  
    }); 
    
});
    </script>
</body>

</html>
