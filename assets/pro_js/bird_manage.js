$(document).ready(function() {
    get_birdmanage();

});

// for export all data
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}
function get_birdmanage(){
    var ct = $('#bird_tb').DataTable({
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
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="fa fa-file-excel-o" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="fa fa-file-pdf-o" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="fa fa-print" ></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="fa fa-eye" ></i>  Colvis <i class="fa fa-sort-down" ></i>',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        'dom': 'Bfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { "bSortable": false, "aTargets": [ 0, 6, 7, 8] }, 
        ],
        'ajax': {
            'url': BASE_URL + 'Bird/get_birdmanage_list',
            'data': function(data) {
                
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Ring No');
            $( row ).find('td:eq(2)').attr('data-label', 'Group');
            $( row ).find('td:eq(3)').attr('data-label', 'Bird Species');
            $( row ).find('td:eq(4)').attr('data-label', 'Gender');
            $( row ).find('td:eq(5)').attr('data-label', 'Cage');
            $( row ).find('td:eq(6)').attr('data-label', 'Aviary');
            $( row ).find('td:eq(7)').attr('data-label', 'Proven');
            $( row ).find('td:eq(8)').attr('data-label', 'Weight');
            $( row ).find('td:eq(9)').attr('data-label', 'Created By');
            $( row ).find('td:eq(10)').attr('data-label', 'Status');
            $( row ).find('td:eq(11)').attr('data-label', 'Action');
            
        },
        "columns": [
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "ring_no" },
            { "data": "group_name" },
            { "data": "bird_species" },
            { "data": "gender" },
            { "data": "cage" },
            { "data": "aviary_name" },
           // { "data": "proven" },
           // { "data": "weight" },
            { "data": "bird_status" },
            { "data": "status" },
            { "data": "upload" },
            { "data": "action" },
          
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    
}

function get_delete_pop(bird_row_id){
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this data!",   
        type: "warning",   
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        closeOnConfirm: false 
    }, function(isConfirm){   
        
        if(isConfirm){
            $.ajax({
                url: BASE_URL + 'Bird/delete_bird',
                method: "POST",
                data:{"bird_row_id":bird_row_id,},
                dataType: "JSON",
                success: function(data) {
                    
                    if(data =='success'){
                        swal("Deleted!", "Your data has been deleted.", "success"); 
                    }
                    else{
                        swal("Cancelled", "Your data file is safe :)", "error"); 
                    }
                    get_birdmanage();

                }
        
            });
    
        }
        
    });
}

function get_move_status(bird_id){
 
    var data = bird_id;
     var get_html = '<input type="hidden" name="p_id" class="SmallInput"  value="'+data+'">';
     $("#pid").html(get_html);
     $('#bird-modal').modal('show');
 }
 $('#bird_status_form').submit(function(e) {
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
     e.preventDefault();
	 var val = $('#bird_status').val();
	 if(val == "Mortality"){
		send_mail(formData);
	 }
     $.ajax({  
         url:BASE_URL + 'Bird/update_status', 
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
                         window.location = BASE_URL +data.url;
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
//  function change_branch(bird_id,branch_id){
//  //alert(bird_id);
//    // var data = bird_id;
//     // var get_html = '<input type="text" name="bird_id" class="SmallInput"  value="'+data+'">';
// 	 get_branch(bird_id,branch_id);
   

//  }
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
			$('#current_branch').val(branch_id);
			
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
                         window.location = BASE_URL +data.url;
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
 function send_mail(data)
	 {
		
	 // alert("test");
	   //  console.log(message_body);
		$.ajax({
			url: BASE_URL + 'Email_send/send_bird_mortality_mail',
			method: "POST",
			data: data,
			cache:false,
			contentType: false,
			processData: false,
			dataType:"json",
			success: function(data) {
				
				console.log(data);
			}
		});
	 }
	