<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Stunted Chick Register</title>

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
                                <h4 class="pull-left page-title">Add Stunted Chick Register</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="view_stund">View Stunted Chick Register</a></li>
                                    <li class="active">Add Stunted Chick Register</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Stunted Chick Register</h3></div>
                                    <div class="panel-body">
									    <form id="stunt_chick_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Date*</label>
                                                <input type="date" class="form-control" id="stund_date"
                                                    name="stund_date" placeholder="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
                                                <select name="aviary_id" id="aviary_id" class="select2" required>
                                                    <option value="">Select Aviary</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
                                                <select class="select2" id="cage" name="cage" required>
                                                    <option value="">Select Cage</option>
                                                </select>

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
                                                        <label for="clutch_no">Egg No</label>
                                                        <select class="select2 " id="egg_no" name="egg_no" required>
                                                    <option value="">Select Egg no</option>
                                                </select>

                                                    </div>
                                                </div>
                                                              
                                  </div> <!-- end row-->

                                    <div class="row">
                                    <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Hatch Date</label>
                                                        <input type="text" class="select2 form-control" id="hatch_date" name="hatch_date" readonly>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Male Parent Ring no</label>
                                                        <input type="text" class="select2 form-control" id="mp_ring" name="mp_ring" readonly>
                                                    </div>
                                                </div>    
                                       <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">No of Stunted Chick(MP) </label>
                                                        <input type="text" class="select2 form-control" id="no_mp_ring" name="no_mp_ring" readonly>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Female Parent Ring no</label>
                                                        <input type="text" class="select2 form-control" id="fp_ring" name="fp_ring" readonly>
                                                    </div>
                                                </div>
                                       
                                      
        </div>  <!-- end row-->

                                 <div class="row">
                                 <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">No of stunted chick(FP) </label>
                                                        <input type="text" class="select2 form-control" id="no_fp_ring" name="no_fp_ring" readonly>
                                                    </div>
                                                </div>
                                 <div class="col-md-3">
                                 <div class="form-group">
                                <label for="clutch_no">Egg weight </label>
                              <input type="text" class="select2 form-control" id="egg_weight" name="egg_weight" required>
                           </div>
                          </div>
                                               <div class="col-md-3">
                                                 <div class="form-group">
                                                        <label for="clutch_no">Standard Egg weight </label>
                                                        <input type="text" class="select2 form-control" id="std_egg_weight" name="std_egg_weight" readonly>
                                                    </div>
                                                </div>
                                         <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no"> Hatch weight </label>
                                                        <input type="text" class="select2 form-control" id="hatch_weight" name="hatch_weight" required>
                                                    </div>
                                                </div>
                                       
          </div><!-- end row-->
                                     <div class="row">
                                     <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no"> Standard Hatch weight </label>
                                                        <input type="text" class="select2 form-control" id="std_hatch_weight" name="std_hatch_weight" readonly>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no"> Age</label>
                                                        <input type="text" class="select2 form-control" id="age" name="age" readonly>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no">Body Weight</label>
                                                        <input type="text" class="select2 form-control" id="body_weight" name="body_weight" required>
                                                    </div>
                                                </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                                        <label for="clutch_no"> Clutch no </label>
                                                        <input type="text" class="select2 form-control" id="clutch_no" name="clutch_no" readonly>
                                                    </div>
                                                </div>
                                               
                                            
        </div><!-- end row--> 
                                   
                               <div class="row">
                               <div class="col-md-3">
                                               <div class="form-group">
                                                        <label for="clutch_no"> Egg no in current clutch </label>
                                                        <input type="text" class="select2 form-control" id="egg_no_clutch" name="egg_no_clutch" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="form-group">
                                                        <label for="clutch_no"> Stunted From Day </label>
                                                        <input type="text" class="select2 form-control" id="stunt_f_day" name="stunt_f_day" required>
                                                    </div>
                                                </div>
                               <div class="col-md-3">
                                              <div class="form-group">
                                                        <label for="clutch_no"> Standard Weaning Days </label>
                                                        <input type="text" class="select2 form-control" id="std_wean_days" name="std_wean_days" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                               <div class="form-group">
                                                        <label for="clutch_no"> Handfeeding Chick issues</label>
                                                        <textarea class="select2 form-control" id="handfeed_chick_issue" name="handfeed_chick_issue"></textarea>

                                                                                                        </div>
                                                </div>
                                                <div class="col-md-3">
                                               <div class="form-group">
                                                        <label for="clutch_no"> Corrective measures Adapted </label>
                                                        <textarea class="select2 form-control" id="c_m_adapt" name="c_m_adapt"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cage">Status*</label>
                                                <select class="select2 form-control" id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="Recovered">Recovered</option>
                                                    <option value="Not Recovered">Not Recovered</option>
                                                    <option value="Dead">Dead</option>
                                                </select>

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
                var page = "Stund_register";

if (page == "Stund_register") {
    $('.healthcare_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".stunded").addClass("active");
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