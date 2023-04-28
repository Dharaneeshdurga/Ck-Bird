<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Non Proven Details</title>

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
                                <h4 class="pull-left page-title">Add Non Proven Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="incubation">View Non Proven Details</a></li>
                                    <li class="active">Add Non Proven Details</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Add Non Proven Details</h3></div>
                                    <div class="panel-body">
									    <form id="nonproven_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                     
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
                                                <label for="cage">Species*</label>
                                                <select class="select2" id="bird_species" name="bird_species">
                                                    <option value="">Select Species</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                  <div class="form-group">
                                                        <label for="Ring_no">BIRD RING NO*</label>
                                                        <select name="ring_no" id="ring_no" class=" form-control" required>
                                                            <option value="">Select Ring no</option>
                                                        </select>
                                                    </div>
                             </div>
        </div><br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="aviary_id">Gender</label>
                                                <select name="gender" id="gender" class=" form-control" required>
                                                            <option value="">Select Gender </option>
                                                            <option value="male">Male </option>
                                                            <option value="female">Female </option>
                                                        </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="cage">DNA Sexing</label>
                                                <input type="date"name="dna_sex" id="dna_sex" class="form-control"> 

                                            </div>

                                            <div class="form-group">
                                                <label for="bird_species">Pairing Date</label>
                                                <input type="date"name="pair_date" id="std_weight"  class="form-control"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="bird_species">Pairing Type</label>
                                                <input type="text"name="pair_type" id="pair_date"  class="form-control"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="bird_species">Bonding</label>
                                                <input type="date"name="bond" id="bond"  class="form-control"> 
                                            </div>
                                          
        </div>
                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <label for="egg_no">Preening</label>
                                                        <input type="date" class="form-control" name="preening" id="preening">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for="egg_no">Feeding Without Dominance</label>
                                                        <input type="date" class="form-control" name="fw_dom" id="fw_dom" >
                                                        <div id="br_id"></div>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="doi">Food Sharing</label>
                                                        <input type="date" class="form-control" name="food_sh" id="food_sh" >
                                                        <div id="if_id"></div>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="dof">Nest box introduce</label>
                                                        <input type="date" class="form-control" name="nx_int" id="nx_int">  
                                                        <div id="dis_id"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Single bird nesting</label>
                                                        <input type="date" class="form-control" name="sb_nest" id="sb_nest">  
                                                        <div id="hatch_id"></div>
                                                    </div>
                                                  

                                                </div>
                                              

                                                <div class="col-md-3">
                                                    
                                                    <div class="form-group">
                                                        <label for="doi">Double Bird nesting</label>
                                                        <input type="date" class="form-control" name="db_nest" id="db_nest">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Entertainment nesting</label>
                                                        <input type="date" class="form-control" name="ent_nest" id="ent_nest" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Breeding Nesting</label>
                                                        <input type="date" class="form-control" name="breed_nest" id="breed_nest" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="egg_weight">male mating in perch</label>
                                                        <input type="date" class="form-control" name="mm_perch" id="mm_perch">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Bisexual mating</label>
                                                        <input type="date" class="form-control" name="bs_mat" id="bs_mat">
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                    <div class="form-group">
                                                        <label for="doi">Egg Without Mating</label>
                                                        <input type="date" class="form-control" name="ew_mat" id="ew_mat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Egg laying after mating</label>
                                                        <input type="date" class="form-control" name="egg_lay_mat" id="egg_lay_mat" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dof">Egg production</label>
                                                        <input type="date" class="form-control" name="egg_p" id="egg_p" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="egg_weight">Type of fertile</label>
                                                        <select name="fertile_type" id="fertile_type" class=" form-control" required>
                                                            <option value="">Select </option>
                                                            <option value="">Fertile </option>
                                                            <option value="">Infertile </option>
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

     
        <script src="<?php echo asset_url();?>pro_js/breeding/add_nproven.js"></script>
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