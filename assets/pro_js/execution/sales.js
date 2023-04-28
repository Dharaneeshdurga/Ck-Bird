$(document).ready(function () {
    get_total_eggs();
    get_total_chicks();
    get_total_production();
    get_total_sales();
    get_total_purchase();
    $('#hideshow_chick').hide();
    $('#hideshow_eggs').hide();
    $('#hs_pro').hide();
    $('#hs_sales').hide();
    $('#hs_purchase').hide();
   // get_datatable();
   var count = 0;
});
function get_sale() {
  var m= $('#sp_month').val();
  var y= $('#sp_year').val();
//alert(y);
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Execution/get_sales_history', 
        method:"POST",  
        data: {'m':m,'y':y},
        dataType:"json",
    
        success:function(data) {
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    ' Successfully Saved..!',
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
function get_total_eggs() {
    $.ajax({
        url: BASE_URL + 'Execution/get_total_eggs',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            $('#total_eggs').text(data.length);

            // var id_html = "";
            // for (let index = 0; index < data.length; index++) {
            //     var sno = index + 1;
            //     id_html += '<tr>';
            //     id_html += '<td>' + sno + '</td>';
            //     id_html += '<td>' + data[index].bird_species + '</td>';
            //     id_html += '<td>' + data[index].egg_no + '</td>';
            //     id_html += '</tr>';
            // }

            // $('#egg_full_details').html(id_html);


        }

    });
}
function get_total_chicks() {
    $.ajax({
        url: BASE_URL + 'Execution/get_total_chicks',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            $('#total_chicks').text(data.length);

            // var id_html = "";
            // for (let index = 0; index < data.length; index++) {
            //     var sno = index + 1;
            //     id_html += '<tr>';
            //     id_html += '<td>' + sno + '</td>';
            //     id_html += '<td>' + data[index].bird_species + '</td>';
            //     id_html += '<td>' + data[index].egg_no + '</td>';
            //     id_html += '</tr>';
            // }

          //  $('#chick_full_details').html(id_html);


        }

    });
}

function get_total_production() {
    $.ajax({
        url: BASE_URL + 'Execution/get_total_production',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            $('#production').text(data.length);

            // var id_html = "";
            // for (let index = 0; index < data.length; index++) {
            //     var sno = index + 1;
            //     id_html += '<tr>';
            //     id_html += '<td>' + sno + '</td>';
            //     id_html += '<td>' + data[index].bird_species + '</td>';
            //     id_html += '<td>' + data[index].ring_no + '</td>';
            //     id_html += '<td>' + data[index].cage_id + '</td>';
            //     id_html += '<td>' + data[index].aviary_name + '</td>';
            //     id_html += '</tr>';
            // }

            // $('#production_full_details').html(id_html);


        }

    });
}
function get_total_sales() {
    $.ajax({
        url: BASE_URL + 'Execution/get_total_sales',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            $('#total_sales').text(data.length);

            var id_html = "";
            for (let index = 0; index < data.length; index++) {
                var sno = index + 1;
                id_html += '<tr>';
                id_html += '<td>' + sno + '</td>';
                id_html += '<td>' + data[index].bird_species + '</td>';
                id_html += '<td>' + data[index].ring_no + '</td>';
                id_html += '<td>' + data[index].cage_id + '</td>';
                id_html += '<td>' + data[index].aviary_name + '</td>';

               var img_name = data[index].bird_image;
               var video_name = data[index].bird_video;
                id_html += '<td> <button onclick="get_bird_images('+"'"+img_name+"'"+')"><img class="pop" src="' + IMG_URL + 'images/' + data[index].bird_image + '" style="width: 50px; height: 50px;"> </button></td>';
                id_html += '<td><button onclick="show_bird_video('+"'"+video_name+"'"+')">Play Video</button></td>';
               // id_html += '<td><a href="' + BASE_URL + 'Execution/sales_update/' +data[index].ring_no + '">Add</a></td>';
                id_html += '<td><form method="post" action="' + BASE_URL + 'Execution/sales_update/"><input type="hidden" name="sp_name" value="' + data[index].bird_species + '"><input type="hidden" name="sp_ring" value="' + data[index].ring_no + '"><button type="submit" value="Add">Add</button></form></td>';

                id_html += '</tr>';
            }

           // $('#sales_full_details').html(id_html);


        }

    });
}
function get_total_purchase() {
    $.ajax({
        url: BASE_URL + 'Execution/get_total_purchase',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            $('#total_purchase').text(data.length);

            var id_html = "";
            for (let index = 0; index < data.length; index++) {
                var sno = index + 1;
                id_html += '<tr>';
                id_html += '<td>' + sno + '</td>';
                id_html += '<td>' + data[index].bird_species + '</td>';
                id_html += '<td>' + data[index].ring_no + '</td>';
                id_html += '<td><button onclick="show_purchase_register('+"'"+data[index].ring_no+"'"+','+"'"+data[index].bird_species+"'"+')">Purchase Update</button></td>';

               // id_html += '<td>' + data[index].cage_id + '</td>';
               // id_html += '<td>' + data[index].aviary_name + '</td>';
                id_html += '</tr>';
            }

          //  $('#purchase_full_details').html(id_html);


        }

    });
}
 function show_purchase_register(ring_no,sp_name){
    $('#sp_name').val(sp_name);
    $('#ring_no').val(ring_no);
    $('#purchase-modal').modal('show');
 }
