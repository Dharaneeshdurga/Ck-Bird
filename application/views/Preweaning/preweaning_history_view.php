<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">
		<?php
    
	if($datawhere == "all"){
		$page_name ="Total Chicks";
	  }
	if($datawhere == "wean"){
		$page_name = " Chicks moved to Weaning";
	
  }
  if($datawhere == "splay_leg"){
  
	  $page_name ="Splay Legged Chicks";
  }
  if($datawhere == "airbubble"){
   
	  $page_name ="Airbubble";
  }
  
  if($datawhere == "sale"){
   
	  $page_name ="Sale";
  }

  if($datawhere == "cured"){
   
	  $page_name ="Cured";
  }
  if($datawhere == "yolk_infection"){
   
	$page_name="Yolk sac infection";
  }
  if($datawhere == "obesity"){
   
	$page_name="Obesity";
  }
  if($datawhere == "ecoli"){
   
	$page_name="E.coli infection";
  }
  if($datawhere == "wry_neck"){
   
	$page_name="Wry neck";
  }
  if($datawhere == "slow_digest"){
   
	$page_name="Slow digestion";
  }
  if($datawhere == "crop_injury"){
   
	$page_name="Crop injury";
  }
  if($datawhere == "crop_burn"){
   
	$page_name="Crop burn";
  }
  if($datawhere == "oes_injury"){
   
	$page_name="Oesophageal injury";
  }
  if($datawhere == "dehydration"){
   
	$page_name="Dehydration";
  }
  if($datawhere == "unabsorbed_yolk_sac"){
   
	$page_name="Unabsorbed yolk sac";
  }
  if($datawhere == "air_crop"){
   
	$page_name="Air in the crop";
  }
  if($datawhere == "air_crop"){
   
	$page_name="Air in the crop";
  }
  if($datawhere == "traumatic_injury"){
   
	$page_name="Traumatic injury";
  }
  if($datawhere == "stunt"){
   
	  $page_name="Stunted by birth";
	}
	if($datawhere == "stunt_after"){
   
	  $page_name="Stunted after birth";
	}
  if($datawhere == "stunted_chick"){
   
	$page_name="Stunted chick";
  }
  if($datawhere == "reduced_crop_size"){
   
	$page_name="Reduced crop size";
  }
  if($datawhere == "splayed_leg"){
   
	$page_name="Splayed leg";
  }
  if($datawhere == "fungal_infection"){
   
	$page_name="Fungal infection";
  }
  if($datawhere == "mort"){
   
	$page_name="Mortality";
  }
  if($datawhere == "asp_pnuem"){
   
	$page_name="Aspiration Pneumonia";
  }
	if($datawhere == "resp_distress"){
	   
			$page_name="Respiratory distress";
		}
   ?>
        <title><?php echo $this->session->userdata('client_name'); ?> | <?php echo $page_name; ?> History</title>

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
                                 <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Preweaning/preweaning_history">Preweaning history</a></li>
                                <li class="active">View Preweaning History</li>
                            </ol>
                                 
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
                                        <h3 class="panel-title"><?php echo $page_name; ?> History</h3>
                                        
                                    </div>
                                                                        
<br>
                                      
                               
                                   
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="incub_his" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Group</th>
                                                            <th>Bird Species</th>
                                                            <th>Avairy</th>
                                                            <th>Cage</th>
                                                            <th>Egg no</th>
																														<th>Health Status</th>
																														<th>Health Status Changed date</th>
																														<th>Sale date</th>
                                                        </tr>
                                                       
                                                    </thead>

                                             
                                                    <tbody>

                                                    <?php 
                                                            if(isset($stunded)&& (!empty($stunded))){
                                                                $stunt = 0;
                                                                foreach ($stunded as $value){
                                                                  
                                                                    if($value->hatch_weight < $value->std_weight){
                                                                        $stunt++;
                                                                       ?>
                                                                        <tr>
                                                                        <td><?php echo $stunt; ?></td>
                                                                         <td><?php echo $value->group_name; ?></td>
                                                                           <td><?php echo $value->bird_species; ?></td>
                                                                            <td><?php echo $value->aviary_name; ?></td>
                                                                             <td><?php echo $value->cage; ?></td>
                                                                             <td><?php echo $value->egg_no; ?></td>
																			 <td><?php echo $value->health_status; ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->health_change_date)); ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->sale_date)); ?></td>
    
    
    
                                                                </tr>       
                                                                   
                                                                  <?php  }
    
                                                                }
                                                              
    
                                                            }


                                                            if(isset($stunded_after)&& (!empty($stunded_after))){
                                                                $stunt_af = 0;
                                                                foreach ($stunded_after as $value){
                                                                    $std_weight = $value->std_weight;
                                                                     $twenty_percent = ($std_weight*20)/100;
                                                                        $act_weight = $value->act_weight;
                                                                        if($act_weight < $twenty_percent){
                                                                        $stunt_af++;
                                                                       ?>
                                                                        <tr>
                                                                        <td><?php echo $stunt_af; ?></td>
                                                                         <td><?php echo $value->group_name; ?></td>
                                                                           <td><?php echo $value->bird_species; ?></td>
                                                                            <td><?php echo $value->aviary_name; ?></td>
                                                                             <td><?php echo $value->cage; ?></td>
                                                                             <td><?php echo $value->egg_no; ?></td>
																			 <td><?php echo $value->health_status; ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->health_change_date)); ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->sale_date)); ?></td>
    
    
    
                                                                </tr>       
                                                                   
                                                                  <?php  }
    
                                                                }
                                                              
    
                                                            }



                                                       // print_r($incub_history_view);
                                                        if(isset($incub_history_view)&& (!empty($incub_history_view))){
                                                         $count=0;
                                                            foreach($incub_history_view as $value){
                                                              $count++;
                                                              ?>
                                                                <tr>
                                                                    <td><?php echo $count; ?></td>
                                                                     <td><?php echo $value->group_name; ?></td>
                                                                       <td><?php echo $value->bird_species; ?></td>
                                                                        <td><?php echo $value->aviary_name; ?></td>
                                                                         <td><?php echo $value->cage; ?></td>
                                                                         <td><?php echo $value->egg_no; ?></td>
																		 <td><?php echo $value->health_status; ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->health_change_date)); ?></td>
																			 <td><?php echo date("d-m-Y", strtotime($value->sale_date)); ?></td>



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
         <script src="<?php echo base_url();?>assets/pro_js/execution/team.js"></script>

        
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
                  $('#incub_his').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var  page="prewean_history";
				
				if(page=="prewean_history"){
                    $('.preweaning_m').click();
					$(".preweaning_history").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
