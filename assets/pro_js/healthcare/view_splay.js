$(document).ready(function() {
    var date= "",to_date="",avairy="",cage="",ring="",sp="";
    get_splay_list(date,to_date,avairy,cage,ring,sp);
  //  get_brooder();
    
  
   // $('#con-close-modal').hide();
});
function get_table(){
   
    var date= $('#track_date').val(); 
   // alert(date);
    var to_date= $('#to_track_date').val(); 
    var avairy= $('#aviary_id').val(); 
    var cage= $('#cage').val(); 
    var sp= $('#bird_species').val(); 
    var ring= $('#egg_no').val(); 
   
    get_splay_list(date,to_date,avairy,cage,ring,sp);
  
    
    
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
    return '<table class="table table-bordered" style="padding-left:50px;" id="child_view">' +
    '<tr>' +
    '<td class="hide_t table-info">Clutch no</td>' +
    '<td data-label="Remark">' + d.clutch_no + '</td>' +
    '</tr>' +
    '<tr>' +
    '<tr>' +
    '<td class="hide_t table-info">Egg no in current clutch</td>' +
    '<td data-label="Remark">' + d.egg_no_clutch + '</td>' +
    '</tr>' +

    '<tr>' +
        '<td class="hide_t table-info">Stunded From day</td>' +
        '<td data-label="Egg Weight">' + d.stunt_f_day + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Standard Weaning Days</td>' +
        '<td data-label="Fertile Type">' + d.std_wean_days + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Handfeeding Chick issues</td>' +
        '<td data-label="DOF">' + d.handfeed_chick_issue + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Corrective Measures Adaptive</td>' +
        '<td data-label="Remark">' + d.c_m_adapt + '</td>' +
        '</tr>' +
       
       
      
        

        '</table>';
}

function get_splay_list(date,to_date,avairy,cage,ring,sp){
    //$('#hide_pdate').hide();
    var ct = $('#splay_tb').DataTable({
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
            'url': BASE_URL + 'Healthcare/get_splay_list',
            'data': function(data) {
                data.date = date,
                data.to_date = to_date,
                data.avairy = avairy,
                data.cage = cage;
                data.ring = ring;
                data.sp = sp;
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
            { "data": "splay_date" },
            { "data": "aviary_id" },
            { "data": "cage" },
            { "data": "bird_species" },
            { "data": "egg_no" },
            { "data": "hatch_date" },
           
            { "data": "mp_ring" },
            {"data": "count_male_ring" },
            {"data": "fp_ring" },
            {"data": "count_female_ring" },
            { "data": "egg_weight" },
            { "data": "std_egg_weight" },
            { "data": "hatch_weight" },
            { "data": "std_hatch_weight" },
            { "data": "detect_date" },
            { "data": "c_m_adapt" },
            { "data": "status" },
            { "data": "action" },
          
           
           
           
            
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
function get_delete_splay(id){
    var resp = confirm("Do you want to Delete this?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Healthcare/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_healthcare_splay"
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
                        window.location = BASE_URL + "Healthcare/view_splay";
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
