<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Requirement</title>

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
                                <div id="req_mail-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">LOGIN & SEND MAIL</h4> 
                                            </div> 
                                            <form name="req_mail_form" id="req_mail_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Email_send/sample_mail'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="email_address" class="control-label">Your Email Address</label>
                                                            <input type="hidden" name="created_by" id="created_by" class="form-control" value="<?php// echo $this->session->userdata('user_id') ?>"> 
                                                            <input type="text" name="email_id" id="email_id" class="form-control" required>
                                                        </div> 
                                                 
                                                  
                                                        <div class="form-group"> 
                                                            <label for="Password" class="control-label">Password</label>
                                                            <input type="password" name="email_password" id="email_password" class="form-control" required>
                                                        </div> 
                                                  
                                                    
                                                        <div class="form-group"> 
                                                            <label for="email_address" class="control-label"> To Email Address</label>
                                                            <input type="text" name="to_id" id="to_id" class="form-control" required>
                                                        </div> 
                                                  
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Send Mail</button> 
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
                                        <h3 class="panel-title">R&D Team</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                  <div class="row">
                                      <form name="team_register" id="team_register" action="javasript:void(0)" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                             <div class="col-md-3">
                                               <div class="form-group">
                                                   <label for="divisions">From Divisions</label>
                                                   <select class="form-control"  id="divisions" name="divisions">
                                                    <option value="">Select Divisions</option>
                                                    <option value="Health">Health</option>
                                                    <option value="Fisheries">Fisheries</option>
                                                    <option value="NPD">NPD</option>
                                                    <option value="Nutrition">Nutrition</option>
                                                    <option value="Breeding">Breeding</option>
													<option value="R&D">R&D</option>
													<option value="Incubation">Incubation</option>
													<option value="Handfeeding">Handfeeding</option>
													<option value="Preweaning">Preweaning</option>
													<option value="Weaning">Weaning</option>
													<option>Birds manage</option>
													<option>Operation</option>
                                                    </select>
                                                   </div>
                                                </div>

												<div class="col-md-3">
                                               <div class="form-group">
                                                   <label for="divisions">To Divisions</label>
                                                   <select class="form-control"  id="to_divisions" name="to_divisions">
                                                    <option value="">Select Divisions</option>
                                                    <option value="Health">Health</option>
                                                    <option value="Fisheries">Fisheries</option>
                                                    <option value="NPD">NPD</option>
                                                    <option value="Nutrition">Nutrition</option>
                                                    <option value="Breeding">Breeding</option>
													<option value="R&D">R&D</option>
													<option value="Incubation">Incubation</option>
													<option value="Handfeeding">Handfeeding</option>
													<option value="Preweaning">Preweaning</option>
													<option value="Weaning">Weaning</option>
													<option>Birds manage</option>
													<option>Operation</option>
                                                    </select>
                                                   </div>
                                                </div>

                                                <div class="col-md-3">
                                               <div class="form-group">
                                                   <label for="requirement">Requirement</label>
                                                   <textarea class="form-control"  id="requirement" name="requirement" required>
                                                   
                                                    </textarea>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                               <div class="form-group">
                                                   <label for="request">Date of placing the request</label>
                                                   <input type="date" class="form-control" id="date_req"
                                                    name="date_req" placeholder="" value="<?php echo date('Y-m-d'); ?>" required>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                            <button type ="submit" style="margin-top: 10%; margin-left: 10%;" class="btn btn-primary waves-effect waves-light">Send Request</button>
                                        </div>

                                           
                                             
                                    </form>
                                    </div>
                                   <br>
                                   <br>
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
                                                            <th>Date of request</th>
                                                            <th>Date of completion</th>
															<th>Reason</th>
                                                            <th class="text-center">Status</th>
															<th class="text-center">Delete</th>
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
                                                            if($val->date_doc=="" ){
                                                                $doc = "Still not assigned by management";
                                                            }
                                                            else if($val->date_doc !==" " ){
                                                                $doc = $val->date_doc;
                                                            }
                                                            $count++;
                                                            $req_date = date("d-m-Y", strtotime($val->date_req));
                                                            echo '<tr><td>'.$count.'</td>
                                                            <td>'.$val->divisions.'</td>
															<td>'.$val->to_division.'</td>
                                                            <td>'.$val->requirement.'</td>
                                                            <td>'.$req_date.'</td>
                                                            <td>'.$doc.'</td>
															<td>'.$val->reason.'</td>
                                                            <td>'.$status.'</td>';
															?>
															<td> <a  onclick="get_delete_pop('<?php echo $val->id;?>','ckb_exec_team_register');" href="#" class="btn btn-danger btn-xs "><i class="fa fa-close"></i> </a>
																</td>
<?php

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
				var  page="team_register";
				
				if(page=="team_register"){
					$(".excecution_m").click();
					$(".team").addClass("active");
				}
			
			});
			function get_delete_pop(row_id,table){
  
  swal({   
      title: "Are you sure? Please be carefull, it affects whole project data",   
      text: "You will not be able to recover this Requirement and all the data related to this Requirement also affected!!!",   
      type: "warning",   
      showCancelButton: true,  
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(isConfirm){   
      
      if(isConfirm){
          $.ajax({
              url:"<?php echo base_url(); ?>index.php/Masters/delete_row_byid",
              method: "POST",
              data:{"row_id":row_id,"table":table},
              dataType: "JSON",
              success: function(data) {
                  
                  if(data =='success'){
                      swal("Deleted!", "Your data has been deleted.", "success"); 
                      location.reload();
                  }
                  else{
                      swal("Cancelled", "Your data file is safe :)", "error"); 
                  }
                 // get_incubation_list();

              }
      
          });
  
      }
      
  });
}
		</script>
	</body>
</html>