function get_bird_images(img_name) {

    var img = '<img class="pop" src="' + IMG_URL + 'images/' + img_name + '" style="width: 100%;">';
        img += '<a href="' + BASE_URL + 'Execution/image_download/' + img_name + '">Download</a>';
    $('#bird_img').html(img);
    $('#imagemodal').modal('show');
}
function show_bird_video(video_name) {

    var video = '<iframe width="100%" height="315" src="' + IMG_URL + 'video/' + video_name + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

    $('#bird_video').html(video);
    $('#videomodal').modal('show');
}		



(function () {
  var count = 0;
$("#show_eggs").on('click', function () {
    $('#hideshow_eggs').show();
    $('#hideshow_chick').hide();
    $('#hs_pro').hide();
    $('#hs_sales').hide();
    $('#hs_purchase').hide();
	count += 1;
	//alert(count);
if(count == 1){
	$('#eggs_total').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "scrollY": "800px",
        "scrollCollapse": true,
        "searching": true,
        "paging": true,
		//"autoWidth": true
    } );
}

});

})();
(function () {
	var count = 0;
$("#show_chick").on('click', function () {
    $('#hideshow_chick').show();
    $('#hideshow_eggs').hide();
    $('#hs_pro').hide();
    $('#hs_sales').hide();
    $('#hs_purchase').hide();
	count += 1;
	if(count == 1){
		$('#chicks_total').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				"scrollY": "800px",
				"scrollCollapse": true,
				"searching": true,
				"paging": true
			} );
		}
});
})();
(function () {
	var count = 0;
$("#show_production").on('click', function () {
    $('#hideshow_chick').hide();
    $('#hideshow_eggs').hide();
    $('#hs_pro').show();
    $('#hs_sales').hide();
    $('#hs_purchase').hide();
	count += 1;
	if(count == 1){
		$('#product_total').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				"scrollY": "800px",
				"scrollCollapse": true,
				"searching": true,
				"paging": true
			} );
		}

});
})();
(function () {
	var count = 0;
$("#show_sales").on('click', function () {
    $('#hideshow_chick').hide();
    $('#hideshow_eggs').hide();
    $('#hs_pro').hide();
    $('#hs_sales').show();
    $('#hs_purchase').hide();
	count += 1;
	if(count == 1){
		$('#sales_total').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				"scrollY": "800px",
				"scrollCollapse": true,
				"searching": true,
				"paging": true
			} );
		}

});
})();

(function () {
	var count = 0;
$("#show_purchase").on('click', function () {
    $('#hideshow_chick').hide();
    $('#hideshow_eggs').hide();
    $('#hs_pro').hide();
    $('#hs_sales').hide();
    $('#hs_purchase').show();

});
count += 1;
if(count == 1){
	$('#purchase_total').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"scrollY": "800px",
			"scrollCollapse": true,
			"searching": true,
			"paging": true
		} );
	}
})();
$('#purchase_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Execution/add_purchase', 
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
                    ' Successfully Saved..!',
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
function get_datatable(){
    var ct = $('#sales_total').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        'lengthChange': true,
        "buttons": [
           
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
           
           
            
        ],  
        'dom': 'Bfrtip',
        "scrollY": "800px",
            "scrollCollapse": true,
            "searching": true,
            "paging": true
});
}
