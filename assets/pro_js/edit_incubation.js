$(document).ready(function () {
   // get_birdgroup();
   // get_aviary();
    getincubedit_details();
	get_incubation_list();
});
function get_incubation_list() {
	$.ajax({
		url: BASE_URL + 'Incubation/get_incubation_title',
		method: "POST",
		dataType: "json",
		success: function (data) {

			if (data.length != 0) {
				var g_html = '<option value="">Select Incubator</option>';
				for (let index = 0; index < data.length; index++) {
					g_html += "<option value=" + data[index].incubation_name + ">" + data[index].incubation_name + "</option>";
				}
				$('#incubator').html(g_html);
	
				}
			}

		

	});
}
function get_birdgroup(bird_groupid){
   // alert(bird_groupid);
    $.ajax({
        url: BASE_URL + 'Bird/get_birdgroup',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = "";
            for (let index = 0; index < data.length; index++) {
               // alert(data[index].auto_id);
                if(bird_groupid == data[index].auto_id ){
                    
                g_html += "<option selected value=" + data[index].auto_id + ">" + data[index].group_name + "</option>";
                }
                else{
                    g_html += "<option  value=" + data[index].auto_id + ">" + data[index].group_name + "</option>";
 
                }
            }

            $('#bird_group').html(g_html);

        }

    });
}

$("#bird_group").on('change', function() {
    
    var bird_group = $('#bird_group').val();
    
    $.ajax({
        url: BASE_URL + 'Bird/get_birdspecies',
        method: "POST",
        data:{"group_id":bird_group,},
        dataType: "JSON",
        success: function(data) {
            var s_html = '<option value="">Select Bird Species</option>';
            for (let index = 0; index < data.length; index++) {
                s_html += "<option value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
            }
            $('#bird_species').html(s_html);

        }

    });

});

