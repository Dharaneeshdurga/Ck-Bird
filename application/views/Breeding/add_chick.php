<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Proven Details</title>

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
                                <h4 class="pull-left page-title">Add Proven Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="incubation">View Proven Details</a></li>
                                    <li class="active">Add Proven Details</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Proven Details</h3></div>
                                    <div class="panel-body">
									    <form id="proven_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                        <?php if (isset($pro_result) && !empty($pro_result)) { 
                                                         foreach($pro_result as $val) { 
                                                          $aviary = $val->aviary_name;
                                                          $aviary_id = $val->aviary_id;
                                                          $cage = $val->cage_id;
                                                          $species = $val->bird_species;
                                                          $species_id = $val->species_id;
                                                          $clutch_no = $val->clutch_no;
                                                           
                                                            }
                                                        }
                                                             ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
                                                <input type="text" id="aviary_id" name="aviary_name" class="form-control" value="<?php echo $aviary;?>" readonly>
                                                <input type="hidden" id="aviary" name="aviary_id" class="form-control" value="<?php echo $aviary_id;?>" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
                                                <input type="text" id="cage"  class="form-control" name="cage" value="<?php echo $cage;?>"readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Species*</label>
                                                <input type="text" id="bird_species"  class="form-control" name="species_name" value="<?php echo $species;?>" readonly>
                                                <input type="hidden" id="species"  class="form-control" name="bird_species" value="<?php echo $species_id;?>" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                                        <label for="clutch_no">Clutch No</label>
                                                        <input type="text"name="clutch_no" id="clutch_no" 
                                                                class="form-control" value="<?php echo $clutch_no; ?>" readonly> 
                                                    </div>
                                                </div>
        </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                <label for="laid_date">Egg laid Date</label>
                                                <input type="date"name="laid_date[]" id="la1" 
                                                                class=" form-control" required> 

                                            </div>

                                            <div class="form-group">
                                                <label for="egg_weight">Egg Weight</label>
                                                <input type="text"name="egg_weight[]" id="eggw1" class="form-control" required> 

                                            </div>

                                            <div class="form-group">
                                                <label for="dys_bw">Days Bw Eggs</label>
                                                <input type="text"name="dys_bw[]" id="1"  class="form-control" readonly> 
                                            </div>
                                            <a href="javascript:void(0);" class="add_button btn-success" style="margin-left:180px;" title="Add field">Add more</a>
                                            <div class="add_more_egg"></div>
        </div>
                                                <div class="col-md-4">
                                                    
                                                 

                                                    <div class="form-group">
                                                        <label for="total_eggs">Total no of eggs</label>
                                                        <input type="text" class="form-control" name="total_eggs" id="total_eggs" required>
                                                        <input type="hidden" class="form-control" name="prev_actual_weight" id="prev_actual_weight" required>
                                                    </div>

                                                    <div class="form-group">
                                                    <label for="brn_egg">No of eggs in Broken</label>
                                                        <input type="text" class="form-control" name="brn_egg" id="brn_egg" >
                                                        <div id="br_id"></div>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="if_egg">No of eggs in IF</label>
                                                        <input type="text" class="form-control" name="if_egg" id="if_egg" >
                                                        <div id="if_id"></div>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="dis_egg">No of eggs in DIS</label>
                                                        <input type="text" class="form-control" name="dis_egg" id="dis_egg">  
                                                        <div id="dis_id"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hatch_egg">No of eggs in HATCH</label>
                                                        <input type="text" class="form-control" name="hatch_egg" id="hatch_egg">  
                                                        <div id="hatch_id"></div>
                                                    </div>
                                                  

                                                </div>
                                              

                                                <div class="col-md-4">
                                                    
                                                    <div class="form-group">
                                                        <label for="last_date">Last egg date</label>
                                                        <input type="text" class="form-control" name="last_date" id="last_date" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="first_date">First egg date</label>
                                                        <input type="date" class="form-control" name="first_date" id="first_date" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="clutch_int">Clutch int</label>
                                                        <input type="text" class="form-control" name="clutch_int" id="clutch_int" readonly >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="avg_day">Average Days Bw Eggs</label>
                                                        <input type="text" class="form-control" name="avg_day" id="avg_day" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Average Weight</label>
                                                        <input type="text" class="form-control" name="avg_weight" id="avg_weight" readonly>
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

      
        <script src="<?php echo asset_url();?>pro_js/breeding/add_proven.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
                var page = "proven";

if (page == "proven") {
    $('.breeding_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".proven").addClass("active");
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