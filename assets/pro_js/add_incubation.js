$(document).ready(function () {
   // $('#fertile_show').hide();
    get_birdgroup();
    get_aviary();
	get_incubation_list();
});

function get_birdgroup(){
    $.ajax({
        url: BASE_URL + 'Bird/get_birdgroup',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = '<option value="">Select Group</option>';
            for (let index = 0; index < data.length; index++) {
                g_html += "<option value=" + data[index].auto_id + ">" + data[index].group_name + "</option>";
            }
            $('#bird_group').html(g_html);

        }

    });
}

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
/*$("#egg_status").on('change', function() {
    var egg_status = $('#egg_status').val();
    if (egg_status == "Normal"){
        $('#fertile_show').show();   
    }
    else{
        $('#fertile_show').hide();    
    }

});*/
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
    var cage = $('#cage').val();
    var aviary_id = $('#aviary_id').val();

    $.ajax({
        url: BASE_URL + 'Incubation/get_ringno_fcage',
        method: "POST",
        data:{"cage":cage,"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            
            var cm_html = '<option value="">Select</option>';
            var cf_html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {

                if(data[index].gender =='Male'){
                    cm_html += "<option value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";

                }else{
                    cf_html += "<option value=" + data[index].ring_no + ">" + data[index].ring_no + "</option>";

                }
            }
            $('#male_parent_rno').html(cm_html);
            $('#female_parent_rno').html(cf_html);
                
        }
                
    });
});

$("#fertile_type").on('change', function() {
    var fertile_type = $('#fertile_type').val();

    if(fertile_type !=''){
        if(fertile_type =='Fertile'){
            $("#dis_div").css({ "display" :"none" });
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

$("#egg_no").keyup(function(){  //validation on egg weight
    var egg_no = $("#egg_no").val();
    check_eggno(egg_no);
   });
   function check_eggno(egg_no){
    $.ajax({
        url: BASE_URL + 'Incubation/egg_no_check',
        method: "POST",
        data:{"egg_no":egg_no},
        dataType: "JSON",
        success: function(data) {
            if(data>0){
                $("#egg_no-success").css({ "display" :"none" });
                $("#egg_no-error").css({ "display" :"block" });
                
               
                $('#btnSave').attr("disabled", true);


            }else{
                $("#egg_no-error").css({ "display" :"none" });
                $("#egg_no-success").css({ "display" :"block" });
                
                setTimeout(
                    function() {
                        $("#egg_no-success").css({ "display" :"none" });
                    }, 1000);
                $('#btnSave').attr("disabled", false);

            }
         
                
        }
                
    });
}
$('#incubationForm').submit(function(e) {
  
       
   
    var formData = new FormData(this);
    e.preventDefault();
	var fer_type =  $('#fertile_type').val();
	if(fer_type == "Dis" || fer_type == "In Fertile" ){
	 send_mail(formData);
	}
    $.ajax({  
        url:BASE_URL + 'Incubation/addIncubation', 
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
