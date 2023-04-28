$(document).ready(function () {
    get_roles();
    edit_roles();
    get_branch();
    edit_branch();
  });
  function get_roles(){
    $.ajax({
        url: BASE_URL + 'Masters/get_all_roles',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Roles</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].roles_name + "</option>";
            }
            $('#emp_roles').html(c_html);
               
        }
                
    });  
  
}
function get_branch(){
    $.ajax({
        url: BASE_URL + 'Masters/get_all_branch',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var c_html = '<option value="">Select Branch</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].branch_name + "</option>";
            }
            $('#emp_branch').html(c_html);
               
        }
                
    });  
  
}
function edit_roles(){
    var emp_role = $('#emp_roles1').val();
   // alert(emp_role);
    $.ajax({
        url: BASE_URL + 'Masters/get_all_roles',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
            var c_html = '';
            for (let index = 0; index < data.length; index++) {
                if(emp_role == data[index].roles_name){
                    c_html += "<option selected value=" + data[index].auto_id + ">" + data[index].roles_name + "</option>";

                }
                else{
                c_html += "<option value=" + data[index].auto_id + ">" + data[index].roles_name + "</option>";
                }
            }
            $('#emp_roles_edit').html(c_html);
               
        }
                
    });  
}

    function edit_branch(){
        var branch_id = $('#branch_id1').val();
      // alert(branch_id);
        $.ajax({
            url: BASE_URL + 'Masters/get_all_branch',
            method: "POST",
            data:{},
            dataType: "JSON",
            success: function(data) {
                var c_html = '';
                for (let index = 0; index < data.length; index++) {
                    if(branch_id == data[index].auto_id){
                        c_html += "<option selected value=" + data[index].auto_id + ">" + data[index].branch_name + "</option>";
    
                    }
                    else{
                    c_html += "<option value=" + data[index].auto_id + ">" + data[index].branch_name + "</option>";
                    }
                }
                $('#branch_edit').html(c_html);
                   
            }
                    
        });  
    }
    $('#passSubmit').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({  
            url:BASE_URL + 'Masters/updatePassword', 
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
                        'Successfully Updated..!Please Login Back..!!!',
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
  
