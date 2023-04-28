var incubation_list = '';

$(document).ready(function () {
//	get_users_list();
//	get_incubation_list();
	getincubedit_details();
	


	$("#actn_feed").keyup(function(){  //showing feed volume
	   var get_feed = $("#actn_feed").val();
	   //alert(get_feed);
	   var feed_html="";
	   for (let index = 1; index <=get_feed; index ++) {
		feed_html +=' <div class="col-md-4">';
		feed_html +=' <div class="form-group">';
		//var index_value = index+1;
		feed_html +='<label for="feed"> Feed no '+index+'</label>';
		feed_html +='<input type="text"name="feed'+index+'"  placeholder="Feed'+index+'" class="SmallInput form-control"  value=" " required/>';
		feed_html +=' </div>';
		feed_html +=' </div>';
	}
   $('#feed_id').html(feed_html);
   targetVol_day();
   	
	  });

	  $("#actual_weight").keyup(function(){  //showing status
		var actual_weight = $("#actual_weight").val();
		var std_weight = $("#std_weight").val();
		var prev_act_weight = $("#prev_actual_weight").val();
		var status = actual_weight - std_weight;
		$('#status').val(status);
		 var target_volfeed = actual_weight/10; //showing target volume //j3
		 target_volfeed = target_volfeed.toFixed(2);
		 $('#target_vol').val(target_volfeed); 
	    var weight_gain = actual_weight - prev_act_weight;
		$('#weight_gain').val(weight_gain); 


		
 
	   });
	   $("#volume").keyup(function(){  //showing target feed per given day
		var target_vol =$('#target_vol').val(); 
		var ratio =$('#ratio').val(); 
		var ratioAr = ratio.split(':');
		var ratio1 = ratioAr[0];
		var ratio2 = ratioAr[1];
		var ratio3 = parseInt(ratio1, 10) + parseInt(ratio2, 10);

		//let ratior = $.add(ratio1,ratio2);
		if(target_vol !=='' && ratio !== '' ){
			var targetfeed_gday= target_vol/ratio3;
			targetfeed_gday = targetfeed_gday.toFixed(2);;
				$("#targetfeed_gday").val(targetfeed_gday);
		}
		//alert( ratio3);
	
 
	   });

	   $("#actualFeed_vday").keyup(function(){  //showing actual feed per given day
		var actual_vol =$('#actualFeed_vday').val(); 
		var ratio =$('#ratio').val(); 
		var ratioAr = ratio.split(':');
		var ratio1 = ratioAr[0];
		var ratio2 = ratioAr[1];
		var ratio3 = parseInt(ratio1, 10) + parseInt(ratio2, 10);
		if(actual_vol !=='' && ratio !== '' ){
			var actualfeed_gday= actual_vol/ratio3;
			actualfeed_gday = actualfeed_gday.toFixed(2);
				$("#actualFeed_gday").val(actualfeed_gday);
		}
		achieved();
 
	   });





});

function targetVol_day(){
   var target_vol =$('#target_vol').val(); 
    var total_feed =$('#target_no_feed').val(); 	
		
    if(target_vol !=='' && total_feed !== '' ){
     var targetVol_day= target_vol*total_feed;
	 targetVol_day = targetVol_day.toFixed(2);
         $("#tv_day").val(targetVol_day);

     }
	
		
	 
}
function achieved(){
	var actualFeed_gday =$('#actualFeed_gday').val(); 
	 var targetfeed_gday =$('#targetfeed_gday').val(); 	
	 var standard_weight =$('#std_weight').val(); 	
	 var actual_weight =$('#actual_weight').val(); 	 
	 if(actualFeed_gday !=='' && targetfeed_gday !== '' ){
	  var achieved= actualFeed_gday/targetfeed_gday;
	  achieved = achieved.toFixed(2);
		  $("#achieved").val(achieved);
		  if(actual_weight < standard_weight ){
			$("#achieved").css("background", "red");  
		  }
		  if(actual_weight >= standard_weight ){
		  $("#achieved").css("background", "green");
		  }
 
	  }
	 
		 
	  
 }

