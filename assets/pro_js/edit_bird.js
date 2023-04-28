$(document).ready(function () {

   // get_birdgroup();
   // get_proven();
   // get_aviary();
    get_bird_edit_details();
});

function get_birdgroup(bird_groupid){
    
    $.ajax({
        url: BASE_URL + 'Bird/get_birdgroup',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = '';
            for (let index = 0; index < data.length; index++) {
                if(bird_groupid == data[index].auto_id ){
                    
                    g_html += "<option selected value=" + data[index].auto_id + ">" + data[index].group_name + "</option>";
                    }
                    else{
                        g_html += "<option  value=" + data[index].auto_id + ">" + data[index].group_name + "</option>";
     
                    }            }
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

function get_proven(proven_id){
    $.ajax({
        url: BASE_URL + 'Bird/get_proven',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var p_html = '<option value="">Select Proven</option>';
            for (let index = 0; index < data.length; index++) {
                if(proven_id == data[index].title ){
                p_html += "<option selected value='" + data[index].title + "'>" + data[index].title + "</option>";
                }
                else{
                    p_html += "<option value='" + data[index].title + "'>" + data[index].title + "</option>";
   
                }
            }
            $('#proven').html(p_html);

        }

    });
}

function get_aviary(av_id){
    $.ajax({
        url: BASE_URL + 'Bird/get_aviary',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var a_html = '<option value="">Select Aviary</option>';
            for (let index = 0; index < data.length; index++) {
                if(av_id == data[index].auto_id ){
                    a_html += "<option selected value=" + data[index].auto_id + ">" + data[index].aviary_name + "</option>";
   
                }
                else {
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
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].cage + "</option>";
            }
            $('#cage').html(c_html);
                
        }
                
    });
});

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

function get_bird_edit_details(){
    
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split( '/' );
	var last_segment = segment_array.pop();
	var current_birdid = last_segment;

    $.ajax({
        type: "POST",
        url: BASE_URL + 'Bird/get_bird_edit_details',
        data: { "current_birdid":current_birdid,},
        dataType: "json",

        success: function(data) {
            
            if(data.length !=''){

              //  $('#bird_group').select2().select2('val',data[0].group_id)
              get_birdgroup(data[0].group_id);
                show_species(data[0].group_id,data[0].species_id);

                $('#ring_no').val(data[0].ring_no);
               // $('#gender').select2().select2('val',data[0].gender);
               g_html ='<option selected value="'+data[0].gender+'">'+data[0].gender+'</option>';
                g_html +=' <option value="Male">Male</option><option value="Female">Female</option><option value="NA">NA</option>';
                $('#gender').html(g_html);
                get_proven(data[0].proven);
                // $('#proven').select2().select2('val',data[0].proven);
                get_aviary(data[0].aviary_id);
               // alert(data[0].aviary_id)zzzz);
             //   $('#aviary_id').select2().select2('val',data[0].aviary_id);
                cage_edit(data[0].aviary_id,data[0].cage_id);
              //  $('#cage').select2().select2('val',data[0].cage_id);
               
                $('#weight').val(data[0].weight);

                
                $('.select2').css('width', '100%');
                
            }
        }
    })
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

function show_species(bird_group,selected_val){
  //  alert(bird_group);
    $.ajax({
        url: BASE_URL + 'Bird/get_birdspecies',
        method: "POST",
        data:{"group_id":bird_group,},
        dataType: "JSON",
        success: function(data) {
            var s_html = '<option value="">Select Bird Species</option>';
            for (let index = 0; index < data.length; index++) {
                if(selected_val == data[index].auto_id){
                    s_html += "<option selected value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
                }
                else{
                    s_html += "<option  value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
  
                }            }
            $('#bird_species').html(s_html);

          //  $('#bird_species').select2().select2('val',selected_val);

        }

    });
}
$("#btnSave").on('click', function() {

    $('#btnSave').attr("disabled", true);
    $('#btnSave').html('<i class="md md-loop"></i> Processing');

    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split( '/' );
	var last_segment = segment_array.pop();
	var current_birdid = last_segment;

    var ring_no = $('#ring_no').val();
    var bird_group = $('#bird_group').val();
    var bird_species = $('#bird_species').val();
    var gender = $('#gender').val();
    var cage = $('#cage').val();
    var weight = $('#weight').val();

    // var cage = $('input[name="get_cage_id"]:checked').val();

    var aviary_name = $('#aviary_name').val();
    var aviary_id = $('#aviary_id').val();
    var proven = $('#proven').val();

    if(ring_no =='' || bird_group =='' || bird_species =='' || gender =='' || cage =='' || aviary_name ==''){
        
        $.Notification.autoHideNotify(
            'danger', 
            'top right', 
            '* Fields Required..!',
            ''
        );

        $('#btnSave').attr("disabled", false);
        $('#btnSave').html('Submit');   
    }
    else{

        $.ajax({
            url: BASE_URL + 'Bird/process_bird_update',
            method: "POST",
            data:{  
                "auto_id":current_birdid,
                "ring_no":ring_no,
                "bird_group":bird_group,
                "bird_species":bird_species,
                "gender":gender,
                "cage":cage,
                "aviary_name":aviary_name,
                "aviary_id":aviary_id,
                "proven":proven,
                "weight":weight,

            },
            dataType: "JSON",
            success: function(data) {
                
                if(data.logstatus =='success'){
                    $.Notification.autoHideNotify(
                        'success', 
                        'top right', 
                        'Updated Successfully..!',
                        ''
                    );			
                    setTimeout(
                        function() {
                            window.location = BASE_URL + data.url;
                    }, 2000);

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

});
