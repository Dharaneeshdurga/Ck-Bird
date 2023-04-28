<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Edit Species</title>

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
    <!--    
        <style>
			.diplay_block{ display:block !important;}
		</style>
        -->
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
                                	Edit Species
                                 </h4>

                                 <ol class="breadcrumb pull-right">
                                    <li><a href="<?php echo base_url(); ?>index.php/Masters/species">Species List</a></li>
                                    <li class="active">Edit Species</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Edit Species</h3></div>
                                    <div class="panel-body">
                                       <form name="species_form" id="species_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Masters/edit_species/update'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                        	 <input type="hidden" name="s_id" value="<?php echo $spe_info['id']; ?>"  >
                                             
                                             <div class="form-group">
                                                <label for="Group">Select Group Name</label>
                                                     <select name="group_id" class="form-control" required>
                                                            <option value="">Select Group Name</option>
                                                            <?php foreach($group as $t => $group ){ ?>
                                                            <option value="<?php echo $group['auto_id'] ?>" <?php echo ($spe_info['group_id'] ==$group['auto_id']?'selected':'');  ?>><?php echo $group['group_name']; ?></option>
                                                            <?php } ?>
                                                    </select>
                                            </div>
                                                        
                                            <div class="form-group"> 
                                                <label for="Species Name" class="control-label">Species Name</label>
                                                 
                                                <input type="text" name="bird_species" id="bird_species" class="form-control" value="<?php echo $spe_info['bird_species']; ?>">
                                            </div>
                                            <div class="form-group"> 
                                                <label for="Species Name" class="control-label">No of Days in Brooder</label>
                                                 
                                                <input type="text" name="days_brooder" id="days_brooder" class="form-control" value="<?php echo $spe_info['days_brooder']; ?>">
                                            </div>
                                            <div class="form-group">
                                                        <label for="Species Name" class="control-label">Weight loss percentage(min)</label>
                                                        <input type="text" name="weight_loss_min" id="weight_loss_min" class="form-control" value="<?php echo $spe_info['weight_loss_min']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                        <label for="Species Name" class="control-label">Weight loss percentage(max)</label>
                                                        <input type="text" name="weight_loss_max" id="weight_loss_max" class="form-control" value="<?php echo $spe_info['weight_loss_max']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                        <label for="Species Name" class="control-label">Days of incubation(min)</label>
                                                        <input type="text" name="incub_days_min" id="incub_days_min" class="form-control" value="<?php echo $spe_info['incub_days_min']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                        <label for="Species Name" class="control-label">Days of incubation(max)</label>
                                                        <input type="text" name="incub_days_max" id="incub_days_max" class="form-control" value="<?php echo $spe_info['incub_days_max']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                        <label for="mrng_feed" class="control-label">Target Morning Feed</label>
                                                        <input type="text" name="mrng_feed" id="mrng_feed" class="form-control" value="<?php echo $spe_info['target_mrg_feed']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                        <label for="aft_feed" class="control-label">Target Afternoon Feed</label>
                                                        <input type="text" name="aft_feed" id="aft_feed" class="form-control"value="<?php echo $spe_info['target_aft_feed']; ?>">
                                                         </div>
                                                         <div class="form-group">
                                                      
                                                      <label for="mrng_feed" class="control-label">Standard Egg Weight</label>
                                                      <input type="text" name="std_egg_weight" id="std_egg_weight" value="<?php echo $spe_info['std_egg_weight']; ?>" class="form-control" required>
                                                       </div>
                                                 
                                                   <div class="form-group">
                                                      <label for="aft_feed" class="control-label">Standard Hatch Weight</label>
                                                      <input type="text" name="std_hatch_weight" id="std_hatch_weight" value="<?php echo $spe_info['std_hatch_weight']; ?>" class="form-control" required>
                                                       </div>
                                            
                                            
                                            <button type="submit" class="btn btn-purple waves-effect waves-light">Save Changes</button>
                                        </form>
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
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
				var  page="species";
				
				if(page=="species"){
                    $(".settings_m").click();

					$(".species").addClass("active");
					
				}
			
			});
		</script>
	</body>
</html>