<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Export excel</title>

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
                            <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Species Age and Standard Weight Details</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Masters/species">Species List
                                        Details</a></li>
                                <li class="active">Species Age and Standard Weight Details</li>
                            </ol>
                        </div>
                    </div>
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
                                 
                            <div class="panel panel-default"> 
                            <div class="panel-heading">
                                        <h3 class="panel-title">Species Age and Standard Weight List</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-10">
                                       <?php if (isset($group_name) && !empty($group_name)) { ?>
                                        <h4 class="panel-title">Group-name:  <?php echo $group_name; ?></h4>
                                        <h4 class="panel-title">Species-name:  <?php echo $bird_species; ?></h4><br>
                                        <?php } ?>
                            <div class="table-responsive">
                         <?php   if (isset($species_result) && !empty($species_result)) { ?>
    <table id="datatable" class="table table-striped table-bordered">
        <?php }
        else { ?> 
        <table  class="table table-striped table-bordered">
             <?php } ?>
        <thead>
            <tr>
                <th class="header">Age</th>
                <th class="header">Standard Weight</th>   
                <th class="header">Action</th>                           
                <!--th class="header">Email</th>                      
                <th class="header">DOB</th>
                <th class="header">Contact Name</th-->
            </tr>
        </thead>
        <tbody>
            <?php  //print_r($species_result); 
            if (isset($species_result) && !empty($species_result)) {
                foreach($species_result as $key => $value ){ 
                    ?>
                    <tr>
                       
                        <td><?php echo $value['age'];; ?></td>   
                        <td><?php echo $value['std_weight']; ?></td> 
                        <td class="<?php if($value['status']==0) { echo "danger"; } ?> text-center"> 
                            <!--a href="<?php// echo base_url('masters/edit_species/'.$value['id']); ?>" class="btn btn-primary btn-xs" ><i class="fa fa-pencil-square-o"></i></a--> &nbsp;&nbsp;
                             <button  onclick="get_view_pop('<?php echo $value['id']; ?>,<?php echo $value['age']; ?>,<?php echo $value['std_weight']; ?>');" class="btn btn-primary btn-xs " style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="viewbtm" data-original-title="view"><i class="fa fa-pencil-square-o" id="editBtn"></i></button>
                                 <?php if($value['status']==0) {  ?>
                                  <a active_id="<?php echo $value['id'];?>" href="#" class="btn btn-success btn-xs active_doc "><i class="fa fa-ban"></i>  </a>
                                  <?php } else { ?>
                                      <a inactive_id="<?php echo $value['id'];?>" href="#" class="btn btn-danger btn-xs inactive_doc "><i class="fa fa-ban"></i> </a>
                                     <?php } ?>
                         </td>
                    
                    </tr>

                    <div id="age-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Edit Age and Weight</h4> 
                                            </div> 
                                            <form name="age_form" id="age_form" class="form-horizontal form-bordered" action="<?php echo base_url("index.php/Incubtemperature/edit_species_age_weight") ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Age Name" class="control-label">Age</label>
                                                            <div id="edit_id"></div>
                                                            <div id="edit_age"></div>
                                                            <!--input type="text" name="edit_id" id="edit_id" class="form-control" value="">
                                                            
                                                            <input type="text" name="edit_age" id="edit_age" class="form-control" value=""-->
                                                            <label for="Age Name" class="control-label">Standard Weight</label>
                                                            <div id="edit_weight"></div>
                                                            <!--input type="text" name="edit_weight" id="edit_weight" class="form-control"  value="" -->
                                                        </div> 
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
                                </div><!-- /.modal -->
                    <?php



                }
            } else {
                ?>
                <tr>
                    <td colspan="5">There is no data.</td>    
                </tr>
            <?php } ?>

        </tbody>
    </table>
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
            </div>
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

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>
        
        <script type="text/javascript">

function get_view_pop(sp_row_id,sp_age,sp_weight)
            {
// alert(sp_row_id);
 //var getdetails =
 var getArr = sp_row_id.split(',');
 //alert(getArr[0]);
                // $('#edit_id').val(sp_row_id);
                // $('#edit_age').val(sp_age); 
               //  $('#edit_weight').val(sp_weight); 
               var get_id = '<input type="hidden" name="edit_id" class="form-control"  value="'+getArr[0]+'">';
               var get_age = '<input type="text" name="edit_age" class="form-control"  value="'+getArr[1]+'">';
               var get_weight = '<input type="text" name="edit_weight" class="form-control"  value="'+getArr[2]+'">';
               $('#edit_id').html(get_id);  
               $('#edit_age').html(get_age);  
               $('#edit_weight').html(get_weight);  
                $('#age-modal').modal('show');   
               
              /* $.ajax({
                 url: BASE_URL + 'Incubtemperature/get_age',
                 method: "POST",
                 data: {
                    "current_id": sp_row_id,
                },
                 dataType: "JSON",
                 success: function(data) {
                     
                 var age = data[0].age;
                 var weight = data[0].std_weight;
                 

                 }
         
             });*/
                
            }

            $('#age_form12').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/edit_species_age_weight', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Updated Successfully..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL +data.url;
                    }, 
                2000);
                    
            }
            else{
                $.Notification.autoHideNotify(
                    'danger', 
                    'top right', 
                    'Request Failed..! Try Again..!',
                    ''
                );
            }
                    
        }  
    }); 
    
});
        $(document).ready(function () {
				var  page="species";
				
				if(page=="species"){
					$(".aviary_active").addClass("md-remove");
					$(".aviary_active").removeClass("md-add");
					$(".species").addClass("active");
					$(".aviary_dispaly").show();
				}
			
			});
			var BASE_URL = "<?php echo base_url();?>index.php/";
			$('#species_list').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Import/UploadData', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {
            if(data.logstatus =='success'){
               // alert('tesr');
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Imported Successfully..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL +data.url;
                    }, 
                2000);
                    
            }
            else{
                $.Notification.autoHideNotify(
                    'danger', 
                    'top right', 
                    'Request Failed..! Try Again..!',
                    ''
                );
            }
                    
        }  
    }); 
    
});
			
			
			
			$(document).ready(function() {
			    $(document).on('click','.inactive_doc',function(){
					var resp = confirm("Do you want to Inactive this Species?");
					if (resp == true) {
						var inactive_id = $(this).attr('inactive_id');
						//alert(inactive_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/inactive_weight",
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
					var resp = confirm("Do you want to active this Species?");
					if (resp == true) {
						var active_id = $(this).attr('active_id');
						//alert(active_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/active_weight",
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