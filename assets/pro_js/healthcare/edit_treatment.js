$(document).ready(function() {
   
    get_treatment_byid();
  
});

function get_treatment_byid(){
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var treatment_id = last_segment;
    $.ajax({
        url: BASE_URL + 'Healthcare/get_treatment_byid',
        method: "POST",
        data:{
            "treatment_id":treatment_id,
      },
        dataType: "JSON",
        success: function(data) {
           // console.log(data.clutch_no[0].clutch_no);
            $('#aviary_id').val(data[0].aviary_id);
            $('#aviary_name').val(data[0].aviary_name);
            $('#cage').val(data[0].cage);
            $('#species_name').val(data[0].species_name);
            $('#bird_species').val(data[0].bird_species);
            $('#eegring_no').val(data[0].eegring_no);
            $('#eegring_no').val(data[0].eegring_no);
            $('#division').val(data[0].division);
            $('#age').val(data[0].age);
            $('#sex').val(data[0].sex);
            $('#bird_count').val(data[0].bird_count);
            $('#therapy_schedule').val(data[0].therapy_schedule);
         
         
           
                
        }
                
    });

}
$('#edit_treat_form').submit(function(e) {
     var formData = new FormData(this);
     e.preventDefault();
     $.ajax({  
         url:BASE_URL + 'Healthcare/add_treatment_form', 
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