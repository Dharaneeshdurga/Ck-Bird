<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | View Preweaning History</title>

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
        <style>
			div.dataTables_filter input {
    			margin-left: 0.5em;
     			display: block !important;
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
                               
                                 
                                 
                               
                            </div>
                        </div>

                        <div class="row">
						<?php if(!empty($from_date)){
												echo "From Date: ".date("d-m-Y", strtotime($from_date));
												echo "</br>";
												echo "To Date: ".date("d-m-Y", strtotime($to_date));
											}
											?>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">View Preweaning History</h3>
                                        
                                    </div>
                                    <div class="panel-body">
                                    <form id="sales_update_form" method="post" autocomplete="false" action="<?php echo base_url()."index.php/Preweaning/preweaning_history"; ?>" nctype="multipart/form-data">
                                       

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
												<a href="<?php echo base_url()."index.php/Preweaning/preweaning_history"; ?>" class="btn btn-warning">Clear</a>

											</div>
                                        </form>
                                        </div>
                                   <br>
                                   
                                        <div class="row">
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
                                                            $stunt = 0; 
                                                        }
                                                        if(isset($stunded_after)&& (!empty($stunded_after))){
                                                            $as = 0;
                                                          
                                                            foreach($stunded_after as $result){
                                                                $std_weight = $result->std_weight;
                                                                $twenty_percent = ($std_weight*20)/100;
                                                                $act_weight = $result->act_weight;
                                                            }
                                                            if($act_weight < $twenty_percent){
                                                                $as++;
                                                             // echo $as;
                                                            }
                                                        
                                                          

                                                        }
                                                        else{
                                                            $as = 0; 
                                                        }
                                                    if(isset($prewean_history)&& (!empty($prewean_history))){
                                                        // print_r($incub_history); 
                                                     //print_r ($incub_history[0]['total_eggs']);
                                                         foreach($prewean_history as $key=>$value) 
                                                         {
                                                              //  print_r($value);
                                                               $total_chicks =  $value['total_chicks'];
                                                               $total_weaning =  $value['total_weaning'];
                                                               $splay_leg =  $value['splay_leg'];
                                                               $airbubble =  $value['airbubble'];
                                                               $mortality =  $value['mortality'];
                                                               $sale =  $value['sale'];
															   $cured =  $value['cured'];
															   $yolk_infection =  $value['yolk_infection'];
															   $obesity =  $value['obesity'];
															   $ecoli =  $value['ecoli'];
															   $wry_neck =  $value['wry_neck'];
															   $asp_pnuem =  $value['asp_pnuem'];
															   $slow_digest =  $value['slow_digest'];
															   $crop_burn =  $value['crop_burn'];
															   $crop_injury =  $value['crop_injury'];
															   $oes_injury =  $value['oes_injury'];
															   $resp_distress =  $value['resp_distress'];
															   $dehydration =  $value['dehydration'];
															   $unabsorbed_yolk_sac =  $value['unabsorbed_yolk_sac'];
															   $air_crop =  $value['air_crop'];
															   $traumatic_injury =  $value['traumatic_injury'];
															   $stunted_chick = $value['stunted_chick'];
															   $reduced_crop_size = $value['reduced_crop_size'];
															   $splayed_leg = $value['splayed_leg'];
															   $fungal_infection = $value['fungal_infection'];

                                                               if($total_chicks >0) {
                                                               $total_chicks_percent = ($total_chicks/$total_chicks)*100;
        
                                                                $total_weaning_percent = round(($total_weaning/$total_chicks)*100,2);

                                                              
                                                                $splay_leg_percent = round(($splay_leg/$total_chicks)*100,2);

                                                               
                                                                $airbubble_percent = round(($airbubble/$total_chicks)*100,2);

                                                              
                                                                $mortality_percent = round(($mortality/$total_chicks)*100,2);

                                                               
                                                                $stunt_percent = round(($stunt/$total_chicks)*100,2);
                                                                $as_percent = round(($as/$total_chicks)*100,2);
                                                                $sale_percent = round(($sale/$total_chicks)*100,2);
																$cured_percent = round(($cured/$total_chicks)*100,2);
																$yolk_infection_percent = round(($yolk_infection/$total_chicks)*100,2);
																$obesity_percent = round(($obesity/$total_chicks)*100,2);
																$ecoli_percent = round(($ecoli/$total_chicks)*100,2);
																$wry_neck_percent = round(($wry_neck/$total_chicks)*100,2);
																$asp_pnuem_percent = round(($asp_pnuem/$total_chicks)*100,2);
																$slow_digest_percent = round(($slow_digest/$total_chicks)*100,2);
																$crop_injury_percent = round(($crop_injury/$total_chicks)*100,2);
																$oes_injury_percent = round(($oes_injury/$total_chicks)*100,2);
																$crop_burn_percent = round(($crop_burn/$total_chicks)*100,2);
																$resp_distress_percent = round(($resp_distress/$total_chicks)*100,2);
																$dehydration_percent = round(($dehydration/$total_chicks)*100,2);
																$unabsorbed_yolk_sac_percent = round(($unabsorbed_yolk_sac/$total_chicks)*100,2);
																$air_crop_percent = round(($air_crop/$total_chicks)*100,2);
																$traumatic_injury_percent = round(($traumatic_injury/$total_chicks)*100,2);
																$stunted_chick_percent = round(($stunted_chick/$total_chicks)*100,2);
																$reduced_crop_size_percent = round(($reduced_crop_size/$total_chicks)*100,2);
																$splayed_leg_percent = round(($splayed_leg/$total_chicks)*100,2);
																$fungal_infection_percent = round(($fungal_infection/$total_chicks)*100,2);
                                                               
															}
                                                               else{
                                                                $total_chicks_percent = 0;
                                                                $total_weaning_percent = 0;
                                                                $splay_leg_percent =0;
                                                                $airbubble_percent =0;
                                                                $mortality_percent = 0;
                                                                $stunt_percent = 0;
                                                                $as_percent=0;
                                                                $sale_percent = 0;
																$stunt_percent = 0;
                                                                $as_percent = 0;
                                                                $sale_percent = 0;
																$cured_percent = 0;
																$yolk_infection_percent = 0;
																$obesity_percent = 0;
																$ecoli_percent =
																$wry_neck_percent =0;
																$asp_pnuem_percent =0;
																$slow_digest_percent =0;
																$crop_injury_percent =0;
																$oes_injury_percent =0;
																$crop_burn_percent =0;
																$resp_distress_percent =0;
																$dehydration_percent =0;
																$unabsorbed_yolk_sac_percent =0;
																$air_crop_percent =0;
																$traumatic_injury_percent =0;
																$stunted_chick_percent =0;
																$reduced_crop_size_percent =0;
																$splayed_leg_percent =0;
																$fungal_infection_percent =0;
                                                               }
                                                       
                                                            }
                                                        } 
                                                        ?>
                                                           <tr>
                                                           <td>1</td>
                                                           <td >Total No of Chicks</td>
                                                           <td style="font-weight:bold;"><?php echo $total_chicks; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $total_chicks_percent.'%'; ?></td>
                                                           <?php
                                                           if(isset($from_date)){
                                                             //  echo $from_date;
                                                           }
                                                            ?>
                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="all">
                                                                    <input type="submit" value="View">
                                                           </form></td>
                                                        </tr>
                                                        <tr>
                                                           <td>2</td>
                                                           <td >Total no of Chicks moved to  Weaning</td>
                                                           <td style="font-weight:bold;"><?php echo $total_weaning; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $total_weaning_percent.'%'; ?></td>
                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="wean">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                        </tr>
                                                        <tr>
                                                           <td>3</td>
                                                           <td >Total No of Splay Leg</td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $splay_leg_percent.'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="splay_leg">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                           </tr>
                                                      
                                                           <td>4</td>
                                                           <td>Total No of Airbubble</td>
                                                           <td style="font-weight:bold;"><?php echo $airbubble;?></td>
                                                           <td style="font-weight:bold;"><?php echo $airbubble_percent.'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="airbubble">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                           </tr>
                                                                                                              </tr>
                                                        <tr>
                                                           <td>5</td>
                                                           <td>Total no of Mortality</td>
                                                           <td style="font-weight:bold;"><?php echo $mortality; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $mortality_percent.'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="mort">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                           </tr>
                                                                                                              </tr>
                                                        <tr>
                                                           <td>6</td>
                                                           <td>Total no of Stunted by birth</td>
                                                           <td style="font-weight:bold;"><?php echo $stunt; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $stunt_percent.'%'; ?></td>

                                                           <td><form target="_blank"  action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="stunt">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                        </tr>
                                                        <tr>
                                                           <td>7</td>
                                                           <td>Total no of Stunted after birth</td>
                                                           <td style="font-weight:bold;"><?php echo $as; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $as_percent.'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="stunt_after">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          </tr>
                                                        <tr>
                                                           <td>8</td>
                                                           <td>Total no of Chicks Moved to Sale</td>
                                                           <td style="font-weight:bold;"><?php echo $sale; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $sale_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="sale">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>9</td>
                                                           <td>Total no of Chicks Cured</td>
                                                           <td style="font-weight:bold;"><?php echo $cured; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $cured_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="cured">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>10</td>
                                                           <td>Total no of Yolk sac infection</td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_infection; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $yolk_infection_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="yolk_infection">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>11</td>
                                                           <td>Total no of Obesity</td>
                                                           <td style="font-weight:bold;"><?php echo $obesity; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $obesity_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="obesity">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>12</td>
                                                           <td>Total no of E.coli infection</td>
                                                           <td style="font-weight:bold;"><?php echo $ecoli; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $ecoli_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="ecoli">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														 
														   <tr>
                                                           <td>13</td>
                                                           <td>Total no of Wry neck</td>
                                                           <td style="font-weight:bold;"><?php echo $wry_neck; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $wry_neck_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="wry_neck">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>14</td>
                                                           <td>Total no of Aspiration Pneumonia</td>
                                                           <td style="font-weight:bold;"><?php echo $asp_pnuem; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $asp_pnuem_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="asp_pnuem">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>15</td>
                                                           <td>Total no of Slow digestion</td>
                                                           <td style="font-weight:bold;"><?php echo $slow_digest; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $slow_digest_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="slow_digest">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>16</td>
                                                           <td>Total no of Crop burns</td>
                                                           <td style="font-weight:bold;"><?php echo $crop_burn; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $crop_burn_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="crop_burn">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>17</td>
                                                           <td>Total no of Crop injuries</td>
                                                           <td style="font-weight:bold;"><?php echo $crop_injury; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $crop_injury_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="crop_injury">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>18</td>
                                                           <td>Total no of Oesophageal injury</td>
                                                           <td style="font-weight:bold;"><?php echo $oes_injury; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $oes_injury_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="oes_injury">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>19</td>
                                                           <td>Total no of Respiratory distress</td>
                                                           <td style="font-weight:bold;"><?php echo $resp_distress; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $resp_distress_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="resp_distress">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>20</td>
                                                           <td>Total no of Dehydration</td>
                                                           <td style="font-weight:bold;"><?php echo $dehydration; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $dehydration_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="dehydration">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>21</td>
                                                           <td>Total no of Unabsorbed yolk sac</td>
                                                           <td style="font-weight:bold;"><?php echo $unabsorbed_yolk_sac; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $unabsorbed_yolk_sac_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="unabsorbed_yolk_sac">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>22</td>
                                                           <td>Total no of Air in the crop</td>
                                                           <td style="font-weight:bold;"><?php echo $air_crop; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $air_crop_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="air_crop">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														 
														   <tr>
                                                           <td>23</td>
                                                           <td>Total no of Traumatic injury</td>
                                                           <td style="font-weight:bold;"><?php echo $traumatic_injury; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $traumatic_injury_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="traumatic_injury">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>24</td>
                                                           <td>Total no of Stunted chick</td>
                                                           <td style="font-weight:bold;"><?php echo $stunted_chick; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $stunted_chick_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="stunted_chick">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>25</td>
                                                           <td>Total no of Reduced crop size</td>
                                                           <td style="font-weight:bold;"><?php echo $reduced_crop_size; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $reduced_crop_size_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="reduced_crop_size">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>26</td>
                                                           <td>Total no of Splayed leg</td>
                                                           <td style="font-weight:bold;"><?php echo $splayed_leg; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $splayed_leg_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="splayed_leg">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
                                                           </tr>
														   <tr>
                                                           <td>27</td>
                                                           <td>Total no of Fungal infection</td>
                                                           <td style="font-weight:bold;"><?php echo $fungal_infection; ?></td>
                                                           <td style="font-weight:bold;"><?php echo $fungal_infection_percent .'%'; ?></td>

                                                           <td><form target="_blank" action="<?php echo base_url()."index.php/Preweaning/preweaning_history_view"; ?>" method="post">
                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date;?>">
                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">
                                                                    <input type="hidden" name="type" value="fungal_infection">
                                                                    <input type="submit" value="View">
                                                           </form></td>                                                          
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
                  $('#sales_his').DataTable( {
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
