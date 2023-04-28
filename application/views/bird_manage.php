<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Bird Manage</title>

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
        
        <link href="<?php echo base_url();?>assets/css/response_table.css" rel="stylesheet"/>
        <!-- sweet alerts -->
        <link href="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <style>
            .dataTables_filter{
                float :right;
            }

            table{
                width:100% !important;
            }
            .btn-group{
                margin-top: 15px;
            }
            @media only screen and (max-width: 600px) {  
                .btn-group{
                    margin-bottom: 5px !important;
                    display: inline-grid !important;
                    margin-left: 5px;

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
            .dt-button-collection{
                
                max-height: 250px;
                overflow: auto;
                /* overflow-y: hidden; */
                margin: 0 auto;
                white-space: nowrap
            }
            .dt-button-collection >a.active{
                background-color: #38bbf7;
                color: #ffff;
                margin-bottom: 1px;
            }

            
        </style>
    </head>



    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <?php include('layouts/topbar.php'); ?>

            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <?php include('layouts/sidebar.php'); ?>

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
                            <div class="col-sm-12">Bird Manage</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php echo base_url(); ?>index.php/Bird/add_bird">Add Bird</a></li>
                                    <li class="active">Bird List</li>
                                </ol>
                            </div>
                        </div>
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
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Bird Details</h3>
                                    </div>
                                    <div class="panel-body">
                                    <div class="row">
                                     <div class="col-md-2">
                                        <a href="<?php echo base_url(); ?>index.php/Bird/add_bird"><button class="btn btn-primary waves-effect waves-light">Add Bird</button></a>
										<br>
										<br>
										<button onclick="get_delete_all()" class="btn btn-danger">Delete All</button>
                                       </div>
                                       <div class="col-md-2">
                                         <a href="<?php echo base_url('index.php/Download_sample/bird_Download'); ?>" class="btn btn-info waves-effect waves-light" ><i class="fa fa-pencil-square-o"></i>Download Sample</a>
                                    </div>
                                    <div class="col-md-8">
                                        <form id="raw_material" action="<?php echo base_url("index.php/Download_sample/bird_upload") ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                              <div class="col-md-3">  
                                                 <button class="btn btn-sm btn-success" style="font-size: 14px;"> <input type="file"  name="uploadFile" /></button>
                                                 </div>
                                                <div class="col-md-3">             
                                                    <input type="submit" name="submit"  style="font-size: 14px; margin-left:20px;"  class="btn btn-sm btn-success" value="Upload" />
                                                   </div>
                                             </div>
                                          </form>
                                       </div>                             
                                    </div>
                                    
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="bird_tb">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Ring No</th>
                                                                <th>Group</th>
                                                                <th>Bird Species</th>
                                                                <th>Gender</th>
                                                                <th>Cage</th>
                                                                <th>Aviary</th>
                                                                <!-- <th>Proven</th> -->
                                                                <!-- <th>Std Weight</th> -->
                                                                <th>Bird Status</th>
                                                                <th>Status</th>
                                                                <th class="text-center">Upload</th>
                                                                <th>Action</th>
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
  <!--bird modal-->     <div id="bird-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">CHANGE STATUS</h4> 
                                            </div> 
                                            <form name="bird_status_form" id="bird_status_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
													<div class="form-group"> 
													<label for="Date" class="control-label">Date</label><br>
													<input type="date" class="form-control" name="health_change_date" id="health_change_date">
														</div>
                                                        <div class="form-group"> 
                                                            <label for="Date" class="control-label">Select status</label><br>
                                                            <div id="pid"></div>
                                                            <select name="bird_status" class="form-control" id="bird_status" required >	
                                                                <option value="">Select</option>
                                                                <option value="Hold">Hold</option>

                                                                <option value="Purchase">Purchase</option>

                                                                <option value="Mortality">Mortality</option>

                                                                <option value="Sale">Sale</option>

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
                        <!-- change branch model -->
								<div id="changeBranch-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  									<div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Move Branch</h4> 
                                            </div> 
                                            <form name="branch_change_form" id="branch_change_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="bird_branch" cbird_branchlass="control-label">Select Branch</label><br>
															<input type="hidden" name="ring_no" id="ring_no" class="form-control"/>
															<input type="hidden" name="current_branch" id="current_branch" class="form-control"/>

                                                            <select name="bird_branch" class="form-control" id="bird_branch" required >	
                                                             

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
                 <?php include('layouts/footer.php'); ?>
                
                <!-- footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <?php include('layouts/rightbar.php'); ?>

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
        <script src="<?php echo base_url();?>assets/jquery-detectmobile/detect.js"></script>
        <script src="<?php echo base_url();?>assets/fastclick/fastclick.js"></script>
        <script src="<?php echo base_url();?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/jquery-blockui/jquery.blockUI.js"></script>

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
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
        <script src="<?php echo base_url();?>assets/pro_js/bird_manage.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {

                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

				var  page="bird_manage";

				if(page=="bird_manage"){
					$(".bird_manage_m a").addClass("active");
					$('.bird_manage_m').click();
					$(".bird_manage").addClass("active");
				}

                // $("[data-toggle=tooltip]").popover({trigger:"hover"});
                // $('#editBtn').tooltip({'placement': 'top'});
			});
			function get_delete_all(){
  
  swal({   
      title: "Are you sure to delete All the Birds data? ",   
      text: "You will not be able to recover this Birds and all the data related this Birds also affected!!!",   
      type: "warning",   
      showCancelButton: true,  
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(isConfirm){   
      
      if(isConfirm){
          $.ajax({
              url:"<?php echo base_url(); ?>index.php/Masters/update_bird_status",
              method: "POST",
              data:{"table":"ckb_bird"},
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
