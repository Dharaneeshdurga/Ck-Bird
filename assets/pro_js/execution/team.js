$(document).ready(function () {
   // $("#reason").css({ "display" :"none" });
    //$("#reason").css({ "display" :"none" });
});
function change_status(id){
    //alert(id);
   $('#manage_id').val(id);
    $('#ch_status-modal').modal('show');
}
    $("#change_status").on('change', function() {
      var status = $(this).val(); 
     // alert(status);
      if(status == 0){   
        $("#reason1").css({ "display" :"block" });
        $("#new_doc1").css({ "display" :"block" });
      
    }
    if(status == 1){   
        $("#up_status").css({ "display" :"none" });
        $("#cs_status").css({ "display" :"block" });
      
    }
     // alert(status);
});
$('#team_register').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
    send_mail(formData);
    $.ajax({  
        url:BASE_URL + 'Execution/add_team_register', 
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
                    'Request Sent Successfully..!',
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
        url: BASE_URL + 'Email_send/send_request_mail',
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

$('#manage_register1').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Execution/update_doc', 
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
                    ' Successfully Saved..!',
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

function doc_save(){
    var team_id = $('#team_id').val();
    var doc = $('#doc').val();
    alert(team_id);
    $.ajax({  
        url:BASE_URL + 'Execution/update_doc', 
        method:"POST",  
        data: {"team_id":team_id,"doc":doc},
        dataType:"json",
    
        success:function(data) {
            if(data.logstatus =='success'){
                
                $.Notification.autoHideNotify(
                    'success', 
                    'top right', 
                    'Successfully Saved..!',
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

}
