<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Mortality & Postmortem Register</title>

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
                                <h4 class="pull-left page-title"> Add Postmortem </h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="view_mort"> View Mortality & Postmortem Register</a></li>
                                    <li class="active"> Add Postmortem </li>
                                </ol>
                            </div>
                        </div>

                       
                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title"> Add Postmortem </h3></div>
                                    <div class="panel-body">
									    <form id="edit_mort_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                      
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
												<input type="text" class="form-control" id="aviary_name"
                                                    name="aviary_name"  placeholder="" readonly>
                                                <input type="hidden" class="form-control" id="aviary_id"
                                                    name="aviary_id"  placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
												<input type="text" class="form-control" id="cage"
                                                    name="cage" placeholder="" readonly>

                                            </div>
                                        </div>
                                       
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Species*</label>
												<input type="hidden" class="form-control" id="bird_species"
                                                    name="bird_species" placeholder="" readonly>
                                                <input type="text" class="form-control" id="species_name"
                                                    name="species_name" placeholder="" readonly>

                                            </div>
                                           
                                            
                                      
        </div>
        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Egg no/Ring no*</label>
												<input type="text" class="form-control" id="no_egg"
                                                    name="egg_no"  placeholder="" readonly>
                                               
                                            </div>
                                           
        </div>
		<div class="col-md-2">
        <div class="form-group">
                                                <label for="cage">Postmortem Date*</label>
                                                <input type="date" class="form-control" id="mort_date"
                                                    name="mort_date" placeholder="" required>

                                            </div>
											</div>
        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Choose video to upload*</label>
                                                <input type="file" class="form-control" id="video_mort"
                                                    name="video_mort" placeholder="" required>
<span style="color:green"> Formats allowed:wmv|mp4|avi|mov</span>
                                            </div>
                                        </div>
        <div class="row">
        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cage"> Division  *</label>
                                                <input type="text" class="form-control" id="division"
                                                    name="division" placeholder="" required>

                                            </div>
      
       
                                            <div class="form-group">
                                                <label for="cage">Age</label>
                                                <input type="text" class="form-control" id="age"
                                                    name="age" placeholder="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Sex </label>
                                                <input type="text" class="form-control" id="sex"
                                                    name="sex"  >
                                            </div>
      
                                            <div class="form-group">
                                                <label for="cage">History</label>
                                                <input type="text" class="form-control" id="history"
                                                    name="history" placeholder="">

                                            </div>
     
        </div>
       
      
        <div class="col-md-4">
                                         <div class="form-group">
                                                <label for="cage">Carcass  Weight (gm)*</label>
                                               <input type="text" class="form-control" id="carcass_weight"
                                                    name="carcass_weight" placeholder="" required>
                                            </div>
       
       
                                            <div class="form-group">
                                                <label for="cage">BCS*</label>
                                                <input type="text" class="form-control" id="bcs"
                                                    name="bcs" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">PM Lesions</label>
                                               <textarea class="form-control" id="pm_lesions"
                                                    name="pm_lesions" placeholder="" required></textarea>
                                            </div>
                                          
        
        </div>
        <div class="row">
        <div class="col-md-4">
                                             
                         
                                            <div class="form-group">
                                                <label for="cage">Tentative Diagnosis*</label>
                                                <input type="text" class="form-control" id="tentative_diagnosis"
                                                    name="tentative_diagnosis" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Confirmative Diagnosis*</label>
                                                <input type="text" class="form-control" id="confirmative_diagnosis"
                                                    name="confirmative_diagnosis" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Cause categorization*</label>
                                                <select class="select2" id="cause_categorization" name="cause_categorization" required>
                                                    <option value="">Select</option>
                                                    <option value="Infectious">Infectious</option>
                                                    <option value="Non Infectious">Non Infectious</option>
                                                    <option value="Managemental">Managemental</option>
                                                   
                                                </select>
                                            </div>
                                          
        </div>
        </div>
        <div class="row">
                                       
                                           
                                            


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

     
        <script src="<?php echo asset_url();?>pro_js/healthcare/edit_mort.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {

                var page = "mort_register";

if (page == "mort_register") {
    $('.healthcare_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".mort").addClass("active");
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
