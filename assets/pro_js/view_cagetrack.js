$(document).ready(function() {
   // get_handfeedtemp_list();
   get_aviary();
   var date= "",to_date="",avairy="",cage="";
   get_cagetrack_list(date,to_date,avairy,cage)
  // $('.table-responsive').hide(); 
  // $('#HideShow-edit').hide();
  
   // $('#con-close-modal').hide();
});



function get_aviary(){
    $.ajax({
        url: BASE_URL + 'Bird/get_aviary',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var a_html = '<option value="">Select Aviary</option>';
            for (let index = 0; index < data.length; index++) {
                a_html += "<option value=" + data[index].auto_id + ">" + data[index].aviary_name + "</option>";
            }
            $('#aviary_id').html(a_html);
                
        }
                
    });
}


$("#aviary_id").on('change', function() {
    var aviary_id = $('#aviary_id').val();

    $.ajax({
        url: BASE_URL + 'Bird/get_cage_listall',
        method: "POST",
        data:{"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Cage</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option value=" + data[index].cage + ">" + data[index].cage + "</option>";
            }
            $('#cage').html(c_html);
                
        }
                
    });
});

$("#cage").on('change', function() {
    
    var aviary_id = $('#aviary_id').val();
    var cage = $('#cage').val();
   // alert(cage);
    $.ajax({
        url: BASE_URL + 'Bird/get_birdspecies_fm',
        method: "POST",
        data:{"aviary_id":aviary_id,"cage_id":cage,},
        dataType: "JSON",
        success: function(data) {
            var s_html = '<option value="">Select Bird Species</option>';
            for (let index = 0; index < data.length; index++) {
                s_html += "<option value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
            }
            $('#bird_species').html(s_html);
            $('#bird_count').val(data.length);

        }

    });

});
function get_table(){
   
    var date= $('#track_date').val(); 
    var to_date= $('#to_track_date').val(); 
    var avairy= $('#aviary_id').val(); 
    var cage= $('#cage').val(); 
   // $('.table-responsive').show(); 
   // alert(date);
    get_cagetrack_list(date,to_date,avairy,cage);
  
    
    
}

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
   /* return '<table class="table table-bordered" style="padding-left:50px;" id="child_view">' +
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
        '<td class="hide_t table-info">DIS Date</td>' +
        '<td data-label="DIS Date">' + d.dis_date + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Created By</td>' +
        '<td data-label="Created By">' + d.user_name + '</td>' +
        '</tr>' +
      
        

        '</table>';*/
}

function  get_cagetrack_list(date,to_date,avairy,cage){
   // alert(date);
    //$('#hide_pdate').hide();
    var ct = $('#individualcage_tb').DataTable({
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
                "extend": 'excelHtml5',
                "text": '<i class="fa fa-file-excel-o" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
					columns: "thead th:not(.noExport)",
					'format': {
                        body: function ( data, row, column, node ) {
                            return data.toString().replace(/<br\s*\/?>/ig, "\n");
                        }
                    }
                },
				
				customize : function ( xlsx ){
					var sheet = xlsx.xl.worksheets['sheet1.xml'];
					

					$('row c[r^="L"]', sheet).each( function () {
						var min_wastage =  $(this).text();
						//alert(std_egg_weight);
						//$(this).attr( 's', '37' );   
						$('row c[r^="M"]', sheet).each( function () {
							var total_wastage = $(this).text();
							//alert(egg_weight);
							if ( parseFloat(min_wastage) > parseFloat(total_wastage) ) {
								$(this).attr( 's', '10' );                 
							}
							else{
								$(this).attr( 's', '15' );   
							}
						});
						
					});
					
				
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
            'url': BASE_URL + 'Feedmaintenance/get_cagetrack_list',
            'data': function(data) {
                data.date = date,
                data.to_date = to_date,
                data.avairy = avairy,
                data.cage = cage;
                
            }
           
        },
        
        createdRow: function( row, data, dataIndex ) {
      //  alert(data.achieved);
      if(parseFloat(data.achieved) > parseFloat(data.to_be_achieved)){
        $( row ).find('td:eq(12)').css({"background": "#fa6f50ea","color":"black","font-weight": "bold"});  
		//red
        if(data.mail_status != "mailed" && data.created_on == data.today_date){
            var message_body = "Aviary:"+ data.aviary_id+"</br>";
			message_body += "Cage:"+ data.cage_id+"</br>";
			message_body += "Minumum wastage:"+ data.to_be_achieved+"</br>";
			message_body += "Attained wastage:"+ data.achieved+"</br>";
           // send_mail(message_body,data.id);

        }
    }
   
    else{
        $( row ).find('td:eq(12)').css({"background":"#3CB371","color":"black","font-weight": "bold"});  
		//green
    }
        // $( row ).find('td:eq(11)').attr('data-label', 'Action');
            
        },
       "columns": [
          /*  {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },*/
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
          
        
            { "data": "date" },
            { "data": "aviary_id" },
            { "data": "cage_id" },
            { "data": "species_id" },
            { "data": "count" },
            { "data": "target_mrng_feed" },
            { "data": "mrng_feed_wast" },  
            { "data": "target_aft_feed" },
            { "data": "aft_feed_wast" },  
            { "data": "total_intake" },  
			{ "data": "to_be_achieved" }, 
            {  "className":"change_color",
                "data": "achieved" },  
                { "data": "action" },   
          
  // { "data": "action" },        
            
        ],
        
        "order": [
            [1, 'asc']
        ]
       
    });

    // Add event listener for opening and closing details
    $('#individualcage_tb tbody').on('click', 'td.details-control', function() {
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
function view_temp_pop(incub_row_id,date){
   // $('#pre_weaning_date').css('display','block');

  // var data = incub_row_id;
   // $('#con-close-modal').data('incubid', data).dialog('open');
   // var get_html = '<input type="hidden" name="p_id" class="SmallInput"  value="'+data+'">';
   // $("#pid").html(get_html);
    $('#temp-modal').modal('show')
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
function get_brooder(){
// alert("test");
      $.ajax({
          url: BASE_URL + 'Incubtemperature/get_brooder',
          method: "POST",
          dataType: "JSON",
          success: function(data) {
              var g_html = '<option value="">Select Brooder</option>';
              for (let index = 0; index < data.length; index++) {
                  g_html += "<option value=" + data[index].auto_id  + ">" + data[index].brooder_name + "</option>";
              }
              $('#brooder_name').html(g_html);
  
          }
  
      });
  }
  $('#edit_incub').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/updateHandfeedtemp', 
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
                    'updated Successfully..!',
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
function send_mail(message_body,id)
 {
     var table ="ckb_cage_track";
     var where_id ="id";
 // alert("test");
   //  console.log(message_body);
    $.ajax({
        url: BASE_URL + 'Email_send/send_status_mail',
        method: "POST",
        data: {
           "message_body": message_body,
           "auto_id":id,
           "table":table,
           "where_id":where_id

       },
        dataType: "JSON",
        success: function(data) {
            
            console.log(data);
        }
    });
 }
 function get_delete_cage(id){
    var resp = confirm("Do you want to Delete this Cage details?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Execution/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_cage_track"
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
                        window.location = BASE_URL + "Feedmaintenance/individual_cage";
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
