<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Treatment Register Details</title>

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
                                <h4 class="pull-left page-title">Add Treatment Register Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="view_treatment">View Treatment Register Details</a></li>
                                    <li class="active">Add Treatment Register Details</li>
                                </ol>
                            </div>
                        </div>

                      
                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Treatment Register Details</h3></div>
                                    <div class="panel-body">
									    <form id="treatment_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Date*</label>
                                                <input type="date" class="form-control" id="date"
                                                    name="date" placeholder="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
                                                <select name="aviary_id" id="aviary_id" class="select2">
                                                    <option value="">Select Aviary</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
                                                <select class="select2" id="cage" name="cage">
                                                    <option value="">Select Cage</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">No of birds in a cage *</label>
                                                <input type="text" class="form-control" id="bird_count"
                                                    name="bird_count" placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Species*</label>
                                                <select class="select2" id="bird_species" name="bird_species" required>
                                                    <option value="">Select Species</option>
                                                </select>

                                            </div>
                                           
                                            
                                      
        </div>
        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Egg no/Ring no*</label>
                                                <select class="select2" id="eegring_no" name="eegring_no" required>
                                                    <option value="">Select Egg/Ring no</option>
                                                </select>
                                            </div>
        </div>
        </div><br>
        <div class="row">
        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cage">Division*</label>
                                                <input type="text" class="form-control" id="division"
                                                    name="division" placeholder="" readonly>

                                            </div>
      
       
                                            <div class="form-group">
                                                <label for="cage">Age*</label>
                                                <input type="text" class="form-control" id="age"
                                                    name="age" placeholder="" readonly>
                                            </div>
      
      
                                            <div class="form-group">
                                                <label for="cage">Sex*</label>
                                                <input type="text" class="form-control" id="sex"
                                                    name="sex" readonly>

                                            </div>
     
        
                                            <div class="form-group">
                                                <label for="cage">Therapy schedule*</label>
                                                <input type="text" class="form-control" id="therapy_schedule"
                                                    name="therapy_schedule" placeholder="" required>

                                            </div>
      
      
                                          
        

        </div>
       
      
        <div class="col-md-4">
                                         <div class="form-group">
                                                <label for="cage">Anamnesis*</label>
                                               <textarea class="form-control" id="anamnesis"
                                                    name="anamnesis"></textarea>
                                            </div>
       

     
                                            <div class="form-group">
                                                <label for="cage">Body weight*</label>
                                                <input type="text" class="form-control" id="body_weight"
                                                    name="body_weight" placeholder="" required>

                                            </div>
     
       
                                            <div class="form-group">
                                                <label for="cage">BCS*</label>
                                                <input type="text" class="form-control" id="bcs"
                                                    name="bcs" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Physical Examination*</label>
                                               <textarea class="form-control" id="physical_examination"
                                                    name="physical_examination"></textarea>
                                            </div>
        
        </div>
        <div class="row">
        <div class="col-md-4">
                                               <div class="form-group">
                                                <label for="cage">Samples collected*</label>
                                                <select class="select2" id="samples_collected" name="samples_collected" required>
                                                    <option value="">Select Samples</option>
                                                    <option value="Samples 1">Samples 1</option>


                                                </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Lab diagnostics*</label>
                                                <select class="select2" id="lab_diagnostics" name="lab_diagnostics" required>
                                                    <option value="">Select Lab diagnostics</option>
                                                    <option value="Lab diagnostics1">Lab diagnostics1</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Inferences*</label>
                                                <textarea class="form-control" id="inferences"
                                                    name="inferences"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Medication details*</label>
                                                <textarea class="form-control" id="medication_details"
                                                    name="medication_details"></textarea>
                                            </div>

        </div>
        </div>
        <div class="row">
                                       
                                           
                                            


                                            <div class="row" style="text-align:center;">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Submit</button>
                                                <button type="submit" class="btn btn-info waves-effect waves-light" id="clear">Reset</button>
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

     
        <script src="<?php echo asset_url();?>pro_js/healthcare/treatment.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
                var page = "treatment_register";

if (page == "treatment_register") {
    $('.healthcare_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".treatment").addClass("active");
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