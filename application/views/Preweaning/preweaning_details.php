<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Pre Weaning Details</title>

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
                                <h4 class="pull-left page-title">Add Pre weaning Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="incubation">View Pre weaning Details</a></li>
                                    <li class="active">Add Pre weaning Details</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Pre weaning Details</h3></div>
                                    <div class="panel-body">
									    <form id="preweaning_form" method="post" autocomplete="false" action="javascript:void(0)">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bird_group">Species</label>
                                                        <input type="text" name="species_id" id="species_name" class="form-control" readonly>
                                                        <input type="hidden" name="incub_id" id="incubation_id" class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bird_species">Brooder</label>
                                                        <input type="text" name="brooder_name" id="brooder_name" 
                                                                class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aviary">Egg no</label>
                                                        <input type="text"name="egg_no" id="egg_no" 
                                                                class="form-control" readonly> 
                                                           
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cage">Hatch weight</label>
                                                        <input type="text"name="hatch_weight" id="hatch_weight" 
                                                                class="form-control" readonly> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="male_parent_rno">Age</label>
                                                        <input type="text"name="age" id="age" 
                                                                class="form-control" > 
                                                              
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="female_parent_rno">Standard Weight</label>
                                                        <input type="text"name="std_weight" id="std_weight" 
                                                                class="form-control"> 
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                 

                                                    <div class="form-group">
                                                        <label for="egg_no">Actual weight</label>
                                                        <input type="text" class="form-control" name="actual_weight" id="actual_weight" required>
                                                        <input type="hidden" class="form-control" name="prev_actual_weight" id="prev_actual_weight" required>
                                                    </div>

                                                    <div class="form-group">
                                                    <label for="egg_no">Status</label>
                                                        <input type="text" class="form-control" name="status" id="status" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="doi">Weight Gain</label>
                                                        <input type="text" class="form-control" name="weight_gain" id="weight_gain" readonly>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="dof">Target Vol/Feed</label>
                                                        <input type="text" class="form-control" name="target_vol" id="target_vol" readonly>  
                                                      
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Target no of Feeds</label>
                                                        <input type="text" class="form-control" name="target_no_feed" id="target_no_feed" readonly>  
                                                      
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Actual No of feed given</label>
                                                        <input type="text" class="form-control" name="actn_feed" id="actn_feed" required>
                                                    </div>

                                                </div>
                                              

                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="doi">Ratio</label>
                                                        <input type="text" class="form-control" name="ratio" id="ratio" placeholder ="(format example- 1:2)" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Volume</label>
                                                        <input type="text" class="form-control" name="volume" id="volume" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Target volume/day</label>
                                                        <input type="text" class="form-control" name="tv_day" id="tv_day" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="egg_weight">Target feed in given/day</label>
                                                        <input type="text" class="form-control" name="targetfeed_gday" id="targetfeed_gday" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Actual feed vol/day</label>
                                                        <input type="text" class="form-control" name="actualFeed_vday" id="actualFeed_vday" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Actual feed in given day</label>
                                                        <input type="text" class="form-control" name="actualFeed_gday" id="actualFeed_gday" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Achieved</label>
                                                        <input type="text" class="form-control" name="achieved" id="achieved">
                                                        <input type="hidden" name="feed_date" id="feed_date" class="form-control" value="<?php echo date("d-m-Y");  ?>"> 
                                                    </div>
                                                </div>
                                               
                                                <div id="feed_id"></div>
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

        <script src="<?php echo base_url();?>assets/pro_js/add_preweaning.js"></script>
        <!--script src="<?php //echo asset_url();?>pro_js/add_incubation.js"></script-->
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
				var  page="preweaning";

				if(page=="preweaning"){
                    $(".preweaning_m a").addClass("active");
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