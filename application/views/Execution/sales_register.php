<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Sales Register</title>

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
        
        <style>
		/*	.diplay_block{ display:block !important;}*/

.dataTables_scroll
{
    overflow:auto;
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
                                     <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Sales Register</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#"></a></li>
                                    <li class="active"></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Start Widget -->
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-info"><i class="md md-account-circle"></i></span>
                                    <div class="mini-stat-info text-right text-muted">
                                        <span class="counter" id="total_eggs"></span>
                                        <a href="javascript:void(0)" id="show_eggs">Total Eggs</a>
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">Eggs <span class="pull-right"></span></h5>
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                    <!--span class="sr-only">60% Complete</span-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-purple"><i class="fa fa-twitter"></i></span>
                                    <div class="mini-stat-info text-right text-muted">
                                        <span class="counter" id="total_chicks"></span>
                                       <a href="#" id="show_chick">Total Chicks</a>
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">Chicks <span class="pull-right"></span></h5>
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                                    <span class="sr-only">Get details</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-success"><i class="ion-eye"></i></span>
                                    <div class="mini-stat-info text-right text-muted">
                                        <span class="counter" id="production"></span>
                                        <a href="#" id="show_production">Total Production</a>
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">Production <span class="pull-right"></span></h5>
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-primary"><i class="ion-android-contacts"></i></span>
                                    <div class="mini-stat-info text-right text-muted">
                                        <span class="counter" id="total_sales"></span>
                                        <a href="#" id="show_sales">Total Sales</a>
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">Sales<span class="pull-right"></span></h5>
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%;">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-primary"><i class="ion-android-contacts"></i></span>
                                    <div class="mini-stat-info text-right text-muted">
                                        <span class="counter" id="total_purchase"></span>
                                        <a href="#" id="show_purchase">Total Purchase</a>
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">Purchase<span class="pull-right"></span></h5>
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%;">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- End row-->
                        <div class="row">
                            <div class="col-md-12">
                               <div class="panel panel-default" id="hideshow_eggs">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Eggs detail</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br> 
                                 <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="eggs_total" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:290px;">S.No</th>
                                                            <th style="width:290px;">Species Name</th>
                                                            <th style="width:290px;">Egg no</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody id="egg_full_details">
													<?php 
											   $count = 0;
											   foreach($total_eggs_details as $egg){
												$count = $count+1;
												?> 
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $egg->bird_species;?></td>
													<td><?php echo $egg->egg_no;?></td>
											   </tr>
											   <?php
											}
											   ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="panel panel-default" id="hideshow_chick">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Chicks detail</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br> 
                                 <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="chicks_total" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Species Name</th>
                                                            <th>Ring no</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody id="chick_full_details">
                                               <?php 
											   $count = 0;
											   foreach($total_chick_details as $chick){
												$count = $count+1;
												?> 
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $chick->bird_species;?></td>
													<td><?php echo $chick->egg_no;?></td>
											   </tr>
											   <?php
											}
											   ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="panel panel-default" id="hs_pro">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Production detail</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br> 
                                 <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="product_total" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Species Name</th>
                                                            <th>Ring no</th>
                                                            <th>Cage no</th>
                                                            <th>Aviary</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody id="">
													<?php 
											   $count = 0;
											   foreach($total_pro_details as $pro){
												$count = $count+1;
												?> 
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $pro->bird_species;?></td>
													<td><?php echo $pro->ring_no;?></td>
													<td><?php echo $pro->cage_id;?></td>
													<td><?php echo $pro->aviary_name;?></td>
											   </tr>
											   <?php
											}
											   ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default" id="hs_sales">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sales detail</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br> 
                                 <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="sales_total" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Species Name</th>
                                                            <th>Ring no</th>
                                                            <th>Cage no</th>
                                                            <th>Aviary</th>
                                                            <th> Photo</th>
                                                            <th> Video</th>
                                                            <th>Sales update</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody id="sales_full_details">
													<?php 
											   $count = 0;
											   foreach($total_sales_details as $sales){
												$count = $count+1;
												?> 
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $sales->bird_species;?></td>
													<td><?php echo $sales->ring_no;?></td>
													<td><?php echo $sales->cage_id;?></td>
													<td><?php echo $sales->aviary_name;?></td>
													<?php  $img_name = $sales->bird_image;
              												 $video_name = $sales->bird_video; ?>
															 <td> <button onclick="get_bird_images('<?php echo $img_name;?>')"><img class="pop" src="<?php echo base_url().'uploads/images/'.$sales->bird_image;?>" style="width: 50px; height: 50px;"> </button></td>
															 <td><button onclick="show_bird_video('<?php echo $video_name;?>')">Play Video</button></td>
															 <td><form method="post" action="<?php echo base_url().'Execution/sales_update/'?>">
																<input type="hidden" name="sp_name" value="<?php echo $sales->bird_species;?>"><input type="hidden" name="sp_ring" value="<?php echo $sales->ring_no;?>">
																 <button type="submit" value="Add">Add</button>
															</form></td>
															</tr>
											   <?php
											}
											   ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" id="hs_purchase">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Purchase detail</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br> 
                                 <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="purchase_total" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Species Name</th>
                                                            <th>Ring no</th>
                                                            <th>Purchase update</th>
                                                            
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody id="purchase_full_details">
													<?php 
											   $count = 0;
											   foreach($total_pur_details as $pur){
												$count = $count+1;
												?> 
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $pur->bird_species;?></td>
													<td><?php echo $pur->ring_no;?></td>
												
													<?php echo '<td><button onclick="show_purchase_register('."'".$pur->ring_no."'".','."'".$pur->bird_species."'".')">Purchase Update</button></td>';?>
											   </tr>
											   <?php
											}
											   ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="purchase-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Add Purchase Register</h4> 
                                            </div> 
                                          
                                              <div class="modal-body"> 
                                               <form name="purchase_form" id="purchase_form" class="form-horizontal form-bordered" action="javascript:void(0)" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                              
                                                <!--div class="row"> 
                                                    <div class="col-md-6--> 
                                                    <div class="row">
                                                   
                                                     <div class="col-md-2"> 
                                                        <!--div class="form-group"-->
                                                        <label  >Purchase Date</label>
                                                        <input type="date" name="pur_date" id="pur_date" class="form-control" required>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2"> 
                                                         <!--div class="form-group"-->
                                                        <label for="total_pur_qty" >Species Name</label>
                                                        <input type="text" name="sp_name" id="sp_name" class="form-control" readonly>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2">
                                                        
                                                        <label for="total_pur_rs" class="control-label">Ring No</label>
                                                        <input type="text" name="ring_no" id="ring_no" class="form-control" readonly>
                                                        
                                                      </div>
                                                      <div class="col-md-2">
                                                        
                                                        <label for="total_pur_rs" class="control-label">Price</label>
                                                        <input type="text" name="price" id="price" class="form-control" required>
                                                        
                                                      </div>
                                                      <div class="col-md-2">
                                                        
                                                        <label for="total_pur_rs" class="control-label">Payment Status</label>
                                                        <select name="pay_status" id="pay_status" class="form-control" required>
                                                       
                                                        <option value="" class="">Select Status</option>
                                                        <option value="Paid" class="">Paid</option>
                                                            <option value="Not Paid" class="">Not Paid</option>
                                                        </select>
                                                      </div>
                                                      
                                                     </div>
                                                     </div>
                                                     <br>
    
                                                  
                                                      
                                                     
                                              
                                             
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add Purchase Register</button> 
                                            </div> 
                                            </form>
      
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div id="bird_img"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div id="bird_video"></div>
      </div>
    </div>
  </div>
</div>
       
                        </div> <!-- End Row -->
                            
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


        <!-- CUSTOM JS -->
         <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
         <script src="<?php echo base_url();?>assets/pro_js/execution/sales.js"></script>

        
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
               var BASE_URL = "<?php echo base_url();?>index.php/";
               var IMG_URL = "<?php echo base_url();?>uploads/";
           $(document).ready(function() {
              
              

	


           } );
		   jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
				var  page="sales_register";
				
				if(page=="sales_register"){
					$(".sales_m").click();
					$(".sales").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
