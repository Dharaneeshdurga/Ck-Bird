<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Sales Update</title>

        <!-- Base Css Files -->
        <link href="<?php echo asset_url();?>css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo asset_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="<?php echo asset_url();?>css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo asset_url();?>css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?php echo asset_url();?>css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
        <!-- Plugins css -->
        <link href="<?php echo asset_url();?>notifications/notification.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>modal-effect/css/component.css" rel="stylesheet">
        <link href="<?php echo asset_url();?>select2/select2.css" rel="stylesheet" type="text/css" />

        <style>
            .checkbox label{
                font-size: 12px !important;
            }
            .panel-title-new{
                font-size: 14px;
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 0;
                margin-top: 0;
            }

            /* Important part */
            .modal-dialog{
                overflow-y: initial !important
            }
            .panel-scroll{
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }
            .panel-title-black{
                color:black;
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

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Add Sales Update</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php echo base_url(); ?>index.php/Execution/sales_register">View Sales Update</a></li>
                                    <li class="active">Add Sales Update</li>
                                </ol>
                            </div>
                        </div>

    <!-- start: alert Message -->
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
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Sales Update</h3></div>
                                    <div class="panel-body">
									    <form id="sales_update_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Execution/save_sales_update"; ?>" enctype="multipart/form-data">
                                       

                                    <div class="row">
                                    <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Date</label>
                                                        <input type="date" class="select2 form-control" id="sales_date" name="sales_date" value="<?php echo $sp_name; ?>" required>
                                                    </div>
                                                </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Species Name</label>
                                                        <input type="text" class="select2 form-control" id="sp_name" name="sp_name" value="<?php echo $sp_name; ?>" readonly>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Ring no</label>
                                                        <input type="text" class="select2 form-control" id="sp_ring" name="sp_ring" value="<?php echo $sp_ring; ?>"  readonly>
                                                    </div>
                                                </div>    
                                       <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Actual cost </label>
                                                        <input type="text" class="select2 form-control" id="act_cost" name="act_cost" required>
                                                    </div>
                                                </div>
                                       
                                       
                                      
        </div>  <!-- end row-->

        <div class="row">
        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Sale cost</label>
                                                        <input type="text" class="select2 form-control" id="sale_cost" name="sale_cost" required>
                                                    </div>
                                                </div>             
        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Discrepancy value</label>
                                                        <input type="text" class="select2 form-control" id="discrep_value" name="discrep_value">
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Reason</label>
                                                        <input type="text" class="select2 form-control" id="reason" name="reason">
                                                    </div>
                                                </div>    
                                     
			      

                                              

        </div>
        
                                            


                                            <div class="row" style="text-align:center;">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Submit</button>
                                            </div>
                                        </form>
                                       
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
                            
                           
                        </div> <!-- End row -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                  <!-- footer -->
                  <?php include('application/views/layouts/footer.php'); ?>
                
                <!-- footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <?php include('application/views/layouts/rightbar.php'); ?>

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
        <script src="<?php echo asset_url();?>/jquery-detectmobile/detect.js"></script>
        <script src="<?php echo asset_url();?>fastclick/fastclick.js"></script>
        <script src="<?php echo asset_url();?>jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo asset_url();?>jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="<?php echo asset_url();?>js/jquery.app.js"></script>
        <script src="<?php echo asset_url();?>select2/select2.min.js" type="text/javascript"></script>

        <!-- Notification -->
        <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
        <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
        <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
        <!-- Modal-Effect -->
        <script src="<?php echo asset_url();?>modal-effect/js/classie.js"></script>
        <script src="<?php echo asset_url();?>modal-effect/js/modalEffects.js"></script>   

      
        <script src="<?php echo asset_url();?>pro_js/healthcare/stund.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
                var page = "sales_update";

if (page == "sales_update") {
    $('.sales_m').click();
    $(".sales").addClass("active");
}

                $('input[type="text"]').attr('autocomplete', 'off');//Disable cache

			});

            // Select2
            jQuery(".select2").select2({
                    width: '100%',

                });
        </script>
	</body>
</html>