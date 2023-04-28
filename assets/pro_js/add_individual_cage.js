$(document).ready(function () {
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
//alert("test");
    $.ajax({
        url: BASE_URL + 'Bird/get_cage_birdcount',
        method: "POST",
        data:{"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var td_html = '';
            for (let index = 0; index < data.cage_result.length; index++) {
                td_html += '<tr>';
				td_html += '<td>'+ (index+1) +'</td>';
				td_html += '<td><input type="text" class="form-control cage" name="cage[]" value="'+data.cage_result[index].cage+'" readonly/></td>';
				td_html +=  '<td><input type="text" class="form-control bird_count"  name="bird_count[]" value="'+data.count[index]+'" readonly/></td>';
			//	td_html +=  '<td><input type="text" class="form-control bird_count"  name="bird_species[]" value="'+data.bird_result+'" readonly/></td>';
				td_html += '<td><input type="text" class="form-control mrng_feed"  name="mrng_feed[]" value="'+data.cage_result[index].target_mrg_feed+'" readonly/></td>';
				total_target_mrg_feed = (data.cage_result[index].target_mrg_feed) * (data.count[index]);
				td_html += '<td><input type="text" class="form-control total_mrng_feed" name="total_mrng_feed[]" value="'+total_target_mrg_feed+'" readonly/></td>';
				td_html += '<td><input type="text" class="form-control aft_feed"   name="aft_feed[]" value="'+data.cage_result[index].target_aft_feed+'" readonly/></td>';
				total_target_aft_feed = (data.cage_result[index].target_aft_feed) * (data.count[index]);
				td_html += '<td><input type="text" class="form-control total_aft_feed"   name="total_aft_feed[]" value="'+total_target_aft_feed+'" readonly/></td>';
				target_feedg = parseFloat(total_target_mrg_feed) +  parseFloat(total_target_aft_feed);
				td_html += '<td><input type="text" class="form-control target_feedg" name="target_feedg[]" value="'+target_feedg+'" readonly/></td>';
				td_html += '<td><input type="text" class="form-control mrg_wastage"  name="mrg_wastage[]" value="" /></td>';
				td_html += '<td><input type="text" class="form-control aft_wastage" name="aft_wastage[]" value=""/></td>';
				td_html += '<td><input type="text" class="form-control total_intake" name="total_intake[]" value="" readonly/></td>';
				td_html += '<td><input type="text" class="form-control to_achieved" name="to_be_achieved[]" value="" readonly/></td>';
				td_html += '<td><input type="text" class="form-control achieved" name="achieved[]" value="" readonly/></td>';

				td_html += '</tr>';
			}
            $('#cage_body').html(td_html);
                
        }
                
    });
});

$("#cage").on('change', function() {
    
    var aviary_id = $('#aviary_id').val();
    var cage = $('#cage').val();
   get_bird_count(aviary_id,cage);
    $.ajax({
        url: BASE_URL + 'Breeding/get_birdmanage_species',
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
function  get_bird_count(aviary_id,cage){
	//alert(cage);
	$.ajax({
        url: BASE_URL + 'Breeding/get_birdmanage_species_count',
        method: "POST",
        data:{"aviary_id":aviary_id,"cage_id":cage,},
        dataType: "JSON",
        success: function(data) {
			var td ='<td><input type="text" class="form-control" value="'+data[0].count_bird+'" readonly/></td>';
            $('.bird_counts').html(td);
		   console.log(data[0].count_bird);
		//return data[0].count_bird;
        }

    });
}
$("#bird_species").on('change', function() {
    
    //var aviary_id = $('#aviary_id').val();
    var bird_species = $('#bird_species').val();
    //alert(bird_species);
    $.ajax({
        url: BASE_URL + 'Bird/get_birdfeed_fm',
        method: "POST",
        data:{"species_id":bird_species},
        dataType: "JSON",
        success: function(data) {
            $('#mrng_feed').val(data[0].target_mrg_feed);
            $('#aft_feed').val(data[0].target_aft_feed);
            get_feed_formula();
        }

    });

});
function get_feed_formula(){//calculate total feed
    var mrng_feed = $('#mrng_feed').val();
    var aft_feed = $('#aft_feed').val();
   var brid_count =  $('#bird_count').val();

   var total_mrng_feed = mrng_feed * brid_count;
   var total_aft_feed = aft_feed * brid_count;
   $('#total_mrng_feed').val(total_mrng_feed);
   $('#total_aft_feed').val(total_aft_feed);
   var target_feedg = total_mrng_feed + total_aft_feed;
   $('#target_feedg').val(target_feedg);


}
jQuery(document ).on( "keyup", ".aft_wastage", function(){
	
	var mrg_wastage = $(this).closest('tr').find('.mrg_wastage').val();  
	var aft_wastage = $(this).val();
	var total_mrng_feed = $(this).closest('tr').find('.total_mrng_feed').val();  
	var total_aft_feed = $(this).closest('tr').find('.total_aft_feed').val();
	var total_feedg = $(this).closest('tr').find('.target_feedg').val();
	var total_intake = (total_mrng_feed - mrg_wastage)+(total_aft_feed - aft_wastage);
	//var to_be_achieved = parseFloat(mrg_wastage) + parseFloat(aft_wastage);
	var total_wastage = parseFloat(mrg_wastage) + parseFloat(aft_wastage);
	$(this).closest('td').next('td').find('.total_intake').val(total_intake);
	if(total_feedg > 0){
		//var achieved = (total_intake/total_feedg)*100;
		var to_achieved = (total_feedg/10);
	}
	else{
		var to_achieved = 0;
	}
	$(this).closest('tr').find('.to_achieved').val(to_achieved);  
	$(this).closest('tr').find('.achieved').val(total_wastage);  
	//alert(total_wastage);
	if(total_wastage > to_achieved){
		$(this).closest('tr').find('.achieved').css({"background": "red"});  
	}
	// if(achieved > 70 && achieved < 80 ){
	// 	$(this).closest('tr').find('.achieved').css({"background": "yellow"});  
	// }
	if(total_wastage < to_achieved){
		$(this).closest('tr').find('.achieved').css({"background": "green"});  
	}
	console.log(mrg_wastage);
	console.log(aft_wastage);
	console.log(total_mrng_feed);
	console.log(total_aft_feed);
	console.log(total_feedg);
	console.log(total_intake);
	
});
$("#aft_wastage").keyup(function(){  
    var aft_wastage = $('#aft_wastage').val();
    var mrg_wastage = $('#mrg_wastage').val();
    var total_mrng_feed =  $('#total_mrng_feed').val();
    var total_aft_feed =  $('#total_aft_feed').val();
    var total_feedg =  $('#target_feedg').val();
    var total_intake = (total_mrng_feed - mrg_wastage)+(total_aft_feed - aft_wastage);
    $('#total_intake').val(total_intake);
    var achieved = (total_intake/total_feedg)*100;
    achieved = achieved.toFixed(2);
    $('#achieved').val(achieved+'%');
if(achieved < 70){
    $("#achieved").css("background", "red");  
}
if(achieved > 70 && achieved < 80 ){
    $("#achieved").css("background", "yellow");  
}
if(achieved > 80){
    $("#achieved").css("background", "green");  
}

});
$('#cage_track').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
	$('#btnSubmit').prop("disabled",true);
    $('#btnSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');
    $.ajax({  
        url:BASE_URL + 'Feedmaintenance/add_cageTrack', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {
			$('#btnSubmit').prop("disabled",false);
			$('#btnSubmit').html('Submit');

            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Added Successfully..!',
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
