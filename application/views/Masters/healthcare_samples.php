<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Samples Collected list</title>

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
                                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">ADD SAMPLES COLLECTED</h4> 
                                            </div> 
                                            <form name="healthsample_form" id="healthsample_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Healthcare/add_samples'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
													<div class="form-group"> 
                                                            <label for="Date" class="control-label" >Date</label>
                                                         
                                                            <input type="date" name="samples_date" id="samples_date" value="<?php echo date('Y-m-d');?>" class="form-control" required>
                                                        </div> 
                                                        <div class="form-group"> 
                                                            <label for="Aviary Name" class="control-label">SAMPLES NAME</label>
                                                            <!-- <input type="hidden" name="auto_id" id="auto_id" class="form-control" value="<?php// $last_id=$last_id['id']+1; echo "SM00".$last_id; ?>">  -->
                                                            <input type="hidden" name="created_by" id="created_by" class="form-control" value="<?php echo $this->session->userdata('user_id') ?>"> 
                                                            <input type="text" name="samples_name" id="samples_name" class="form-control" required>
                                                        </div> 

														<div class="form-group"> 
                                                            <label for="test" class="control-label" >Test for</label>
                                                         
                                                            <input type="text" name="test_for" id="test_for"  class="form-control" >
                                                        </div> 
														<div class="form-group"> 
                                                            <label for="Inference" class="control-label" >Inference</label>
                                                         
                                                            <input type="text" name="inference" id="inference"  class="form-control" >
                                                        </div>
														<div class="form-group"> 
                                                            <label for="Result" class="control-label" >Result</label>
                                                         
                                                            <input type="text" name="result" id="result"  class="form-control" >
                                                        </div>
                                                    </div> 
													
												
                                                     
                                                </div> 
												
											
													
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">ADD</button> 
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
                                        <h3 class="panel-title">Samples List</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">
                                     Add Samples
                                     </button><br><br>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
															<th>Date</th>
                                                            <th>Samples Collected List</th>
															<th>Test for</th>
															<th>Inference</th>
															<th>Result</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($samples as $k => $val ){ ?>
                                                            <tr>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $k+1; ?></td>
																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php if($val['samples_date'] != ""){ echo  date("d-m-Y", strtotime($val['samples_date'])); }?></td>

                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['samples_name']; ?></td>
                                                            
																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['test_for']; ?></td>
																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['inference']; ?></td>
																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['result']; ?></td>



																<td class="<?php if($val['status']==0) { echo "danger"; } ?> text-center"> 
                                                                                             
                                                                <a href="<?php echo base_url('index.php/Healthcare/edit_healthcare_samples/'.$val['id']); ?>" class="btn btn-primary btn-xs" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;
                                                                    
                                                     <?php if($val['status']==0) {  ?>
                                                    <a active_id="<?php echo $val['id'];?>" href="#" class="btn btn-success btn-xs active_doc "><i class="fa fa-ban"></i>  </a>
                                                    <?php } else { ?>
                                                    <a inactive_id="<?php echo $val['id'];?>" href="#" class="btn btn-danger btn-xs inactive_doc "><i class="fa fa-ban"></i> </a>
                                                    <?php } ?>
                                                    
                                                                   
                                                               
                                                                
                                                                
                                                                    
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
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

        



        <!-- CUSTOM JS -->
         <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
				var  page="samples";
				
				if(page=="samples"){
					$('.healthcare_m').click();
					$(".samples").addClass("active");
				}
			
			});
			
			
			
			
			
			$(document).ready(function() {
			    $(document).on('click','.inactive_doc',function(){
					var resp = confirm("Do you want to Inactive this samples collected?");
					if (resp == true) {
						var inactive_id = $(this).attr('inactive_id');
						//alert(inactive_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Healthcare/inactive_samples",
							data : {'inactive_id':inactive_id},
							success:function(data){
								//var filetable = $('#datatable').DataTable();
								location.reload();
							}
						});
					} 
					else {
							
					} 
				}); 
			});//end doc
			
			
			
			$(document).ready(function() {
			    $(document).on('click','.active_doc',function(){
					var resp = confirm("Do you want to active this samples collected??");
					if (resp == true) {
						var active_id = $(this).attr('active_id');
						//alert(active_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Healthcare/active_samples",
							data : {'active_id':active_id},
							success:function(data){
								//var filetable = $('#datatable').DataTable();
								location.reload();
							}
						});
					} 
					else {
							
					} 
				}); 
			});//end doc
		</script>
	</body>
</html>
