<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Edit Incubation Details</title>

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
                                <h4 class="pull-left page-title">Edit Incubation Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php echo base_url()."index.php/Incubation/incubation"?>">View Incubation Details</a></li>
                                    <li class="active">Edit Incubation Details</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Edit Incubation Details</h3></div>
                                    <div class="panel-body">
									    <form id="incubationForm" method="post" autocomplete="false" action="javascript:void(0)">
                                            <input type="hidden" name="auto_id" id="auto_id">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bird_group">Group*</label>
                                                        <select name="bird_group" id="bird_group" class="select form-control">
                                                            <!-- <option value="">Select Group</option> -->
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bird_species">Bird Species*</label>
                                                        <select name="bird_species" id="bird_species" class="form-control" required>
                                                            <option value="">Select Bird Species</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aviary">Aviary*</label>
                                                        <select name="aviary_id" id="aviary_id" class="form-control" required>
                                                            <!-- <option value="">Select Aviary</option> -->
                                                           
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cage">Cage*</label>
                                                        <select class="select2" id="cage" name="cage" required>
                                                            <option value="">Select Cage</option>
                                                        </select>
                                                    </div>
													<div class="form-group">
                                                        <label for="cage">Clutch No*</label>
                                                       <input type="text" class ="form-control" name="clutch_no" id="clutch_no" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="male_parent_rno">Male Parent Ring No.*</label>
                                                        <select  class="form-control" name="male_parent_rno" id="male_parent_rno" placeholder="Male Parent Ring No">
                                                            <!-- <option value="">Select</option> -->

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="female_parent_rno">Female Parent Ring No.*</label>
                                                        <select  class="form-control" name="female_parent_rno" id="female_parent_rno" placeholder="Female Parent Ring No">
                                                            <!-- <option value="">Select</option> -->

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="egg_no">Egg No*</label>
                                                        <input type="text" class="form-control" name="egg_no" id="egg_no" required>
                                                    </div>
                                                    <!--div class="form-group">
                                                        <label for="egg_laid">Egg Laid Date*</label>
                                                        <input type="date" class="form-control" name="egg_laid_date" id="egg_laid_date" required>
                                                    </div-->
                                                    <!--div class="form-group">
                                                        <label for="fertile_type">Egg status*</label>
                                                        <select class="select2" id="egg_status" name="egg_status" required>
                                                            <option value="">Select Egg status</option>
                                                            <option value="Broken">Broken</option>
                                                            <option value="Crack">Crack</option>
                                                            <option value="Normal">Normal</option>
                                                        </select>
                                                    </div-->
                                                    <div class="form-group" id="fertile_show">
                                                        <label for="fertile_type">Egg Type*</label>
                                                        
                                                        <select class="form-control" id="fertile_type" name="fertile_type" >
                                                            <option value="">Select Fertile Type</option>
                                                            <option value="Fertile">Fertile</option>
                                                            <option value="In Fertile">In Fertile</option>
                                                            <option value="Dis">Dis</option>
                                                            <option value="Broken">Broken</option>
                                                            <option value="Crack">Crack</option>
                                                            <option value="Unknown">Unknown</option>
                                                        </select>
                                                    </div>
													<div class="form-group">
                                                        <label for="cage">Egg No in Clutch*</label>
                                                       <input type="text" class ="form-control" name="egg_no_clutch" id="egg_no_clutch" required>
		</div>
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="doi">Date of Incubation*</label>
                                                        <input type="date" class="form-control" name="doi" id="doi" required>
                                                    </div>
													<div class="form-group">
                                                        <label for="doi">Select Incubator*</label>
														<select  class="select2" name="incubator" id="incubator">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Date (Egg type)*</label>
                                                        <input type="date" class="form-control" name="dof" id="dof" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="egg_weight">Egg Weight*</label>
                                                        <input type="text" class="form-control" name="egg_weight" id="egg_weight" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Remark</label>
                                                        <textarea name="remark" id="remark" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
										
                                            <div class="row" id="fertile_div" style="display:none">
                                                <h4>Fertile Details</h4>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pip_weight">Pip Weight</label>
                                                        <input type="text" class="form-control" name="pip_weight" id="pip_weight">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shell_weight">Shell Weight</label>
                                                        <input type="text" class="form-control" name="shell_weight" id="shell_weight">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pip_date">Pip Date</label>
                                                        <input type="date" class="form-control" name="pip_date" id="pip_date">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hatch_type">Hatch Type</label>
                                                        <select name="hatch_type" id="hatch_type" class="form-control">
                                                            <option value="">Select Hatch Type</option>
                                                            <option value="Assist">Assist</option>
                                                            <option value="Normal">Normal</option>
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="hatch_weight">Hatch Weight</label>
                                                        <input type="text" class="form-control" name="hatch_weight" id="hatch_weight">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shell_thick">Shell Thick</label>
                                                        <input type="text" class="form-control" name="shell_thick" id="shell_thick">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="hatch_date">Hatch Date</label>
                                                        <input type="date" class="form-control" name="hatch_date" id="hatch_date">
                                                    </div>
                                                </div>
                                             


											<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="Egg length">Egg length</label>
                                                        <input type="text" class="form-control" name="egg_length" id="egg_length">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="egg_breadth">Egg breadth</label>
                                                        <input type="text" class="form-control" name="egg_breadth" id="egg_breadth">
                                                    </div>
                                                </div>
												
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="shell_layer">Shell layer</label>
														<select name="shell_layer" id="shell_layer" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Thick">Thick</option>
                                                            <option value="Thin">Thin</option>
                                                            <option value="Rubbery">Rubbery</option>
                                                        </select>                                                     
													</div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="hatch_time">Hatch Time</label>
                                                        <input type="time" class="form-control" name="hatch_time" id="hatch_time">
                                                    </div>
                                                </div>
												
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="moved_time">Moved Time</label>
                                                        <input type="time" class="form-control" name="moved_time" id="moved_time">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="date_bos">Date of BOS</label>
                                                        <input type="date" class="form-control" name="date_bos" id="date_bos">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="date_bos">BOS Findings</label>
														<select class="select2" name="bos_findings" id="bos_findings">
														<option value="">Select</option>   
														<option>Fungal infection</option>
															<option>NAD</option>
															<option>Decomposed egg</option>
															<option>Damaged egg at receipt</option> 
															<option>Damaged egg after receipt</option> 
															<option>Weak embryo</option>
															<option>Bacterial infection</option>
															<option>Green rot</option>
															<option>THI</option>
															<option>shock</option>
															<option>Yolk sac infection</option>
															<option>Aspiration of yolk contents</option>
															<option>Pipping difficulty</option>
															<option>Egg shell deformities</option>
															<option>Aspiration of albumen contents</option>
															<option>Blood vein pip</option>
															<option>Malposition</option>
															<option>Infertile</option> 
															</select>     
														                                          
													 </div>
												</div>
                                            </div>
											<div class="row" id="dis_div" style="display:none">
											<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dis_type">Dis Type</label>
                                                        <select name="dis_type" id="dis_type" class="select2">
                                                            <option value="">Select Dis Type</option>
                                                            <option value="Early Dis">Early Dis</option>
                                                            <option value="Mid Dis">Mid Dis</option>
                                                            <option value="Late Dis">Late Dis</option>
                                                          
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dis_date">Dis Date</label>
                                                        <input type="date" class="form-control" name="dis_date" id="dis_date">
                                                    </div>
											</div>
											<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dis_weight">Dis Weight</label>
                                                        <input type="text" class="form-control" name="dis_weight" id="dis_weight">
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
    <!-- sweet alerts -->
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

        <script src="<?php echo asset_url();?>pro_js/edit_incubation.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
				var  page="incubation";

				if(page=="incubation"){
					$(".incubation_m a").addClass("active");
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
