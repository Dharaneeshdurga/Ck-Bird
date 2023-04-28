$(document).ready(function() {
   // get_handfeedtemp_list();
   get_brooder();
   $('#handfeedtemp_tb').hide(); 
   $('#HideShow-edit').hide();
  
   // $('#con-close-modal').hide();
});
function get_table(){
   
    var date= $('#cur_date').val(); 
    var broo= $('#brooder_name').val(); 
    if((date == "" )||(broo == "")){
      alert('Please select Date and Brooder');
    }
    else{
        $('#HideShow-edit').hide();
    $('#handfeedtemp_tb').show(); 
    get_handfeedtemp_list(date,broo);
    }
    
}
function get_edit() {
   
    //var formData = new FormData(this);
    //var obj = {};
   
    data1 = $('#cur_date').val();
    data2 = $('#brooder_name').val();
   // if((data1 == "" )||(data2 == "")){
       // alert('Please select Date and Incubation');
    //}
   // else{
    $('#handfeedtemp_tb').hide();
    $('#HideShow-edit').show();
       // alert(data2);
   
   
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/get_handtempdetails', 
        method:"POST",  
       // cache:false,
        data:{"date": data1, "broo":data2},
       // contentType: false,
      //  processData: false,
        dataType:"json",
        
        success: function(data) {
           var da = '<th scope="row">date</th>';
           // for (let index = 0; index < data.length; index++) {
                da +='<td><input type="hidden" name="date" class="SmallInput"  value="'+data[0].date+ '"></td>';
            //}
          $('#date').html(da);
           
           var ind = '<th scope="row">induction</th>';
           // for (let index = 0; index < data.length; index++) {
                ind +='<td><input type="text" name="brooder_name" class="SmallInput"  value="'+data[0].brooder_id+ '"></td>';
            //}
           $('#induction').html(ind);

          /*  var a_html = '<th scope="row">Note Down Time</th>';
            for (let index = 0; index < data.length; index++) {
                a_html +='<td><input type="text" name="notetime'+index+'" class="SmallInput"  value="'+data[index].note_time+ '"></td>';
            }
           $('#notetime').html(a_html);*/

           var id_html = '<th scope="row">id</th>';
           for (let index = 0; index < data.length; index++) {
               id_html +='<td><input type="text" name="id'+index+'" class="SmallInput"  value="'+data[index].id+ '"></td>';
           }
          $('#id').html(id_html);


           var b_html = '<th scope="row">Temperature</th>';
           for (let index = 0; index < data.length; index++) {
            b_html +='<td><input type="text"class="SmallInput" name="temp'+index+'" value="'+data[index].temperature+ '"></td>';
           }
           $('#temperature').html(b_html);
          
           var c_html = '<th scope="row">Relative Humidity</th>';
           for (let index = 0; index < data.length; index++) {
            c_html +='<td><input type="text" class="SmallInput" name="hum'+index+'"value="'+data[index].relative_humidity+ '"></td>';
               //c_html +='<td>'+data[index].relative_humidity+ '</td>';
           }
           $('#rel_hum').html(c_html);

           var d_html = '<th scope="row">Rotation</th>';
           for (let index = 0; index < data.length; index++) {
            d_html +='<td><input type="text"class="SmallInput" name="rotation'+index+'" value="'+data[index].rotation+ '"></td>';
               //d_html +='<td>'+data[index].rotation+ '</td>';
           }
           $('#rotation').html(d_html);

           var e_html = '<th scope="row">Egg No</th>';
           for (let index = 0; index < data.length; index++) {
            e_html +='<td><input type="text" class="SmallInput" name="eggno'+index+'" value="'+data[index].egg_no+ '"></td>';
              // e_html +='<td>'+data[index].egg_no+ '</td>';
           }
           $('#egg_no').html(e_html);

        
           show_users();
          // var f_html = '<th scope="row">Sign</th>';
           
        // for (let index = 0; index < data.length; index++) {
          // f_html += '';
           // show_users(data[index].sign);
             // f_html += "<option value=" + data[index].sign + ">" + data[index].sign + "</option>";
           //  f_html += '</select></td>';
              // f_html +='<td>'+data[index].sign+ '</td>';
         //  }
          
          // $('#sign').html(f_html);
           // $('#notetime6').val(a_html);
            //$('#user12p').html(a_html);
            //$('#user2p').html(a_html);
            //$('#user4p').html(a_html);
           // $('#user6p').html(a_html);
            //$('#user8p').html(a_html);
            //$('#user10p').html(a_html);
                
        }
                

        
    }); 
//}// end else
        
} 
//});
function show_users(){
    
    $.ajax({
        url: BASE_URL + 'Incubtemperature/get_users',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var s_html = '<option value="">Select User</option>';
            for (let index = 0; index < data.length; index++) {
              // s_html += '<td><select name="user'+index+'" id="user6" class="select2">';
                
                    s_html += "<option value=" + data[index].auto_id + ">" + data[index].user_name + "</option>";
                 //  s_html += '</select></td>';
                
                   // 
            }
            $('#user0').html(s_html);
            $('#user1').html(s_html);
            $('#user2').html(s_html);
            $('#user3').html(s_html);
            $('#user4').html(s_html);
            $('#user5').html(s_html);
            $('#user6').html(s_html);
            $('#user7').html(s_html);
            $('#user8').html(s_html);
            //$('#user').select2().select2('val',selected_val);

           

        }

    });
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

function get_handfeedtemp_list(date,broo){
    //$('#hide_pdate').hide();
    var ct = $('#handfeedtemp_tb').DataTable({
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
            'url': BASE_URL + 'Handfeeding/get_handfeedtemp_list',
            'data': function(data) {
                data.date = date,
                data.broo = broo;
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
            { "data": "brooder_id" },
            { "data": "time" },
            { "data": "temperature" },
            { "data": "relative_humidity" },
           // { "data": "rotation" },
            { "data": "egg_no" },
            { "data": "sign" },   
  // { "data": "action" },        
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#handfeedtemp_tb tbody').on('click', 'td.details-control', function() {
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