function get_aviary(aviary_id){
    $.ajax({
        url: BASE_URL + 'Bird/get_aviary',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var a_html = '';
            for (let index = 0; index < data.length; index++) {
                if(aviary_id == data[index].auto_id){
                a_html += "<option selected value=" + data[index].auto_id + ">" + data[index].aviary_name + "</option>";
                }
                else{
                    a_html += "<option value=" + data[index].auto_id + ">" + data[index].aviary_name + "</option>";
   
                }
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
$("#fertile_type").on('change', function() {
    var fertile_type = $('#fertile_type').val();

    if(fertile_type !=''){
        if(fertile_type =='Fertile'){
            $("#dis_div").css({ "display" :"block" });
            $("#fertile_div").css({ "display" :"block" });
    
        }else if(fertile_type =='Dis'){
            $("#fertile_div").css({ "display" :"none" });
            $("#dis_div").css({ "display" :"block" });
        }
		else{
			$("#fertile_div").css({ "display" :"none" });
			$("#dis_div").css({ "display" :"none" });
		}
    }
    else{
        $("#fertile_div").css({ "display" :"none" });
        $("#dis_div").css({ "display" :"none" });
    }
});
function getincubedit_details(){

    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split( '/' );
	var last_segment = segment_array.pop();
	var current_incubid = last_segment;


    $.ajax({
        url: BASE_URL + 'Incubation/getincubedit_details',
        method: "POST",
        data:{"current_incubid":current_incubid,},
        dataType: "JSON",
        success: function(data) {
           
            if(data.length !=0){
                $('#auto_id').val(data[0].auto_id);

              //  $('#bird_group').select2().select2('val',data[0].group_id);
                 get_birdgroup(data[0].group_id);
                show_species(data[0].group_id,data[0].species_id);
//alert(data[0].species_id);
               // $('#aviary_id').select2().select2('val',data[0].aviary_id);
               get_aviary(data[0].aviary_id);
                cage_edit(data[0].aviary_id,data[0].cage);
                
              //  $('#cage').select2().select2('val',data[0].cage);

                ring_details(data[0].aviary_id,data[0].cage,data[0].male_parent_ringno,data[0].female_parent_ringno);
                 $('#incubator').select2().select2('val',data[0].incubator);
                $('#egg_no').val(data[0].egg_no);
               // $('#egg_status').select2().select2('val',data[0].egg_status);
              //  $('#fertile_type').select2('val',data[0].fertile_type);
              o_html ='<option selected value="'+data[0].fertile_type+'">'+data[0].fertile_type+'</option>';
           o_html +=  '<option value="Fertile">Fertile</option>';
           o_html +=   '<option value="In Fertile">In Fertile</option>';
           o_html +=  '<option value="Dis">Dis</option>';
           o_html +=  '<option value="Broken">Broken</option>';
           o_html +=  '<option value="Crack">Crack</option>';
           o_html +=  '<option value="Unknown">Unknown</option>';
              $("#fertile_type").html(o_html);
                if(data[0].fertile_type =='Fertile'){

                    $('#pip_weight').val(data[0].pip_weight);
                    $('#shell_weight').val(data[0].shell_weight);
                    $('#pip_date').val(data[0].pip_date);
                    h_html ='<option selected value="'+data[0].hatch_type+'">'+data[0].hatch_type+'</option>';
                    h_html +='<option value="Assist">Assist</option> <option value="Normal">Normal</option>';
                  //  $('#hatch_type').select2().select2('val',data[0].hatch_type);
                  $("#hatch_type").html(h_html);

                    $('#hatch_weight').val(data[0].hatch_weight);
                    $('#hatch_date').val(data[0].hatch_date);
                    $('#shell_thick').val(data[0].shell_thick);

                    // infertile field empty
                    d_html ='<option selected value="'+data[0].dis_type+'">'+data[0].dis_type+'</option>';

                    d_html += '<option value="Early Dis">Early Dis</option><option value="Mid Dis">Mid Dis</option> <option value="Late Dis">Late Dis</option>';
                    $('#dis_type').html(d_html);
                  //  $('#dis_type').select2().select2('val',data[0].dis_type);
                    $('#dis_date').val(data[0].dis_date);

					$('#egg_length').val(data[0].egg_length);
					$('#egg_breadth').val(data[0].egg_breadth);
					
					//$('#egg_index').val(data[0].egg_length);
					$('#shell_layer').select().select('val',data[0].shell_layer);

					//$('#shell_layer').val(data[0].shell_layer);
					$('#hatch_time').val(data[0].hatch_time);
					$('#moved_time').val(data[0].moved_time);
					$('#date_bos').val(data[0].bos_date);
					$('#bos_findings').select2().select2('val',data[0].bos_findings);
					$('#dis_weight').val(data[0].dis_weight);
					//$('#bos_date').val(data[0].incubator);
			
					//$('#lay_pip_weight').val("");


                    $("#dis_div").css({ "display" :"block" });
                    $("#fertile_div").css({ "display" :"block" });
                    
                }else{

               

                    // fertile field empty
                    $('#pip_weight').val("");
                    $('#shell_weight').val("");
                    $('#pip_date').val("");
                    $('#hatch_type').val("");

                    $('#hatch_weight').val("");
                    $('#hatch_date').val("");
                    $('#shell_thick').val("");
					//$('#dis_type').val("");
					//$('#dis_date').val("");
					$('#egg_length').val("");
					$('#egg_breadth').val("");
					
					//$('#egg_index').val("");
				
					$('#shell_layer').val("");
					$('#hatch_time').val("");
					$('#moved_time').val("");
					$('#bos_date').val("");
					$('#bos_findings').val("");
					//$('#dis_weight').val("");
					$('#incubator').val("");
			
					//$('#lay_pip_weight').val("");
				

                    $("#fertile_div").css({ "display" :"none" });
                   // $("#infertile_div").css({ "display" :"block" });
                }
//    //  $('#dis_type').select2().select2('val',data[0].dis_type);
//    d_html ='<option selected value="'+data[0].dis_type+'">'+data[0].dis_type+'</option>';

//    d_html += '<option value="Early Dis">Early Dis</option><option value="Mid Dis">Mid Dis</option> <option value="Late Dis">Late Dis</option>';
//    $('#dis_type').html(d_html);
//    $('#dis_date').val(data[0].dis_date);
                $('#doi').val(data[0].doi);
                $('#dof').val(data[0].dof);
                $('#egg_weight').val(data[0].egg_weight);
				$('#clutch_no').val(data[0].clutch_no);
				$('#egg_no_clutch').val(data[0].egg_no_clutch);
                $('#remark').val(data[0].remark);
                
                $('.select2').css('width', '100%');

                
            }
        }

    });
}

function show_species(bird_group,selected_val){
    
    $.ajax({
        url: BASE_URL + 'Bird/get_birdspecies',
        method: "POST",
        data:{"group_id":bird_group,
            "species_id":selected_val},
        dataType: "JSON",
        success: function(data) {
            var s_html = '';
            for (let index = 0; index < data.length; index++) {
                if(selected_val == data[index].auto_id){
                   // alert(data[index].bird_species);
                    s_html += "<option selected value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
                }
                else{
                    s_html += "<option  value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
  
                }
                }

            $('#bird_species').html(s_html);

           // $('#bird_species').select2().select2('val',selected_val);

        }

    });
}

function cage_edit(aviary_id,selected_val){

    $.ajax({
        url: BASE_URL + 'Bird/get_cage_listall',
        method: "POST",
        data:{"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Cage</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option value='" + data[index].cage + "'>" + data[index].cage + "</option>";
            }
            $('#cage').html(c_html);
            $('#cage').select2().select2('val',selected_val);
                
        }

    });
}

function ring_details(aviary_id,cage,male_parent_ringno,female_parent_ringno){

    $.ajax({
        url: BASE_URL + 'Incubation/get_ringno_fcage',
        method: "POST",
        data:{"cage":cage,"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            
            var cm_html = '<option value="">Select</option>';
            var cf_html = '<option value="">Select</option>';
            cm_html += "<option selected value=" + male_parent_ringno + ">" + male_parent_ringno+ "</option>";
            cf_html += "<option selected value=" + female_parent_ringno + ">" + female_parent_ringno + "</option>";

            for (let index = 0; index < data.length; index++) {

                if(data[index].gender =='Male'){
                    if(male_parent_ringno == data[index].ring_no ){
                        cm_html += "<option selected value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";
                        }
                        else{
                            cm_html += "<option  value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";
    
                        }
                }else{
                    if(female_parent_ringno == data[index].ring_no ){
                    cf_html += "<option selected value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";
                    }
                    else{
                        cf_html += "<option  value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";

                    }
                }
            }
            // alert(cm_html);
            // alert(cf_html);
            $('#male_parent_rno').html(cm_html);
           // $('#male_parent_rno').select2().select2('val',male_parent_ringno);

            $('#female_parent_rno').html(cf_html);
          // $('#female_parent_rno').select2().select2('val',female_parent_ringno);

           // $('.select2').css('width', '100%');
                
        }
                
    });
}

$('#incubationForm').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
   var mp = $('#male_parent_rno').val();
   var fp =  $('#female_parent_rno').val();
   if(mp == " " || fp == " "){
       alert("Male or female parent ring no seems to be empty")
   }
   var fer_type =  $('#fertile_type').val();
   if(fer_type == "Dis" || fer_type == "In Fertile" ){
	send_mail(formData);
   }

    $.ajax({  
        url:BASE_URL + 'Incubation/editIncubation', 
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
                    'Updated Successfully..!',
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
function send_mail(data)
 {
    
 // alert("test");
   //  console.log(message_body);
    $.ajax({
        url: BASE_URL + 'Email_send/send_dis_mail',
        method: "POST",
		data: data,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(data) {
            
            console.log(data);
        }
    });
 }
