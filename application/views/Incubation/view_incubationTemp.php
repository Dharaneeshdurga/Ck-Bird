<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> | View Incubation Details</title>

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
                /*width: 50%;*/
                table td {
  position: relative;
}

table td input {
  position: absolute;
  display: block;
  top:0;
  left:0;
  margin: 0;
  height: 100%;
  
  border: none;
  padding: 10px;
  box-sizing: border-box;
}
            }
            
        </style>    
        <style>
.SmallInput { width: 100px; height: 30px; }
.moveleft {margin-left: 400px; margin-top: 30px; margin-bottom:30px;}
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
                                <h4 class="pull-left page-title">View Incubation Temperature Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="view_incubationTemp">View Incubation Details</a></li>
                                    <!--li class="active">Add Incubation Details</li-->
                                </ol>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Basic example -->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">View Incubation Temperature Details</h3></div>
                                    <div class="panel-body">
									    <form id="view_incubationTemp" method="post" autocomplete="false" action="javascript:void(0)">

                                           <div class="row">
                                           <div class="col-md-3">
                                                    <div class="form-group">
                                                   
                                                        <label for="cur_date">SELECT DATE</label>
                                                        <input type="date" class="form-control" name="cur_date" id="cur_date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="incubation_no">SELECT INCUBATION*</label>
                                                        <select name="incubation_no" id="incubation_no" class="select2" required>
                                                            <option value="">Select incubation</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 moveleft">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">View & Edit</button>
                                            </div>
                                                   <?php if (isset($data)) 
                                                        { 
                                                            print_r($data);
                                                        }?>

        </form>
                                                    <div id="inform">
                                                        <!--p>your list will be dilsplayed afer select the date and incubation</p-->
        </div>
                                                    <div id="HideShow">
                                                    <form name="edit_incub" id="edit_incub" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">

                                           <table class="table">
                                      <thead>
                                             <tr>
                                               <th scope="col">Time</th>
                                                <th scope="col">6:00AM
                                                
                                             <!--input type="text" name="incubation" id="incubation" value=""-->
                                                <input type="hidden" name="6am" id="6am" value="6:00AM">
                                            </th>
                                                <th scope="col">8:00AM
                                                <input type="hidden" name="8am" id="8am" value="8:00AM">
                                                </th>
                                                <th scope="col">10:00AM
                                                <input type="hidden" name="10am" id="10am" value="10:00AM">
                                                </th>
                                                <th scope="col">12:00PM
                                                <input type="hidden" name="12pm" id="12pm" value="12:00PM">
                                                </th>
                                                <th scope="col">2:00PM
                                                <input type="hidden" name="2pm" id="2pm" value="2:00PM">
                                                </th>
                                                <th scope="col">4:00PM
                                                <input type="hidden" name="4pm" id="4pm" value="4:00PM">
                                                </th>
                                                <th scope="col">6:00PM
                                                <input type="hidden" name="6pm" id="6pm" value="6:00PM">
                                                </th>
                                                <th scope="col">8:00PM
                                                <input type="hidden" name="8pm" id="pm" value="8:00PM">
                                                </th>
                                                <th scope="col">10:00PM
                                                <input type="hidden" name="10pm" id="pm" value="10:00PM">
                                                </th>
                                            </tr>
                                         </thead>
                                            <tbody>
                                            <tr id="date" style="">
                                             </tr>
                                             <tr id="induction" style="display:none">
                                             </tr>
                                             <tr id="id" style="">
                                             </tr>
                                            <tr id="notetime">
                                             </tr>
                                            <tr id="temperature">
                                               <th scope="row">Temperature</th>
                                              
                                                  </tr>
                                                 <tr id="rel_hum">
                                                 <th scope="row">Relative Humidity</th>
                                                 
                                                </tr>
                                                <tr id="rotation">
                                                 <th scope="row">Rotation</th>
                                                </tr>
                                                <tr id="eggno">
                                                </tr>
                                                <tr id="sign">
                                                
                                                </tr>
                                         </tbody>
                                         </table>  
                                         <div class="row">
                                    <div class="col-md-4 moveleft">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Update</button>
                                            </div>
                                                    </form>
                                         
        </div>
                                  
        </div>
                                   
        </div>
                                   
        </form><!-- end form-->
        </div> <!-- row -->
        
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
 <!-- CUSTOM JS -->
 
<script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo asset_url();?>pro_js/view_incubtemp.js"></script>
<script>
			var BASE_URL = "<?php echo base_url();?>index.php/";

            $(document).ready(function () {
				var  page="incubation";

				if(page=="incubation"){
					$(".incubation_m a").addClass("active");
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