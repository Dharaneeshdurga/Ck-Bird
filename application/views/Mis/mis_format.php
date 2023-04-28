<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | MIS Format</title>

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
			.tr_head{

            }
		</style> -->
        
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
                                        <h3 class="panel-title">MIS Format</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <form id="incubation_history_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Mis/mis_format"; ?>" enctype="multipart/form-data">
                                       

                                       <div class="row">
                                       <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">From Date</label>
                                                           <input type="date" class="select2 form-control" id="date" name="date"  >
                                                       </div>
                                                   </div>
                                                   <div class="col-md-2">
                                            <div class="form-group">
                                                           <label for="tdate">To Date</label>
                                                           <input type="date" class="select2 form-control" id="to_date" name="to_date" >
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
                                                <table id="mis_format" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                         
                                                            <th>Title</th>
                                                            <th>Population</th>
                                                        </tr>
                                                       
                                                    </thead>
                                                    <?php 
                                                      if(isset($incub_history)&& (!empty($incub_history))){
                                                         foreach($incub_history as $key=>$value) 
                                                         {
                                                               $total_eggs =  $value['total_eggs'];
                                                               $fertile_assist =  $value['fertile_assist'];
                                                               $fertile_normal =  $value['fertile_normal'];
                                                               $infertile =  $value['infertile'];
                                                               $dis =  $value['dis'];
                                                    
                                                         }
                                                        }
                                                        if(isset($stunded)&& (!empty($stunded))){
                                                            $stunt = 0;
                                                            foreach ($stunded as $value){    
                                                                if($value->hatch_weight < $value->std_weight){
                                                                              $stunt++;
                                                                       }
                                                                    }
                                                           }
                                                           else{
                                                            $stunt = 0; 
                                                           }
                                                  //Handfeeding 

                                                  if(isset($handfeed_history)&& (!empty($handfeed_history))){
                                                    // print_r($incub_history); 
                                                 //print_r ($incub_history[0]['total_eggs']);
                                                     foreach($handfeed_history as $key=>$value) 
                                                     {
                                                          //  print_r($value);
                                                           $total_chicks =  $value['total_chicks'];
                                                           $total_preweaning =  $value['total_preweaning'];
                                                           $splay_leg_hand =  $value['splay_leg'];
                                                           $airbubble_hand =  $value['airbubble'];
                                                           $mortality_hand =  $value['mortality'];
                                                           $sale_hand =  $value['sale'];
                                                     }
                                                    }
                                                    if(isset($stunded_handfeed)&& (!empty($stunded_handfeed))){
                                                        $stunt_hand = 0;
                                                        foreach ($stunded_handfeed as $value){
                                                          
                                                            if($value->hatch_weight < $value->std_weight){
                                                                       
                                                                        $stunt_hand++;
                                                                 
                                                            }

                                                        }
                                                      

                                                    }
                                                    else{
                                                        $stunt_hand = 0;
                                                    }
                                                    if(isset($stunded_after_handfeed)&& (!empty($stunded_after_handfeed))){
                                                        $as_hand = 0;
                                                      
                                                        foreach($stunded_after_handfeed as $result){
                                                            $std_weight = $result->std_weight;
                                                            $twenty_percent = ($std_weight*20)/100;
                                                            $act_weight = $result->act_weight;
                                                        }
                                                        if($act_weight < $twenty_percent){
                                                            $as_hand++;
                                                         // echo $as;
                                                        }
                                                    
                                                      

                                                    }
                                                    else{
                                                        $as_hand = 0;
                                                    }


                                                    //PREWEANING

                                                    if(isset($prewean_history)&& (!empty($prewean_history))){
                                                        // print_r($incub_history); 
                                                     //print_r ($incub_history[0]['total_eggs']);
                                                         foreach($prewean_history as $key=>$value) 
                                                         {
                                                              //  print_r($value);
                                                               $total_chicks_pre =  $value['total_chicks'];
                                                               $total_weaning =  $value['total_weaning'];
                                                               $splay_leg_prewean =  $value['splay_leg'];
                                                               $airbubble_prewean =  $value['airbubble'];
                                                               $mortality_prewean =  $value['mortality'];
                                                               $sale_prewean =  $value['sale'];
                                                         }
                                                        }
                                                        if(isset($stunded_prewean)&& (!empty($stunded_prewean))){
                                                            $stunt_p = 0;
                                                            foreach ($stunded_prewean as $value){
                                                              
                                                                if($value->hatch_weight < $value->std_weight){
                                                                           
                                                                            $stunt_p++;
                                                                     
                                                                }
    
                                                            }
                                                          
    
                                                        }
                                                        else{
                                                            $stunt_p = 0;
                                                        }
                                                        if(isset($stunded_after_prewean)&& (!empty($stunded_after_prewean))){
                                                            $as_p = 0;
                                                          
                                                            foreach($stunded_after_prewean as $result){
                                                                $std_weight = $result->std_weight;
                                                                $twenty_percent = ($std_weight*20)/100;
                                                                $act_weight = $result->act_weight;
                                                            }
                                                            if($act_weight < $twenty_percent){
                                                                $as_p++;
                                                             // echo $as;
                                                            }
                                                        
                                                          
    
                                                        }
                                                        else{
                                                            $as_p = 0;
                                                        }

                                                        if(isset($wean_history)&& (!empty($wean_history))){
                                                            // print_r($incub_history); 
                                                         //print_r ($incub_history[0]['total_eggs']);
                                                             foreach($wean_history as $key=>$value) 
                                                             {
                                                                  //  print_r($value);
                                                                   $total_chicks_w =  $value['total_chicks'];
                                                                   $total_production =  $value['total_production'];
                                                                   $splay_leg_w =  $value['splay_leg'];
                                                                   $airbubble_w =  $value['airbubble'];
                                                                   $mortality_w =  $value['mortality'];
                                                                   $sale_w =  $value['sale'];
                                                             }
                                                            }

                                                            if(isset($stunded_wean)&& (!empty($stunded_wean))){
                                                                $stunt_w = 0;
                                                                foreach ($stunded_wean as $value){
                                                                  
                                                                    if($value->hatch_weight < $value->std_weight){
                                                                               
                                                                                $stunt_w++;
                                                                         
                                                                    }
        
                                                                }
                                                              
        
                                                            }
                                                            else{
                                                                $stunt_w = 0;
                                                            }
                                                            if(isset($stunded_after_wean)&& (!empty($stunded_after_wean))){
                                                                $as_w = 0;
                                                              
                                                                foreach($stunded_after_wean as $result){
                                                                    $std_weight = $result->std_weight;
                                                                    $twenty_percent = ($std_weight*20)/100;
                                                                    $act_weight = $result->act_weight;
                                                                }
                                                                if($act_weight < $twenty_percent){
                                                                    $as_w++;
                                                                 // echo $as;
                                                                }
                                                            
                                                              
        
                                                            }
                                                            else{
                                                                $as_w = 0;
                                                            }
                                                  ?>

                                             
                                                    <tbody>
                                                        <tr><td class="month_tbody text-center">TOTAL POPULATION/DIVISION</td><td></td></tr>
                                                    <tr>
                                                        <td>Total number of eggs in Incubation</td>
                                                        <td><?php echo $total_eggs;?></td>
                                                    </tr>    
                                                    <tr>
                                                        <td>Total number of Chicks in Handfeeding</td>
                                                        <td><?php echo $total_chicks; ?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Total number of birds in Pre Weaning</td>
                                                        <td><?php echo $total_chicks_pre; ?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Total number of birds in  Weaning</td>
                                                        <td></td>
                                                    </tr>   
                                                    <tr><td class="month_tbody text-center">INCUBATION</td><td></td></tr>
                                                    <tr>
                                                             <td >Total No of Eggs</td>
                                                           <td style="font-weight:bold;"><?php echo $total_eggs; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Hatch(Assist)</td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_assist; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Hatch(Normal)</td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_normal; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Infertile Eggs</td>
                                                           <td style="font-weight:bold;"><?php echo $infertile; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Total no of DIS</td>
                                                           <td style="font-weight:bold;"><?php echo $dis; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt; ?></td>
                                                     </tr>
                                                     <tr><td class="month_tbody text-center">HANDFEEDING</td><td></td></tr>
                                                    <tr>
                                                             <td >Total No of Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $total_chicks; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Chicks moved to  Preweaning</td>
                                                           <td style="font-weight:bold;"><?php echo $total_preweaning; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Splay leg</td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg_hand; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Airbubble</td>
                                                           <td style="font-weight:bold;"><?php echo $airbubble_hand; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Mortality</td>
                                                           <td style="font-weight:bold;"><?php echo $mortality_hand; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt_hand; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted After birth</td>
                                                           <td style="font-weight:bold;"><?php echo $as_hand; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of chicks moved to sale</td>
                                                           <td style="font-weight:bold;"><?php echo $sale_hand; ?></td>
                                                     </tr>
                                                    
                                                    
                                                     <tr><td class="month_tbody text-center">PREWEANING</td><td></td></tr>
                                                    <tr>
                                                             <td >Total No of Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $total_chicks_pre; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Chicks moved to  Weaning</td>
                                                           <td style="font-weight:bold;"><?php echo $total_preweaning; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Splay leg</td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg_prewean; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Airbubble</td>
                                                           <td style="font-weight:bold;"><?php echo $airbubble_prewean; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Mortality</td>
                                                           <td style="font-weight:bold;"><?php echo $mortality_prewean; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt_p; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted After birth</td>
                                                           <td style="font-weight:bold;"><?php echo $as_p; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of chicks moved to sale</td>
                                                           <td style="font-weight:bold;"><?php echo $sale_prewean; ?></td>
                                                     </tr>
                                                     <tr><td class="month_tbody text-center">WEANING</td><td></td></tr>
                                                    <tr>
                                                             <td >Total No of Birds</td>
                                                           <td style="font-weight:bold;"><?php echo $total_chicks_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Chicks moved to  Production</td>
                                                           <td style="font-weight:bold;"><?php echo $total_production; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Splay leg</td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total No of Airbubble</td>
                                                           <td style="font-weight:bold;"><?php echo $airbubble_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Mortality</td>
                                                           <td style="font-weight:bold;"><?php echo $mortality_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of Stunted After birth</td>
                                                           <td style="font-weight:bold;"><?php echo $as_w; ?></td>
                                                     </tr>
                                                     <tr>
                                                             <td >Total no of chicks moved to sale</td>
                                                           <td style="font-weight:bold;"><?php echo $sale_w; ?></td>
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
                  $('#mis_format').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		paging: false,
        ordering: false,
        info: false,
		searching:false
    } );
} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var  page="incubation_history";
				
				if(page=="incubation_history"){
                    $('.incubation_m').click();
					$(".incub_history").addClass("active");
				}
			
			});
		</script>
	</body>
</html>
