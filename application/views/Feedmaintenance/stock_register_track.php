<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?>Stock Register Track</title>

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

        
        <link href="<?php echo base_url();?>assets/select2/select2.css" rel="stylesheet" type="text/css" />

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

            .select2-choice {
                height: 35px !important;
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
                    <div class="row">
                           <div class="col-sm-12">
                                <h4 class="pull-left page-title">ADD STOCK DETAILS</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php echo base_url(); ?>index.php/Feedmaintenance/new_stock">Back to month wise stock</a></li>
                                    <li class="active">ADD STOCK DETAILS</li>
                                </ol>
                            </div>
                        </div>
                    <div id="stock-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">ADD STOCK DETAILS</h4> 
                                            </div> 
                                          
                                              <div class="modal-body"> 
                                               <form name="stock_form" id="stock_form" class="form-horizontal form-bordered" action="javascript:void(0)" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                              
                                                <!--div class="row"> 
                                                    <div class="col-md-6--> 
                                                    <div class="row">
                                                    <div class="col-md-2"> 
                                                    
                                                            <label >Type</label>
                                                                 <select name="type" id="type" class="select2" required>
                                                                        <option value="">Select Type</option>
                                                                       
                                                                </select>
                                                    
                                                         </div>
                                                        <div class="col-md-2"> 
                                                      
                                                        <label >Particular</label>
                                                                 <select name="part" id="part" class="select2" required>
                                                                        <option value="">Select Particular</option>
                                                                       
                                                                </select>
                                                   
                                                     </div>
                                                     <div class="col-md-2"> 
                                                        <!--div class="form-group"-->
                                                        <label  >Purchase Date</label>
                                                        <input type="date" name="pur_date" id="pur_date" class="form-control" required>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2"> 
                                                         <!--div class="form-group"-->
                                                        <label for="total_pur_qty" >Total Purchase Qty</label>
                                                        <input type="text" name="total_pur_qty" id="total_pur_qty" class="form-control" required>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2">
                                                        
                                                        <label for="total_pur_rs" class="control-label">Total Purchase Rs</label>
                                                        <input type="text" name="total_pur_rs" id="total_pur_rs" class="form-control" required>
                                                        
                                                      </div>
                                                      
                                                     </div>
                                                     </div>
                                                     <br>
    
                                                  
                                                      
                                                     
                                              
                                             
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add Stock</button> 
                                            </div> 
                                            </form>
      
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->

<!-- Daily used qty add data modal start -->

                                <div id="add_usedstock-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">ADD UTILIZED QUANTITY</h4> 
                                            </div> 
                                          
                                              <div class="modal-body"> 
                                               <form name="add_usedstock_form" id="add_usedstock_form" class="form-horizontal form-bordered" action="javascript:void(0)" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                              
                                                <!--div class="row"> 
                                                    <div class="col-md-6--> 
                                                    <div class="row">
                                                    <div class="col-md-6"> 
                                                   
                                                        <div class="form-group">
                                                        <label  >Date</label>
                                                       <div id="stock_id"></div>
                                                        <input type="date" name="us_date" id="us_date" class="form-control" required>
                                                         </div>
                                               
                                                  
                                                         <div class="form-group">
                                                        <label for="total_pur_qty" >Utilized quantity of a day</label>
                                                        <input type="text" name="us_qty" id="us_qty" class="form-control" required>
                                                         </div>
                                                         
                                                         <div class="form-group">
                                                        <label for="dis_value" >Discrepancy qty</label>
                                                        <input type="text" name="dis_value" id="dis_value" class="form-control" required>
                                                         </div>
                                                  
                                                   
                                                         </div>
                                                     </div>
                                                     </div>
                                                     <br>
    
                                
                                             
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add</button> 
                                            </div> 
                                            </form>
      
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
                                <div id="add_discrep-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">ADD UTILIZED QUANTITY</h4> 
                                            </div> 
                                          
                                              <div class="modal-body"> 
                                               <form name="add_discep_form" id="add_discep_form" class="form-horizontal form-bordered" action="javascript:void(0)" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                              
                                                <!--div class="row"> 
                                                    <div class="col-md-6--> 
                                                    <div class="row">
                                                    <div class="col-md-6"> 
                                                   
                                                        <div class="form-group">
                                                        <label  >Date</label>
                                                       <div id="stock_id1"></div>
                                                        <input type="date" name="us_date" id="us_date" class="form-control" required>
                                                         </div>
                                               
                                                  
                                                     
                                                         
                                                         <div class="form-group">
                                                        <label for="dis_value" >Discrepancy qty</label>
                                                        <input type="text" name="dis_value" id="dis_value" class="form-control" required>
                                                         </div>
                                                  
                                                   
                                                         </div>
                                                     </div>
                                                     </div>
                                                     <br>
    
                                
                                             
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add</button> 
                                            </div> 
                                            </form>
      
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->





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
                      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Stock Register Details</h3>              
                                        <div id="month" class="panel-title"></div>
                                    </div>
                                    <div class="panel-body">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#stock-modal">
                                     Add Stock Details
                                     </button>
                                        <div class="row">
                                           
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="type">Type*</label>
                                                    <select name="type" id="type1" class="select2">
                                                        <option value="">Select Type</option>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="part">Particulars*</label>
                                                    <select class="select2" id="part1" name="part">
                                                        <option value="">Select Particulars</option>
                                                    </select>


                                                </div>
                                            </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <button type="submit" onclick="get_table()" style="top: 24px;" class="btn btn-purple waves-effect waves-light" id="btnSave">Filter</button>
                                          </div>
                                         </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="stockreg_tb">
                                                        <thead>
                                                            <tr>
                                                            <!--th>#</th-->
                                                                <th>Sno</th>
                                                                <th>Type</th>
                                                                <th>Particulars</th>
                                                                <th>Purchase Date</th>
                                                                <th>Opening Stock Qty</th>
                                                                <th>Total Purchase Qty.</th>
                                                                <th>Total Purchase Rs.</th>
                                                                <th>Total Consumption Qty.</th>
                                                                <th>Total Discrepancy qty</th>
                                                                <th>closing(Remaining) Stock Qty</th>
                                                                <th>Add Utilized Quantity/day</th>
                                                                <!---th>View Utilized Quantity</th-->
                                                                
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
                               <!--weaning modal-->     
                             
                        </div> <!-- End row -->
                  

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
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/pro_js/stock/add_stock.js"></script>

        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/";
            
            $(document).ready(function () {

                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

                var page = "stock register track";

                if (page == "stock register track") {
                  //  $('.feedm_m').click();
                    $(".stock_m a").addClass("active");
                }


            // Select2
            jQuery(".select2").select2({
                width: '100%',

            });

           
});

        </script>    
	</body>
</html>