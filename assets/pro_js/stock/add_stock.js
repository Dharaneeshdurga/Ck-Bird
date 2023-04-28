$(document).ready(function () {
    get_type();
    var type="",part="";
    get_novemberstock_list(type,part);
});

function add_used_qty(stock_id){
      var get_html = '<input type="hidden" name="stock_id" class="SmallInput"  value="'+stock_id+'">';
      $('#stock_id').html(get_html);
      $('#add_usedstock-modal').modal('show');

}function add_discrep_qty(stock_id,dis_value){
   // dis_value ="0";
    var get_html = '<input type="hidden" name="stock_id" class="SmallInput"  value="'+stock_id+'">';
 get_html += '<input type="hidden" name="us_qty" class="SmallInput"  value="'+dis_value+'">';

    $('#stock_id1').html(get_html);
    $('#add_discrep-modal').modal('show');

}


function get_table(){
   
   // var date= $('#track_date').val(); 
   // alert(date);
   // var to_date= $('#to_track_date').val(); 
    var type= $('#type1').val(); 
    var part= $('#part1').val(); 
   
   
    get_novemberstock_list(type,part);
  
    
    
}
function get_type(){
    $.ajax({
        url: BASE_URL + 'Feedmaintenance/get_type',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var a_html = '<option value="">Select Type</option>';
            for (let index = 0; index < data.length; index++) {
                a_html += "<option>" + data[index].type + "</option>";
            }
            $('#type').html(a_html);
            $('#type1').html(a_html);
                
        }
                
    });
}


$("#type").on('change', function() {
    var type = $('#type').val();

    $.ajax({
        url: BASE_URL + 'Feedmaintenance/get_part',
        method: "POST",
        data:{"type":type,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Particular</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option>" + data[index].particular + "</option>";
            }
            $('#part').html(c_html);
                
        }
                
    });
});

$("#type1").on('change', function() {
    var type = $('#type1').val();

    $.ajax({
        url: BASE_URL + 'Feedmaintenance/get_part',
        method: "POST",
        data:{"type":type,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Particular</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option>" + data[index].particular + "</option>";
            }
            $('#part1').html(c_html);
                
        }
                
    });
});



$('#stock_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Feedmaintenance/add_stock_register', 
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
                    'Added Successfully..!',
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

$('#add_usedstock_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Feedmaintenance/add_used_register', 
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
                    'Added Successfully..!',
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
$('#add_discep_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Feedmaintenance/add_used_register', 
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
                    'Added Successfully..!',
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


function get_novemberstock_list(type,part){
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var month = segment_array[5];
    var year = last_segment;
    var my = month+"&nbsp&nbsp"+year; // need space
    $("#month").html(my);
  //alert(year);
    var ct = $('#stockreg_tb').DataTable({
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
            'url': BASE_URL + 'Feedmaintenance/get_stock_list',
            'data': function(data) {
                //data.date = date,
                //data.to_date = to_date,
                data.type = type,
                data.part = part;
                data.month = month;
                data.year = year;
            }
        },
        createdRow: function( row, data, dataIndex ) {
           
            
        },
        "columns": [
           /* {
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
            { "data": "type" },
            { "data": "particular" },
            { "data": "pur_date" },
            { "data": "opening_stock" },
            { "data": "total_pur_qty" },
            { "data": "total_pur_rs" },
            { "data": "total_consumption" },
            { "data": "dis_value" },
            {"data": "closing_stock" },
            {"data": "action" },
          //  {"data": "view" },
    
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
   /* $('#splay_tb tbody').on('click', 'td.details-control', function() {
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
    });*/
}