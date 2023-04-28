var incubation_list = '';

$(document).ready(function () {
	get_users_list();
	get_incubation_list();
	getincubedit_details();
});

function set_incubation_list(x) {
	incubation_list = x;
}

function set_users_list(x) {
	users_list = x;
}

function get_incubation_list() {
	$.ajax({
		url: BASE_URL + 'Incubation/get_incubation_title',
		method: "POST",
		dataType: "json",
		success: function (data) {

			if (data.length != 0) {
				set_incubation_list(data);
			}

		}

	});
}

function get_users_list() {
	$.ajax({
		url: BASE_URL + 'Incubation/get_users_list',
		method: "POST",
		dataType: "json",
		success: function (data) {

			if (data.length != 0) {
				set_users_list(data);
			}

		}

	});
}

function getincubedit_details() {

	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_incubid = last_segment;


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
				$('#egg_no').text(data[0].egg_no);
				$('#group_name').text("Group Name: " + data[0].group_name);
				$('#species_name').text("Species: " + data[0].bird_species);
				$('#aviary_name').text("Aviary: " + data[0].aviary_name);
				$('#cage_name').text("Cage: " + data[0].cage);
				$('#weight_of_egg').val(data[0].egg_weight);
				$('#date_of_incub').val(data[0].doi);
				$('#pip_date').val(data[0].pip_date);
				$('#hatch_date').val(data[0].hatch_date);
				$('#hatch_weight').val(data[0].hatch_weight);
				$('#weight_loss_min').val(data[0].weight_loss_min);
				$('#weight_loss_max').val(data[0].weight_loss_max);
				$('#incub_days_max').val(data[0].incub_days_max);
				$('#incub_days_min').val(data[0].incub_days_min);
				 var weight_loss_min = data[0].weight_loss_min;
				 $('#min_percent').text(weight_loss_min + "%");
				 var weight_loss_max = data[0].weight_loss_max;
				 $('#max_percent').text(weight_loss_max  + "%");
				 var incub_days_max = data[0].incub_days_max;
				 var incub_days_min = data[0].incub_days_min;
				 var weight_loss_output_min = weight_loss_min/incub_days_min; 
				 weight_loss_output_min = weight_loss_output_min.toFixed(2)//formula
				 $('#weight_loss_per_day_min').val(weight_loss_output_min);

				 var weight_loss_output_max = weight_loss_max/incub_days_min; 
				 weight_loss_output_max = weight_loss_output_max.toFixed(2)//formula
				 $('#weight_loss_per_day_max').val(weight_loss_output_max);

// total weight to be lost
     var total_weight_loss_min = data[0].egg_weight*weight_loss_min/100;
	 total_weight_loss_min = total_weight_loss_min.toFixed(2)
	 $('#total_loss_min').val(total_weight_loss_min);

	 var total_weight_loss_max = data[0].egg_weight*weight_loss_max/100;
	 total_weight_loss_max = total_weight_loss_max.toFixed(2);
	 $('#total_loss_max').val(total_weight_loss_max);

	 var egg_weight_hatch_day = data[0].egg_weight -  total_weight_loss_min;
	 $('#hatch_weight').val(egg_weight_hatch_day); //weight on hatch day

	 var weight_tobelost_day =  total_weight_loss_min/incub_days_max;
	 weight_tobelost_day = weight_tobelost_day.toFixed(2);
	 $('#weight_tobe_lost').val(weight_tobelost_day); //weight to be lost per day




				 //get pip and hatch date
				 var doi = data[0].doi //date of incubation
				 var date = new Date(doi),
				     days = incub_days_min;
				 days = parseInt(days, 10);
			  
			     if(!isNaN(date.getTime())){
				 var output_date = date.setDate(date.getDate() + days);
				 //output_date = date.toInputFormat();
				 //alert(output_date);  
				  //$("#pip_date").val(date.toInputFormat());  // calculated pip date
			     } else {
				  alert("Invalid Date");  
			     }

				
//alert(weight_loss_output_min);


				getincubprev_details();


			}
		}

	});
}
Date.prototype.toInputFormat = function() {
	var yyyy = this.getFullYear().toString();
	var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
	var dd  = this.getDate().toString();
	//return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
	return  (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + yyyy;
 };


function getincubprev_details() {
	var segment_str = window.location.pathname;
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_incubid = last_segment;

	$.ajax({
		url: BASE_URL + 'Incubation/getincub_wl_details',
		method: "POST",
		data: {
			"current_incubid": current_incubid,
		},
		dataType: "JSON",
		success: function (data) {
			var get_doi = $('#date_of_incub').val();
            var numberOfDaysToAdd = 3;

            var incubation_list_col = '<option value="">Select Incubation</option>';
				for (let ilc = 0; ilc < incubation_list.length; ilc++) {
					incubation_list_col += '<option value="' + incubation_list[ilc].incubation_name + '">' + incubation_list[ilc].incubation_name + '</option>';
				}

				var created_by_list_col = '<option value="">Select User</option>';
				for (let clc = 0; clc < users_list.length; clc++) {
					created_by_list_col += '<option value="' + users_list[clc].user_id + '">' + users_list[clc].user_name + '</option>';
				}


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

                var get_last_idate_index = data.length - 1;
                var get_last_idate = data[get_last_idate_index].idate;
                var get_loop_count = 8 - data.length;
                
				for (let index_n = 0; index_n < get_loop_count; index_n++) {
                    
                    var someDate = new Date(get_last_idate);
                    someDate.setDate(someDate.getDate() + numberOfDaysToAdd); //number  of days to add, e.x. 15 days
                    var dateFormated = someDate.toISOString().substr(0, 10);
                    numberOfDaysToAdd = numberOfDaysToAdd + 3;

                    var dateAr = dateFormated.split('-');
                    var put_newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
                    // console.log(put_newDate);


                    var TodayDate = new Date();
                    var endDate= new Date(Date.parse(dateFormated));
                    
                    
                    if(endDate <= TodayDate){
                        id_html += '<tr>';
						id_html += '<td><input type="checkbox" name="assign_chbox[]" class="checkbox"></td>';
						id_html += '<td>' + put_newDate + '<input type="hidden" name="id_date[]" id="id_date" value=' + dateFormated + '></td>';
						id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_14[]" id="id_weight_14" class="form-control" ></td>';
						id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_16[]" id="id_weight_16" class="form-control" ></td>';
						id_html += '<td><input type="number" name="id_actual_weight[]" id="id_actual_weight" class="form-control" ></td>';
						id_html += '<td><input type="number" name="id_heart_beat[]" id="id_heart_beat" class="form-control" ></td>';
						id_html += '<td><select name="id_incubation_name[]" id="id_incubation_name" class="form-control" >' + incubation_list_col + '</select></td>';
						id_html += '<td><input type="number" name="id_humidity[]" id="id_humidity" class="form-control" ></td>';
						id_html += '<td><input type="number" name="id_aircell_density[]" id="id_aircell_density" class="form-control" ></td>';
						id_html += '<td><select name="id_checked_by[]" id="id_checked_by" class="form-control" >' + created_by_list_col + '</select></td>';
						id_html += '</tr>';
                    }
                    else {
						
						id_html += '<tr>';
						id_html += '<td><input type="checkbox" disabled="disabled"></td>';
						id_html += '<td>' + put_newDate + '</td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + incubation_list_col + '</select></td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
						id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + created_by_list_col + '</select></td>';
						id_html += '</tr>';
					}
                }
				$('#incub_details_tbody').html(id_html);

			} else {

				var id_html = '';

				for (let index = 0; index < 8; index++) {

					if (index == 0) {
						var dateFormated = get_doi;
						var dateAr = dateFormated.split('-');
						var put_newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

                        var TodayDate = new Date();
                        var endDate= new Date(Date.parse(dateFormated));
                        
                        if(endDate <= TodayDate){
                            id_html += '<tr>';
						    id_html += '<td><input type="checkbox" name="assign_chbox[]" class="checkbox"></td>';
                            id_html += '<td>' + put_newDate + '<input type="hidden" name="id_date[]" value=' + dateFormated + '></td>';
                            id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_14[]" id="id_weight_14" class="form-control" ></td>';
                            id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_16[]" id="id_weight_16" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_actual_weight[]" id="id_actual_weight" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_heart_beat[]" id="id_heart_beat" class="form-control" ></td>';
                            id_html += '<td><select name="id_incubation_name[]" id="id_incubation_name" class="form-control" >' + incubation_list_col + '</select></td>';
                            id_html += '<td><input type="number" name="id_humidity[]" id="id_humidity" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_aircell_density[]" id="id_aircell_density" class="form-control" ></td>';
                            id_html += '<td><select name="id_checked_by[]" id="id_checked_by" class="form-control" >' + created_by_list_col + '</select></td>';
                            id_html += '</tr>';

                        }else{
                            id_html += '<tr>';
						    id_html += '<td><input type="checkbox" disabled="disabled"></td>';
                            id_html += '<td>' + put_newDate + '</td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + incubation_list_col + '</select></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + created_by_list_col + '</select></td>';
                            id_html += '</tr>';
                            
                        }
						
					} else {
						var someDate = new Date(get_doi);
						someDate.setDate(someDate.getDate() + numberOfDaysToAdd); //number  of days to add, e.x. 15 days
						var dateFormated = someDate.toISOString().substr(0, 10);
						numberOfDaysToAdd = numberOfDaysToAdd + 3;

						var dateAr = dateFormated.split('-');
						var put_newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

                        var TodayDate = new Date();
                        var endDate= new Date(Date.parse(dateFormated));
                        
                        if(endDate <= TodayDate){
                            id_html += '<tr>';
						    id_html += '<td><input type="checkbox" name="assign_chbox[]" class="checkbox"></td>';
                            id_html += '<td>' + put_newDate + '<input type="hidden" name="id_date[]" id="id_date" value=' + dateFormated + '></td>';
                            id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_14[]" id="id_weight_14" class="form-control" ></td>';
                            id_html += '<td><input type="number" step="0.01" data-decimal="2" oninput="enforceNumberValidation(this)" name="id_weight_16[]" id="id_weight_16" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_actual_weight[]" id="id_actual_weight" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_heart_beat[]" id="id_heart_beat" class="form-control" ></td>';
                            id_html += '<td><select name="id_incubation_name[]" id="id_incubation_name" class="form-control" >' + incubation_list_col + '</select></td>';
                            id_html += '<td><input type="number" name="id_humidity[]" id="id_humidity" class="form-control" ></td>';
                            id_html += '<td><input type="number" name="id_aircell_density[]" id="id_aircell_density" class="form-control" ></td>';
                            id_html += '<td><select name="id_checked_by[]" id="id_checked_by" class="form-control" >' + created_by_list_col + '</select></td>';
                            id_html += '</tr>';


                        }else{
                            id_html += '<tr>';
                            id_html += '<td><input type="checkbox" disabled="disabled"></td>';
                            id_html += '<td>' + put_newDate + '</td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + incubation_list_col + '</select></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><input type="number" name="" id="" class="form-control" readonly/></td>';
                            id_html += '<td><select name="incubation_name" id="" class="form-control" disabled>' + created_by_list_col + '</select></td>';
                            id_html += '</tr>';
                            
                        }
						
					}

				}

				$('#incub_details_tbody').html(id_html);
			}
		}

	});

}


 // Select all

 $("#select_all").change(function(){  //"select all" change

    var status = this.checked; // "select all" checked status
    $('.checkbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
    // $(this).closest("tr").find('select').attr("required", true);
    $("#incub_details_tb").find('select').attr("required", true);
    $("#incub_details_tb").find('input').attr("required", true);

});


$('#incub_details_tb').on('change', 'input[type="checkbox"]', function () {
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
        $(this).closest("tr").find('select').attr("required", false);
        $(this).closest("tr").find('input').attr("required", false);

    }else{
        $(this).closest("tr").find('select').attr("required", true);
        $(this).closest("tr").find('input').attr("required", true);

    }

    //check "select all" if all checkbox items are checked
    if ($('input[name="assign_chbox[]"]:checked').length == $('input[name="assign_chbox[]"]').length ){
        $("#select_all").prop('checked', true); //change "select all" checked status to true
    }
});
// end select all

