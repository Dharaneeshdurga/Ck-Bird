<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Hand feeding Details</title>

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
        <link href="<?php echo base_url();?>assets/notifications/notification.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>select2/select2.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
        <style>
            .dataTables_filter{
                float :right;
            }

            table{
                width:100% !important;
            }
            .btn-group{
                margin-top: 15px;
            }
            @media only screen and (max-width: 600px) {  
                .btn-group{
                    margin-bottom: 5px !important;
                    display: inline-grid !important;
                    margin-left: 5px;

                }

                .hide_t{
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
            .dt-button-collection{
                
                max-height: 250px;
                overflow: auto;
                /* overflow-y: hidden; */
                margin: 0 auto;
                white-space: nowrap
            }
            .dt-button-collection >a.active{
                background-color: #38bbf7;
                color: #ffff;
                margin-bottom: 1px;
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
                            <!--div class="col-sm-12">
                                <h4 class="pull-left page-title">Incubation Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php// echo base_url(); ?>Incubation/add_incubation_details">Add Incubation Details</a></li>
                                    <li class="active">Incubation Details</li>
                                </ol>
                            </div>
                        </div-->
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Handfeeding Details</h3>
                                    </div>
                                    <div class="panel-body">
                                        <!--a href="<?php //echo base_url(); ?>Incubation/add_incubation_details"><button class="btn btn-primary waves-effect waves-light">Add Incubation</button></a-->
                                        <div class="row">
                                        <div class="col-md-2">
                                         <a href="<?php echo base_url('index.php/Download_sample/handfeeding_Download'); ?>" class="btn btn-info waves-effect waves-light" ><i class="fa fa-pencil-square-o"></i>Download Sample</a>
                                    </div>
                                    <div class="col-md-8">
                                        <form id="incub_sample" action="<?php echo base_url("index.php/Download_sample/handfeeding_upload") ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                              <div class="col-md-3">  
                                                 <button class="btn btn-sm btn-success" style="font-size: 14px;"> <input type="file"  name="uploadFile" /></button>
                                                 </div>
                                                <div class="col-md-3">             
                                                    <input type="submit" name="submit"  style="font-size: 14px; margin-left:20px;"  class="btn btn-sm btn-success" value="Upload" />
                                                   </div>
                                             </div>
                                          </form>
                                       </div>                             
                                    </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="handfeeding_tb">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Sno</th>
                                                                <th>Group</th>
                                                                <th>Bird Species</th>
                                                                <th>Avairy</th>
                                                                <th>Cage</th>
                                                                <th>Male Parent Ring No</th>
                                                                <th>Female Parent Ring No</th>
                                                                <th>Egg No</th>
                                                                <th>Moved on</th>
                                                                <th>Brooder Name</th>
                                                                <!-- <th>Stunt Status</th> -->
                                                                <!-- <th>Health Status</th> -->
                                                                <th>Action</th>
                                                                <th>View Handfeed History</th>
                                                                
                                                                <!--th>Action</th-->
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
                   <!--change brooder modal--->     <div id="change-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">MOVE TO BROODER</h4> 
                                            </div> 
                                            <form name="move_brooder_form" id="move_brooder_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
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
                                                        <select name="brooder" id="brooder_select" class="select2" required>
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
                           <!-- pre weaning modal-->     <div id="preweaning-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">MOVE TO PRE WEANING</h4> 
                                            </div> 
                                            <form name="preweaning_form" id="preweaning_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label><br>
                                                            <div id="pid"></div>
                                                            <input type = "date"  name="p_date" class="form-control" id="p_date" required/>	
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
 <!--move to sale modal-->     <div id="movesale-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">MOVE TO SALE</h4> 
                                            </div> 
                                            <form name="product_form" id="product_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label><br>
                                                            <div id="hid"></div>
                                                            <input type = "date"  name="pr_date" class="form-control" id="pr_date" required />	
                                                     </div>
                                                     <div class="form-group"> 
                                                            <label for="Date" class="control-label">Gender</label><br>
                                                            <div id="pid"></div>
                                                            <select name="gender" class="form-control" id="gender">	
                                                            <option value="">Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
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
                                                            <select name="health_status" class="select2" id="health_status" required >	
                                                            <option value="">Select Status</option>
															<option>Mortality</option>
															<option>Cured</option>
															<option>Yolk sac infection</option>
															<option>Obesity</option>
															<option>E.coli infection</option>
															<option>Wry neck</option>
															<option>Aspiration Pneumonia</option>
															<option>Slow digestion </option>
															<option>Crop burn</option>
															<option>Crop injury</option>
															<option>Oesophageal injury</option>
															<option>Respiratory distress</option>
															<option>Dehydration</option>
															<option>Unabsorbed yolk sac</option>
															<option>Air in the crop</option>
															<option>Traumatic injury</option>
															<option>Stunted chick</option>
															<option>Reduced crop size</option>
															<option>Splayed leg</option>
															<option>Fungal infection</option>

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
		<script src="<?php echo asset_url();?>select2/select2.min.js" type="text/javascript"></script>


        <script src="<?php echo base_url();?>assets/pro_js/handfeed_list.js"></script>
        <!-- <script src="<?php //echo base_url();?>assets/pro_js/pre_weaning.js"></script> -->
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {

                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

                var  page="handfeeding";

                if(page=="handfeeding"){
                    $('.handfeeding_m').click();

                    $(".add_handfeeding_m").addClass("active");
                }

            });
			   // Select2
			   jQuery(".select2").select2({
                    width: '100%',

                });
        </script>    
	</body>
</html>
