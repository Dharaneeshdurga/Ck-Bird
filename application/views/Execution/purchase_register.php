<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon_1.ico">

        <title><?php echo $this->session->userdata('client_name'); ?>Purchase Register</title>

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
            .background_success{
                background-color:#66d56ee0;
                text-align: center;
                font-size: 15px;
                font-weight: bold;
            }
            .background_warining{
                background-color:#f2f54ac9;
                text-align: center;
                font-size: 15px;
                font-weight: bold;
            }
            .background_fail{
                background-color:#e98f86c9;
                text-align: center;
                font-size: 15px;
                font-weight: bold;
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
                    <div class="row">
                           <div class="col-sm-12">
                                <!-- <h4 class="pull-left page-title">ADD Purchase</h4> -->
                                <!-- <ol class="breadcrumb pull-right"> -->
                                    <!-- <lizc><a href="<?php //echo base_url(); ?>index.php/Feedmaintenance/new_stock">Back to month wise stock</a></li> -->
                                    <!-- <li class="active">ADD STOCK DETAILS</li> -->
                                <!-- </ol> -->
                            </div>
                        </div>
                   

<!-- Daily used qty add data modal start -->

                             





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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> Purchase Register Details</h3>              
                                        <div id="month" class="panel-title"></div>
                                    </div>
                                    <div class="panel-body">
                                   
                                        <!--div class="row">
                                           
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="type">Type*</label>
                                                    <select name="type" id="type1" class="select2">
                                                        <option value="">Select Type</option>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="part">Particulars*</label>
                                                    <select class="select2" id="part1" name="part">
                                                        <option value="">Select Particulars</option>
                                                    </select>


                                                </div>
                                            </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <button type="submit" onclick="get_table()" style="top: 24px;" class="btn btn-purple waves-effect waves-light" id="btnSave">Filter</button>
                                          </div>
                                         </div>

                                        </div !-->
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="purchase_tb">
                                                        <thead>
                                                            <tr>
                                                        <!--th>#</th-->
                                                                <th>S.no</th>
                                                              <th>Purchase Date</th>
                                                                <th>Species Name </th>
                                                                <th>Ring no</th>
                                                                <th>Price</th>
                                                                <th class="text-center">Payment Status</th>
                                                                <th  class="text-center">Invoice Upload</th>
                                                                <th>View Invoice</th>
                                                                <th>Action</th>
                                                               
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php  if (isset($pur_result) && !empty($pur_result)) { 
                                                           $count = 0;
                                                         
                                                         foreach($pur_result as $val) { 
                                                          
                                                            $count++;
                                                            $pur_date = date("d-m-Y", strtotime($val->pur_date));?>

                                                         <tr>
                                                           <td><?php echo $count; ?></td>
                                                           <td><?php echo $pur_date; ?></td>
                                                           <td><?php echo $val->species_name ;?></td>
                                                           <td ><?php echo $val->egg_no;?></td>
                                                           <td ><?php echo $val->price; ?></td>
                                                           <?php
                                                           $date1_ts = strtotime($pur_date);
                                                           $today_date= date('d-m-Y');
                                                           $date2_ts = strtotime($today_date);
                                                           $diff = $date2_ts - $date1_ts;
                                                           $no_days = $diff / 86400;
                                                           
                                                           if($val->pay_status == "Paid"){
                                                               $td_class = "background_success";
                                                               $sp_text = "";
                                                               $btn="";
                                                              } 
                                                              else if($val->pay_status == "Not Paid" && $no_days <= 7){
                                                                $td_class = "background_warining";
                                                                $re_days = 7-$no_days;
                                                                $sp_text = "(".$re_days." Days Remaining)<br>";
                                                                  $btn = "<a href='".base_url()."index.php/Execution/update_purchase_status/".$val->auto_id."' class='btn btn success'>Update to Paid</a>";
                                                              }
                                                              else if($val->pay_status == "Not Paid" && $no_days > 7){
                                                                $td_class = "background_fail";
                                                               // $re_days = 7-$no_days;
                                                                $sp_text = "(It Exceeds 7 Days)<br>";
                                                                $btn = "<a href='".base_url()."index.php/Execution/update_purchase_status/".$val->auto_id."' class='btn btn success'>Update to Paid</a>";
                                                              }
                                                              
                                                           ?>
                                                           <td class="<?php echo $td_class;?>"><?php  echo $val->pay_status; ?>
                                                           <br><span class=""><?php  echo $sp_text; ?><?php  echo $btn; ?> </span>
                                                        </td>
                                                          
                                                         
                                                            <td >	 <div class="form-group"> 
		 <form method="post" action="<?php echo base_url()."index.php/Execution/upload_purchase_invoice";?>" style="width:173px;"  enctype="multipart/form-data">
		  
				  <input type="file" style="width:173px;" class="btn btn-light" id="invoice_purchase" name="invoice_purchase"/>
				  <input type="hidden" class="form-control" id="pur_id" name="pur_id" value="<?php echo $val->auto_id;  ?>"  />
	
				 
					<input type="submit" class="btn btn-light" value="Upload Invoice" />
				
			 </form> </div></td>
            <td><a href="<?php echo base_url()."uploads/purchase/".$val->invoice;?>" target="_blank">View Invoice</a></td>
            <td><button onclick="get_delete_purchase('<?php echo $val->id;?>');"  class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> </button></td>

        </tr>
  
                                                       
                                                     <?php
                                                        }
                                                    }
                                                             ?>

                                                        </tbody>
                                                    </table>
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
    <!-- <script src="<?php// echo base_url();?>assets/pro_js/stock/add_stock.js"></script> -->

        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/";
            
            $(document).ready(function () {
                
                
            $('#purchase_tb').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
                $('.btn-group button').removeClass('btn-outline-primary');
                $('.btn-group button').addClass('btn-info btn-custom waves-effect waves-light');

                var page = "Purchase register";

                if (page == "Purchase register") {
                    $(".sales_m").click();
                    $(".purchase_reg").addClass("active");
                }


            // Select2
            jQuery(".select2").select2({
                width: '100%',

            });

           
});
function get_delete_purchase(id){
    var resp = confirm("Do you want to Delete this Purchase update?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Execution/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_purchase_register"
        },
        dataType: "JSON",
        success: function(data) {
            
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Deleted Successfully..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = BASE_URL + "Execution/purchase_register";
                    }, 
                2000);
                    
            }
            else{
                $.Notification.autoHideNotify(
                    'danger', 
                    'top right', 
                    'Request Failed..! Try Again..!',
                    ''
                );
            }
                    
        }  
        
    });
}
 }
        </script>    
	</body>
</html>