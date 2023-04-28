$(document).ready(function () {

    check_ringno();
    get_birdgroup();
    get_proven();
    get_aviary();
    // get_cagelist();
    
});

function check_ringno(){
				
    var ring_no = document.getElementById("ring_no").value;
    if(ring_no !=''){

        $.ajax({
            url: BASE_URL + 'Bird/check_ringno',
            method: "POST",
            data:{"ring_no":ring_no,},
            dataType: "JSON",
            success: function(data) {
                
                if(data.response =='already_exits'){
                    $("#ring_no-success").css({ "display" :"none" });
                    $("#ring_no-error").css({ "display" :"block" });
                    
                   
                    $('#btnSave').attr("disabled", true);


                }else{
                    $("#ring_no-error").css({ "display" :"none" });
                    $("#ring_no-success").css({ "display" :"block" });
                    
                    setTimeout(
                        function() {
                            $("#ring_no-success").css({ "display" :"none" });
                        }, 1000);
                    $('#btnSave').attr("disabled", false);

                }
            }
    
        });


    }
    else{
        
    }
}

function get_proven(){
    $.ajax({
        url: BASE_URL + 'Bird/get_proven',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var p_html = '<option value="">Select Proven</option>';
            for (let index = 0; index < data.length; index++) {
                p_html += "<option>" + data[index].title + "</option>";
            }
            $('#proven').html(p_html);

        }

    });
}

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

$("#checkcageBtn").on('click', function() {
    var cage = $('#cage').val();
    var aviary_id = $('#aviary_id').val();

        $.ajax({
            url: BASE_URL + 'Bird/get_cage_info',
            method: "POST",
            data:{"cage":cage,"aviary_id":aviary_id,},
            dataType: "JSON",
            success: function(data) {
                

                if(data.response.length !=0){

                    var c_html = '';
                    for (let index = 0; index < data.response.length; index++) {
                        c_html += '<div class="col-md-3">';
                            c_html += '<div class="panel panel-default panel-fill">';
                                c_html += '<div class="panel-heading">';
                                c_html += '<h3 class="text-danger">'+data.response[index].bird_species+'</h3>';
                                c_html += '</div>';

                                c_html += '<div class="panel-body">';
                                    c_html += '<div class="row">';
                                        c_html += '<div class="col-md-4">';
                                            c_html += '<strong>Group</strong>';
                                            c_html += '<br/>';
                                            c_html += '<p class="text-muted">'+data.response[index].group_name+'</p>';
                                        c_html += '</div>';

                                        c_html += '<div class="col-md-4">';
                                            c_html += '<strong>Gender</strong>';
                                            c_html += '<br/>';
                                            c_html += '<p class="text-muted">'+data.response[index].gender+'</p>';
                                        c_html += '</div>';
                                        
                                        c_html += '<div class="col-md-4">';
                                            c_html += '<strong>Proven</strong>';
                                            c_html += '<br/>';
                                            c_html += '<p class="text-muted">'+data.response[index].proven+'</p>';
                                        c_html += '</div>';

                                    c_html += '</div>';

                                c_html += '</div>';
                            c_html += '</div>';
                        c_html += '</div>';
                    }

                    $('#per_cage_details').html(c_html);
                    $('#cage_info_title').text(data.response[0].cage_id+ " - Cage Details");
                    
                    $('#cage-modal').modal('show');

                }
                
            }
    
        });
    
    
});


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


$("#confirmCagebtn").on('click', function() {
    
    
    $('#closeCagemodel').click();
    var cage_id = $('input[name="get_cage_id"]:checked').val();
    
    $.ajax({
        url: BASE_URL + 'Bird/get_aviary',
        method: "POST",
        data:{"cage_id":cage_id,},
        dataType: "JSON",
        success: function(data) {
            
            if(data.length !=0){
                $('#aviary_id').val(data[0].auto_id);
                $('#aviary_name').val(data[0].aviary_name);
            }
           

        }

    });

});

$("#btnSave").on('click', function() {
    
    $('#btnSave').attr("disabled", true);
    $('#btnSave').html('<i class="md md-loop"></i> Processing');

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
            url: BASE_URL + 'Bird/process_bird_save',
            method: "POST",
            data:{  
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
                        'Inserted Successfully..!',
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
