<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Edit Bird</title>

        <!-- Base Css Files -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo base_url();?>assets/css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?php echo base_url();?>assets/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
        <!-- Plugins css -->
        <link href="<?php echo base_url();?>assets/notifications/notification.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/modal-effect/css/component.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/select2/select2.css" rel="stylesheet" type="text/css" />

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
            <?php include('layouts/topbar.php'); ?>

            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <?php include('layouts/sidebar.php'); ?>

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
                                <h4 class="pull-left page-title">Edit Bird</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="../bird_manage">View Bird</a></li>
                                    <li class="active">Edit Bird</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Edit Bird Details</h3></div>
                                    <div class="panel-body">
                                        <form role="form" autocomplete="false" id="birdForm">

                                            <!-- check cage model start -->
                                            <div id="cage-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-full">
                                                    <div class="modal-content p-0 b-0">
                                                        <div class="panel panel-color panel-pink">
                                                            <div class="panel-heading"> 
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                                <h3 class="panel-title" id="cage_info_title"></h3> 
                                                            </div> 
                                                            <div class="panel-body panel-scroll" style="background:#f5f5f5;"> 
                                                                <div class="row"  id="per_cage_details">
                                                                   
                                                                </div>
                                                                
                                                            </div> 
                                                            
                                                        </div>
                                                        

                                                    </div><!-- /.modal-content -->
                                                    
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <!-- check cage model end -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="bird_group">Group*</label>
                                                        <select name="bird_group" id="bird_group" class="form-control">
                                                            <option value="">Select Group</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Gender*</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="cage">Cage*</label>
                                                                <select class="select2" id="cage" name="cage">
                                                                    <option value="">Select Cage</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="" style="margin-top:15px;"></label>

                                                                <br>
                                                                <button type="button" class="btn  btn-pink" id="checkcageBtn" >Check Cage</button>

                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="bird_species">Bird Species*</label>
                                                        <select name="bird_species" id="bird_species" class="form-control">
                                                            <option value="">Select Bird Species</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="proven">Proven</label>
                                                        <select name="proven" id="proven" class="form-control">
                                                            <option value="">Select Proven</option>
                                                           
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="weight">Weight</label>
                                                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="ring_no">Ring No*</label>
                                                        <input type="text" class="form-control" id="ring_no" readonly name="ring_no" oninput="check_ringno();" placeholder="Ring No" value="">
                                                        <span id="ring_no-error" class="error" for="ring_no" style="display:none;">Ring No Already Exits..!</span>
                                                        <span id="ring_no-success" class="text-success" for="ring_no" style="display:none;">Ring No Free to Use..!</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="aviary">Aviary*</label>
                                                        <select name="aviary_id" id="aviary_id" class="form-control">
                                                            <option value="">Select Aviary</option>
                                                           
                                                        </select>

                                                        <!-- <input type="text" class="form-control" id="aviary_name" name="aviary_name" placeholder="Aviary"> -->
                                                        <!-- <input type="hidden" class="form-control" id="aviary_id" name="aviary_id" placeholder="Aviary"> -->
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row" style="text-align:center;">
                                                    <button type="button" class="btn btn-purple waves-effect waves-light" id="btnSave">Update</button>
                                            </div>
                                        </form>
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
                            
                           
                        </div> <!-- End row -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                  <!-- footer -->
                  <?php include('layouts/footer.php'); ?>
                
                <!-- footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <?php include('layouts/rightbar.php'); ?>

            <!-- /Right-bar -->


        </div>
        <!-- END wrapper -->
    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/waves.js"></script>
        <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url();?>assets//jquery-detectmobile/detect.js"></script>
        <script src="<?php echo base_url();?>assets/fastclick/fastclick.js"></script>
        <script src="<?php echo base_url();?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>

        <!-- Notification -->
        <script src="<?php echo base_url();?>assets/notifications/notify.min.js"></script>
        <script src="<?php echo base_url();?>assets/notifications/notify-metro.js"></script>
        <script src="<?php echo base_url();?>assets/notifications/notifications.js"></script>
        <!-- Modal-Effect -->
        <script src="<?php echo base_url();?>assets/modal-effect/js/classie.js"></script>
        <script src="<?php echo base_url();?>assets/modal-effect/js/modalEffects.js"></script>   


        <script src="<?php echo base_url();?>assets/pro_js/edit_bird.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
				var  page="add_bird";

				if(page=="add_bird"){
					$(".bird_manage_m a").addClass("active");
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