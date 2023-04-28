$(document).ready(function() {
   
    get_mort_byid();
  
});

function get_mort_byid(){
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var mort_id = last_segment;
	 var decode_eggs = mort_id.split('%2C');
    var aviary_id  = decodeURIComponent(decode_eggs[0]);
	var aviary_id1  = decodeURIComponent(aviary_id);
    var species_id  = decodeURIComponent(decode_eggs[1]);
	var species_id1  = decodeURIComponent(species_id);
	//var species_id = s_id.replace("%2520", "  ");
    var cage  = decode_eggs[2];
	var egg_no  = decode_eggs[3];
	$('#aviary_id').val(aviary_id1);
	$('#aviary_name').val(aviary_id1);
	$('#cage').val(cage);
	$('#species_name').val(species_id1);
	$('#bird_species').val(species_id1);
	$('#no_egg').val(egg_no);
 //  alert(species_id1);

	
	 $.ajax({
		 url: BASE_URL + 'Healthcare/get_egg_details',
		 method: "POST",
		 data:{
			 "egg_no":egg_no,
	   },
		 dataType: "JSON",
		 success: function(data) {
			if(data.inf != "bird"){
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
			else{
				$('#division').val("Bird");
				$('#sex').val(data.bird[0].gender);
			}	 
		 }
				 
	 });

}
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
$('#edit_mort_form').submit(function(e) {
     var formData = new FormData(this);
     e.preventDefault();
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
                     'Successfully Added ..!',
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
