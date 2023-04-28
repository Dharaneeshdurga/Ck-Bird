$(document).ready(function() {
    get_handfeed_list();
    get_brooder();
    
  
   // $('#con-close-modal').hide();
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

// /* Formatting function for row details - modify as you need */
function format(d) {
    // `d` is the original data object for the row
    return '<table class="table table-bordered" style="padding-left:50px;" id="child_view">' +
        '<tr>' +
        '<td class="hide_t table-info">Egg Weight</td>' +
        '<td data-label="Egg Weight">' + d.egg_weight + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Fertile Type</td>' +
        '<td data-label="Fertile Type">' + d.fertile_type + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">DOF</td>' +
        '<td data-label="DOF">' + d.dof + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Remark</td>' +
        '<td data-label="Remark">' + d.remark + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">PIP Weight</td>' +
        '<td data-label="PIP Weight">' + d.pip_weight + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">PIP Date</td>' +
        '<td data-label="PIP Date">' + d.pip_date + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Hatch Weight</td>' +
        '<td data-label="Hatch Weight">' + d.hatch_weight + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Hatch Date</td>' +
        '<td data-label="Hatch Date">' + d.hatch_date + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Shell Weight</td>' +
        '<td data-label="Shell Weight">' + d.shell_weight + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Hatch Type</td>' +
        '<td data-label="Hatch Type">' + d.hatch_type + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Shell Thick</td>' +
        '<td data-label="Shell Thick">' + d.shell_thick + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">DIS Type</td>' +
        '<td data-label="DIS Type">' + d.dis_type + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Health Status</td>' +
        '<td data-label="DIS Type">' + d.health_status + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">DIS Date</td>' +
        '<td data-label="DIS Date">' + d.dis_date + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Created By</td>' +
        '<td data-label="Created By">' + d.user_name + '</td>' +
        '</tr>' +
        '<tr>' +
      
        

        '</table>';
}

function get_handfeed_list(){
    //$('#hide_pdate').hide();
    var ct = $('#handfeeding_tb').DataTable({
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
            'url': BASE_URL + 'Incubtemperature/get_handfeed_list',
            'data': function(data) {
                
            }
        },
        createdRow: function( row, data, dataIndex ) {
            // $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Ring No');
            // $( row ).find('td:eq(2)').attr('data-label', 'Group');
            // $( row ).find('td:eq(3)').attr('data-label', 'Bird Species');
            // $( row ).find('td:eq(4)').attr('data-label', 'Gender');
            // $( row ).find('td:eq(5)').attr('data-label', 'Cage');
            // $( row ).find('td:eq(6)').attr('data-label', 'Aviary');
            // $( row ).find('td:eq(7)').attr('data-label', 'Proven');
            // $( row ).find('td:eq(8)').attr('data-label', 'Weight');
            // $( row ).find('td:eq(9)').attr('data-label', 'Created By');
            // $( row ).find('td:eq(10)').attr('data-label', 'Status');
            // $( row ).find('td:eq(11)').attr('data-label', 'Action');
            
        },
        "columns": [
            {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "group_name" },
            { "data": "bird_species" },
            { "data": "aviary_name" },
            { "data": "cage" },
            { "data": "male_parent_ringno" },
            { "data": "female_parent_ringno" },
            { "data": "egg_no" },
            { "data": "moved_on" },
            { "data": "brooder" },
           // { "data": "stunt_status" },
            //{ "data": "health_status" },
            { "data": "action" },
            { "data": "view" },
           
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#handfeeding_tb tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = ct.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
}


function get_delete_pop(incub_row_id){
   // alert("d");
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
                url: BASE_URL + 'Incubation/delete_incubation',
                method: "POST",
                data:{"incub_row_id":incub_row_id,},
                dataType: "JSON",
                success: function(data) {
                    
                    if(data =='success'){
                        swal("Deleted!", "Your data has been deleted.", "success"); 
                    }
                    else{
                        swal("Cancelled", "Your data file is safe :)", "error"); 
                    }
                    get_handfeed_list();

                }
        
            });
    
        }
        
    });
}
function get_brooder(){
    //  alert("test");
      $.ajax({
          url: BASE_URL + 'Incubtemperature/get_brooder',
          method: "POST",
          dataType: "JSON",
          success: function(data) {
              var g_html = '<option value="">Select Brooder</option>';
              for (let index = 0; index < data.length; index++) {
                //   if(data[index].brooder_name == "Brooder 36"){
                //     data_id = "B0001";
                //   }
                //   if(data[index].brooder_name == "Brooder 35"){
                //     data_id = "B0002";
                //   }
                //   if(data[index].brooder_name == "Brooder 34"){
                //     data_id = "B0003";
                //   }
                //   if(data[index].brooder_name == "Brooder 33"){
                //     data_id = "B0004";
                //   }
                  g_html += "<option value=" +data[index].auto_id  + ">" + data[index].brooder_name + "</option>";
              }
              $('#brooder_select').html(g_html);
  
          }
  
      });
  }
