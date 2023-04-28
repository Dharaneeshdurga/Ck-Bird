<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | View Incubation History</title>

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
                                        <h3 class="panel-title">View Incubation History</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <form id="incubation_history_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Incubation/incubation_history"; ?>" nctype="multipart/form-data">
                                       

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
												<a href="<?php echo base_url()."index.php/Incubation/incubation_history"; ?>" class="btn btn-warning">Clear</a>

											</div>
                                        </form>
                                        </div>
                                   <br>
                                   
                                        <div class="row">
											<?php if(!empty($from_date)){
												echo "From Date: ".date("d-m-Y", strtotime($from_date));
												echo "</br>";
												echo "To Date: ".date("d-m-Y", strtotime($to_date));
											}
											?>
											</br>
											</br>
											</br>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="sales_his" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Title</th>
                                                            <th>Total</th>
                                                            <th>Percentage</th>
                                                            <th>View</th>
                                                        </tr>
                                                       
                                                    </thead>

                                             
                                                    <tbody>
                                                        <?php 
                                                        //  if(empty($from_date){
														// 	$from_date=""
														//  }
                                                        //print_r($stunded);
                                                        if(isset($stunded)&& (!empty($stunded))){
                                                            $stunt = 0;
                                                            foreach ($stunded as $value){
                                                              
                                                                if($value->hatch_weight < $value->std_weight){
                                                                            //echo'stund';
                                                                            $stunt++;
                                                                        //    echo $stunt;
                                                                }

                                                            }
                                                          

                                                        }
                                                        else{
                                                            $stunt =0;
                                                        }
                                                        if(isset($incub_history)&& (!empty($incub_history))){
                                                        // print_r($incub_history); 
                                                     //print_r ($incub_history[0]['total_eggs']);
                                                         foreach($incub_history as $key=>$value) 
                                                         {
                                                              //  print_r($value);
                                                               $total_eggs =  $value['total_eggs'];
                                                               $fertile_assist =  $value['fertile_assist'];
                                                               $fertile_normal =  $value['fertile_normal'];
                                                               $infertile =  $value['infertile'];
                                                               $dis =  $value['dis'];
															   $crack =  $value['crack'];
															   $broken =  $value['broken'];
															   $healthy =  $value['healthy_chick'];
															   $low_weight_chick =  $value['low_hatch_weight'];
															   $yolk_sac =  $value['yolk_sac'];
															   $yolk_sac_infection =  $value['yolk_sac_infection'];
															   $splay_leg =  $value['splay_leg'];
															   $wry_neck =  $value['wry_neck'];
															   $unknown =  $value['unknown'];


                                                               if($total_eggs >0) {
                                                               $total_eggs_percent = ($total_eggs/$total_eggs)*100;
        
                                                                $fertile_assist_percent = round(($fertile_assist/$total_eggs)*100,2);

                                                              
                                                                $fertile_normal_percent = round(($fertile_normal/$total_eggs)*100,2);

                                                               
                                                                $infertile_percent = round(($infertile/$total_eggs)*100,2);

                                                              
                                                                $dis_percent = round(($dis/$total_eggs)*100,2);

																$crack_percent = round(($crack/$total_eggs)*100,2);
																$broken_percent = round(($broken/$total_eggs)*100,2);
																$healthy_percent = round(($healthy/$total_eggs)*100,2);
																$low_weight_chick_percent = round(($low_weight_chick/$total_eggs)*100,2);

																$yolk_sac_percent = round(($yolk_sac/$total_eggs)*100,2);
																$yolk_sac_infection_percent = round(($yolk_sac_infection/$total_eggs)*100,2);
																$splay_leg_percent = round(($splay_leg/$total_eggs)*100,2);
																
																$wry_neck_percent = round(($wry_neck/$total_eggs)*100,2);
																$unknown_percent = round(($unknown/$total_eggs)*100,2);

                                                                $stunt_percent = round(($stunt/$total_eggs)*100,2);
                                                               }
                                                               else{
                                                                $total_eggs_percent = 0;
        
                                                                $fertile_assist_percent = 0;

                                                              
                                                                $fertile_normal_percent =0;

                                                               
                                                                $infertile_percent =0;

																$unknown_percent =0;
                                                                $dis_percent = 0;
$wry_neck_percent =0;
                                                               
                                                                $stunt_percent = 0;
																$crack_percent =0;
																$broken_percent =0;
																$healthy_percent = 0;
																$low_weight_chick_percent = 0;

																$yolk_sac_percent = 0;
																$yolk_sac_infection_percent = 0;
																$splay_leg_percent = 0;
                                                               }
                                                       
                                                            }
                                                        } 
                                                        ?>
                                                          <tr>
                                                           <td>1</td>
                                                           <td >Total No of Eggs</td>
                                                           <td style="font-weight:bold;"><?php echo $total_eggs; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $total_eggs_percent.'%'; ?></td>
                                                           <td> <!--<form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="all">
                                                                    <input type="submit" value="View">
                                                           </form> -->
														 
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/all"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
                                                         </tr>
                                                        <tr>
                                                           <td>2</td>
                                                           <td >Total No of Hatch(Assist)</td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_assist; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_assist_percent.'%'; ?></td>
                                                           <td>
															<!-- <form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="assist">
                                                                    <input type="submit" value="View">
                                                           </form> -->
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/assist"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                        </tr>
                                                        <tr>
                                                           <td>3</td>
                                                           <td >Total No of Hatch(Normal)</td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_normal; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $fertile_normal_percent.'%'; ?></td>

                                                           <td>
															<!-- <form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="normal">
                                                                    <input type="submit" value="View">
                                                           </form> -->
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/normal"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                       
													 </tr>
                                                      
                                                           <td>4</td>
                                                           <td>Total No of Infertile Eggs</td>
                                                           <td style="font-weight:bold;"><?php echo $infertile;?></td>
                                                           <td style="font-weight:bold;"><?php echo $infertile_percent.'%'; ?></td>

                                                           <td>
															<!-- <form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="infertile">
                                                                    <input type="submit" value="View">
                                                           </form> -->
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/infertile"; ?>" class="btn btn-sm btn-default" >View</a>
														</td>                                                       
													 </tr>
                                                        <tr>
                                                           <td>5</td>
                                                           <td>Total no of DIS</td>
                                                           <td style="font-weight:bold;"><?php echo $dis; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $dis_percent.'%'; ?></td>

                                                           <td>
															<!-- <form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="dis">
                                                                    <input type="submit" value="View">
                                                           </form> -->
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/dis"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>6</td>
                                                           <td>Total no of Crack</td>
                                                           <td style="font-weight:bold;"><?php echo $crack; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $crack_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/crack"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>7</td>
                                                           <td>Total no of Broken</td>
                                                           <td style="font-weight:bold;"><?php echo $broken; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $broken_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/broken"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>8</td>
                                                           <td>Total no of Healthy Chick</td>
                                                           <td style="font-weight:bold;"><?php echo $healthy; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $healthy_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/healthy"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>9</td>
                                                           <td>Total no of Low hatch weight chick</td>
                                                           <td style="font-weight:bold;"><?php echo $low_weight_chick; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $low_weight_chick_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/low_weight_chick"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>10</td>
                                                           <td>Total no of Unabsorbed yolk sac</td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_sac; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_sac_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/yolk_sac"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>11</td>
                                                           <td>Total no of Yolk sac infection chicks</td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_sac_infection; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_sac_infection_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/yolk_sac_infection"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>
													  <tr>
                                                           <td>12</td>
                                                           <td>Total no of Splayed leg chicks</td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/splay_leg"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>

													  <tr>
                                                           <td>13</td>
                                                           <td>Total no of Wry neck chick</td>
                                                           <td style="font-weight:bold;"><?php echo $wry_neck; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $wry_neck_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/wry_neck"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>

													  <tr>
                                                           <td>14</td>
                                                           <td>Total no of Unknown Eggs</td>
                                                           <td style="font-weight:bold;"><?php echo $unknown; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $unknown_percent.'%'; ?></td>

                                                           <td>
															
														   <a target="_blank" href="<?php echo base_url()."index.php/Incubation/incubation_history_view/".$from_date."/".$to_date."/unknown"; ?>" class="btn btn-sm btn-default" >View</a>

														</td>                                                      
													  </tr>

                                                        <!-- <tr>
                                                           <td>6</td>
                                                           <td>Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $stunt_percent.'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Incubation/incubation_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="stunt">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                        </tr> -->
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
         <!-- <script src="<?php //echo base_url();?>assets/pro_js/execution/team.js"></script> -->

        
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
                  $('#sales_his').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		"searching": false
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
