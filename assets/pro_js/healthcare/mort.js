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
        url: BASE_URL + 'Breeding/get_birdspecies_egg_ring',
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

    $.ajax({
        url: BASE_URL + 'Healthcare/get_mortality_eggs',
        method: "POST",
        data:{"species_id":species_id,
        "cage_id":cage_id,
        "aviary_id":aviary_id,},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Egg no</option>';
            for (let index = 0; index < data.length; index++) {
                if(data[index].ring_no != ""){
                c_html += "<option value=" + data[index].egg_no + ">" + data[index].egg_no + "</option>";
                }
            }
            $('#egg_no').html(c_html);
                
        }
                
    });

});

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
            var status= data.full_egg_result[0].status;
			$('#mort_date').val(data.full_egg_result[0].health_change_date);
            if(status == 1){
                var divsion1 = "Incubation";
                $('#division').val(divsion1);
            }
            if(status == 0){
                var divsion2 = "Handfeeding";
                $('#division').val(divsion2);
            }
            if(status == 2){
                var divsion3 = "Preweaning";
                $('#division').val(divsion3);
            }
            if(status == 3){
                var divsion4 = "Weaning";
                $('#division').val(divsion4);
               // console.log(data.full_egg_result[0].gender);
                $('#sex').val(data.full_egg_result[0].gender);
            }
           var incub_id = data.full_egg_result[0].auto_id;
            get_handfeed_date(incub_id)
                
        }
                
    });

});
function get_handfeed_date(incub_id){
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

$('#mort_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Healthcare/add_mort_register', 
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
