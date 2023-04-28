<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">
		<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
	 $page = end($link_array);
	 if( $page == "all"){
		$page_name = "Total Eggs";
	 }
	 if( $page == "assist"){
		$page_name = "Hatch (Assist)";
	 }
	 if( $page == "normal"){
		$page_name = "Hatch (Normal)";
	 }
	 if( $page == "infertile"){
		$page_name = "Infertile Eggs";
	 }
	 if( $page == "dis"){
		$page_name = "Dis Eggs";
	 }
	 if( $page == "crack"){
		$page_name = "Crack Eggs";
	 }
	 if( $page == "broken"){
		$page_name = "Broken Eggs";
	 }
	 
	 if( $page == "healthy"){
		$page_name = "Healthy Chicks";
	 }
	 if( $page == "low_weight_chick"){
		$page_name = "Low hatch weight chicks";
	 }
	 if( $page == "yolk_sac"){
		$page_name = "Unabsorbed yolk sac";
	 }
	 if( $page == "yolk_sac_infection"){
		$page_name = "Yolk sac infection chicks";
	 }
	 if( $page == "splay_leg"){
		$page_name = "Splayed leg chicks";
	 }
	 if( $page == "wry_neck"){
		$page_name = "Wry neck chick";
	 }
	 if( $page == "unknown"){
		$page_name = "Unknown Eggs";
	 }
	 
	 
	 
?>

        <title><?php echo $this->session->userdata('client_name'); ?> | <?php echo $page_name; ?> History</title>

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
		<link href="<?php echo asset_url();?>css/response_table.css" rel="stylesheet" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
        
        <!--<style>
			.diplay_block{ display:block !important;}
		</style>-->
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
    @media screen
{
    .noPrint{}
    .visible{display:none;}
}

@media print
{
    .noPrint{display:none;}
    #incub_printtb{display:block;}
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
                                <h4 class="pull-left page-title">
                                	 
                                	
                                 </h4>
                                 
                                 
                                  <!-- start: alert Message -->
								 <?php $message = $this->session->flashdata('message'); ?>
                                <?php $error = $this->session->flashdata('error'); ?>
                                    <?php if (!empty($message)): ?>
                                        <div class="alert alert-success" style="clear:both;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="fa fa-check-circle fa-fw fa-lg"></i>
                                            <strong></strong> <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
            
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger" style="clear:both;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
                                            <i class="fa fa-times-circle fa-fw fa-lg"></i>
                                            <strong></strong><?php echo $error; ?>
                                        </div>              
                                    <?php endif; ?>
                                     <!-- start: alert Message -->
                                 
                                 
                                <!-- /.modal -->
                               
                                 
                                 
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                        <h3 class="panel-title"><?php echo $page_name; ?> History</h3>
                                        
                                    </div>
                                                                        
<br>
                                      
                               
                                   
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive">
                                                <table id="incub_his" class="table table-striped table-bordered">
												<thead>
                                                        <tr>
                                                            <th class="noExport">#</th>
                                                            <th>Sno</th>
                                                            <th>Group</th>
                                                            <th>Bird Species</th>
                                                            <th>Avairy</th>
                                                            <th>Cage</th>
                                                            <th>Male Parent Ring No</th>
                                                            <th>Female Parent Ring No</th>
                                                            <th>Egg No</th>
															<!-- <th>Standard Egg weight</th> -->
                                                            <th>Egg Weight</th>
															<!-- <th>Standard Hatch weight</th> -->
															<!-- <th>Hatch Weight</th> -->
															<th>Fertile Type</th>
															<th>Date(Egg type)</th>
															<th>Remark</th>
															<th>PIP Weight</th>
															<th>PIP Date</th>
															<th>DOI</th>
															<th>Hatch Date</th>
															<th>Shell Weight</th>
															<th>Hatch Type</th>
															<th>Shell Thick</th>
															<th>DIS Type</th>
															<th>DIS Date</th>
															<th>Egg Length</th>
															<th>Egg Breadth</th>
															<th>Egg index</th>
															<th>Shell layer</th>
															<th>Hatch Time</th>
															<th>Moved_time</th>
															<th>Bos Date</th>
															<th>Lay to pip hatch weight</th>
															<th>Health Status</th>
														
                                                            <th>Cltuch No</th>
                                                            <th>Egg No In Clutch</th>
															  <th class="noExport">Action</th>
                                                            <th class="noExport">Weight Loss History</th>
															<th>Bos Findings</th>
															
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
                            
                        </div> <!-- End Row -->
						<div id="health-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 					<div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Change Health Status</h4> 
                                            </div> 
                                            <form name="health_form" id="health_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label><br>
                                                            <div id="health_id"></div>
                                                            <input type = "date"  name="hs_date" class="form-control" id="hs_date" required />	
                                                     </div>
                                                     <div class="form-group"> 
                                                            <label for="Date" class="control-label">Status</label><br>
                                                            <div id="pid"></div>
                                                            <select name="health_status" class="form-control" id="health_status" required >	
                                                            <option value="">Select Status</option>
															<option>Healthy chick</option>
															<option>Low hatch weight chick</option>
															<option>Unabsorbed yolk sac</option>
															<option>Yolk sac infection chick</option>
															<option>Splayed leg chick</option>
															<option>Wry neck chick</option>
                                                               </select>
                                                     </div>
                                                    
                                                    </div> 
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Change</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
								<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">MOVE</h4> 
                                            </div> 
                                            <form name="move_form" id="move_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Date</label>
                                                            <div id="getid"></div>
                                                             <input type="hidden" name="auto_id" id="auto_id" class="form-control" value="<?php //$last_id=$last_id['id']+1; echo "A00".$last_id; ?>"> 
                                                            <input type="text" name="move_date" id="move_date" class="form-control" value="<?php echo date("d-m-Y");  ?>"> 
                                                     </div>
                                                   <div class="form-group">
                                                            <label for="brooder" class="control-label">SELECT BR0ODER</label>
                                                        <select name="brooder" id="brooder_select" class="select2 form-control" required>
                                                            <option value="">Select brooder</option>
                                                        </select>
                                                        </div> 
                                                    </div> 
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Move</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
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
         <script src="<?php echo base_url();?>assets/pro_js/incub_history_view.js"></script>

        
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

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
        <script type="text/javascript">
               var BASE_URL = "<?php echo base_url();?>index.php/";
    //         $(document).ready(function() {
    //               $('#incub_his').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    // } );
//} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var  page="incubation_history";
				
				if(page=="incubation_history"){
                    $('.incubation_m').click();
					$(".incub_history").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
