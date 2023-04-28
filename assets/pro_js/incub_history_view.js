// for export all data
$(document).ready(function() {
    
    get_incubation_list();
	get_brooder();
  //  get_incubationprint_list();
     
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
        '<td class="hide_t table-info">DIS Weight</td>' +
        '<td data-label="DIS Date">' + d.dis_weight + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Egg Length</td>' +
        '<td data-label="DIS Date">' + d.egg_length + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Egg Breadth</td>' +
        '<td data-label="DIS Date">' + d.egg_breadth + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Egg index</td>' +
        '<td data-label="DIS Date">' + d.egg_index + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Shell layer</td>' +
        '<td data-label="DIS Date">' + d.shell_layer + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Hatch Time</td>' +
        '<td data-label="DIS Date">' + d.hatch_time + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Moved_time</td>' +
        '<td data-label="DIS Date">' + d.moved_time + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Lay to Pip hatch weight</td>' +
        '<td data-label="DIS Date">' + d.lay_pip_weight + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">BOS date</td>' +
        '<td data-label="DIS Date">' + d.bos_date + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">BOS FIndings</td>' +
        '<td data-label="DIS Date">' + d.bos_findings + '</td>' +
        '</tr>' +
		'<tr>' +
        '<td class="hide_t table-info">Incubator</td>' +
        '<td data-label="DIS Date">' + d.incubator + '</td>' +
        '</tr>' +
		'<td class="hide_t table-info">Clutch No</td>' +
        '<td data-label="DIS Date">' + d.clutch_no + '</td>' +
        '</tr>' +
		'<td class="hide_t table-info">Egg No In clutch</td>' +
        '<td data-label="DIS Date">' + d.egg_no_clutch + '</td>' +
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
	var segment_array = segment_str.split( '/' );
	console.log(segment_array);
var from_date = segment_array[5];
var to_date = segment_array[6];
var type = segment_array[7];
// if(type == "all"){
// 	$(".page_name").text("Total Eggs");
// }
    var ct = $('#incub_his').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        'lengthChange': true,
		'dom': 'lBfrtip',
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
       
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            { 'visible': false, 'targets': [12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,35] },
        ],
        'ajax': {
            'url': BASE_URL + 'Incubation/incubation_history_view_gt',
            'data': function(data) {
                data.from_date =from_date;
				data.to_date =to_date;
				data.type =type;

            }
        },
        createdRow: function( row, data, dataIndex ) {
			



             $( row ).find('td:eq(1)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Ring No');
             $( row ).find('td:eq(2)').attr('data-label', 'Group');
             $( row ).find('td:eq(3)').attr('data-label', 'Bird Species');
             $( row ).find('td:eq(4)').attr('data-label', 'Aviary');
             $( row ).find('td:eq(5)').attr('data-label', 'Cage');
            $( row ).find('td:eq(6)').attr('data-label', 'Male Parent Ring No');
            $( row ).find('td:eq(7)').attr('data-label', 'Female Parent Ring No');
             $( row ).find('td:eq(8)').attr('data-label', 'Egg no');
			// $( row ).find('td:eq(9)').attr('data-label', 'Standard egg weight');
			 $( row ).find('td:eq(10)').attr('data-label', 'Egg Weight');
			// $( row ).find('td:eq(11)').attr('data-label', 'Standard hatch weight');
			// $( row ).find('td:eq(12)').attr('data-label', 'Hatch Weight');
			
			 $( row ).find('td:eq(12)').attr('data-label', 'Fertile Type');
			 $( row ).find('td:eq(13)').attr('data-label', 'DOF');
			 $( row ).find('td:eq(14)').attr('data-label', 'Remark');
			 $( row ).find('td:eq(15)').attr('data-label', 'PIP Weight');
			 $( row ).find('td:eq(16)').attr('data-label', 'PIP Date');
			 $( row ).find('td:eq(17)').attr('data-label', 'Doi');
			 $( row ).find('td:eq(18)').attr('data-label', 'Hatch Date');
			 $( row ).find('td:eq(19)').attr('data-label', 'Shell Weight');
			 $( row ).find('td:eq(20)').attr('data-label', 'Hatch Type');
			 $( row ).find('td:eq(21)').attr('data-label', 'Shell Thick');
			 $( row ).find('td:eq(22)').attr('data-label', 'DIS Type');
			 $( row ).find('td:eq(23)').attr('data-label', 'DIS Date');
			 $( row ).find('td:eq(24)').attr('data-label', 'Egg Length');
			 $( row ).find('td:eq(25)').attr('data-label', 'Egg Breadth');
			 $( row ).find('td:eq(26)').attr('data-label', 'Egg index');
			 $( row ).find('td:eq(27)').attr('data-label', 'Shell layer');
			 $( row ).find('td:eq(28)').attr('data-label', 'Hatch Time');
			 $( row ).find('td:eq(29)').attr('data-label', 'Moved_time');
			 $( row ).find('td:eq(30)').attr('data-label', 'Bos Date');
			 $( row ).find('td:eq(31)').attr('data-label', 'Lay to pip hatch weight');
			 $( row ).find('td:eq(32)').attr('data-label', 'Health status');
			
			 $( row ).find('td:eq(35)').attr('data-label', 'Clutch no');
			 $( row ).find('td:eq(36)').attr('data-label', 'Egg no in clutch');
			 $( row ).find('td:eq(33)').attr('data-label', 'Action');
             $( row ).find('td:eq(34)').attr('data-label', 'weight loss history');
			 $( row ).find('td:eq(37)').attr('data-label', 'Bos Findings');
			
			
			
			
			 
			
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
			//{ "data": "std_egg_weight" },
			{ "data":"egg_weight"},
			//{ "data": "std_hatch_weight" },
		//	{ "data":"hatch_weight"},
			{ "data":"fertile_type" },
			{ "data":"dof"},
			{ "data":"remark"},
			{ "data":"pip_weight" },
			{ "data":"pip_date" },
			{ "data": "doi" },

			
			{ "data":"hatch_date" },
			{ "data":"shell_weight" },
			{ "data":"hatch_type"}, 
			{ "data":"shell_thick"},
			{ "data":"dis_type" },
			{ "data":"dis_date"},
			{ "data":"egg_length"}, 
			{ "data":"egg_breadth"},
			{ "data":"egg_index"},
			{ "data":"shell_layer" },
			{ "data":"hatch_time"}, 
			{ "data":"moved_time"},
			{ "data":"bos_date" },
			{ "data": "lay_pip_weight" },
            { "data": "stunt_status" },
        
			{ "data": "clutch_no" },
			{ "data": "egg_no_clutch" },
			  { "data": "action" },
           { "data": "weight_loss" },
		   { "data": "bos_findings" },
		
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#incub_his tbody').on('click', 'td.details-control', function() {
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


function change_health_status(incub_row_id){
	var data = incub_row_id;
	var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
	$("#health_id").html(get_html);
	$('#health-modal').modal('show');  

}
$('#health_form').submit(function(e) {
    e.preventDefault();
     
    // var p_date = $('#pre_weaning_date').val();
     var formData = new FormData(this);
    
     $.ajax({  
         url:BASE_URL + 'Incubation/change_health_status', 
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
                         window.location =window.location.pathname;
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
 function get_brooder(){
    //  alert("test");
      $.ajax({
          url: BASE_URL + 'Incubtemperature/get_brooder',
          method: "POST",
          dataType: "JSON",
          success: function(data) {
              var g_html = '<option value="">Select Brooder</option>';
              for (let index = 0; index < data.length; index++) {
                // if(data[index].brooder_name == "Brooder 36"){
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
                  g_html += "<option value=" + data[index].auto_id + ">" + data[index].brooder_name + "</option>";
              }
              $('#brooder_select').html(g_html);
  
          }
  
      });
  }
function get_move_pop(incub_row_id){
    //alert(incub_row_id);
   // $('#con-close-modal').show();
   var data = incub_row_id;
  // $('#con-close-modal').data('incubid', data).dialog('open');
   var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
   $("#getid").html(get_html);
   $('#con-close-modal').modal('show')
   
         
           /*  $.ajax({
                 url: BASE_URL + 'Incubation/move_incubation',
                 method: "POST",
                 data:{"incub_row_id":incub_row_id,},
                 dataType: "JSON",
                 success: function(data) {
                     
                   var id ='<input type="text" name="incubation" class="SmallInput"  value="'+data+'">';
                   $('#incubid').html(id);
                   setTimeout(
                    function() {
                        window.location = BASE_URL +data.url;
                    }, 
                2000);
                    
                 }
         
             });*/
     
         
        
    
 }
 function get_history_pop(incub_row_id){
    //alert(incub_row_id);
   // $('#con-close-modal').show();
   var data = incub_row_id;
  // $('#con-close-modal').data('incubid', data).dialog('open');
  // var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
  // $("#weightloss_id").html(get_html);
   $('#weightloss-modal').modal('show');
  incub_history_pop(incub_row_id);
   
         
             $.ajax({
                 url: BASE_URL + 'Incubation/getincubedit_details_wl',
                 method: "POST",
                 data: {
                    "current_incubid": incub_row_id,
                },
                 dataType: "JSON",
                 success: function(data) {
                     
                   // var gm = '<th scope="row">Group Name</th>'; 
                    // for (let index = 0; index < data.length; index++) {
                     gm =data[0].group_name;
                    $('#group_name').html(gm);

                    bs =data[0].bird_species;
                    $('#species').html(bs);

                    av =data[0].aviary_name;
                    $('#avairy').html(av);

                    cg =data[0].cage;
                    $('#cage').html(cg);

                    en =data[0].egg_no;
                    $('#eggno').html(en);

                    ew =data[0].egg_weight;
                    $('#eggno').html(ew);

                    dt =data[0].doi;
                    $('#date_incubation').html(dt);

                    pt =data[0].pip_date;
                    $('#pip_date').html(pt);

                    ht =data[0].hatch_date;
                    $('#hatch_date').html(ht);

                    hw =data[0].hatch_weight;
                    $('#hatch_weight').html(hw);



                    
                    
                 }
         
             });
     
         
        
    
 }



 function incub_history_pop(incub_row_id){
    //alert(incub_row_id);
   // $('#con-close-modal').show();
  // var data = incub_row_id;
  // $('#con-close-modal').data('incubid', data).dialog('open');
  // var get_html = '<input type="hidden" name="incub_id" class="SmallInput"  value="'+data+'">';
  // $("#weightloss_id").html(get_html);
  // $('#weightloss-modal').modal('show');
   
         
             $.ajax({
                 url: BASE_URL + 'Incubation/getincub_wl_details',
                 method: "POST",
                 data: {
                    "current_incubid": incub_row_id,
                },
                 dataType: "JSON",
                 success: function(data) {
                     
                    if (data.length != 0) {

                        var id_html = '';
                        // alert(data.length);
                        for (let index = 0; index < data.length; index++) {
        
                            var dateAr = data[index].idate.split('-');
                            var put_newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
        
                            id_html += '<tr>';
                            id_html += '<td><input type="checkbox" disabled="disabled"></td>';
                            id_html += '<td>' + put_newDate + '</td>';
                            id_html += '<td>' + data[index].weight_14 + '</td>';
                            id_html += '<td>' + data[index].weight_16 + '</td>';
                            id_html += '<td>' + data[index].actual_weight + '</td>';
                            id_html += '<td>' + data[index].heart_beat + '</td>';
                            id_html += '<td>' + data[index].incubation_name + '</td>';
                            id_html += '<td>' + data[index].humidity + '</td>';
                            id_html += '<td>' + data[index].aircell_density + '</td>';
                            id_html += '<td>' + data[index].user_name + '</td>';
                            id_html += '</tr>';
                        }

                        $('#incub_history_tbody').html(id_html);

                    
                    
                 }
                }
         
             });
     
             
    
 }


 function get_incubationprint_list(){
    var ct = $('#incub_printtb').DataTable({
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
                "className": 'tb_visible',
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
            'url': BASE_URL + 'Incubation/get_incubation_list',
            'data': function(data) {
               // d.hepl_recruitment_ref_number =hepl_recruitment_ref_number;

            }
        },
        createdRow: function( row, data, dataIndex ) {
            //$('#incub_printtb').hide();
            $('#incub_printtb_filter').css('display', 'none');
            $('#incub_printtb_info').css('display', 'none');
            $('#incub_printtb_paginate').css('display', 'none');
            $('#incub_tb_wrapper .btn-group').css('display', 'none');
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
			// $( row ).find('td:eq(37)').attr('data-label', 'Bos Findings');
            // $( row ).find('td:eq(11)').attr('data-label', 'Action');
            
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
            { "data": "group_name" },
            { "data": "bird_species" },
            { "data": "aviary_name" },
            { "data": "cage" },
            { "data": "male_parent_ringno" },
            { "data": "female_parent_ringno" },
            { "data": "egg_no" },
            { "data": "doi" },
            { "data": "stunt_status" },
		
            { "data": "egg_weight" },
            { "data": "fertile_type" },
            { "data": "dof" },
            { "data": "remark" },
            { "data": "pip_weight" },
            { "data": "pip_date" },
            { "data": "hatch_weight" },
            { "data": "hatch_date" },
            { "data": "shell_weight" },
            { "data": "hatch_type" },
            { "data": "shell_thick" },
            { "data": "dis_type" },
            { "data": "dis_date" },
		
			
         
            
        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
  
}

// $('.btn-group .btn+.btn').on('click', function() {
//     alert("test");

// });
$('#move_form').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/move_handfeeding', 
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
                    'Successfully Moved to Handfeeding..!',
                    ''
                );		
                setTimeout(
                    function() {
                        window.location = window.location.pathname;
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
