$(document).ready(function() {
    get_incubation_list();
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
        '<tr>' +
        '<td class="hide_t table-info">Created On</td>' +
        '<td data-label="Created On">' + d.created_on + '</td>' +
        '</tr>' +

        '</table>';
}

function get_incubation_list(){
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var ring_no = last_segment;
    // var decode_eggs = incub_eggs.split('%2C');
    // var aviary_id  = decode_eggs[0];
    // var species_id  = decode_eggs[1];
    // var cage  = decode_eggs[2];
    //console.log(decode_eggs);
    var ct = $('#incubation_tb').DataTable({
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
            'url': BASE_URL + 'Breeding/get_incubation_list',
            'data': function(data) {
              data.ring_no = ring_no;
            //   data.species_id = species_id,
            //   data.cage = cage;

            }
        },
        createdRow: function( row, data, dataIndex ) {
             $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Ring No');
             $( row ).find('td:eq(1)').attr('data-label', 'Group');
             $( row ).find('td:eq(2)').attr('data-label', 'Bird Species');
             $( row ).find('td:eq(3)').attr('data-label', 'Aviary');
             $( row ).find('td:eq(4)').attr('data-label', 'Cage');
            $( row ).find('td:eq(5)').attr('data-label', 'Male Parent Ring No');
            $( row ).find('td:eq(6)').attr('data-label', 'Female Parent Ring No');
             $( row ).find('td:eq(7)').attr('data-label', 'Egg no');
             $( row ).find('td:eq(8)').attr('data-label', 'Doi');
            $( row ).find('td:eq(9)').attr('data-label', 'Action');
             $( row ).find('td:eq(10)').attr('data-label', 'weight loss history');
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
            { "data": "doi" },
          //  { "data": "action" },
            { "data": "weight_loss" },
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#incubation_tb tbody').on('click', 'td.details-control', function() {
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

function get_incubdetails_list(incub_row_id){
   // var incub_row_id = $('#icub_id').val();
    $('#incubation-modal').modal('show');
 //alert(incub_row_id);
var ct = $('#weightloss_export_tb').DataTable({
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
    drawCallback: function () {
        // $.getScript("../assets/js/jquery.app.js");

        // $('[data-toggle="tooltip"]').tooltip();
    },
    'ajax': {
        'url': BASE_URL + 'Incubation/get_incubdetails_list',
        'data': function(data) {
            data.weightloss_id = incub_row_id;
        }
    },
    createdRow: function( row, data, dataIndex ) {
        
    },
    "columns": [
     /*   {
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
        { "data": "idate" },
        { "data": "weight_14" },
        { "data": "weight_16" },
        { "data": "actual_weight" },
        { "data": "heart_beat" },
        { "data": "incubation_name" },
        { "data": "humidity" },
        { "data": "aircell_density" },
        { "data": "checked_by" },
        
    ],
    "order": [
        [1, 'asc']
    ]
});

}
