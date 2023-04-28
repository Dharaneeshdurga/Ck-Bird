<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?>Monthly Stock</title>

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
            .row_bg{
                background-color:#6bc9c991;
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
                      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Monthly stock</h3>
                                    </div>
                                    <div class="panel-body">
                                    
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table  table-bordered" id="individualcage_tb">
                                                        <thead>
                                                            <tr>
                                                          
                                                                <th>S.no</th>
                                                                <th>Month & Year</th>
                                                                <th>Add Stock Details</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody class="month_tbody">
                                                        <?php 
                                                      $month = "January";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>1</td>
                                                          <td>JANUARY &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $jan_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/January/".date('Y');?>

                                                          <td><a href="<?php echo $jan_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr>
                                                      <?php 
                                                      $month = "February";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>2</td>
                                                          <td>FEBRUARY &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $feb_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/Febuary/".date('Y');?>

                                                          <td><a href="<?php echo $feb_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "March";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>3</td>
                                                          <td>MARCH &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $mar_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/March/".date('Y');?>

                                                          <td><a href="<?php echo $mar_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
        </tr>

                                                      <?php 
                                                      $month = "April";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                                <td>4</td>
                                                                <td>APRIL &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                                <?php $apr_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/April/".date('Y');?>

                                                                <td><a href="<?php echo $apr_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                                
                                                            </tr> 
                                                            <?php 
                                                      $month = "May";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>5</td>
                                                          <td>MAY &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $may_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/May/".date('Y');?>

                                                          <td><a href="<?php echo $may_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "June";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>6</td>
                                                          <td>JUNE &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $june_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/June/".date('Y');?>

                                                          <td><a href="<?php echo $june_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "July";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>7</td>
                                                          <td>JULY &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $july_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/July/".date('Y');?>

                                                          <td><a href="<?php echo $july_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "August";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>8</td>
                                                          <td>AUGUST &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $aug_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/August/".date('Y');?>

                                                          <td><a href="<?php echo $aug_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "September";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>9</td>
                                                          <td>SEPTEMBER &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $sep_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/September/".date('Y');?>

                                                          <td><a href="<?php echo $sep_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "October";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>10</td>
                                                          <td>OCTOBER &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $oct_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/October/".date('Y');?>

                                                          <td><a href="<?php echo $oct_stock_link; ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "November";
                                                      $cur_month = date('F');
                                                      
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>11</td>
                                                          <td>NOVEMBER &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                      <?php $nov_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/November/".date('Y');?>
                                                          <td><a href="<?php echo $nov_stock_link;?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                      <?php 
                                                      $month = "December";
                                                      $cur_month = date('F');
                                                     
                                                      if($month == $cur_month){
                                                          echo '<tr class="row_bg">';
                                                      }
                                                     else{
                                                      echo '<tr>';
                                                     }
                                                      ?>
                                                          
                                                          <td>12</td>
                                                          <td>DECEMBER &nbsp&nbsp&nbsp <?php echo date('Y'); ?></td>
                                                          <?php $dec_stock_link = base_url()."index.php/Feedmaintenance/stock_register_track/December/".date('Y');?>

                                                          <td><a href="<?php echo $dec_stock_link ?>"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="stock Details"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></a></td>
                                                          
                                                      </tr> 
                                                    
                                                              </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
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
    <!---script src="<?php //echo base_url();?>assets/pro_js/view_cagetrack.js"></script-->

        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/";
            
            $(document).ready(function () {

                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

                var page = "new_stock";

                if (page == "new_stock") {
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