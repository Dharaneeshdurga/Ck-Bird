<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | Add Dead in Shell Register Details</title>

        <!-- Base Css Files -->
        <link href="<?php echo asset_url();?>css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo asset_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="<?php echo asset_url();?>css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo asset_url();?>css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?php echo asset_url();?>css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
        <!-- Plugins css -->
        <link href="<?php echo asset_url();?>notifications/notification.css" rel="stylesheet" />
        <link href="<?php echo asset_url();?>modal-effect/css/component.css" rel="stylesheet">
        <link href="<?php echo asset_url();?>select2/select2.css" rel="stylesheet" type="text/css" />

        <style>
            .checkbox label{
                font-size: 12px !important;
            }
            .panel-title-new{
                font-size: 14px;
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 0;
                margin-top: 0;
            }

            /* Important part */
            .modal-dialog{
                overflow-y: initial !important
            }
            .panel-scroll{
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }
            .panel-title-black{
                color:black;
            }
            .select2-choice {
                height: 35px !important;
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
                                <h4 class="pull-left page-title"> Add Dead in Shell Register Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="view_shell"> View Dead in Shell Register Details</a></li>
                                    <li class="active"> Add Dead in Shell Register Details</li>
                                </ol>
                            </div>
                        </div>

                        <div id="history_modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Parents History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="weightloss_export" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                   <div id="weightloss_id"></div>
                                                  <h4 id="total_clutch"></h4>
                                                <th>Clutch.No</th>
                                                <th>Hatch</th>
                                                <th>Infertile</th>
                                                <th>DIS</th>
                                                <th>Stage/Reason</th>
                                                <th>Broken</th>
                                                <th>Total</th>
                                         </tr>
                                            </thead>
                                            <tbody id="get_his">
                                             
                                               

                                         </tbody> 

                                     
                                                
                                         </table> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <!--button type="submit" class="btn btn-info waves-effect waves-light">Move</button--> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal --> 
                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title"> Add Dead in Shell Register Details</h3></div>
                                    <div class="panel-body">
									    <form id="shell_form" method="post" autocomplete="false" action="javascript:void(0)">
                                        <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Date*</label>
                                                <input type="date" class="form-control" id="shell_date"
                                                    name="shell_date" placeholder="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
                                                <select name="aviary_id" id="aviary_id" class="select2">
                                                    <option value="">Select Aviary</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Cage*</label>
                                                <select class="select2" id="cage" name="cage">
                                                    <option value="">Select Cage</option>
                                                </select>

                                            </div>
                                        </div>
                                       
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Species*</label>
                                                <select class="select2" id="bird_species" name="bird_species" required>
                                                    <option value="">Select Species</option>
                                                </select>

                                            </div>
                                           
                                            
                                      
        </div>
        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Egg no/Ring no*</label>
                                                <select class="select2" id="egg_no" name="egg_no" required>
                                                    <option value="">Select Species</option>
                                                </select>
                                            </div>
        </div>
        <div class="col-md-2">
                                          <div class="form-group">
                                            <button  onclick=" get_parents_history() " style="top: 24px;" class="btn btn-purple waves-effect waves-light" id="btnSave">View Parents History</button>
                                          </div>
                                         </div>
        </div><br>
        <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Date DIS*</label>
                                                <input type="text" class="form-control" id="dis_date"
                                                    name="dis_date" placeholder="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Date BOS*</label>
                                                <input type="date" class="form-control" id="bos_date"
                                                    name="bos_date" placeholder="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cage">Choose video to upload*</label>
                                                <input type="file" class="form-control" id="video_bos"
                                                    name="video_bos" placeholder="" required>
<span style="color:green"> Formats allowed:wmv|mp4|avi|mov</span>
                                            </div>
                                        </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cage"> Male Parent Ring no  *</label>
                                                <input type="text" class="form-control" id="mp_ring"
                                                    name="mp_ring" placeholder="" readonly>

                                            </div>
      
       
                                            <div class="form-group">
                                                <label for="cage">Female Parent Ring no*</label>
                                                <input type="text" class="form-control" id="fp_ring"
                                                    name="fp_ring" placeholder="" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Egg Weight *</label>
                                                <input type="text" class="form-control" id="egg_weight"
                                                    name="egg_weight" value="" readonly>
                                            </div>
      
                                            <div class="form-group">
                                                <label for="cage">Standard Egg weight*</label>
                                                <input type="text" class="form-control" id="std_egg_weight"
                                                    name="std_egg_weight" placeholder="" readonly>

                                            </div>
     
        
                                            <div class="form-group">
                                                <label for="cage">Egg Shell Weight*</label>
                                                <input type="text" class="form-control" id="egg_shell_weight"
                                                    name="egg_shell_weight" placeholder="" required>

                                            </div>
      
      
                                          
        

        </div>
       
      
        <div class="col-md-4">
                                         <div class="form-group">
                                                <label for="cage">Egg Shell Thickness*</label>
                                               <input type="text" class="form-control" id="egg_shell_thick"
                                                    name="egg_shell_thick" placeholder="" required>
                                            </div>
       
       
                                            <div class="form-group">
                                                <label for="cage">Egg Dimension(lenght*diameter(mm))*</label>
                                                <input type="text" class="form-control" id="egg_lb"
                                                    name="egg_lb" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Membrane Integrity</label>
                                                <select class="select2" id="membrane_integrity" name="membrane_integrity" required>
                                                    <option value="">Select Membrane Integrity</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Loose">Loose</option>
                                                    <option value="Adhered">Adhered</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">EDEMA*</label>
                                                <select class="select2" id="edema" name="edema" required>
                                                    <option value="">Select EDEMA</option>
                                                    <option value="Present">Present</option>
                                                    <option value="Absent">Absent</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">HEMORRHAGE*</label>
                                                <select class="select2" id="hemo" name="hemo" required>
                                                    <option value="">Select Hemorrhage</option>
                                                    <option value="Present">Present</option>
                                                    <option value="Absent">Absent</option>
                                                </select>
                                            </div>
        
        </div>
        <div class="row">
        <div class="col-md-4">
                                             
                                            
     
                                            <div class="form-group">
                                                <label for="cage">Degree of Sac Yolk Retraction*</label>
                                                <select class="select2" id="yolk" name="yolk" required>
                                                    <option value="">Select</option>
                                                    <option value="Absent">Absent</option>
                                                    <option value="Mild">Mild</option>
                                                    <option value="Moderate">Moderate</option>
                                                    <option value="Complete">Complete</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Clutch no*</label>
                                                <input type="text" class="form-control" id="clutch_no"
                                                    name="clutch_no" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Egg no in clutch*</label>
                                                <input type="text" class="form-control" id="egg_no_clutch"
                                                    name="egg_no_clutch" placeholder="" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Stage of DIS*</label>
                                                <input type="text" class="form-control" id="dis_type"
                                                    name="dis_type" placeholder="" readonly>
                                                <!--select class="select2" id="bird_species" name="bird_species" required>
                                                    <option value="">Select</option>
                                                    <option value="">Early</option>
                                                    <option value="">Mid</option>
                                                    <option value="">Late</option>
                                                   
                                                </select-->
                                            </div>
                                            <div class="form-group">
                                                <label for="cage">Inference*</label>
                                                <input type="text" class="form-control" id="inference"
                                                    name="inference" placeholder="" required>

                                            </div>
        </div>
        </div>
        <div class="row">
                                       
                                           
                                            


                                            <div class="row" style="text-align:center;">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Submit</button>
                                            </div>
                                        </form>
                                       
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
                           
       
                           
                        </div> <!-- End row -->

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
            <?php include('application/views/layouts/rightbar.php'); ?>

            <!-- /Right-bar -->


        </div>
        <!-- END wrapper -->
    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
        <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo asset_url();?>js/waves.js"></script>
        <script src="<?php echo asset_url();?>js/wow.min.js"></script>
        <script src="<?php echo asset_url();?>js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo asset_url();?>/jquery-detectmobile/detect.js"></script>
        <script src="<?php echo asset_url();?>fastclick/fastclick.js"></script>
        <script src="<?php echo asset_url();?>jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo asset_url();?>jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="<?php echo asset_url();?>js/jquery.app.js"></script>
        <script src="<?php echo asset_url();?>select2/select2.min.js" type="text/javascript"></script>

        <!-- Notification -->
        <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
        <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
        <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
        <!-- Modal-Effect -->
        <script src="<?php echo asset_url();?>modal-effect/js/classie.js"></script>
        <script src="<?php echo asset_url();?>modal-effect/js/modalEffects.js"></script>   

     
        <script src="<?php echo asset_url();?>pro_js/healthcare/shell.js"></script>
        <script>
			var BASE_URL = "<?php echo base_url();?>index.php/";
            var IMG_URL = "<?php echo base_url();?>uploads/";
function get_table(){
    $('#history_modal').modal("show");
}
            $(document).ready(function () {

                var page = "shell_register";

if (page == "shell_register") {
    $('.healthcare_m').click();
    // $('.incubation_li a').addClass('subdrop');

    $(".shell").addClass("active");
}

                $('input[type="text"]').attr('autocomplete', 'off');//Disable cache

			});

            // Select2
            jQuery(".select2").select2({
                    width: '100%',

                });
        </script>
	</body>
</html>