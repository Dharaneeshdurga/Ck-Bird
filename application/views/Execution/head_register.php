<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | R&D Head</title>

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
                                <div id="ch_status-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Update status</h4> 
                                            </div> 
                                            <form name="update_form" id="update_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Execution/update_reason'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="ch_status" class="control-label">Select status</label>
                                                            <input type="hidden" name="manage_id" id="manage_id" class="form-control"> 
                                                            <select class="form-control" name="change_status" id="change_status" required>
                                                                  <option value="">Select status</option>
                                                                  <option value="1">Close</option>
                                                                  <option value="0">Open</option>
                                                               </select>
                                                        </div> 
                                                 
                                                  
                                                        <div class="form-group" id="reason1" style="display:none"> 
                                                            <label for="Reason" class="control-label">Reason</label>
                                                            <input type="text" name="reason" id="reason" class="form-control">
                                                        </div> 
                                                  
                                                    
                                                        <div class="form-group" id="new_doc1" style="display:none"> 
                                                            <label for="doc" class="control-label"> Date of Completion</label>
                                                            <input type="date" name="new_doc" id="new_doc" class="form-control">
                                                        </div> 
                                                  
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                                <!-- /.modal -->
                                 
                                 
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">R&D Head</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                 
                                   <br>
                                   
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
															<th>From Division</th>
															<th>To Division</th>
                                                            <th>Requirement</th>
                                                            <th>Date of completion</th>
                                                            
                                                             <th class="text-center" class="st_change" >Reason for incomplete</th> 
                                                            <th>Action</th>
															<th class="text-center" class="st_change" >Status</th> 
                                                            <th>Send</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                 <?php  if (isset($team_result) && !empty($team_result)) { 
                                                           $count = 0;
                                                         
                                                         foreach($team_result as $val) { 
                                                            if($val->status_change == 0){
                                                                $status = "Open";
                                                            }
                                                            if($val->status_change == 1){
                                                                $status = "Closed";
                                                            }
                                                            $count++;
                                                            $req_date = date("d-m-Y", strtotime($val->date_req));?>

                                                         <tr>
                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo $count; ?></td>
                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo$val->divisions ;?></td>
														   <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo$val->to_division ;?></td>

                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo $val->requirement;?></td>
                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo $val->date_doc; ?></td>
                                                          
                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo $val->reason; ?></td>
                                                          <?php //if($val->status_rd == "") { ?>
                                                           <td class="<?php if($val->status_change==1) { echo "danger"; } ?>">
                                                           <form name="head_register" id="head_register" action="<?php echo base_url('index.php/Execution/update_head_decision'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">

                                                           <input type="hidden" class="form-control" name="team_id" id="team_id" value="<?php echo $val->auto_id; ?>"/>

                                                           <select class="form-control" name="status_rd" id="status_rd">
                                                              <option value="">Select</option>
                                                              <option value="Accepted">Accepted</option>
                                                              <option value="Rejected">Rejected</option>

                                                          </select>
                                                        
                                                            </td>
															<td class="<?php if($val->status_change==1) { echo "danger"; } ?>"><?php echo $status;
															 if($val->status_rd !=""){
																echo "/" . $val->status_rd;
															 }
															 ?>
														</td>
                                                            <td class="<?php if($val->status_change==1) { echo "danger"; } ?>"> <button type=submit class="btn btn-purple waves-effect waves-light">Send</button></td></tr>
  
                                                        </form>
                                                         

                                                     <?php  
                                                        //  } // end status if
                                                        //   else{
                                                        //      echo '<td>'. $val->status_rd.'</td>
                                                        //      <td> <button type=submit class="btn btn-purple waves-effect waves-light" disabled>Send</button></td></tr>
                                                        //      ';
                                                              
                                                        //   }  
                                                     }
                                                        }
                                                             ?>
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


        <script type="text/javascript">
               var BASE_URL = "<?php echo base_url();?>index.php/";
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
				var  page="head_register";
				
				if(page=="head_register"){
					$(".excecution_m").click();
					$(".head").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
