<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Mortality & Postmortem register</title>

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
    <style>
    .dataTables_filter {
        float: right;
    }

    table {
        width: 100% !important;
    }

    .btn-group {
        margin-top: 15px;
    }

    @media only screen and (max-width: 600px) {
        .btn-group {
            margin-bottom: 5px !important;
            display: inline-grid !important;
            margin-left: 5px;

        }

        .hide_t {
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

    .dt-button-collection {

        max-height: 250px;
        overflow: auto;
        /* overflow-y: hidden; */
        margin: 0 auto;
        white-space: nowrap
    }

    .dt-button-collection>a.active {
        background-color: #38bbf7;
        color: #ffff;
        margin-bottom: 1px;
    }
    .form-horizontal .form-group{
        margin-left: unset;
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
                            <!-- <h4 class="pull-left page-title">Mortality & Postmortem Register</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Healthcare/stund_register">Add Mortality & Postmoderm Register</a></li>
                                <li class="active">Mortality & Postmortem Register</li>
                            </ol> -->
                        </div>
                    </div>
<!-- move to handfeeding modal -->  

   <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">  Mortality & Postmortem register</h3>
                                </div>
                                <div class="panel-body">
                                    <!-- <a href="<?php echo base_url(); ?>index.php/Healthcare/mort_register"><button
                                            class="btn btn-primary waves-effect waves-light">Add Mortality  Register</button></a>
                                           <br><br>
                                            <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="aviary_id">From Date*</label>
                                                    <input type="date" name="track_date" id="track_date" class="form-control"><br>
                                                    <label for="aviary_id">To Date*</label>
                                                    <input type="date" name="to_track_date" id="to_track_date" class="form-control">
                                                    

                                                </div>
                                            </div>
                                           
                                             <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="aviary_id">Aviary*</label>
                                                    <select name="aviary_id" id="aviary_id" class="select2 form-control">
                                                        <option value="">Select Aviary</option>

                                                    </select><br>
                                                    <label for="cage">Cage*</label>
                                                    <select class="select2 form-control" id="cage" name="cage">
                                                        <option value="">Select Cage</option>
                                                    </select>
                                                </div>
                                            </div>
                                         

                                                <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Species*</label>
                                                <select class="select2 form-control" id="bird_species" name="bird_species" required>
                                                    <option value="">Select Species</option>
                                                </select><br>
                                                <label for="Ring_no">BIRD RING NO/EGG NO*</label>
                                                        <select name="egg_no" id="egg_no" class=" form-control" required>
                                                            <option value="">Select Ring no</option>
                                                        </select>
                                            </div>
                                        </div>
                                      
                                            
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <button type="submit" onclick="get_table()" style="top: 24px;" class="btn btn-purple waves-effect waves-light" id="btnSave">Filter</button>
                                          </div>
                                         </div> -->
                                            <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="mort_tb">
                                                    <thead>
                                                        <tr>
                                                      
                                                            <th>Sno</th>
                                                            <th>Mortality Date</th>
                                                            <th>Aviary</th>
                                                            <th>Cage</th>
                                                            <th>Bird Species</th>
                                                            <th>Egg no/Ring no</th>
                                                            <th>Action</th>
                                                           
                                                           
                                                            
                                                            <!--my code-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->
                    <div class="modal fade" id="videomodal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div id="bird_video"></div>
      </div>
    </div>
  </div>
</div>

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
    <script src="<?php echo base_url();?>assets/pro_js/healthcare/view_mort.js"></script>
  
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";
    var IMG_URL = "<?php echo base_url();?>uploads/";

   
    $(document).ready(function() {
       
     /*   $('#proven_tb').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );*/
        $('.btn-group button').removeClass('btn-outline-primary');
        $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

        var page = "mort_register";

if (page == "mort_register") {
    $('.healthcare_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".mort").addClass("active");
}

    });
   
    </script>
</body>

</html>
