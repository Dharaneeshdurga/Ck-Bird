<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Species Details</title>

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
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">ADD Species</h4> 
                                            </div> 
                                            <div class="row">
                                              <div class="col-md-12">
                                              <div class="modal-body"> 
                                               <form name="species_form" id="species_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/Masters/add_species'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                              
                                                <!--div class="row"> 
                                                    <div class="col-md-6--> 
                                                    <div class="row">
                                                    <div class="col-md-2"> 
                                                    
                                                            <label for="Group">Select Group Name</label> 
                                                          <?php  $branch_id = $this->session->userdata('branch_id');
                                                      //    echo  $branch_id;
                                                          ?>
                                                                 <select name="group_id" class="form-control" required>
                                                                        <option value="">Select Group Name</option>
                                                                        <?php foreach($group as $t => $group ){ 

                                                                        if($branch_id == $group['branch_id']){
                                                                         ?>
                                                                        <option value="<?php echo $group['auto_id'] ?>"><?php echo $group['group_name'] ?></option>
                                                                        <?php }} ?>

                                                                </select>
                                                    
                                                         </div>
                                                        <div class="col-md-2"> 
                                                      
                                                            <label for="Species Name">Species Name</label>
                                                             <!-- <input type="hidden" name="auto_id" id="auto_id" class="form-control" value="<?php //$last_id=$last_id['id']+1; echo "S00".$last_id; ?>">  -->
                                                            <input type="hidden" name="created_by" id="created_by" class="form-control" value="<?php echo $this->session->userdata('user_id') ?>"> 
                                                            <input type="text" name="bird_species" id="bird_species" class="form-control" required>
                                                   
                                                     </div>
                                                     <div class="col-md-2"> 
                                                        <!--div class="form-group"-->
                                                        <label for="brooder Name" >No of days in Brooder</label>
                                                        <input type="text" name="days_brooder" id="days_brooder" class="form-control" required>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2"> 
                                                         <!--div class="form-group"-->
                                                        <label for="weight Name" >Weight loss(%)(min)</label>
                                                        <input type="text" name="weight_loss_min" id="weight_loss_min" class="form-control" required>
                                                         <!--/div-->
                                                     </div>
                                                     <div class="col-md-2">
                                                        
                                                        <label for="max Name" class="control-label">Weight loss (%)(max)</label>
                                                        <input type="text" name="weight_loss_max" id="weight_loss_max" class="form-control" >
                                                        
                                                      </div>
                                                      <div class="col-md-2">
                                                        <label for="incub_days_min" class="control-label">Days of incubation(min)</label>
                                                        <input type="text" name="incub_days_min" id="incub_days_min" class="form-control" >
                                                       
                                                                        </div>
                                                     </div>
                                                     <br>
    
                                                  
                                                      <div class="row">
                                                      <div class="col-md-2">
                                                       
                                                        <label for="incub_days_max" class="control-label">Days of incubation(max)</label>
                                                        <input type="text" name="incub_days_max" id="incub_days_max" class="form-control" required>
                                                         </div>
                                                   
                                                     <div class="col-md-2">
                                                      
                                                        <label for="mrng_feed" class="control-label">Target Morning Feed</label>
                                                        <input type="text" name="mrng_feed" id="mrng_feed" class="form-control" required>
                                                         </div>
                                                   
                                                     <div class="col-md-2">
                                                        <label for="aft_feed" class="control-label">Target Afternoon Feed</label>
                                                        <input type="text" name="aft_feed" id="aft_feed" class="form-control" required>
                                                         </div>
                                                      
                                                        <div class="col-md-2">
                                                      
                                                      <label for="mrng_feed" class="control-label">Standard Egg Weight</label>
                                                      <input type="text" name="std_egg_weight" id="std_egg_weight" class="form-control" required>
                                                       </div>
                                                 
                                                   <div class="col-md-2">
                                                      <label for="aft_feed" class="control-label">Standard Hatch Weight</label>
                                                      <input type="text" name="std_hatch_weight" id="std_hatch_weight" class="form-control" required>
                                                       </div>
                                                      </div>
                                                       
                                                    </div> 
                                                     
                                                </div> 
                                             
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Add Species</button> 
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
                                        <h3 class="panel-title">Species List</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">
                                     Add Species
                                     </button> 
                                     <!-- FOR DELETE OPTION --->
                                          <button onclick="get_delete_all()" class="btn btn-danger">Delete All</button>
                                                                                               
                                    
                                    </div>
                                                                        <div class="col-md-4">
                                     <a href="<?php echo base_url('index.php/Import/export_csv'); ?>" class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i>Age and Std weight Download sample</a> &nbsp;&nbsp;
                                     
                                     <br><br>                         </div>
                                      <div class ="row">
                                      <div class="col-md-4">
                                         <a href="<?php echo base_url('index.php/Download_sample/species_Download'); ?>" class="btn btn-info waves-effect waves-light" ><i class="fa fa-pencil-square-o"></i>Species bulk upload Download Sample</a>
                                    </div>
                                    <div class="col-md-8">
                                        <form id="raw_material" action="<?php echo base_url("index.php/Download_sample/species_upload") ?>" method="post" enctype="multipart/form-data">
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
                                                                        <br><br>   

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            
                                               <div class="table-responsive">
                                            <!--button onclick ="fileDownload()" >Download Sample</button-->
                                            <p><?php// echo site_url();?></p>
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Group Name</th>
                                                            <th>Species Name</th>
                                                            <th>No of Days in Brooder</th>
                                                            <th>Std Egg Weight</th>
                                                            <th>Std hatch Weight</th>
                                                            <th  style="style=width: 13%"> Days in incubation(min)</th>
                                                            <th  style="style=width: 13%">Days in incubation(max)</th>
                                                            <th>Excel Upload

                                                            <!--span style="color:red;">*You can choose an Excel file(.xls or .xlxs or.csv) as Upload</span-->
                                                            </th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        <?php $count=0; foreach($species_join_group as $k => $val ){ 
                                                            $branch_id = $this->session->userdata('branch_id');
                                                            if($branch_id == $val['branch_id']){
                                                                $count++;  
                                                                ?>
                                                            <tr>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $count; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['group_name']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['bird_species']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['days_brooder']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['std_egg_weight']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['std_hatch_weight']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['incub_days_min']; ?></td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?>"><?php echo $val['incub_days_max']; ?></td>
                                                                <td>
                                                      <!--div class="col-md-6"-->
                                                     
                                                      <form id="species_list" style="width:173px;" action="<?php echo base_url("index.php/Import/uploadData") ?>" method="post" enctype="multipart/form-data">
                                                                <!--form id="species_list" action="javascript:void(0)" method="post" enctype="multipart/form-data"-->
                                                       
                                                          <input type="hidden" name="species_id" value="<?php echo $val['auto_id']; ?>" /><br>
                                                            <input type="file" name="uploadFile" /><br>
                                                            
                                                                <!--input type="file" name="uploadFile" value="" /><br-->
                                                             <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Upload" />
                                                             </form>
                                                             <!--/div-->
                                                          
                                                                 </td>
                                                                <td class="<?php if($val['status']==0) { echo "danger"; } ?> text-center"> 
                                                                                             
                                                                <a href="<?php echo base_url('index.php/Masters/edit_species/'.$val['id']); ?>" class="btn btn-primary btn-xs" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;
                                                                    
                                                     <?php if($val['status']==0) {  ?>
                                                    <a active_id="<?php echo $val['id'];?>" href="#" class="btn btn-success btn-xs active_doc "><i class="fa fa-ban"></i>  </a>
                                                    <?php } else { ?>
                                                    <a inactive_id="<?php echo $val['id'];?>" href="#" class="btn btn-warning btn-xs inactive_doc "><i class="fa fa-ban"></i> </a>
                                                    <?php } ?>
                                                    <a  onclick="get_delete_pop('<?php echo $val['id'];?>','ckb_species');" href="#" class="btn btn-danger btn-xs "><i class="fa fa-close"></i> </a>

                                                    <form id="species_list" action="<?php echo base_url("index.php/Incubtemperature/getage") ?>" method="post" enctype="multipart/form-data">
                                                                <!--button  onclick="get_view_pop('<?php //echo $val['auto_id']; ?>');" class="btn btn-success btn-xs " style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="viewbtm" data-original-title="view"><i class="fa fa-pencil-square-o" id="editBtn"></i></button-->
                                                                <input type="hidden" name="species_id" value="<?php echo $val['auto_id']; ?>" />
                                                                <input type="hidden" name="gname" value="<?php echo $val['group_name']; ?>" />
                                                                <input type="hidden" name="sname" value="<?php echo $val['bird_species']; ?>" />
                                                                     <button type="submit" name= "submit" class="btn btn-success btn-xs " style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="viewbtm" data-original-title="view"><i class="fa fa-eye" id="editBtn"></i></button>
                                                                  </form> 

                                                                </td>
                                                    
                                                            </tr>
                                                        <?php } }?>
                                                    </tbody>
                                                </table>
                                                <div id="viewage-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Species Age and weight</h4> 
                                            </div> 
                                           
                                            <div class="modal-body"> 
                                            <form name="edit_age" id="edit_age" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <table id="weightloss_export" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                  
                                                  
                                                   <th>Age</th>
                                                <th>Standard Weight</th>
                                             
                                               
                                           
                                           
                                            </thead>
                                            <tbody id="species_result">
                                            
                                               
                                              
                                         </tbody> 
                                        <div id="age_id"></div>
                                         </table> 
                                                    </div>
                                         <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Update</button>
                                                    </form>
                                            </div> 
                                            <div class="modal-footer"> 
                                            
                                                
      	
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <!--button type="submit" class="btn btn-info waves-effect waves-light">Move</button--> 
                                            </div> 
                                           
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
                                              

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
        $(document).ready(function () {
				var  page="species";
				
				if(page=="species"){
                    $(".settings_m").click();

					$(".species").addClass("active");
					
				}
			
			});
            function get_view_pop(incub_row_id)
            {
 //alert(incub_row_id);
                $('#viewage-modal').modal('show');
                $.ajax({
                 url: BASE_URL + 'Incubtemperature/getage',
                 method: "POST",
                 data: {
                    "current_id": incub_row_id,
                },
                 dataType: "JSON",
                 success: function(data) {
                     
                   // var gm = '<th scope="row">Group Name</th>'; 
                    // for (let index = 0; index < data.length; index++) {
                      // var action_url1 ="";
                        var a_html="";
                        var b_html="";
            for (let index = 0; index < data.length; index++) {
                 a_html += '<tr>';
                a_html +='<td><input type="text" name="age'+index+'" class="SmallInput"  value="'+data[index].age+ '"></td>';
                a_html +='<td><input type="text" name="weight'+index+'" class="SmallInput"  value="'+data[index].std_weight+ '"></td>';
              //  a_html +='<td><input type="hidden" name="sp_id" class="SmallInput"  value="'+data[index].species_id+ '"></td>';
              //  a_html +='<td><input type="hidden" name="length" class="SmallInput"  value="'+data.length+ '"></td>';
                //a_html += '<td><a href="" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
      		   // a_html += '<button  onclick="get_delete_pop();" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="Deletebtn" data-original-title="Delete"><i class="fa fa-close"></i></button></td>';
                //a_html +='<td>edit</td>';
                a_html += '</tr>';
               // c_html = data[index].species_id;
               
               

            }
          //  c_html += '<input type="hidden" name="age_id" value="'+ c_html +'"/>';
            
           // var link = '<a href="<?php// echo base_url('masters/edit_age?val=S001')?>"'+ c_html + '" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
            $('#species_result').html(a_html);
           //$('#age_id').html(c_html);
           /* var a_htmls = '<th scope="row">Age</th>';
            for (let index = 0; index < data.length; index++) {
                a_html ='<td>'+ data[index].age + '</td>';
               
               // a_html +='<td><input type="text" name="notetime'+index+'" class="SmallInput"  value="'+data[index].note_time+ '"></td>';
            }*/
           
          

          

                    
                    
                 }
         
             });
                
            }
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $('#edit_age').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/updateage', 
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
                    'updated Successfully..!',
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
							url : "<?php echo base_url(); ?>Masters/inactive_species",
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
							url : "<?php echo base_url(); ?>Masters/active_species",
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
      text: "You will not be able to recover this SPECIES and all the data related this species also affected!!!",   
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
      title: "Are you sure to delete All the sepecies data? ",   
      text: "You will not be able to recover this SPECIES and all the data related this species also affected!!!",   
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
              data:{"table":"ckb_species"},
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
