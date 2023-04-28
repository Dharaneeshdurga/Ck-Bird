$(document).ready(function () {
    //alert("test");
   get_incubtemp();
    get_users();
    get_brooder();
});
function get_brooder(){
    //  alert("test");
      $.ajax({
          url: BASE_URL + 'Incubtemperature/get_brooder',
          method: "POST",
          dataType: "JSON",
          success: function(data) {
              var g_html = '<option value="">Select Brooder</option>';
              for (let index = 0; index < data.length; index++) {
                  g_html += "<option value=" + data[index].auto_id  + ">" + data[index].brooder_name + "</option>";
              }
              $('#brooder_name').html(g_html);
  
          }
  
      });
  }



function get_incubtemp(){
    //alert("test");
    $.ajax({
        url: BASE_URL + 'Incubtemperature/get_incubdetails',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            var g_html = '<option value="">Select Incubation</option>';
            for (let index = 0; index < data.length; index++) {
                g_html += "<option value=" + data[index].id + ">" + data[index].incubation_name + "</option>";
            }
            $('#incubation_no').html(g_html);

        }

    });
}



function get_users(){
      //alert("test");
    $.ajax({
        url: BASE_URL + 'Incubtemperature/get_users',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var a_html = '<option value="">Select Users</option>';
            for (let index = 0; index < data.length; index++) {
                a_html += "<option value=" + data[index].user_id + ">" + data[index].user_name + "</option>";
            }
            $('#user6').html(a_html);
            $('#user8').html(a_html);
            $('#user10').html(a_html);
            $('#user12p').html(a_html);
            $('#user2p').html(a_html);
            $('#user4p').html(a_html);
            $('#user6p').html(a_html);
            $('#user8p').html(a_html);
            $('#user10p').html(a_html);
                
        }
                
    });
}




$('#handfeedTemp').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Handfeeding/addHandfeedtemp', 
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
