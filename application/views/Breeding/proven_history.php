<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Proven History</title>

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
                               
                                 
                                 
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Proven History </h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <form id="sales_update_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Breeding/proven_history"; ?>" nctype="multipart/form-data">
                                       

                                       <div class="row">
                                       <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">From Date</label>
                                                           <input type="date" class="select2 form-control" id="fdate" name="fdate"  >
                                                       </div>
                                                   </div>
                                                   <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">To Date</label>
                                                           <input type="date" class="select2 form-control" id="tdate" name="tdate" >
                                                       </div>
                                                   </div>
                                     
                                   
                                                   <div class="col-md-2" style="margin-top:25px;">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Filter</button>
                                            </div>
                                        </form>
                                        </div>
                                   <br>
                                   
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="proven_his" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Month</th>
                                                            <th>Year</th>
                                                            <th>Total Eggs</th>
                                                             <th>Infertile Eggs(%)</th> 
                                                             <th>Dis Eggs(%)</th> 
                                                             <th>Fertile Eggs(%)</th>
                                                             <th>Broken Eggs(%)</th>  
   
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        <?php //print_r($proven_history);
                                                          if (isset($proven_history) && !empty($proven_history)) { 
                                                            $count = 0;
                                                               foreach($proven_history as $val) { 
                                                                  $count++;
                                                                  $month = $val->month;
                                                                    if($month == 01){
                                                                            $month = "January";
                                                                        }
                                                                     if($month == 02){
                                                                            $month = "February";
                                                                        }
                                                                        if($month == 03){
                                                                            $month = "March";
                                                                        }
                                                                        if($month == 04){
                                                                            $month = "April";
                                                                        }
                                                                        if($month == 05){
                                                                            $month = "May";
                                                                        }
                                                                        if($month == 06){
                                                                            $month = "June";
                                                                        }
                                                                        if($month == 07){
                                                                            $month = "July";
                                                                        }
                                                                        if($month == '08'){
                                                                           $month = "August";
                                                                        }
                                                                        if($month == '09'){
                                                                            $month = "September";
                                                                         }
                                                                        if($month == '10'){
                                                                            $month = "October";
                                                                        }
                                                                        if($month == '11'){
                                                                            $month = "November";
                                                                        }
                                                                        if($month == '12'){
                                                                            $month = "December";
                                                                        }
                                                                            ?>
      
                                                               <tr>
                                                                 <td><?php echo $count; ?></td>
                                                                 <td><?php echo $month ; ?></td>
                                                                 <td><?php echo $val->year ;; ?></td>
                                                                 <td><?php echo $val->total_eggs ;?></td>
                                                                 <td ><?php echo $val->infertile_percent;?></td>
                                                                 <td ><?php echo $val->dis_percent; ?></td>
                                                                 <td ><?php echo $val->hatch_percent; ?></td>
                                                                 <td ><?php echo $val->broken_percent; ?></td>
                                                               </tr>
                                                               
                                                               <?php }
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
         <script src="<?php //echo base_url();?>assets/pro_js/execution/team.js"></script>

        
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

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
        <script type="text/javascript">
               var BASE_URL = "<?php echo base_url();?>index.php/";
            $(document).ready(function() {
                  $('#proven_his').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var  page="proven_history";
				
				if(page=="proven_history"){
					$(".breeding_m").click();
					$(".proven_history").addClass("active");
				}
			
			});
		</script>
	</body>
</html>