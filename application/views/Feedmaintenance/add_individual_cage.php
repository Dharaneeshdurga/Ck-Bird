<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Individual Cage Track</title>

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

    <!-- DataTables -->
    <link href="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- sweet alerts -->
    <link href="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="<?php echo base_url();?>assets/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/select2/select2.css" rel="stylesheet" type="text/css" />
	<!-- <link href="<?php echo base_url();?>assets/responsive-table/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen"/> -->

    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>

    <style>
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

                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Feedmaintenance/individual_cage">Individual Cage Track</a></li>
                                <li class="active">Add Individual Cage Track</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Individual Cage Track</h3>
                                </div>
                                <div class="panel-body">
                                <form id="cage_track" method="post" autocomplete="false" action="javascript:void(0)">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Date*</label>
                                                <input type="date" name="track_date" id="track_date" class="form-control" value="<?php echo date("Y-m-d");?>" required>

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
                                        <!-- <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
                                                <select class="select2" id="cage" name="cage">
                                                    <option value="">Select Cage</option>
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_species">Bird Species*</label>
                                                <select class="select2" id="bird_species" name="bird_species">
                                                    <option value="">Select Bird Species</option>
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Bird Count*</label>
                                                <input type="text" class="form-control" id="bird_count"
                                                    name="bird_count" placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Target Mrng Feed/ Bird</label>
                                                <input type="text" class="form-control" id="mrng_feed"
                                                    name="mrng_feed" placeholder="" readonly>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Target Mrng Feed</label>
                                                <input type="text" class="form-control" id="total_mrng_feed"
                                                    name="total_mrng_feed" placeholder="" readonly>

                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count"></label>
                                                <input type="text" class="form-control" id="aft_feed"
                                                    name="aft_feed" placeholder="" readonly>
Target Aftrn Feed/ Bird
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Target Aftrn Feed</label>
                                                <input type="text" class="form-control" id="total_aft_feed"
                                                    name="total_aft_feed" placeholder="" readonly> 

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Target Feed(g) / Day</label>
                                                <input type="text" class="form-control" id="target_feedg"
                                                    name="target_feedg" placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Mrng Feed Wastage</label>
                                                <input type="text" class="form-control" id="mrg_wastage"
                                                    name="mrg_wastage" placeholder="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Aftrn Feed Wastage</label>
                                                <input type="text" class="form-control" id="aft_wastage"
                                                    name="aft_wastage" placeholder="" required>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Total Intake</label>
                                                <input type="text" class="form-control" id="total_intake"
                                                    name="total_intake" placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bird_count">Achieved</label>
                                                <input type="text" class="form-control" id="achieved"
                                                    name="achieved" placeholder="" readonly>

                                            </div>
                                        </div> -->
															</div>

						<div class="row>">
							<div class="col-md-12 col-lg-12">
							<div class="panel-body "> 
                                        <div class="table-responsive">
                                            <table id="" class="table table-small-font table-bordered table-striped">
									
										<thead>
											<tr>
												<th>S.no</th>
												<th style="width:120px;">Cage</th>
												<th>Bird Count</th>
												<!-- <th style="width:200px;">Species list</th> -->
												<th>Target Mrng Feed/ Bird</th>
												<th>Target Mrng Feed</th>
												<th>Target Aftrn Feed/ Bird</th>
												<th>Target Aftrn Feed</th>
												<th>Target Feed(g) / Day</th>
												<th>Mrng Feed Wastage</th>
												<th>Aftrn Feed Wastage</th>
												<th>Total Intake</th>
												<th>Minimum Wastage</th>
												<th>Total Wastage</th>
											</tr>
									</thead>	
									<tbody id="cage_body">
										
									</tbody>	
								</table>
							</div>
							<div class=" text-right">
                                            <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSubmit">Submit</button>
                                        </div>
						</div>						
				                                   
</form>
</div>





                                </div><!-- panel-body -->
                            </div> <!-- panel -->
                        </div>

                    </div> <!-- End Row -->


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
        <div class="side-bar right-bar nicescroll">
            <h4 class="text-center">Chat</h4>
            <div class="contact-list nicescroll">
                <ul class="list-group contacts-list">
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="">
                            </div>
                            <span class="name">Chadengle</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-2.jpg" alt="">
                            </div>
                            <span class="name">Tomaslau</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-3.jpg" alt="">
                            </div>
                            <span class="name">Stillnotdavid</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-4.jpg" alt="">
                            </div>
                            <span class="name">Kurafire</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-5.jpg" alt="">
                            </div>
                            <span class="name">Shahedk</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-6.jpg" alt="">
                            </div>
                            <span class="name">Adhamdannaway</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-7.jpg" alt="">
                            </div>
                            <span class="name">Ok</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-8.jpg" alt="">
                            </div>
                            <span class="name">Arashasghari</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-9.jpg" alt="">
                            </div>
                            <span class="name">Joshaustin</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/users/avatar-10.jpg" alt="">
                            </div>
                            <span class="name">Sortino</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                </ul>
            </div>
        </div>
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
    <script src="<?php echo base_url();?>assets/chat/moment-2.2.1.js"></script>
    <script src="<?php echo base_url();?>assets/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/jquery-detectmobile/detect.js"></script>
    <script src="<?php echo base_url();?>assets/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url();?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>assets/jquery-blockui/jquery.blockUI.js"></script>

    <!-- sweet alerts -->
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>
  <!-- Notification -->
        <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
        <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
        <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
    <!-- CUSTOM JS -->
    <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
    <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

    <script src="<?php echo base_url();?>assets/pro_js/add_individual_cage.js"></script>
	<!-- <script src="<?php echo base_url();?>assets/responsive-table/rwd-table.min.js" type="text/javascript"></script> -->

    <script type="text/javascript">
//    $(document).ready(function() {
//         $('#add_cage').dataTable();
//     });
    </script>

    <script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>index.php/";

    $(document).ready(function() {
		$('#feed_tb').DataTable( {
       // dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		paging: false,
      //  ordering: false,
        info: false,
		searching:false
    } );



        var page = "add_individual_cage";

        if (page == "add_individual_cage") {
            $('.feedm_m').click();
            $(".add_ic_feed_m").addClass("active");
        }

    });

    // Select2
    jQuery(".select2").select2({
        width: '100%',

    });
    </script>
</body>

</html>
