$(document).ready(function() {
    var date= "",to_date="",avairy="",cage="",clutch="",sp="";
    get_proven_list(date,to_date,avairy,cage,clutch,sp);
   // get_brooder();
     
});
$("#bird_species").on('change', function() {
    
    var cage_id = $('#cage').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#bird_species').val();

    $.ajax({
        url: BASE_URL + 'Breeding/get_clutch_no',
        method: "POST",
        data:{"species_id":species_id,
        "cage_id":cage_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Chick no</option>';
            for (let index = 0; index < data.length; index++) {
              //  if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].clutch_no + ">" + data[index].clutch_no + "</option>";
              //  }
            }
            $('#clutch_no').html(c_html);
                
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
/*function format(d) {
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
}*/
function get_table(){
   
    var date= $('#track_date').val(); 
   // alert(date);
    var to_date= $('#to_track_date').val(); 
    var avairy= $('#aviary_id').val(); 
    var cage= $('#cage').val(); 
    var sp= $('#bird_species').val(); 
    var clutch= $('#clutch_no').val(); 
   // $('.table-responsive').show(); 
//alert(clutch);
   get_proven_list(date,to_date,avairy,cage,clutch,sp);
  
    
    
}
function get_proven_list(date,to_date,avairy,cage,clutch,sp){
   
   // alert(incub_row_id);
  // var data = incub_row_id;
    var ct = $('#proven_tb').DataTable({
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
            'url': BASE_URL + 'Breeding/get_proven_all',
            'data': function(data) {
                data.date = date,
                data.to_date = to_date,
                data.avairy = avairy,
                data.cage = cage,
                data.clutch = clutch,
                data.sp = sp;
                
            }
        },
        createdRow: function( row, data, dataIndex ) {
           
           if(data.clutch_int <= 45){
                $( row ).find('td:eq(13)').css({"background": "#3CB371","color":"black","font-weight": "bold"}); //green 
                
           
            }
            else if(data.clutch_int > 45){
                $( row ).find('td:eq(13)').css({"background": "#fa6f50ea","color":"black","font-weight": "bold"});  //red
               if(data.mail_status != "mailed"){
                var message_body ="Aviary:"+data.aviary_name+"\n";
                message_body += "<p>Cage:"+data.cage+"\n</p>";
                message_body += "Species:"+data.bird_species+"\n";
                message_body += "Clutch no:"+data.clutch_no+"\n";
                message_body += "Clutch Interval:"+data.clutch_int+"\n";
                console.log(message_body);
                send_mail(message_body,data.auto_id);
               }
            }
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
            { "data": "date" },
            { "data": "aviary_name" },
            { "data": "cage" },
            { "data": "bird_species" },
            { "data": "clutch_no" },
            { "data": "total_eggs" },
            { "data": "eggs_broken" },
            { "data": "eggs_if" },
            { "data": "eggs_dis" },
            { "data": "egg_hatch" },
           { "data": "last_date" },
            { "data": "cfirst_date" },
            { "data": "clutch_int" },
            { "data": "avg_days" },
            { "data": "avg_weight" },
            { "data": "action" },
            { "data": "incub" },
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
  /*  $('#get_weaning_update tbody').on('click', 'td.details-control', function() {
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

function get_egg_details(proven_id){

      
$('#eggd-modal').modal('show');
    
             $.ajax({
                 url: BASE_URL + 'Breeding/get_proven_egg',
                 method: "POST",
                 data: {
                    "proven_id": proven_id,
                },
                 dataType: "JSON",
                 success: function(data) {
                   
                     
                    if (data.length != 0) {

                        var id_html = '';
                     var index_value =1;
                     var laid_date = data[0].laid_date;
                    var laid_dateAr =  str_to_ary(laid_date);

                    var egg_weight = data[0].egg_weight;
                    var egg_weightAr =  str_to_ary(egg_weight);

                    var days_bw = data[0].days_bw;
                    var days_bwAr =  str_to_ary(days_bw);
                    var eggno_incub = data[0].eggno_incub;
                    var eggno_incubAr =  str_to_ary(eggno_incub);
                 
                  //   alert(laid_date5[0]);
                     function str_to_ary(str){
                        var str1 = str.replace("[", "");
                        var str2 = str1.replace("]", "");
                      //  var str3 = str2.replace('"', '');
                      //  var str4 = str3.replace('"', '');
                         var str5 = str2.split(",");
                         return str5;
                     }
                    // var count = laid_dateAr.length;
                    for (let index = 0; index < laid_dateAr.length; index++) {
                        id_html += '<tr>';
                       
                         id_html += '<td>'+ index_value + '</td>';
                         var dateAr = laid_dateAr[index].split('-');
                         var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
                         id_html +='<td>'+newDate+ '</td>';
                         id_html +='<td>'+eggno_incubAr[index]+ '</td>';
                         id_html +='<td>'+egg_weightAr[index]+ '</td>';
                         id_html +='<td>'+days_bwAr[index]+ '</td>';
                         id_html += '</tr>';
                         index_value++;
                     }

                        $('#get_eggs').html(id_html);

                    
                    
                 }
                }
         
             });
     
             
    
 }
 function send_mail(message_body,auto_id)
 {
     var table ="ckb_breeding_proven";
     var where_id ="auto_id";
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
  function get_delete_proven(id,egg_no){
    var resp = confirm("Do you want to Delete this proven?");
    if (resp == true) {
    $.ajax({
        url: BASE_URL + 'Breeding/delete_breeding_proven',
        method: "POST",
        data: {
           
           "id":id,
           "egg_no":egg_no,
          

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