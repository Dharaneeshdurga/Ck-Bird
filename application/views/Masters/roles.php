<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Roles</title>

        <!-- Base Css Files -->
         <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
       <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/jquery-multi-select/multi-select.css"  rel="stylesheet" type="text/css" />

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
        <link href="<?php echo base_url();?>assets/css/toggle.css" rel="stylesheet" type="text/css" />


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
                                                <h4 class="modal-title">ADD Roles</h4> 
                                            </div> 
                                            <form name="roles_form" id="roles_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Masters/add_roles'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="Role Name" class="control-label">Role Name</label>
                                                            <input type="hidden" name="created_by" id="created_by" class="form-control" value="<?php echo $this->session->userdata('user_id') ?>"> 
                                                            <input type="text" name="role_name" id="role_name" class="form-control" required>
                                                        </div> 
                                                    
                                                  
                                                        <div class="form-group"> 
                                                            <label for="Description" class="control-label">Description</label>
                                                            <textarea name="roles_desc" id="roles_desc" class="form-control" required></textarea>
                                                        </div> 
                                                      </div>
                                                </div> 
                                            </div> 

                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add Role</button> 
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
                                        <h3 class="panel-title">Roles List</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <div class ="row">
                                        <div class="col-md-2">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">
                                     Add Roles
                                     </button><br><br>
                                     </div>
                                     <div class="col-md-2">
                                     <a href="<?php echo base_url('index.php/Masters/view_roles'); ?>" class="btn btn-sm btn-primary" >View Roles</a>
                                      <br><br>
                                     </div>
                                   
                                    
                       
        <?php 
         $count = 0;
        foreach($roles_result as $result) {
            $count = $count+1;
            $div_id = "role-permission-".$count;
            $p_id = "p-".$count;
            ?>    
            <div class="col-md-12 col-sm-12 col-xs-12">                      
         
         <div class="row bg-dark p-3 justify-content-center align-items-center">
            <div class="col-md-4">
                <h5 class="text-white mt-2 mb-2"><strong><?php echo $result->roles_name; ?></strong></h5>
            </div>
            <div class="col-md-4 text-center role-members">
            <?php $query_no = $this->db->get_where('ckb_users', array('role_id'=>$result->auto_id));
                                $members_count = $query_no->num_rows();
                                ?>
                <button class="btn btn-xs btn-danger btn-rounded show-members" data-role-id="2"><i class="fa fa-users"></i><?php echo $members_count;?>  Members</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-default btn-sm btn-rounded pull-right" onclick="toggle('<?php echo $div_id;?>')" data-role-id="<?php echo $count;?>"><i class="fa fa-key"></i> Permissions</button>
            </div>
            
           </div> <br>
          
        </div>
        
                             


        <div class="row" id="reload">
            <div class="col-md-12 b-t permission-section" style="" id="<?php echo $div_id;?>">
                <table class="table ">
                    <thead>
                     <tr class="bg-white">
                        <th>
                            <div class="form-group d-flex">
                                <label class="switch mr-2">
                               <?php
                                $query1 = $this->db->get_where('ckb_role_permission', array('role_id'=>$result->auto_id,'role_permission'=>1, ));
                                $has_permission = $query1->num_rows();
                                echo $has_permission;
                                //exit;
                                if($has_permission >= 14){
                                ?>
                                 <input type="checkbox" id="<?php echo $p_id;?>"onchange="toggleAllPermissions('<?php echo $result->auto_id; ?>', '<?php echo $p_id;?>','<?php echo $div_id;?>');"  checked="checked">
                                 <span class="slider round"></span>
                                 <?php } else {?>
                                    <input type="checkbox" id="<?php echo $p_id;?>"onchange="toggleAllPermissions('<?php echo $result->auto_id; ?>', '<?php echo $p_id;?>','<?php echo $div_id;?>');">
                                    <span class="slider round"></span>
                                    <?php } ?>
                                </label>
                                Select All                            
                            </div>
                        </th>
                        <th>Submenus</th>
                        <th>Permission</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menu_result as $k => $val  ){ 
                        $menu_id = "menu-id-".$val['id']."-".$result->auto_id;
                        ?>
                        
                        <tr>
                                <td><?php echo $val['menu_name'];?></td>
                                <td>
                                    <?php
                                $query = $this->db->get_where('ckb_submenus', array('menu_id' => $val['id'] ));
                                $has_submenu = $query->num_rows();
                                $mrole_id = $result->auto_id;
                                if($has_submenu>0){?>
                                    <button class="btn btm-pink" onclick="get_submenu('<?php echo $result->auto_id; ?>', '<?php echo $val['id'];?>');">Has Submenu</button>

                              <?php      
                                }
                                else{
                                    echo 'No submenu';
                                   // echo '<input type="text" id="test_tog"/>';
                                }
                               ?>
                                </td>
                                 <td>
                                        <label class="switch permissions">
                                        <?php
                                $query2 = $this->db->get_where('ckb_role_permission', array('role_id'=>$result->auto_id,'menu_id'=>$val['id'],'role_permission'=>1));
                                $hasmenu_permission = $query2->num_rows();
                                if($hasmenu_permission >0){?>
                                     <input type="checkbox" value="active" id= "<?php echo $menu_id; ?>" class="one_permission-<?php echo $result->auto_id;?>" onchange="togglePermission('<?php echo $result->auto_id; ?>', '<?php echo $val['id'];?>','<?php echo $menu_id; ?>');" checked="checked">
                                    <span class="slider round"></span>
                               <?php
                                }
                               else{
                               ?>
                                            <input type="checkbox" value="active" id= "<?php echo $menu_id; ?>" class="one_permission-<?php echo $result->auto_id;?>" onchange="togglePermission('<?php echo $result->auto_id; ?>', '<?php echo $val['id'];?>','<?php echo $menu_id; ?>');">
                                            <span class="slider round"></span>
                                       <?php } ?>
                                        </label>
                                </td>
                                
                            </tr>
                            <?php } ?>                   
                     </tbody>
                </table>
            </div>
        </div>
  <?php } ?>  
  
  
  <div id="submenu-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Sub menus permission</h4> 
                                            </div> 
                                            <form name="roles_form" id="roles_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Masters/add_roles'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                            <div class="modal-body"> 
                                            <div class="row">
            <div class="col-md-12 b-t permission-section1" style="" id="<?php //echo $div_id;?>">
                <table class="table ">
                    <thead>
                     <tr class="bg-white">
                        <th>
                            <div class="form-group d-flex" id="get_all_submenu_permission">
                                                         
                            </div>
                        </th>
                       
                        <th>Permission</th>
                      
                    </tr>
                    </thead>
                    <tbody id="all_sb">
            
                        
                                           
                     </tbody>
                </table>
            </div>
        </div>
     

                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <!-- <button type="submit" class="btn btn-info waves-effect waves-light">Add Role</button>  -->
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                                <!-- /.modal -->
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
        <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-multi-select/jquery.multi-select.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-multi-select/jquery.quicksearch.js"></script>
          <!-- sweet alerts -->
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

        



        <!-- CUSTOM JS -->
         <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
         <script src="<?php echo base_url();?>assets/pro_js/roles/permission.js"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
             //multiselect start

             $('#my_multi_select1').multiSelect();

            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>
        
        <script type="text/javascript">
             var BASE_URL = "<?php echo base_url();?>index.php/";
        $(document).ready(function () {
				var  page="roles";
				
				if(page=="roles"){
					$(".settings_m").click();
					$(".roles").addClass("active");
				}
			
			});
			
			
			
			
			
			$(document).ready(function() {
			    $(document).on('click','.inactive_doc',function(){
					var resp = confirm("Do you want to Inactive this Aviary?");
					if (resp == true) {
						var inactive_id = $(this).attr('inactive_id');
						//alert(inactive_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/inactive_aviary",
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
					var resp = confirm("Do you want to active this Aviary?");
					if (resp == true) {
						var active_id = $(this).attr('active_id');
						//alert(active_id);
						$.ajax({
							type : "POST", 
							url : "<?php echo base_url(); ?>index.php/Masters/active_aviary",
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