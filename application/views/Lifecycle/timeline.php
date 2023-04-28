<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | birds lifecycle</title>

    <!-- Base Css Files -->
    <link href="<?php echo asset_url();?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="<?php echo asset_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="<?php echo asset_url();?>css/animate.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>css/response_table.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="<?php echo asset_url();?>css/waves-effect.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="<?php echo asset_url();?>css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet" type="text/css" />
    <!-- sweet alerts -->
    <link href="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
    <style>
    .dataTables_filter {
        float: right;
    }

    table {
        width: 100% !important;
    }

    .btn-group {
        margin-top: 15px;
    }

    @media only screen and (max-width: 600px) {
        .btn-group {
            margin-bottom: 5px !important;
            display: inline-grid !important;
            margin-left: 5px;

        }

        .hide_t {
            display: none !important;

        }
    }

    .buttons-columnVisibility {
        display: block;
        padding: 6px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }

    .dt-button-collection {

        max-height: 250px;
        overflow: auto;
        /* overflow-y: hidden; */
        margin: 0 auto;
        white-space: nowrap
    }

    .dt-button-collection>a.active {
        background-color: #38bbf7;
        color: #ffff;
        margin-bottom: 1px;
    }
    .form-horizontal .form-group{
        margin-left: unset;
    }
.form-control-custom{
    background-color: #fafafa;
    color: rgba(0,0,0,0.6);
    font-size: 14px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
    border: 1px solid #eee;
    box-shadow: none;
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
                                <h4 class="pull-left page-title">Lifecycle</h4>
                                <ol class="breadcrumb pull-right">
                                    <!--li><a href="#">Moltran</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active">Timeline</li-->
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                           
                            <form id="lifecycle_form" method="post" autocomplete="false" action="javascript:void(0)">
                            <div class="row">
                                    <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Aviary*</label>
                                                <select name="aviary_id" id="aviary_id" class="select2 form-control">
                                                    <option value="">Select Aviary</option>

                                                </select>

                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Group*</label>
                                                <select name="group_id" id="group_id" class="select2 form-control">
                                                    <option value="">Select Group</option>

                                                </select>

                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Species*</label>
                                                <select name="species_id" id="species_id" class="select2 form-control">
                                                    <option value="">Select species</option>

                                                </select>

                                            </div>
                                          </div>
                             <div class="col-md-2">
                            <div class="form-group">
                                                        <label for="Ring_no">BIRD RING NO*</label>
                                                        <select name="ring_no" id="ring_no" class="select2 form-control" required>
                                                            <option value="">Select Ring no</option>
                                                        </select>
                                                    </div>
                             </div>
                             <!--div class="col-md-3">
                            <div class="form-group">
                                                        <label for="Ring_no">BIRD EGG NO*</label>
                                                        <select name="egg_no"  id="egg_no" class="select2 form-control">
                                                            <option value="">Select Egg no</option>
                                                        </select>
                                                    </div>
                             </div-->
                             <div class="col-md-2">
                             <button type="submit" style="margin-top: 25px;" class="btn btn-success waves-effect waves-light" id="btnSave"><i class="fa fa-thumbs-o-up"></i></button>
                             </div>
</div>
</div>
                                  </form>
                                  <div id="loader"></div>
                            <section id="cd-timeline" class="cd-container">
                          
                                    <div class="cd-timeline-block">
                                   
                                        <div class="cd-timeline-img cd-success">
                                            <i class="fa fa-twitter"></i>
                                        </div> <!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                        <div class="row">
                                                <div class="col-md-4">
                                            <h5 id="bird-group"></h5>
                                         </div>
                                         <div class="col-md-5">
                                            <h5 id="bird-species"></h5>
                                          </div>
                                                <div class="col-md-3">
                                            <h5 id="bird-aviary"></h5>
                                            </div>
                                      </div><!-- end row-->
                                           
                                      
                                      <div class="row">
                                        <div class="col-md-4">
                                        <h5 id="cage"></h5>
                                        </div>
                                        <div class="col-md-5">
                                            <h5 id="proven"></h5>
                                         </div>
                                        <div class="col-md-3">
                                            <h5 id="gender"></h5>
                                      </div>    
                                      </div><!-- end row-->
                                            <span class="cd-date" id="bird_date"></span>
                                            <!--input type="text" id="bird_date" name="bird_date" /-->
                                        </div> <!-- cd-timeline-content -->
                                    </div> <!-- cd-timeline-block -->

                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img cd-danger">
                                            <i class="fa fa-dashcube"></i>
                                        </div> <!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                            <h4>Incubation Details</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <input type="hidden" id="icub_id" >
                                            <h5 id="egg-no"></h5>
                                            </div>
                                            <div class="col-md-4">
                                            <h5 id="egg-weight"></h5>
                                            </div>   
                                            <div class="col-md-4">  
                                            <h5 id="fertile_type"></h5>
                                          </div>
                                      </div>
                                      <div class="row">
                                      <!--div class="col-md-6">
                                            
                                            <h5 id="date_fertile"></h5>
                                            <input type="hidden" id="icub_id" >
                                      </div-->   
                                      <div class="col-md-6">
                                      <button type="button" onclick="get_incubdetails_list();" class="btn btn-primary btn-rounded waves-effect waves-light m-t-15">See more </button>
                                       </div>
                                      </div>
                                    
                                           
                                            
                                            <span class="cd-date" id="incub-date"></span>
                                        </div> <!-- cd-timeline-content -->
                                    </div> <!-- cd-timeline-block -->

                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img cd-info">
                                            <i class="fa fa-hand-o-left"></i>
                                        </div> <!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                            <h3>Handfeeding Details</h3>
                                            <div class="row">
                                                <div class="col-md-5">
                                                <h5 id="brooder1">Brooder 36</h5>
                                            <h5 id="date1"></h5>
                                          
                                      </div>
                                      <div class="col-md-5">
                                      <h5 id="brooder1">Brooder 35</h5>
                                           <h5 id="date2"></h5>
                                           
                                      </div>    
                                      </div>
                                      <div class="row">
                                                <div class="col-md-5">
                                                <h5 id="brooder1">Brooder 34</h5>
                                                <h5 id="date3"></h5>
                                            
                                      </div>
                                      <div class="col-md-5">
                                               <h5 id="brooder1">Brooder 33</h5>
                                                <h5 id="date4"></h5>
                                      </div>    
                                      </div>
                                      
                                            <button type="button"  onclick="get_handfeedhistory_list();"  class="btn btn-primary btn-rounded waves-effect waves-light m-t-15">See more </button>
                                            
                                            <span class="cd-date" id="handfeed-date"></span>
                                        </div> <!-- cd-timeline-content -->
                                    </div> <!-- cd-timeline-block -->

                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img cd-pink">
                                            <i class="fa fa-file-powerpoint-o"></i>
                                        </div> <!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                            <h3>Preweaning Details</h3>
                                            <div class="row">
                                                <div class="col-md-4">
                                            <h5 id="age"></h5>
                                            </div>
                                            <div class="col-md-4">
                                            <h5 id="std_weight"></h5>
                                            </div>
                                            <div class="col-md-4">
                                            <h5 id="status"></h5>
                                            </div>

                                      </div>
                                      <div class="row">
                                      <!--div class="col-md-6">
                                            
                                            <h5 id="date_fertile"></h5>
                                            <input type="hidden" id="icub_id" >
                                      </div-->   
                                      <div class="col-md-6">
                                      <button type="button"  onclick="get_preweanhistory_list();"  class="btn btn-primary btn-rounded waves-effect waves-light m-t-15">See more </button>
                                       </div>
                                      </div> 

                                            
                                            <span class="cd-date" id="preweaning-date"></span>
</div>
                                    </div> <!-- cd-timeline-block -->

                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img cd-warning bounce-in">
                                            <i class="fa fa-wordpress"></i>
                                        </div> <!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                            <h3>Weaning details</h3>
                                            <div class="row">
                                                <div class="col-md-4">
                                            <h5 id="agew"></h5>
                                            </div>
                                            <div class="col-md-4">
                                            <h5 id="std_weightw"></h5>
                                            </div>
                                            <div class="col-md-4">
                                            <h5 id="statusw"></h5>
                                            </div>
                                          
                                      </div>
                                      <div class="row">
                                      <!--div class="col-md-6">
                                            
                                            <h5 id="date_fertile"></h5>
                                            <input type="hidden" id="icub_id" >
                                      </div-->   
                                      <div class="col-md-6">
                                      <button type="button" onclick="get_weanhistory_list();" class="btn btn-primary btn-rounded waves-effect waves-light m-t-15">See more </button>
                                       </div>
                                      </div>    


                                            <span class="cd-date" id="weaning-date"></span>
                                        </div> <!-- cd-timeline-content -->
                                    </div> <!-- cd-timeline-block -->

                                     
                                    

                                
                                </section> <!-- cd-timeline -->
                              <!-- INCUBATION MODAL-->  <div id="incubation-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="weightloss_export_tb" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                   <div id="weightloss_id"></div>
                                                  
                                                   <th>Sno</th>
                                                 <th>Date</th>
                                                <th>Weight(min percent)</th>
                                                <th>Weight(max percent)</th>
                                                <th>Actual Weight</th>
                                                <th>Heart Beat</th>
                                                <th>Incubation Name</th>
                                                 <th>Humidity</th>
                                                <th>Air Cell Density</th>
                                                <th>Checked By</th>
                                           
                                         </tr>
                                            </thead>
                                          

                                                
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
                                 <!-- handfeeding MODAL-->  <div id="handfeed-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                 <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="get_handfeed_update" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                <th>#</th>
                                                            <th>Sno</th>
                                                <th>Date</th>
                                                    <th>Species</th>
                                                    <th>age</th>
                                                    <th>Standard weight</th>
                                                <th>Target vol/feed</th>
                                                <th>Actual weight</th>
                                                <th>Status</th>
                                                <th>Weight Gain</th> 
                                            <th>Achieved</th>
                                            <th>action</th>
                                          
                                           
                                           
                                         </tr>
                                            </thead>
                                          

                                                
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
                                   <!-- preweaning MODAL-->  <div id="preweaning-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                   <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="get_preweaning_update" class="table table-bordered">
                                                   <thead>
                                                  
                                                <tr>
                                                <th>#</th>
                                                <th>Sno</th>
                                                <th>Date</th>
                                                <th>Species</th>
                                                <th>age</th>
                                                <th>Standard weight</th>
                                                <th>Target vol/feed</th>
                                                <th>Actual weight</th>
                                                <th>Status</th>
                                                <th>Weight Gain</th> 
                                            <th>Achieved</th>
                                            <th>action</th>
                                          
                                           
                                           
                                         </tr>
                                            </thead>
                                            <tbody>
                                              
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
                                  <!-- weaning MODAL-->  <div id="weaning-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                  <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="get_weaning_update" class="table table-bordered">
                                                   <thead>
                                                  
                                                <tr>
                                                <th>#</th>
                                                <th>Sno</th>
                                                <th>Date</th>
                                                <th>Species</th>
                                                <th>age</th>
                                                <th>Standard weight</th>
                                                <th>Target vol/feed</th>
                                                <th>Actual weight</th>
                                                <th>Status</th>
                                                <th>Weight Gain</th> 
                                            <th>Achieved</th>
                                            <th>action</th>
                                          
                                           
                                           
                                         </tr>
                                            </thead>
                                            <tbody>
                                              
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


                            </div>
                        </div><!-- Row -->


            </div> <!-- container -->
                               
                </div> <!-- content -->

                <?php include('application/views/layouts/footer.php'); ?>


</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<!-- Right Sidebar -->
<?php include('application/views/layouts/right_sidebar.php'); ?>
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
    <script src="<?php echo asset_url();?>jquery-detectmobile/detect.js"></script>
    <script src="<?php echo asset_url();?>fastclick/fastclick.js"></script>
    <script src="<?php echo asset_url();?>jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo asset_url();?>jquery-blockui/jquery.blockUI.js"></script>

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
        <!-- CUSTOM JS -->
        <script src="<?php echo asset_url();?>js/jquery.app.js"></script>
        <script src="<?php echo asset_url();?>pro_js/lifecycle.js"></script>

          <!-- Notification -->
    <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
    <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
    <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
    
    <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

        <script type="text/javascript">
        	var  page="timeline";

if(page=="timeline"){
    $('.lifecycle_m a').addClass("active");

   // $(".temhum_incubation_m").addClass("active");
}
        	var BASE_URL = "<?php echo base_url();?>index.php/";
            jQuery(document).ready(function($){
            var $timeline_block = $('.cd-timeline-block');

                //hide timeline blocks which are outside the viewport
                $timeline_block.each(function(){
                    if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
                        $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
                    }
                });

                //on scolling, show/animate timeline blocks when enter the viewport
                $(window).on('scroll', function(){
                    $timeline_block.each(function(){
                        if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
                            $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
                        }
                    });
                });
            });
        </script>
	
	</body>
</html>