function get_moveBrooder_pop(incub_row_id,boorder_name){
    //alert(incub_row_id);
   // $('#con-close-modal').show();
   var data_id = incub_row_id; 
   var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data_id+'">';
   $("#getid").html(get_html);
   $('#change-modal').modal('show'); 
   var boorder=boorder_name;
   if(boorder=="Brooder 36"){
    $('#brooder_select').children('option[value="B0001"]').remove();
    // $('#brooder_select').children('option[value="B0001"]').css('color','red');
   }
   else if(boorder=="Brooder 35"){
    $('#brooder_select').children('option[value="B0001"]').remove();
    $('#brooder_select').children('option[value="B0002"]').remove();
   }
   else if(boorder=="Brooder 34"){
    $('#brooder_select').children('option[value="B0001"]').remove();
    $('#brooder_select').children('option[value="B0002"]').remove();
    $('#brooder_select').children('option[value="B0003"]').remove();
   }
   else if(boorder=="Brooder 33"){
    $('#brooder_select').children('option[value="B0001"]').remove();
    $('#brooder_select').children('option[value="B0002"]').remove();
    $('#brooder_select').children('option[value="B0003"]').remove();
    $('#brooder_select').children('option[value="B0004"]').remove();
   }
   
//    $.ajax({
//     url: BASE_URL + 'Incubtemperature/brooder_select',
//     data:{"incub_row_id":data_id,},
//     method: "POST",
//     dataType: "JSON",
//     success: function(data) {
       
       
    // }

// });
  // $('#con-close-modal').data('incubid', data).dialog('open');
   
 }
 function change_healthStatus(incub_row_id){
    var data = incub_row_id;
   var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
   $("#health_id").html(get_html);
   $('#health-modal').modal('show');  
 }


 $('#move_brooder_form').submit(function(e) {  //change brooder submit form
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Handfeeding/change_brooder', 
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

function get_move_production(incub_row_id){
    //var data = incub_row_id;
    $.ajax({
     url: BASE_URL + 'Handfeeding/get_handfeed_byid',
     method: "POST",
     data:{
         "incub_id":incub_row_id
     },
     dataType: "JSON",
     success: function(data) {
        if(data.act_weight=="error"){
            $.Notification.autoHideNotify(
                'error', 
                'top right', 
                'Request Failed..! Try Again..!',
                ''
            );
        }else{
         var get_html = '<input type="hidden" name="p_id" class="SmallInput"  value="'+data.full_detail[0].auto_id+'">';
          get_html += '<input type="hidden" name="ring_no" class="SmallInput"  value="'+data.full_detail[0].egg_no+'">';
          get_html += '<input type="hidden" name="group_id" class="SmallInput"  value="'+data.full_detail[0].group_id+'">';
          get_html += '<input type="hidden" name="aviary_id" class="SmallInput"  value="'+data.full_detail[0].aviary_id+'">';
          get_html += '<input type="hidden" name="cage" class="SmallInput"  value="'+data.full_detail[0].cage+'">';
          get_html += '<input type="hidden" name="species_id" class="SmallInput"  value="'+data.full_detail[0].species_id+'">';
          get_html += '<input type="hidden" name="weight" class="SmallInput"  value="'+data.act_weight[0].act_weight+'">';
          get_html += '<input type="hidden" name="proven" class="SmallInput"  value="Handfeed">';
 
         $("#hid").html(get_html);
         $('#movesale-modal').modal('show');
        }     
     }
             
 });
    
 }
 $('#product_form').submit(function(e) {
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
     e.preventDefault();
     $.ajax({  
         url:BASE_URL + 'Handfeeding/move_production', 
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
                     'error', 
                     'top right', 
                     'Request Failed..! Try Again..!',
                     ''
                 );
             }
                     
         }  
     });
 
 });
 $('#health_form').submit(function(e) {
    e.preventDefault();
     
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
    var health_status = $('#health_status').val();
	if(health_status == "Mortality"){
		send_mail(formData);
	}
     $.ajax({  
         url:BASE_URL + 'Handfeeding/change_health_status', 
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
                     'Successfully Changed ..!',
                     ''
                 );		
                 setTimeout(
                     function() {
                         window.location = BASE_URL +data.url;
                        // location.reload();
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
 function get_movePreWeaning(incub_row_id){
    // $('#pre_weaning_date').css('display','block');
 
    var data = incub_row_id;
    // $('#con-close-modal').data('incubid', data).dialog('open');
     var get_html = '<input type="hidden" name="p_id" class="SmallInput"  value="'+data+'">';
     $("#pid").html(get_html);
     $('#preweaning-modal').modal('show')
 }
 $('#preweaning_form').submit(function(e) {
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
     e.preventDefault();
     $.ajax({  
         url:BASE_URL + 'Handfeeding/move_pre_weaning', 
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

 function revert_to_incubation(egg_no,incub_id){
    var resp = confirm("Are you sure want to revert this?");
    if (resp == true) {
    $.ajax({
     url: BASE_URL + 'Handfeeding/revert_to_incubation',
     method: "POST",
     data:{
         "egg_no":egg_no,
         "incub_id":incub_id
     },
     dataType: "JSON",
     success: function(data) {
        if(data.logstatus =='success'){
                 
            $.Notification.autoHideNotify(
                'success', 
                'top right', 
                'Successfully Reverted to Incubation ..!',
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
             
     }
    }
         
	function send_mail(data)
 {
    
 // alert("test");
   //  console.log(message_body);
    $.ajax({
        url: BASE_URL + 'Email_send/send_mortality_mail',
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

    
 