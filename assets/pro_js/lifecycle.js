$(document).ready(function () {
  /*  $('#loader').bind('ajaxStart', function(){
        $(this).show();
    }).bind('ajaxStop', function(){
        $(this).hide();
    });*/
    //('#cd-timeline').hide();
    $('#cd-timeline').hide();
    $('#loader').hide();
    $('#lifecycle_form').submit(function () {
        $('#cd-timeline').hide();
        $('#loader').show();
       // alert("start again");
      
        // e.preventDefault();
        var formData = new FormData(this);
       // e.preventDefault();
        // alert(bird_ringno);
         $.ajax({
             url: BASE_URL + 'Lifecycle/get_bird_dt',
             method: "POST",
             data: formData,
             contentType: false,
             processData: false,
             dataType: "json",
             cache: false,
             success: function(data) {
                $('#cd-timeline').show();
                 //birds detail
                 var d =new  Date(data[0].bird_date);
                 const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
                 var birdDate = d.getDate()+' '+months[(d.getMonth())]+' '+d.getFullYear(); 
             // alert(data[0].auto_id);
                $('#bird_date').text(birdDate);
                $('#bird-group').text("Group: " + data[0].group_name);
                $('#bird-species').text("Species: " + data[0].bird_species);
                $('#bird-aviary').text("Aviary: " + data[0].aviary_name);
                $('#cage').text("Cage: " + data[0].cage_id);
                $('#proven').text("Proven: " + data[0].proven);
                $('#gender').text("Gender: " + data[0].gender);
              //incubation details
              
                $('#icub_id').val(data[0].incub_id);
                var d =new  Date(data[0].incub_date);
                var birdDate1 = d.getDate()+' '+months[(d.getMonth())]+' '+d.getFullYear(); 
                $('#incub-date').text(birdDate1);
                    // alert(d.getMonth());
                $('#egg-no').text("Egg no: " + data[0].egg_no);
                $('#egg-weight').text("Egg weight: " + data[0].egg_weight);
                $('#fertile_type').text("Fertile Type: " + data[0].fertile_type);
                $('#date_fertile').text("Date Fertile: " + data[0].dof);
                var d1 = data[0].move_handfeed_date;
                var dateAr = d1.split('-');
		    	//var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
                var move_handfeed_date = dateAr[2]+' '+months[(dateAr[1])]+' '+ dateAr[0]; 
               // alert((dateAr[1]));
                //$('#handfeed-date').text(move_handfeed_date);
                $('#handfeed-date').text(data[0].move_handfeed_date);
                $('#date1').text("Moved on: " + data[0].move_handfeed_date);
                $('#date2').text("Moved on: " + data[0].move_35_date);
                $('#date3').text("Moved on: " + data[0].move_34_date);
                $('#date4').text("Moved on: " + data[0].move_33_date);
                $('#age').text("Age: " + data[0].pw_age);
                $('#std_weight').text("Std weight: " + data[0].pw_weight);
                $('#status').text("Status: " + data[0].pw_status);
              //  $('#achieved').text("Achieved: " + data[0].achieved);
                var d2 =new  Date(data[0].move_33_date);
                var move_33_date = d2.getDate()+' '+months[(d2.getMonth())]+' '+d2.getFullYear(); 
             //   $('#preweaning-date').text(move_33_date);
                $('#preweaning-date').text(data[0].move_33_date);
                $('#weaning-date').text(data[0].moved_weaning_date);

                $('#agew').text("Age: " + data[0].w_age);
                $('#std_weightw').text("Std weight: " + data[0].w_weight);
                $('#statusw').text("Status: " + data[0].w_status);
                //$('#achievedw').text("Achieved: " + data[0].achieved);
               
               // get_eggno_dt(data[0].ring_no);
               
             },
             complete: function(){
                $('#loader').hide();
              }
     
         });
     
     });
  // get_ringno();
  // get_eggno();
   get_aviary();
  
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
        url: BASE_URL + 'Lifecycle/get_group',
        method: "POST",
        data:{"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Group</option>';
            for (let index = 0; index < data.length; index++) {
                if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].group_id + ">" + data[index].group_name + "</option>";
                }
            }
            $('#group_id').html(c_html);
                
        }
                
    });
});

$("#group_id").on('change', function() {
    var group_id = $('#group_id').val();
    var aviary_id = $('#aviary_id').val();

    $.ajax({
        url: BASE_URL + 'Lifecycle/get_species',
        method: "POST",
        data:{"group_id":group_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Species</option>';
            for (let index = 0; index < data.length; index++) {
               if(data[index].bird_species != "null"){
                c_html += "<option value=" + data[index].species_id + ">" + data[index].bird_species + "</option>";
                }
            }
            $('#species_id').html(c_html);
                
        }
                
    });
});