function get_brooder(current_broo_id,species_id){
	/*var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_incubid = last_segment;*/

	  $.ajax({
		  url: BASE_URL + 'Incubtemperature/get_selectedbrooder',
		  method: "POST",
		  data: {
			"current_broo_id": current_broo_id,
		},
		  dataType: "JSON",
		  success: function(data) {
			var status = data[0].status;
			var moved_date = data[0].move_handfeed_date;
			var dateAr = moved_date.split('-');
			var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
			var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
			var output = d.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
			daysdifference(newDate,output,species_id)
			//alert(moved_date);
			if(status == 0){
			get_brooder_details(data[0].move_handfeed_brooder)
			//$('#brooder_name').val('Brooder 36'); 
			//$('#target_no_feed').val('16');
		
			}
			if(status == 3){
				get_brooder_details(data[0].move_35_brooder)
				//$('#brooder_name').val('Brooder 35'); 
			//$('#target_no_feed').val('16');
			  }
			  if(status == 2){
				get_brooder_details(data[0].move_34_brooder)
			//$('#brooder_name').val('Brooder 34'); 
			//$('#target_no_feed').val('8');
			  }
			  if(status == 1){
				get_brooder_details(data[0].move_33_brooder)
				//$('#brooder_name').val('Brooder 33'); 
			//$('#target_no_feed').val('8');
			  }
			 // $('#target_no_feed').val(data[0].target_feed);
			//  $('#target_no_feed').val();
  
		  }
  
	  });
  }

  function get_brooder_details(bro_id){
	 
	$.ajax({
		url: BASE_URL + 'Incubtemperature/get_brooder_name',
		method: "POST",
		data: {
		  "current_broo_id": bro_id,
	  },
	  dataType: "JSON",
	  success: function(data) {
		//alert((data[0].brooder_name));
		$('#brooder_name').val(data[0].brooder_name); 
		$('#target_no_feed').val(data[0].target_feed);

	  }

	});

  }
function getincubedit_details() {

	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_incubid = last_segment;
	get_weightgain(current_incubid);

	$.ajax({
		url: BASE_URL + 'Incubation/getincubedit_details_wl',
		method: "POST",
		data: {
			"current_incubid": current_incubid,
		},
		dataType: "JSON",
		success: function (data) {

			if (data.length != 0) {
				$('#incubation_id').val(current_incubid);
				$('#egg_no').val(data[0].egg_no);
				//$('#group_name').val(data[0].group_name);
				$('#species_name').val(data[0].bird_species);
			//	$('#target_no_feed').val(data[0].target_feed);
				//$('#brooder_name').val(data[0].brooder);
				$('#weight_of_egg').val(data[0].egg_weight);
				$('#date_of_incub').val(data[0].doi);
				$('#pip_date').val(data[0].pip_date);
				$('#hatch_date').val(data[0].hatch_date);
				$('#hatch_weight').val(data[0].hatch_weight);
			//	var brooder_id = data[0].brooder;
		    	var species_id = data[0].species_id;
				get_brooder(current_incubid,species_id);
			

			}
		}

	});
}

function daysdifference(firstDate, secondDate, getid){  
	//var from = $(firstDate).replace(/\//g, '-');
	//alert(getid);
    var startDay = new Date(firstDate);  
    var endDay = new Date(secondDate);  
  
// Determine the time difference between two dates     
    var millisBetween = startDay.getTime() - endDay.getTime();  
  
// Determine the number of days between two dates  
    var days = millisBetween / (1000 * 3600 * 24);  
  
// Show the final number of days between dates     
    var age =  Math.round(Math.abs(days));// for pre_weaning age
	$('#age').val(age);
//	$('#age').val('4');
	get_weight(age,getid)
	
}  

function get_weight(age,getid){
	//alert(getid);
	$.ajax({
		url: BASE_URL + 'Handfeeding/get_speciesWeight',
		method: "POST",
		data: {
			"current_id": getid,
			"current_age": age
		},
		dataType: "JSON",
		success: function (data) {
		//	if(data[0].std_weight != ""){
			$('#std_weight').val(data[0].std_weight);
		//	}

		}
	});


}

function get_weightgain(getid){
	//alert(getid);
	$.ajax({
		url: BASE_URL + 'Weaning/get_weaning_weight',
		method: "POST",
		data: {
		   "current_incubid": getid,
	   },
		dataType: "JSON",
		success: function(data) {
		
			for(var i=0; i <= data.length; i++){
				
				if(i == data.length-1){
					
				var prev_actWeight = data[i].act_weight;
				//var prev_actWeight = i;
				$('#prev_actual_weight').val(prev_actWeight);
				}
			}
			

		}
	});


}



$('#weaning_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Weaning/addWeaning', 
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
                    'Added Successfully..!',
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