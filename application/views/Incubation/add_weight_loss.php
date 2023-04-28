<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">

    <title><?php echo $this->session->userdata('client_name'); ?> | Add Weight Loss</title>

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
    <!-- Plugins css -->
    <link href="<?php echo asset_url();?>notifications/notification.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>modal-effect/css/component.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>select2/select2.css" rel="stylesheet" type="text/css" />


    <style>
    table.table-bordered th:last-child,
    table.table-bordered td:last-child {
        border-right-width: 1px !important;
    }

    .form-control {
        margin-bottom: 5px;
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
                                Add Weight Loss
                            </h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Incubation/incubation">Weight Loss</a></li>
                                <li class="active">Add Weight Loss</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Weight Loss</h3>
                                </div>
                                <div class="panel-body">
                                    <form name="incubdt_form" id="incubdt_form" class="form-horizontal form-bordered"
                                        action="<?php echo base_url('index.php/Masters/edit_aviary/update'); ?>"
                                        enctype="multipart/form-data" data-parsley-validate method="post"
                                        autocomplete="off">
                                        <input type="hidden" name="incubation_id" id="incubation_id">
                                        <div class="col-md-7">

                                            <table class="table table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th><span id="group_name"></span> <span id="species_name"
                                                                style="float:right;"></span></th>
                                                        <th><span id="aviary_name"></span> <span id="cage_name"
                                                                style="float:right;"></span></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Egg Number</th>
                                                        <td id="egg_no"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight of egg</th>
                                                        <td><input type="text" name="weight_of_egg" id="weight_of_egg"
                                                                class="form-control"></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Weight loss Percentage(%)</th>
                                                        <td><input type="text" name="weight_loss_min" id="weight_loss_min"
                                                                class="form-control" readonly />
                                                                <input type="text" name="weight_loss_max" id="weight_loss_max"
                                                                class="form-control" readonly /></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Date of incubation </th>
                                                        <td><input type="date" name="date_of_incub" id="date_of_incub"
                                                                class="form-control" readonly /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Incubation period</th>
                                                        <td><input type="text" name="incub_days_max" id="incub_days_max"
                                                                class="form-control" readonly /></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Days to pip</th>
                                                        <td><input type="text" name="incub_days_min" id="incub_days_min"
                                                                class="form-control" readonly /></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Date of Egg Laid</th>
                                                        <td><input type="date" name="elaid_date" id="elaid_date"
                                                                class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pip Date</th>
                                                        <td><input type="date" name="pip_date" id="pip_date"
                                                                class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hatch Date</th>
                                                        <td><input type="date" name="hatch_date" id="hatch_date"
                                                                class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight loss percentage per day</th>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                name="weight_loss_per_day_min" id="weight_loss_per_day_min" >
                                                            <input type="text" class="form-control"
                                                                name="weight_loss_per_day_max" id="weight_loss_per_day_max">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total weight to be lost </th>
                                                        <td>
                                                            <input type="text" name="total_loss_min" id="total_loss_min" class="form-control" value=""
                                                                readonly />
                                                            <input type="text"  name="total_loss_max" id="total_loss_max" class="form-control" value=""
                                                                readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Egg weight on hatch day</th>
                                                        <td>
                                                            <input type="text" class="form-control" name="hatch_weight"
                                                                id="hatch_weight" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight to be lost per day</th>
                                                        <td>
                                                            <input type="text" class="form-control" name ="weight_tobe_lost" id="weight_tobe_lost" value=""
                                                                readonly />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <table class="table table-bordered" id="incub_details_tb">

                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 5%"><input type="checkbox" name="select_all" id="select_all"></th>
                                                    <th rowspan="2" style="width: 10%">Date</th>
                                                    <th colspan="3" style="width: 25%" scope="colgroup">Weight</th>
                                                    <th rowspan="2" style="width: 10%">Heart Beat</th>
                                                    <th rowspan="2" style="width: 17%">Incubation Name</th>
                                                    <th rowspan="2" style="width: 10%">Humidity</th>
                                                    <th rowspan="2" style="width: 10%">Air Cell Density</th>
                                                    <th rowspan="2" style="width: 13%">Checked By</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" id="min_percent"></th>
                                                    <th scope="col" id="max_percent"></th>
                                                    <th scope="col">Actual</th>
                                                </tr>

                                            </thead>
                                            <tbody id="incub_details_tbody">

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-purple waves-effect waves-light"
                                            id="btnSave">Save
                                            Changes</button>
                                    </form>
                                </div><!-- panel-body -->
                            </div> <!-- panel -->
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

    <!-- Notification -->
    <script src="<?php echo asset_url();?>notifications/notify.min.js"></script>
    <script src="<?php echo asset_url();?>notifications/notify-metro.js"></script>
    <script src="<?php echo asset_url();?>notifications/notifications.js"></script>
    <!-- CUSTOM JS -->
    <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>

    <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.js"></script>

    <script src="<?php echo base_url();?>assets/pro_js/add_weightloss.js"></script>

    <script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>index.php/";

    $(document).ready(function() {
        $('#datatable').dataTable();
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        var page = "add_weight_loss";

        if (page == "add_weight_loss") {
            $('.incubation_m').click();
            $(".add_incubation_m").addClass("active");
        }

    });
    </script>
</body>

</html>