<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Incubation Temperature Details</title>

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
                            <h4 class="pull-left page-title">Incubation Temperature Details</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Incubtemperature/add_incubtemperature">Add Incubation temperature
                                        Details</a></li>
                                <li class="active"> Incubation Temperature Details</li>
                            </ol>
                        </div>
                    </div>
<!-- move to handfeeding modal -->   
                               


<div id="temp-modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-full"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Weight Loss History</h4> 
                                            </div> 
                                            <form name="" id="" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                            <table id="temp_tb" class="table table-bordered">
                                                   <thead>
                                                   <tr>
                                                            <!--th>#</th-->
                                                            <th>Sno</th>
                                                            <th>Date</th>
                                                            <th>Incubation No</th>
                                                            <th>Time</th>
                                                            <th>Temperature</th>
                                                            <th>Relative Humidity</th>
                                                            <th>Rotation</th>
                                                            <th>Total No of Egg</th>
                                                            <th>User</th>
                                                            <th>Action</th>
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

                    <!-- /.modal -->








                   

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Incubation Temperature & Humidity Details</h3>
                                </div>
                                <div class="panel-body">
                                    <a href="<?php echo base_url(); ?>index.php/Incubtemperature/add_incubtemperature"><button
                                            class="btn btn-primary waves-effect waves-light">Add Temperature & Humidity</button></a><br><br>
                                            <a href="<?php echo base_url(); ?>index.php/Incubtemperature/datalog"><button
                                            class="btn btn-primary waves-effect waves-light">Data Log</button></a><br><br>
                                          
                                            <p style="color:red">(Please select Date and Incubation to View/Edit Data)</p><br>
                                       <div class="col-md-2">
                                       <div class="form-group">
                                                   
                                                   <label for="cur_date"> DATE</label>
                                                   <input type="date" class="form-control" name="cur_date" id="cur_date" required>
                                               </div>

                                               </div>
                                               <div class="col-md-2">
                                               <div class="form-group">
                                                        <label for="incubation_no">INCUBATION*</label>
                                                        <select name="incubation_no" id="incubation_no" class="select2 form-control" required>
                                                            <option value="">Select incubation</option>
                                                        </select><br>
                                                        <button type="submit" onclick="get_table();"; class="btn btn-primary waves-effect waves-light" id="btnSave">View</button>
                                                        <button type="submit" onclick="get_edit();"; class="btn btn-primary waves-effect waves-light" id="btnSave">Edit</button>
                                                    </div>
                                                   
                                               </div>
                                              
                                             
                                             
                                           
                                            
                                             
                                           


                                            <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                       
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="incubtemp_tb">
                                                    <thead>
                                                        <tr>
                                                            <!--th>#</th-->
                                                            <th>Sno</th>
                                                            <th>Date</th>
                                                            <th>Incubation No</th>
                                                            <th>Time</th>
                                                            <th>Temperature</th>
                                                            <th>Relative Humidity</th>
                                                            <th>Rotation</th>
                                                            <th>Total No of Egg</th>
                                                            <th>User</th>
                                                            <!--th>Action</th-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                              <div class="col-md-12">
                              <div id="HideShow-edit">
                        
                         
                                                    <form name="edit_incub" id="edit_incub" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                                    <div class="table-responsive">
                                           <table class="table" id="bootstrap">
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
                                            <tr id="date" style="display:none"></tr>
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
                                                <th scope="row">Sign</th>
                                                <td><select name="user0" id="user0" class="select2"></select>
                                                <td><select name="user1" id="user1" class="select2"></select>
                                                <td><select name="user2" id="user2" class="select2"></select>
                                                <td><select name="user3" id="user3" class="select2"></select>
                                                <td><select name="user4" id="user4" class="select2"></select>
                                                <td><select name="user5" id="user5" class="select2"></select>
                                                <td><select name="user6" id="user6" class="select2"></select>
                                                <td><select name="user7" id="user7" class="select2"></select>
                                                <td><select name="user8" id="user8" class="select2"></select>
                                                </td> 
                                                </tr>
                                         </tbody>
                                         </table>  
</div>

                                         <div class="row">
                                    <div class="col-md-4 moveleft">
                                                <button type="submit" class="btn btn-purple waves-effect waves-light" id="btnSave">Update</button>
                                            </div>
                                                    </form>
</div>
</div>
</div>
                        </div>
                    </div> <!-- End row -->


                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('application/views/layouts/footer.php'); ?>


        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <?php include('application/views/layouts/right_sidebar.php'); ?>

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
 <!-- Notification -->
 <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
        <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
        <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
    <!-- CUSTOM JS -->
    <script src="<?php echo asset_url();?>js/jquery.app.js"></script>
    <script src="<?php echo base_url();?>assets/pro_js/list_incubtemp.js"></script>
    <script src="<?php echo asset_url();?>pro_js/view_incubtemp.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";

    $(document).ready(function() {
        $('#weightloss_export').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
        $('.btn-group button').removeClass('btn-outline-primary');
        $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

        var page = "incubtemperature";

        if (page == "incubtemperature") {
            $('.incubation_m').click();
            // $('.incubation_li a').addClass('subdrop');

            $(".temhum_incubation_m").addClass("active");
        }

    });
  
    </script>
</body>

</html>