$(document).ready(function () {
    get_aviary();
  //  get_datatable();
   
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
    
    var aviary_id = $('#aviary_id').val();
    var cage = $('#cage').val();
   // alert(cage);
    $.ajax({
        url: BASE_URL + 'Breeding/get_birdspecies_fm',
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

$("#bird_species").on('change', function() {
    
    var cage_id = $('#cage').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#bird_species').val();
    spc_std_weight(species_id);
    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_no',
        method: "POST",
        data:{"species_id":species_id,
        "cage_id":cage_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Egg no</option>';
            for (let index = 0; index < data.length; index++) {
               
               // if(data[index].status != "1"){
                   //s console.log(data[index].status);
                c_html += "<option value=" + data[index].egg_no + ">" + data[index].egg_no + "</option>";
               // }
                
            }
            $('#egg_no').html(c_html);
                
        }
                
    });

});

function spc_std_weight(species_id){
    $.ajax({
        url: BASE_URL + 'Bird/get_birdfeed_fm',
        method: "POST",
        data:{"species_id":species_id},
        dataType: "JSON",
        success: function(data) {
            $('#std_egg_weight').val(data[0].std_egg_weight);
            $('#std_hatch_weight').val(data[0].std_hatch_weight);
           
        }

    });
}


$("#egg_no").on('change', function() {
    var egg_no = $(this).val();
   // get_clutch(egg_no);
    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_details',
        method: "POST",
        data:{
            "egg_no":egg_no,
      },
        dataType: "JSON",
        success: function(data) {
         
            $('#hatch_date').val(data.full_egg_result[0].hatch_date);
            $('#mp_ring').val(data.full_egg_result[0].male_parent_ringno);
            $('#fp_ring').val(data.full_egg_result[0].female_parent_ringno);
            $('#egg_weight').val(data.full_egg_result[0].egg_weight);
            $('#hatch_weight').val(data.full_egg_result[0].hatch_weight);
            $('#body_weight').val(data.act_weight[0].act_weight);
            $('#no_mp_ring').val(data.male_ring_count);
            $('#no_fp_ring').val(data.female_ring_count);

            var incub_id = data.full_egg_result[0].auto_id;
            get_handfeed_date(incub_id)


            $('#clutch_no').val(data.clutch_no[0].clutch_no);
            $('#egg_no_clutch').val(data.eggno_in_clutch[0].eggno_in_clutch);

            
                
        }
                
    });

});
function get_handfeed_date(incub_id){
   // alert("test");
    $.ajax({
        url: BASE_URL + 'Healthcare/get_handfeed_details',
        method: "POST",
        data:{
            "incub_id":incub_id,
      },
        dataType: "JSON",
        success: function(data) {
           // console.log(data);
            var moved_date = data[0].move_handfeed_date;
    var dateAr = moved_date.split('-');
    var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = d.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
    daysdifference(newDate,output)
                
        }
                
    });
  
}

function daysdifference(firstDate, secondDate){  
	//var from = $(firstDate).replace(/\//g, '-');
	//alert(getid);
    var startDay = new Date(firstDate);  
    var endDay = new Date(secondDate);  
  
// Determine the time difference between two dates     
    var millisBetween = startDay.getTime() - endDay.getTime();  
  
// Determine the number of days between two dates  
    var days = millisBetween / (1000 * 3600 * 24);  
  
// Show the final number of days between dates     
    var age =  Math.round(Math.abs(days));  
	$('#age').val(age);

	
} 
function get_clutch(eeg_no){

    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_clutch',
        method: "POST",
        data:{
            "egg_no":eeg_no,
      },
        dataType: "JSON",
        success: function(data) {
           // console.log(data.clutch_no[0].clutch_no);
            $('#clutch_no').val(data.clutch_no[0].clutch_no);
            $('#egg_no_clutch').val(data.eggno_in_clutch[0].eggno_in_clutch);
           
                
        }
                
    });

}

$('#stunt_chick_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Healthcare/add_stunt_register', 
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
$('#splay_chick_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Healthcare/add_splayleg_register', 
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