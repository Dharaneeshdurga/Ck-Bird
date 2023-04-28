$(document).ready(function() {
    get_aviary();
    var date= "",to_date="",avairy="",cage="",ring="",sp="";
    get_shell_list(date,to_date,avairy,cage,ring,sp);
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
   
    get_shell_list(date,to_date,avairy,cage,ring,sp);
  
    
    
}
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
        url: BASE_URL + 'Breeding/get_birdspecies_fm',
        method: "POST",
        data:{"aviary_id":aviary_id,"cage_id":cage,},
        dataType: "JSON",
        success: function(data) {
            var s_html = '<option value="">Select Bird Species</option>';
            for (let index = 0; index < data.length; index++) {
                s_html += "<option value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
            }
            $('#bird_species').html(s_html);
           // $('#bird_count').val(data.length);

        }

    });

});

$("#bird_species").on('change', function() {
    
    var cage_id = $('#cage').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#bird_species').val();

    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_no',
        method: "POST",
        data:{"species_id":species_id,
        "cage_id":cage_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Egg no</option>';
            for (let index = 0; index < data.length; index++) {
                if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].egg_no + ">" + data[index].egg_no + "</option>";
                }
            }
            $('#egg_no').html(c_html);
                
        }
                
    });

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
    '<td class="hide_t table-info">Clutch no</td>' +
    '<td data-label="Remark">' + d.clutch_no + '</td>' +
    '</tr>' +
    '<tr>' +
    '<tr>' +
    '<td class="hide_t table-info">Egg no in current clutch</td>' +
    '<td data-label="Remark">' + d.egg_no_clutch + '</td>' +
    '</tr>' +

    '<tr>' +
        '<td class="hide_t table-info">Membrane integrity</td>' +
        '<td data-label="Egg Weight">' + d.membrane_integrity + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">EDEMA</td>' +
        '<td data-label="Fertile Type">' + d.edema + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">HEMORRHAGE</td>' +
        '<td data-label="DOF">' + d.hemo + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">inferences</td>' +
        '<td data-label="Remark">' + d.inference + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Degree of Yolk Sac Retraction</td>' +
        '<td data-label="DOF">' + d.yolk + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide_t table-info">Dis type</td>' +
        '<td data-label="Remark">' + d.dis_type + '</td>' +
        '</tr>' +
       
       
      
        

        '</table>';
}

function get_shell_list(date,to_date,avairy,cage,ring,sp){
    //$('#hide_pdate').hide();
    var ct = $('#shell_tb').DataTable({
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
            'url': BASE_URL + 'Healthcare/get_shell_list',
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
            console.log(data);
           
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
            { "data": "shell_date" },
            { "data": "dis_date" },
            { "data": "bos_date" },
            { "data": "aviary_id" },
            { "data": "cage" },
            { "data": "bird_species" },
            { "data": "egg_no" },
            { "data": "mp_ring" },
            {"data": "fp_ring" },
            { "data": "egg_weight" },
            { "data": "std_egg_weight" },
           
             { "data": "egg_shell_weight" },
             {"data": "egg_shell_thick" },
             {"data": "egg_lb" },
             {"data": "action" },
           
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#shell_tb tbody').on('click', 'td.details-control', function() {
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
function get_parents_history(mp_ring,fp_ring){
    //var mp_ring = $('#mp_ring').val();
  // var fp_ring =  $('#fp_ring').val();
   $('#history_modal').modal("show");  
    $.ajax({
        url: BASE_URL + 'Healthcare/get_parents_history',
        method: "POST",
        data:{
            "mp_ring":mp_ring,
            "fp_ring":fp_ring,
      },
        dataType: "JSON",
        success: function(data) {
           // console.log(data);
           // alert(data.length);
           var tot = "Total clutch:"+data.length;
           $('#total_clutch').html(tot);   
           
       var tb_html ="";
       for(var i=0; i < data.length; i++){
          // alert(i);
            tb_html +="<tr>";
            tb_html +="<td>" +data[i].clutch_no+ "</td>";
            tb_html +="<td>" +data[i].egg_hatch+ "</td>";
            tb_html +="<td>" +data[i].eggs_if+ "</td>";
            tb_html +="<td>" +data[i].eggs_dis+ "</td>";
            tb_html +="<td> mid </td>";
            tb_html +="<td>" +data[i].eggs_broken+ "</td>";
            tb_html +="<td>" +data[i].total_eggs+ "</td>";
            tb_html +='</tr>';
            //console.log(i);
       }
       $('#get_his').html(tb_html);   
         // alert("test");
        }
                
    });

}
function get_bos_video(video_name) {

    var video = '<iframe width="100%" height="315" src="' + IMG_URL + 'video/' + video_name + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

    $('#bird_video').html(video);
    $('#videomodal1').modal('show');
}
function get_delete_shell(id){
    var resp = confirm("Do you want to Delete this?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Healthcare/update_delete_status',
        method: "POST",
        data:{
            "id":id,
            "table":"ckb_healthcare_shell"
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
                        window.location = BASE_URL + "Healthcare/view_shell";
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