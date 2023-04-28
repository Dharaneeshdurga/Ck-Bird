$(document).ready(function() {
    get_weanhistory_list();
   // get_brooder();
     
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
        '<td class="hide_t table-info">Actual volume/day</td>' +
        '<td data-label="Egg Weight">' + d.actualv_day + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Actual Feed/Day</td>' +
        '<td data-label="Fertile Type">' + d.actualf_day + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Ratio</td>' +
        '<td data-label="DOF">' + d.ratio + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Volume</td>' +
        '<td data-label="Remark">' + d.volume + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Target no of feed</td>' +
        '<td data-label="PIP Weight">' + d.target_feed + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Target Feed in given day</td>' +
        '<td data-label="PIP Date">' + d.targetg_day + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Hatch Weight</td>' +
        '<td data-label="Hatch Weight">' + d.hatch_weight + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Actual no of feed given</td>' +
        '<td data-label="Hatch Date">' + d.actn_feed + '</td>' +
        '</tr>' +
        '<tr>' +
      

        '</table>';
}

function get_weanhistory_list(){
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var incub_row_id = last_segment;
   // alert(incub_row_id);
  // var data = incub_row_id;
    var ct = $('#get_weaning_update').DataTable({
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
            'url': BASE_URL + 'Weaning/get_weaning_update',
            'data': function(data) {
                data.incub_id = incub_row_id;
                
            }
        },
        createdRow: function( row, data, dataIndex ) {
           
            if(data.status > 0){
                $( row ).find('td:eq(07)').css({"background": "#3CB371","color":"black","font-weight": "bold"});  
            }
            else{
                $( row ).find('td:eq(07)').css({"background": "#fa6f50ea","color":"black","font-weight": "bold"});  
                if(data.mail_status != "mailed"){
                    var message_body = "From weaning Details";
                    send_mail(message_body,data.incub_id);

                }
            }
        },
        "columns": [
            // {
            //     "className": 'details-control',
            //     "orderable": false,
            //     "data": null,
            //     "defaultContent": ''
            // },
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "created_on" },
            { "data": "species_id" },
            { "data": "age" },
            { "data": "std_weight" },
            { "data": "target_vfeed" },
            { "data": "act_weight" },
            { "data": "status" },
            { "data": "weight_gain" },
          // { "data": "achieved" },
          //  { "data": "action" },
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#get_weaning_update tbody').on('click', 'td.details-control', function() {
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

function feed_history_pop(incub_row_id,date){
   // alert(date);
   // $('#con-close-modal').show();
  // var data = incub_row_id;
  // $('#con-close-modal').data('incubid', data).dialog('open');
  // var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
  // $("#weightloss_id").html(get_html);
   $('#feed-modal').modal('show');
   
         
             $.ajax({
                 url: BASE_URL + 'Weaning/get_wean_feed',
                 method: "POST",
                 data: {
                    "current_incubid": incub_row_id,
                    "current_date": date,
                },
                 dataType: "JSON",
                 success: function(data) {
                     
                    if (data.length != 0) {

                        var id_html = '';
                     id_html += '<table id=datatable  class="table table-bordered">';
                     //id_html += '<thead>';
                     var index_value =1;
                     for (let index = 0; index < data.length; index++) {
                        id_html += '<tr>';
                       
                         id_html += '<td>Feed no '+ index_value + '</td>';
                         id_html +='<td>'+data[index].feed+ '</td>';
                         id_html += '</tr>';
                         index_value++;
                     }
                   //  id_html += '</thead>';
                    
                      
                        id_html += '</table>';


                     //  $('#id').html(id_html);

                        $('#feed_history').html(id_html);

                    
                    
                 }
                }
         
             });
     
             
    
 }
 function send_mail(message_body,auto_id)
 {
     var table ="ckb_weaning";
     var where_id ="incub_id";
 // alert("test");
     console.log(message_body);
    $.ajax({
        url: BASE_URL + 'Email_send/send_status_mail',
        method: "POST",
        data: {
           "message_body": message_body,
           "auto_id":auto_id,
           "table":table,
           "where_id":where_id

       },
        dataType: "JSON",
        success: function(data) {
            
            console.log(data);
        }
    });
 }