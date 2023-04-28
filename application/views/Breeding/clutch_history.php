<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Clutch Details</title>

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
                            <!-- <h4 class="pull-left page-title">Proven Details</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php //echo base_url(); ?>index.php/Proven/add_proven">Add Proven</a></li>
                                <li class="active">Proven Details</li>
                            </ol> -->
                        </div>
                    </div>
<!-- move to handfeeding modal -->  
<div id="eggd-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Egg History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="weightloss_export" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                   <div id="weightloss_id"></div>
                                                  
                                                <th>S.no</th>
                                                <th>Laid Date</th>
                                                <th>Egg no(incubation)</th>
                                                <th>Egg Weight</th>
                                                <th>Days bw eggs</th>
                                         </tr>
                                            </thead>
                                            <tbody id="get_eggs">
                                             
                                           
                                               

                                         </tbody> 

                                     
                                                
                                         </table> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <!--button type="submit" class="btn btn-info waves-effect waves-light">Move</button--> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal --> 
   <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Clutch Details</h3>
                                </div>
                                <div class="panel-body">
                                    <!-- <a href="<?php echo base_url(); ?>index.php/Breeding/add_proven"><button
                                            class="btn btn-primary waves-effect waves-light">Add Proven</button></a>
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
                                                <label for="clutch_no">Clutch No</label><br>
                                                        <select class="select2 form-control" id="clutch_no" name="clutch_no" required>
                                                    <option value="">Select Clutch</option>
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
                                                <table class="table table-striped table-bordered" id="clutch_his_tb">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th>Sno</th>
                                                            <th>Clutch no</th>
                                                            <th>egg no</th>
                                                            <th>Egg type</th>
                                                            <!-- <th>Egg no in chick</th> -->
                                                            <th>Egg weight</th>
															<th>Egg laid date</th>
															<th>Days btw eggs</th>
                                                           
                                                        </tr>
                                                    </thead>
													
                                                    <tbody>
                                                      <?php //echo print_r($clutch_result);
													    if(isset($clutch_result)&& (!empty($clutch_result))){
															$count = count($clutch_result);
															//echo $count;
															for($i=0; $i<$count;  $i++){
																$ni = $i-1;
																if($i > 1){
																$date1 = strtotime($clutch_result[$i]->doi); // or your date as well
																$date2 = strtotime($clutch_result[$ni]->doi);
																$datediff = $date1 - $date2;
																$diff = ($datediff / (60 * 60 * 24));
																	//if($i > 1){
																		//
																//	}
																//else{
																	//$diff = 0;
																//}
															}
															else{
																$diff = 0;	
															}
																?>
																<tr>
																  <td><?php echo $i+1; ?></td>
                                                                         <td><?php echo $clutch_result[$i]->clutch_no; ?></td>
                                                                           <td><?php echo $clutch_result[$i]->egg_no; ?></td>
                                                                            <td><?php echo $clutch_result[$i]->fertile_type; ?></td>
																			<!-- <td><?php// echo $value->egg_no_clutch; ?></td> -->
																			<td><?php echo $clutch_result[$i]->egg_weight; ?></td>
																			<td><?php echo  date("d-m-Y", strtotime($clutch_result[$i]->doi)); ?></td>
																			<td><?php echo $diff;?></td>
															</tr>
															
																<?php
																$arry_eggs[] = $clutch_result[$i]->egg_weight;
																$arry_days[] = $diff;
															}
																$sum_eggs= array_sum($arry_eggs);
																$sum_days = array_sum($arry_days);

																$avg_eggs = round($sum_eggs/$count);
																$avg_days = round($sum_days/$count);

														}
													 
													 ?> 
                                                    </tbody>
													<tfoot>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td style=" font-weight:bold;">Avg weight: <?php echo $avg_eggs ;?></td>
	<td></td>
	<td  style=" font-weight:bold;">Avg Days between eggs: <?php echo $avg_days;?></td>
</tr>
														</tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->


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
    <!-- <script src="<?php echo base_url();?>assets/pro_js/breeding/bird_proven.js"></script> -->
    <!-- <script src="<?php //echo base_url();?>assets/pro_js/breeding/add_proven.js"></script> -->
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";

    $(document).ready(function() {
       
		$('#clutch_his_tb').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
        ],
		paging: false,
        ordering: false,
        info: false,
		searching:false
    } );
        $('.btn-group button').removeClass('btn-outline-primary');
        $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

        var page = "proven";

        if (page == "proven") {
            $('.breeding_m').click();
            // $('.incubation_li a').addClass('subdrop');

            $(".proven").addClass("active");
        }

    });
   
    </script>
</body>

</html>