function enforceNumberValidation(ele) {
	if ($(ele).data('decimal') != null) {
		// found valid rule for decimal
		var decimal = parseInt($(ele).data('decimal')) || 0;
		var val = $(ele).val();
		if (decimal > 0) {
			var splitVal = val.split('.');
			if (splitVal.length == 2 && splitVal[1].length > decimal) {
				// user entered invalid input
				$(ele).val(splitVal[0] + '.' + splitVal[1].substr(0, decimal));
			}
		} else if (decimal == 0) {
			// do not allow decimal place
			var splitVal = val.split('.');
			if (splitVal.length > 1) {
				// user entered invalid input
				$(ele).val(splitVal[0]); // always trim everything after '.'
			}
		}
	}
}
$('#incubdt_form').submit(function (e) {

	// $('#btnSave').attr("disabled", true);
	$('#btnSave').html('<i class="md md-loop"></i> Processing');

	var formData = new FormData(this);
	e.preventDefault();
    
    var check_box_len = $('input[name="assign_chbox[]"]:checked').length;
    
    if(check_box_len !=0){
        $.ajax({
            url: BASE_URL + 'Incubation/submitIncubationdetails',
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function (data) {
                // $('#btnSave').attr("disabled", false);
                $('#btnSave').text('Save Changes');

                if (data.message == 'success') {

                    $.Notification.autoHideNotify(
                        'success',
                        'top right',
                        'Updated Successfully..!',
                        ''
                    );
                    setTimeout(
                        function () {
                            window.location = BASE_URL +data.url;
                        },
                        2000);

                } else {
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
    else{

        $.Notification.autoHideNotify(
            'warning',
            'top right',
            'Select checkbox to proceed further..!',
            ''
        );

    }
});