$("#species_id").on('change', function() {
    var group_id = $('#group_id').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#species_id').val();

    $.ajax({
        url: BASE_URL + 'Lifecycle/get_ring_av',
        method: "POST",
        data:{"species_id":species_id,
        "group_id":group_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Ring no</option>';
            for (let index = 0; index < data.length; index++) {
                if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].ring_no + "</option>";
                }
            }
            $('#ring_no').html(c_html);
                
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

/*function get_eggno_dt(ring_no){
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_incub_egg',
        method: "POST",
        data:{"current_ring_no": ring_no},
        cache: false,
        dataType: "json",
        success: function(data) {
            
          //  if (typeof auto_id === "undefined") {
                //alert("undefined");

         //   }
         //   else {
            $('#icub_id').val(data[0].auto_id);
            var d =new  Date(data[0].created_on);
            const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            var birdDate1 = d.getDate()+' '+months[(d.getMonth())]+' '+d.getFullYear(); 
            $('#incub-date').text(birdDate1);
           // alert(data[0].egg_no);
            $('#egg-no').text("Egg no: " + data[0].egg_no);
            $('#egg-weight').text("Egg weight: " + data[0].egg_weight);
            $('#fertile_type').text("Fertile Type: " + data[0].fertile_type);
            $('#date_fertile').text("Date Fertile: " + data[0].dof);
            var d1 =new  Date(data[0].move_handfeed_date);
            var move_handfeed_date = d1.getDate()+' '+months[(d1.getMonth())]+' '+d1.getFullYear(); 
           // $('#handfeed-date').text(move_handfeed_date);
           $('#handfeed-date').text(data[0].move_handfeed_date);
            $('#date1').text("Moved on: " + data[0].move_handfeed_date);
            $('#date2').text("Moved on: " + data[0].move_35_date);
            $('#date3').text("Moved on: " + data[0].move_34_date);
            $('#date4').text("Moved on: " + data[0].move_33_date);
            $('#age').text("Age: " + data[0].age);
            $('#std_weight').text("Std weight: " + data[0].std_weight);
            $('#status').text("Status: " + data[0].status);
            $('#achieved').text("Achieved: " + data[0].achieved);
            var d2 =new  Date(data[0].move_33_date);
            var move_33_date = d2.getDate()+' '+months[(d2.getMonth())]+' '+d2.getFullYear(); 
         //   $('#preweaning-date').text(move_33_date);
            $('#preweaning-date').text(data[0].move_33_date);
            $('#weaning-date').text(data[0].moved_weaning_date);
            get_weanhistory();
          //  }

        },
        cache: false

    });

}*/
/*function get_ringno(){
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_birds',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = '<option value="">Select ring no</option>';
            for (let index = 0; index < data.length; index++) {
                if(data[index].ring_no != ""){
                g_html += "<option value=" + data[index].auto_id + ">" + data[index].ring_no + "</option>";
                }
            }
            $('#ring_no').html(g_html);

        }

    });
}*/

/*function get_eggno(){
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_incubation',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = '<option value="">Select egg no</option>';
            for (let index = 0; index < data.length; index++) {
                g_html += "<option value=" + data[index].auto_id + ">" + data[index].egg_no + "</option>";
            }
            $('#egg_no').html(g_html);

        }

    });
}*/

function get_incubdetails_list(){
    var incub_row_id = $('#icub_id').val();
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

}// Add event listener for opening and closing details

/*function get_weanhistory(){
   // $('#weaning-modal').modal('show');
   var incub_row_id = $('#icub_id').val();
   // alert(incub_row_id);
  // var data = incub_row_id;
  $.ajax({
    url: BASE_URL + 'Lifecycle/get_weaning',
    data:{"incub_id": incub_row_id},
    method: "POST",
    dataType: "JSON",
    success: function(data) {
     // alert(data[0].age);
     $('#agew').text("Age: " + data[0].age);
     $('#std_weightw').text("Std weight: " + data[0].std_weight);
     $('#statusw').text("Status: " + data[0].status);
     $('#achievedw').text("Achieved: " + data[0].achieved);
    }

});
      
       
    
}*/

function get_handfeedhistory_list(){
    var incub_row_id = $('#icub_id').val();
    window.open( BASE_URL + 'Handfeeding/view_handfeed_details/'+ incub_row_id,'_blank' );
   
}
function get_preweanhistory_list(){
    var incub_row_id = $('#icub_id').val();
    window.open( BASE_URL + 'Preweaning/view_preweaning_details/'+ incub_row_id );
   
}
function get_weanhistory_list(){
    var incub_row_id = $('#icub_id').val();
    window.open( BASE_URL + 'Weaning/view_weaning_details/'+ incub_row_id );
   
}
/*function get_preweanhistory_list(){
    $('#preweaning-modal').modal('show');
    var incub_row_id = $('#icub_id').val();
   // alert(incub_row_id);
  // var data = incub_row_id;
    var ct = $('#get_preweaning_update').DataTable({
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
            'url': BASE_URL + 'Preweaning/get_preweaning_update',
            'data': function(data) {
                data.incub_id = incub_row_id;
                
            }
        },
        createdRow: function( row, data, dataIndex ) {
           
            if(data.status > 0){
                $( row ).find('td:eq(10)').css({"background": "#3CB371","color":"black","font-weight": "bold"});  
            }
            else{
                $( row ).find('td:eq(10)').css({"background": "#fa6f50ea","color":"black","font-weight": "bold"});  
            }
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
            { "data": "created_on" },
            { "data": "species_id" },
            { "data": "age" },
            { "data": "std_weight" },
            { "data": "target_vfeed" },
            { "data": "act_weight" },
            { "data": "status" },
            { "data": "weight_gain" },
           { "data": "achieved" },
            { "data": "action" },
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#get_preweaning_update tbody').on('click', 'td.details-control', function() {
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
}*/
