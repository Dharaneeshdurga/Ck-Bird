<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon_1.ico">
	
        <title><?php echo $this->session->userdata('client_name'); ?> | Other Branch birds History  History</title>

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
    @media screen
{
    .noPrint{}
    .visible{display:none;}
}

@media print
{
    .noPrint{display:none;}
    #incub_printtb{display:block;}
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
                                 <ol class="breadcrumb pull-right">
                                <li><a href="<?php echo base_url(); ?>index.php/Bird/bird_history">Birds history</a></li>
                                <li class="active">view Birds details</li>
                            </ol>
                                 
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
                                        <h3 class="panel-title"> Other Branch birds History</h3>
                                        
                                    </div>
                                                                        
<br>
                                      
                               
                                   
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="other_his_tb" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
														<th>S.no</th>
                                                                <th>Ring No</th>
                                                                <th>Group</th>
                                                                <th>Bird Species</th>
                                                                <th>Gender</th>
                                                                <th>Cage</th>
                                                                <th>Aviary</th>
																<th>Current Branch</th>
																<th>Moved Date</th>
                                                                <th>Action</th>
                                                        </tr>
                                                       
                                                    </thead>

                                             
                                                    <tbody>
												<?php 
												$count = 1;
                                              foreach ($other_branch_result as $value){
												
												?>
													<tr>
													<td><?php echo $count++; ?></td>
													<td><?php echo $value->ring_no; ?></td>
													 <td><?php echo $value->group_name; ?></td>
													   <td><?php echo $value->bird_species; ?></td>
													   <td><?php echo $value->gender; ?></td>
													   <td><?php echo $value->cage_id; ?></td>
														<td><?php echo $value->aviary_name; ?></td>
														
														
														 <td><?php echo $value->branch_name; ?></td>
														 <td><?php echo date("d-m-Y", strtotime($value->branch_moved_date)); ?></td>
														 <td><button  onclick="change_branch('<?php echo $value->ring_no?>');"style = "margin-top: 5px;" class="btn btn-warning btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="changeBranch" title="Change branch"><i class="fa fa-exchange"></i></button></td>
														  </tr>
														<?php
														 }
												?>
                                    </tbody>
                                                        
                                                  
                                                      
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> <!-- End Row -->
 <!--bird modal-->    
 change branch model -->
								<div id="changeBranch-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  									<div class="modal-dialog"> 
                                        <div class="modal-content"> 
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                <h4 class="modal-title">Move Branch</h4> 
                                            </div> 
                                            <form name="branch_change_form" id="branch_change_form" class="form-horizontal form-bordered" action="javascript:void(0)"  autocomplete="off">
                                            <div class="modal-body"> 
                                                <div class="row"> 
                                                    <div class="col-md-6"> 
                                                        <div class="form-group"> 
                                                            <label for="bird_branch" cbird_branchlass="control-label">Select Branch</label><br>
															<input type="hidden" name="ring_no" id="ring_no" class="form-control"/>
															<input type="hidden" name="current_branch" id="current_branch" class="form-control"/>

															<select name="bird_branch" class="form-control" id="bird_branch" required >	
                                                             

                                                            </select>

                                                     </div>
                                                    
                                                   
                                                    </div> 
                                                     
                                                </div> 
                                            </div> 
                                            <div class="modal-footer"> 
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Move</button> 
                                            </div> 
                                            </form>
                                        </div> 
                                    </div>
                                </div><!-- /.modal -->
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
                  $('#other_his_tb').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

} );
        </script>
        
        <script type="text/javascript">
        $(document).ready(function () {
			var  page="bird_history";
				
				if(page=="bird_history"){
					$(".bird_manage_m a").addClass("active");
					$('.bird_manage_m').click();
					$(".bird_history").addClass("active");
				}
			
			});
			function change_branch(ring_no,branch_id){
	
    $.ajax({
        url: BASE_URL + 'Masters/get_all_branch',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Branch</option>';
            for (let index = 0; index < data.length; index++) {
				if(branch_id != data[index].auto_id ){
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].branch_name + "</option>";
				}
            }
           
			$('#changeBranch-modal').modal('show');
			$('#bird_branch').html(c_html);
			$('#ring_no').val(ring_no);
        }
                
    });  
  
}
$('#branch_change_form').submit(function(e) {
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
     e.preventDefault();
     $.ajax({  
         url:BASE_URL + 'Bird/change_branch', 
         method:"POST",  
         data: formData,
         cache:false,
         contentType: false,
         processData: false,
         dataType:"json",
         
         success:function(data) {
             if(data.logstatus =='success'){
                 
                 $.Notification.autoHideNotify(
                     'success', 
                     'top right', 
                     'Successfully Moved ..!',
                     ''
                 );		
                 setTimeout(
                     function() {
                         window.location =window.location.pathname;
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
 
 });
		</script>
	</body>
</html>
