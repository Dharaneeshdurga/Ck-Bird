<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?> Raw material track</title>

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

        
        <link href="<?php echo base_url();?>assets/select2/select2.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo asset_url();?>js/modernizr.min.js"></script>
        <style>
            .dataTables_filter{
                float :right;
            }

            table{
                width:100% !important;
            }
            .btn-group{
                margin-top: 15px;
            }
            @media only screen and (max-width: 600px) {  
                .btn-group{
                    margin-bottom: 5px !important;
                    display: inline-grid !important;
                    margin-left: 5px;

                }

                .hide_t{
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
            .dt-button-collection{
                
                max-height: 250px;
                overflow: auto;
                /* overflow-y: hidden; */
                margin: 0 auto;
                white-space: nowrap
            }
            .dt-button-collection >a.active{
                background-color: #38bbf7;
                color: #ffff;
                margin-bottom: 1px;
            }

            .select2-choice {
                height: 35px !important;
            }
            .SmallInput { width: 100px; height: 30px; }
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
                            <!--div class="col-sm-12">
                                <h4 class="pull-left page-title">Incubation Details</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="<?php// echo base_url(); ?>Incubation/add_incubation_details">Add Incubation Details</a></li>
                                    <li class="active">Incubation Details</li>
                                </ol>
                            </div>
                        </div-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Raw Material update</h3>
                                    </div>
                                    <div class="panel-body">
                                       

                                        <div class="row">
                                        <form id="raw_material_track" action="<?php echo base_url("index.php/Feedmaintenance/get_raw_material_track") ?>" method="post" enctype="multipart/form-data">
                                           

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
                                                    <label for="group">Group*</label>
                                                    <select class="select2" id="group_id" name="group_id" required>
                                                        <option value="">Select group</option>
                                                        
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="aviary_id">Species*</label>
                                                <select  class="select2" name="species_id" id="species_id"  required>
                                                    <option value="">Select species</option>

                                                </select>


                                            </div>
                                          </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="act">Actual Type*</label>
                                                    <select class="select2" id="act" name="act" required>
                                                        <option value="">Select Type</option>
                                                        
                                                    </select>

                                                    <input type="hidden" name="count_sp" id="count_sp">
                                                </div>
                                            </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <button type="submit"  style="top: 24px;" class="btn btn-purple waves-effect waves-light" id="btnSave"><i class="fa fa-thumbs-o-up"></i></button>
                                          </div>
                                         </div>
        </form>
                                        </div>
                                        <div class="row" id="show_mat">
                                        <form id="mat-update" method= "post" action="javascript:void(0);">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="aviary_id"> Date*</label>
                                                    <input type="date" name="mat_date" id="mat_date" class="form-control" required><br>

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive1">
                                                    <h5 class=""></h5>
                                                   
                                                        
                                                    <table class="table table-striped table-bordered" id="raw_mat">
                                                        <thead>
                                                            <tr>
    
                                                                <th>Sno</th>
                                                                <th>Species</t>
                                                                <th>Section</th>
                                                                <th>Raw Material</th>
                                                                <th>Target/bird</th>
                                                                <th>Total Target</th>
                                                                <th>Actual(g)</th>
                                                                <th>Status</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                       
                                                       <?php if (isset($mat_result) && !empty($mat_result)) { 
                                                           $count = 0;
                                                          
                                                         foreach($mat_result as $val) { 
                                                            $count++;
                                                            if (isset($count_sp) && !empty($count_sp)) { 
                                                               $target = $val->target;
                                                               $output_tr =floatval($target);
                                                               $total_target = $output_tr * $count_sp;
                                                            }
                                                             ?>
                                                         
                                                            <tr>
                                                             <td><?php echo $count; ?></td>
                                                             <td><?php echo $val->species_id;;?></td>
                                                             <?php $section = $val->section;
                                                             $section = ucfirst($section)?>
                                                             <td class="section"><?php echo $section;?></td>
                                                             <td><?php echo $val->material; ?></td>
                                                            
                                                             
                                                             <input type="hidden" name="count[]" id="count" value="<?php echo count($mat_result); ?>" >
                                                             <input type="hidden" name="group_name[]" value="<?php echo $val->group_id; ?>" >
                                                             <input type="hidden" name="species_name[]" value="<?php echo $val->species_id; ?>" >
                                                             <input type="hidden" name="aviary_name[]" value="<?php echo $val->aviary_id; ?>" >
                                                             <input type="hidden" name="material[]" value="<?php echo $val->material; ?>" >
                                                             <input type="hidden" name="section[]" value="<?php echo $val->section; ?>" >
                                                             <td><input type="text" name="target_b[]" id="targetb<?php echo $count; ?>" class="form-control SmallInput " value="<?php echo $val->target; ?>"readonly></td>
                            
                                                             <td class="tg"><input type="text" name="target[]" id="target<?php echo $count; ?>" class="form-control SmallInput " value="<?php echo $total_target; ?>"readonly></td>
                                                             <td class="tt" style="display:none"><?php echo $total_target;?></td>
                                                             <td><input type="text" name="actual[]" id="actual<?php echo $count; ?>" class="form-control SmallInput actual"  value=""></td>
                                                             <td class="ss"><input type="text" name="status[]" id="" class="form-control SmallInput actual"  value=""></td>
                                                             
    
                                                         </tr>
                                                       
                                                         <?php  }
                                                                
                                                                }    ?>
                                                      </tbody>
                                                       
                                                    </table>
                                                    <div class="col-md-2 text-center" style="padding-left: 90%;">
                                          <div class="form-group">
                                            <button type="submit"  class="btn btn-primary waves-effect waves-light " id="btnSave">Submit</button>
                                          </div>
                                         </div>
                                                            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <!--weaning modal-->     
                            
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
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url();?>assets/sweet-alert/sweet-alert.init.js"></script>
        <script src="<?php echo base_url();?>assets/select2/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/pro_js/raw-material.js"></script>

        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/";
            
            $(document).ready(function () {

              
        $('#get_handfeed_update').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

                var page = "raw_material_track";

                if (page == "raw_material_track") {
                    $('.feedm_m').click();
                    $(".raw_mat_m").addClass("active");
                }


            // Select2
            jQuery(".select2").select2({
                width: '100%',

            });

            var ct = $('#raw_mat').DataTable({
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'lengthChange': true,
            "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="fa fa-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                // "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="fa fa-file-excel-o" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                // "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                // "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="fa fa-file-pdf-o" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                // "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="fa fa-print" ></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                // "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="fa fa-eye" ></i>  Colvis <i class="fa fa-sort-down" ></i>',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        'dom': 'Bfrtip',
        
        
    });

});

        </script>    
	</body>
</html>