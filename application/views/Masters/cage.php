<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Cage Details</title>

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
                                                <h4 class="modal-title">ADD Cage</h4> 
                                            </div> 
                                            <form name="cage_form" id="cage_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Masters/add_cage'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                    
                                                    	
                                                            <label for="Aviary">Select Aviary Name</label>
                                                                 <select name="aviary_id" class="form-control" required>
                                                                        <option value="">Select Aviary Name</option>
                                                                        <?php foreach($aviary as $t => $aviary ){ 
                                                                            $branch_id = $this->session->userdata('branch_id'); //important
                                                                            if($branch_id == $aviary['branch_id']) {?>
                                                                        <option value="<?php echo $aviary['auto_id'] ?>"><?php echo $aviary['aviary_name'] ?></option>
                                                                        <?php } }?>
                                                                </select>
                                                    
																			</div>
																			<div class="col-md-6"> 
                                                      
                                                            <label for="Cage Name" class="control-label">Cage</label>
                                                             <!-- <input type="hidden" name="auto_id" id="auto_id" class="form-control" value="<?php //$last_id=$last_id['id']+1; echo "C00".$last_id; ?>">  -->
                                                            <input type="hidden" name="created_by" id="created_by" class="form-control" value="<?php echo $this->session->userdata('user_id') ?>"> 
                                                            <input type="text" name="cage" id="cage" class="form-control" required>
                                                        
                                                    </div> 
													<div class="col-md-6"> 
														<label for="diet" class="control-label">Diet pattern</label>
														<select name="diet" class="form-control" required>
														<option value="">select</option>
														<option>Maintenance Diet</option>
														<option>Breeding Diet</option>
														<option>Semiadult Diet</option>
														</select>
                                                        </div>

   													 <div class="col-md-6"> 
														<label for="mrng_feed" class="control-label">Target Morning Feed</label>
                                                        <input type="text" name="mrng_feed" id="mrng_feed" class="form-control" required>
                                                        </div>

														<div class="col-md-6"> 
														<label for="aft_feed" class="control-label">Target Afternoon Feed</label>
                                                        <input type="text" name="aft_feed" id="aft_feed" class="form-control" required>
                                                        </div>

                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add Cage</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
                                 
                                 
                               <!-- <ol class="breadcrumb pull-right">
                                    <li><a href="#">Moltran</a></li>
                                    <li><a href="#">Tables</a></li>
                                    <li class="active">Datatable</li>
                                </ol>-->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Cage List</h3>
                                    </div>
                                    <div class="panel-body">
                                    <div class ="row">
                                        <div class="col-md-2">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">
                                     Add Cage
                                     </button>
									 <br><br>
									 <button onclick="get_delete_all()" class="btn btn-danger">Delete All</button>

                                     <br><br>
                                     </div>

                                     <div class="col-md-2">
                                         <a href="<?php echo base_url('index.php/Download/cage_Download'); ?>" class="btn btn-info waves-effect waves-light" ><i class="fa fa-pencil-square-o"></i>Download Sample</a>
                                    </div>
                                    <div class="col-md-8">
                                        <form id="raw_material"   action="<?php echo base_url("index.php/Download/cage_upload") ?>" method="post" enctype="multipart/form-data">
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
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Aviary Name</th>
                                                            <th>Cage</th>
															<th>Diet Pattern</th>
															<th>Target Mrng Feed</th>
															<th>Target Aft Feed</th>
                                                           <!-- <th>No of Birds</th>-->
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        <?php 
                                                         $count =0;
                                                        foreach($cage_join_aviary as $k => $val ){ $branch_id = $this->session->userdata('branch_id');
                                                       
                                                        if($branch_id == $val['branch_id']){
                                                            $count++;
                                                            ?>
                                                            <tr>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $count; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>">
                                                                
																	<?php echo $val['aviary_name']; ?>
                                                            
                                                                </td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['cage']; ?></td>
																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['diet_pattern']; ?></td>

																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['target_mrg_feed']; ?></td>

																<td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['target_aft_feed']; ?></td>

                                                                <!--<td class="<?php //if($val['status']==0) { echo "danger"; } ?>"><?php //echo $val['no_of_birds']; ?></td>-->
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?> text-center"> 
                                                                                             
                                                                <a href="<?php echo base_url('index.php/Masters/edit_cage/'.$val['id']); ?>" class="btn btn-primary btn-xs" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;
                                                                    
                                                     <?php if($val['status']==0) {  ?>
                                                    <a active_id="<?php echo $val['id'];?>" href="#" class="btn btn-success btn-xs active_doc "><i class="fa fa-ban"></i>  </a>
                                                    <?php } else { ?>
                                                    <a inactive_id="<?php echo $val['id'];?>" href="#" class="btn btn-warning btn-xs inactive_doc "><i class="fa fa-ban"></i> </a>
                                                    <?php } ?>
                                                    
                                                    <a  onclick="get_delete_pop('<?php echo $val['id'];?>','ckb_cage');" href="#" class="btn btn-danger btn-xs "><i class="fa fa-close"></i> </a>
            
                                                               
                                                                
                                                                
                                                                    
                                                                </td>
                                                            </tr>
                                                        <?php } }?>
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
				var  page="cage";
				
				if(page=="cage"){
                    $(".settings_m").click();
					$(".cage").addClass("active");
				}
			
			});
			
			
			
			
			
			$(document).ready(function() {
			    $(document).on('click','.inactive_doc',function(){
					var resp = confirm("Do you want to Inactive this Cage?");
					if (resp == true) {
						var inactive_id = $(this).attr('inactive_id');
						//alert(inactive_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/inactive_cage",
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
					var resp = confirm("Do you want to active this Cage?");
					if (resp == true) {
						var active_id = $(this).attr('active_id');
						//alert(active_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/active_cage",
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
            function get_delete_pop(row_id,table){
  
  swal({   
      title: "Are you sure? Please be carefull, it affects whole project data",   
      text: "You will not be able to recover this CAGE and all the data related to this cage also affected!!!",   
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
function get_delete_all(){
  
  swal({   
      title: "Are you sure to delete All the Cages data? ",   
      text: "You will not be able to recover this Cage and all the data related this Cage also affected!!!",   
      type: "warning",   
      showCancelButton: true,  
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(isConfirm){   
      
      if(isConfirm){
          $.ajax({
              url:"<?php echo base_url(); ?>index.php/Masters/delete_species_all",
              method: "POST",
              data:{"table":"ckb_cage"},
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