<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | SOP</title>

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
        
        
        
        <<style>
			.btn-group {
    margin-top: 15px;
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
                                 
                                 
                                 <!-- /.modal -->
                               
                                 
                               <!-- <ol class="breadcrumb pull-right">
                                   
                                    <li><a href="<?php //echo base_url(); ?>index.php/Incubtemperature/incubtemperature">Listing</a></li>
                                    <li class="active">Datalog</li>
                                </ol> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">SOP details</h3>
                                    </div>
                                    
                                    <div class="row"> 
                            <div class="col-lg-12"> 
                                <ul class="nav nav-tabs navtab-bg"> 
                                    <li class="active"> 
                                        <a href="#tf" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                            <span class="hidden-xs">Training Files</span> 
                                        </a> 
                                    </li> 
                                    <li class=""> 
                                        <a href="#tv" data-toggle="tab" aria-expanded="true"> 
                                            <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                            <span class="hidden-xs">Training videos</span> 
                                        </a> 
                                    </li> 
                                </ul> 
                                <div class="tab-content"> 
                                    <div class="tab-pane active" id="tf"> 
                                        <div class="col-md-4">
                                             <form id="sop"  action="<?php echo base_url("index.php/Execution/upload_sop_file") ?>" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                   <label for="cur_date"> DATE</label>
                                                   <input type="date" class="form-control" name="sop_date" id="sop_date" required>
                                               </div>
                                               <div class="form-group">
                                                   <label for="cur_date"> Title</label>
                                                   <input type="text" class="form-control" name="title" id="title" required>
                                               </div>
                                               <div class="form-group"> 
                                                            <input type="file" name="sop_file" /><br>
                                                             <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Upload file" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                        <table class="table table-striped table-bordered" id="datalog_tb">
                                                        <thead>
                                                            <tr>
                                                            <th>S.No</th>
                                                            <th>Date</th>
                                                            <th>Title</th>
                                                            <th>Download File</th>
                                                            <th>Action</th>
                                                   
                                                              
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        <?php 
                                                        if(isset($sop_file) &&(!empty($sop_file))){
                                                          $count = 0;
                                                            foreach($sop_file as $val){
                                                                $count++;
                                                                $date = date('d-m-Y',strtotime($val->date));
                                                                ?>
                                                                <tr>
                                                                 <td><?php echo $count;?></td>
                                                                <td><?php echo $date;?></td>
                                                                <td><?php echo $val->title;?></td>
                                                                <td><a href="<?php echo base_url("index.php/Execution/tf_download/".$val->sop_file); ?>">Download</a></td>
                                                                <td><button onclick="get_delete_file('<?php echo $val->id;?>');"  class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> </button></td>

                                                            </tr>
                                                               <?php

                                                            }
                                                        }
                                                        
                                                        ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                    </div>


                                    </div> <!-- END OF TAB 1!-->
                                    <div class="tab-pane" id="tv"> 
                                    <div class="col-md-4">
                                             <form id="sop"  action="<?php echo base_url("index.php/Execution/upload_sop_video") ?>" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                   <label for="cur_date"> DATE</label>
                                                   <input type="date" class="form-control" name="sop_date" id="sop_date" required>
                                               </div>
                                               <div class="form-group">
                                                   <label for="cur_date"> Title</label>
                                                   <input type="text" class="form-control" name="title" id="title" required>
                                               </div>
                                               <div class="form-group"> 
                                                            <input type="file" name="sop_video" /><br>
                                                             <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Upload Video" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                        <table class="table table-striped table-bordered" id="tvideo_tb">
                                                        <thead>
                                                            <tr>
                                                            <th>S.No</th>
                                                            <th>Date</th>
                                                            <th>Title</th>
                                                            <th>Download Video</th>
                                                            <th>Action</th>
                                                   
                                                              
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        <?php 
                                                        if(isset($sop_video) &&(!empty($sop_video))){
                                                          $count1 = 0;
                                                            foreach($sop_video as $val1){
                                                                $count1++;
                                                                $date1 = date('d-m-Y',strtotime($val1->date));
                                                                ?>
                                                                <tr>
                                                                 <td><?php echo $count1;?></td>
                                                                <td><?php echo $date1;?></td>
                                                                <td><?php echo $val1->title;?></td>
                                                                <td><a href="<?php echo base_url("index.php/Execution/tv_download/".$val1->sop_video); ?>">Download</a></td>
                                                                <td><button onclick="get_delete_video('<?php echo $val1->id;?>');"  class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> </button></td>

                                                            </tr>
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
                                          
                                           
                            
                            
                            
                            <div class ="row" class="">
                                            <div class="tr_hideshow">
                                       
                                  
                                                             
                                    </div>
                                    </div>
                                    <br>
                                                              <br>
                                            <div class ="row" class="">
                                                <div class="tr_hideshow">
                                                   
                                                </div>
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
          <!-- sweet alerts -->
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>
         <!-- Notification -->
    <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
    <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
    <script src="<?php echo asset_url();?>notifications/notifications.js"></script>

        



        <!-- CUSTOM JS -->
         <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
         <script src="<?php echo base_url();?>assets/pro_js/execution/sop.js"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

      
       
        
        <script type="text/javascript">
        $(document).ready(function () {
//             $(".tr_hideshow").hide();
//             $("#tf").on('click', function() {	
//     $(".tr_hideshow").show();

// });
            $('#datalog_tb').dataTable();
            $('#tvideo_tb').dataTable();
            var page = "sop";

if (page == "sop") {
    $('.sop_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".tf").addClass("active");
}
			



});
           
			var BASE_URL = "<?php echo base_url();?>index.php/";

  function get_delete_file(id){
    var resp = confirm("Do you want to Delete this Sop details?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Execution/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_sop_files"
        },
        dataType: "JSON",
        success: function(data) {
            
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Deleted Successfully..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL + "Execution/sop";
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
}
 }
 function get_delete_video(id){
    var resp = confirm("Do you want to Delete this Sop details?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Execution/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_sop_video"
        },
        dataType: "JSON",
        success: function(data) {
            
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Deleted Successfully..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL + "Execution/sop";
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
}
 }
		</script>
	</body>
</html>