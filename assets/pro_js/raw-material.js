$(document).ready(function () {
    //('#cd-timeline').hide();
    $('#hideShow').hide();
   // $('#table-hideShow').hide();
   //get_rawMaterail_Importlist();
    get_aviary();
  
});

function get_materials(){
    $('#hideShow').show(); 
    var gp = $('#group_id').val(); 
    var aviary_id = $('#aviary_id').val(); 
    $('#gp_id').val(gp);
    $('#aviary').val(aviary_id);
                
   // alert(aviary_id);
}
$("#actn_feed").click(function(){ 
    var sp = $('#species_id').val(); 
    alert("test");
    $.ajax({
        url: BASE_URL + 'Import/uploadMat',
        method: "POST",
        data:{"gp_id":gp},
        dataType: "JSON",           
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
             // b_html = data[index].aviary_name;
               //  b_html += "<option>" + data[index].aviary_name + "</option>";
            }
            $('#aviary_id').html(a_html);
  // $('#av').html(b_html);
                
        }
                
    });
}
$("#aviary_id").on('change', function() {
    var aviary_id = $('#aviary_id').val();

    $.ajax({
        url: BASE_URL + 'Lifecycle/get_group',
        method: "POST",
        data:{"aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Group</option>';
            for (let index = 0; index < data.length; index++) {
                //if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].group_id + ">" + data[index].group_name + "</option>";
                //c_html += "<option>" + data[index].group_name + "</option>";
               // }
            }
            $('#group_id').html(c_html);
                
        }
                
    });
});

$("#group_id").on('change', function() {
    var group_id = $('#group_id').val();
    var aviary_id = $('#aviary_id').val();
   
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_species',
        method: "POST",
        data:{"group_id":group_id,
        "aviary_id":aviary_id},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Species</option>';
            for (let index = 0; index < data.length; index++) {
               // if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].species_id + ">" + data[index].bird_species + "</option>";
               // }
            }
            $('#species_id').html(c_html);
                
        }
                
    });
});

function get_sp_count(group_id,aviary_id,species_id){
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_species_count',
        method: "POST",
        data:{"group_id":group_id,
        "aviary_id":aviary_id,
        "species_id":species_id},
        dataType: "JSON",
        success: function(data) {
           //alert(data);
            $('#count_sp').val(data);
                
        }
                
    });

}
$("#species_id").on('change', function() {
    var group_id = $('#group_id').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#species_id').val();
    get_sp_count(group_id,aviary_id,species_id);
    $.ajax({
        url: BASE_URL + 'Lifecycle/get_type',
        method: "POST",
        data:{"group_id":group_id,
        "aviary_id":aviary_id,
        "species_id":species_id},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select type</option>';
            for (let index = 0; index < data.length; index++) {
               // if(data[index].ring_no != ""){
                c_html += "<option>" + data[index].actual_type + "</option>";
               // }
            }
            $('#act').html(c_html);
                
        }
                
    });
});
$('#mat-update').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
   // alert("staRT");
    $.ajax({  
        url:BASE_URL + 'Feedmaintenance/add_matTrack', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {
           // alert("success");
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
$("#actual").keyup(function(){  //showing status
    var actual = $("#actual").val();
    var target = $("#target").val();
   // var prev_act_weight = $("#prev_actual_weight").val();
    var status = actual - target;
    $('#status').val(status);
    if(status < 0 ){
        $("#status").css("background", "red");  
      }
      if(status >= 0 ){
      $("#status").css("background", "green");
      }


   });
  
   /* var count = $('#count').val();
    for ($i=0; $i<=count; $i++){
        $("#actual"+$i).keyup(function(){
            alert($i);
        var actual = $(this).val();
        $("#status"+$i).val("test");
         alert("#status"+$i);
        });
    }*/
   
    window.onload = function () { 
        var calc = document.getElementsByClassName("actual");
    
    
        for(let input of calc) {
            input.addEventListener("keyup", calculateThis);
        }
    
    
        function calculateThis() {
           var target = $(this).closest('td').prev('.tt').text();
           var actual = $(this).val();
           var status = actual - target;
           var tg =  $(this).closest('tr').find('.ss input').val(status);
           if(status > 0){
            $(this).closest('tr').find('.ss input').css({"background": "#3CB371","color":"black","font-weight": "bold"});  
        }
        else{
            $(this).closest('tr').find('.ss input').css({"background": "#fa6f50ea","color":"black","font-weight": "bold"});  
        }
        
        }
    
    }

  
    //var target = $("#target").val(); 
  
   