<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | View Bird Manage History</title>

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
			div.dataTables_filter input {
    			margin-left: 0.5em;
     			display: block !important;
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
                                        <h3 class="panel-title">View Birds History</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <form id="sales_update_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Bird/bird_history"; ?>" nctype="multipart/form-data">
                                       

                                       <div class="row">
                                       <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">From Date</label>
                                                           <input type="date" class="select2 form-control" id="date" name="date"  >
                                                       </div>
                                                   </div>
                                                   <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">To Date</label>
                                                           <input type="date" class="select2 form-control" id="to_date" name="to_date" >
                                                       </div>
                                                   </div>
                                     
                                   
                                                   <div class="col-md-2" style="margin-top:25px;">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Filter</button>
												<a href="<?php echo base_url()."index.php/Bird/bird_history"; ?>" class="btn btn-warning">Clear</a>

											</div>
                                        </form>
                                        </div>
                                   <br>
                                   
                                        <div class="row">
										<?php if(!empty($from_date)){
												echo "From Date: ".date("d-m-Y", strtotime($from_date));
												echo "</br>";
												echo "To Date: ".date("d-m-Y", strtotime($to_date));
											}
											?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="bird_his" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Title</th>
                                                            <th>Total</th>
                                                            <th>Percentage</th>
                                                            <th>View</th>
                                                        </tr>
                                                       
                                                    </thead>

                                             
                                              <tbody>
														<?php 
														foreach($bird_history as $value){
															$total_birds = $value['total_birds'];
															$mort = $value['mort'];
															$sale = $value['sale'];
															$purchase = $value['purchase'];
															$semi_adult = $value['semi_adult'];
															$proven = $value['proven'];
															$non_proven = $value['non_proven'];
															$other_branch = $value['other_branch'];
														}
														if($total_birds >0) {
														$total_birds_percent = round(($total_birds/$total_birds)*100,2);
														$mort_percent = round(($mort/$total_birds)*100,2);
														$sale_percent = round(($sale/$total_birds)*100,2);
														$purchase_percent = round(($purchase/$total_birds)*100,2);
														$semi_adult_percent = round(($semi_adult/$total_birds)*100,2);
														$proven_percent = round(($proven/$total_birds)*100,2);
														$non_proven_percent = round(($non_proven/$total_birds)*100,2);
														$other_branch_percent = round(($other_branch/$total_birds)*100,2);

													}
														else{
															$total_birds_percent = "0";
															$mort_percent = "0";
															$sale_percent ="0";
															$purchase_percent = "0";
															$semi_adult_percent = "0";
															$proven_percent = "0";
															$non_proven_percent ="0";
															$other_branch_percent ="0";
														}
														?>
											  <tr>
                                                           <td>1</td>
                                                           <td >Total no of Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $total_birds; ?></td>
                                                           <td style="font-weight:bold;"><?php  echo $total_birds_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/all"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														 <tr>
                                                           <td>2</td>
                                                           <td >Total no of Bird Sales</td>
                                                           <td style="font-weight:bold;"><?php echo $sale; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $sale_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/sale"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														 <tr>
                                                           <td>3</td>
                                                           <td >Total no of Purchase Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $purchase; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $purchase_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/purchase"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														<tr>
                                                           <td>4</td>
                                                           <td >Total no of Mortality Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $mort; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $mort_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/mort"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														 <tr>
                                                           <td>5</td>
                                                           <td >Total no of Semi Adult Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $semi_adult; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $semi_adult_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/semi_adult"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														 <tr>
                                                           <td>6</td>
                                                           <td >Total no of  Birds Moved to other branches</td>
                                                           <td style="font-weight:bold;"><?php echo $other_branch; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $other_branch_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/other_branch/".$from_date."/".$to_date."/other_branch"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
															<tr>
															<td ><span style="display:none">7</span></td>
																<td style="font-size:16px;font-weight:bold">Breeding</td>
																<td style="boder:none"></td>
																<td style="boder:none"></td>
																<td style="boder:none"></td>
															
															</tr>
															<tr>
                                                           <td>7</td>
                                                           <td >Total no of Proven</td>
                                                           <td style="font-weight:bold;"><?php echo $proven; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $proven_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/proven"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
														 <tr>
                                                           <td>8</td>
                                                           <td >Total no of Non Proven</td>
                                                           <td style="font-weight:bold;"><?php echo $non_proven; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $non_proven_percent.'%'; ?></td>
                                                           <td>
														   <a target="_blank" href="<?php echo base_url()."index.php/Bird/bird_history_view/".$from_date."/".$to_date."/non_proven"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
														 </tr>
                                                     </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
         <script src="<?php echo base_url();?>assets/pro_js/execution/team.js"></script>

        
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
            $(document).ready(function() {
                  $('#bird_his').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var  page="bird_history";
				
				if(page=="bird_history"){
					$(".bird_manage_m a").addClass("active");
					$('.bird_manage_m').click();
					$(".bird_history").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
