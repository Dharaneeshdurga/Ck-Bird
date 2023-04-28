
function employeeid_valid(){
    var textInput = document.getElementById("log_user_id").value;
    textInput = textInput.replace(/[&\/\-_=|\][;\#,+()$~%.'":*?<>{}@^!`]/g, "");
    document.getElementById("log_user_id").value = textInput;
    if(textInput ==''){
        $("#id_group").addClass("has-error");
        $("#btnLogin").attr("disabled", true);

    }
    else{
        $("#id_group").addClass("has-success");
        $("#id_group").removeClass("has-error");
        $('#btnLogin').removeAttr("disabled");

    }
}

function password_valid(){
				
    var textInput = document.getElementById("log_pass").value;
    if(textInput ==''){
        $("#pass_group").removeClass("has-success");
        $("#pass_group").addClass("has-error");

        $("#btnLogin").attr("disabled", true);


    }
    else{
        $("#pass_group").removeClass("has-error");

        $("#pass_group").addClass("has-success");
        $("#btnLogin").attr("disabled", false);
        

    }
}

$('#loginForm').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();

       $.ajax({  
            url:BASE_URL + 'Login/doLogin', 
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
                        'Loged In Successfully',
                        ''
                    );			


                    setTimeout(
                        function() {
                            window.location = BASE_URL + data.url;

                        }, 2000);

                }
                else{

                    $.Notification.autoHideNotify(
                        'warning', 
                        'top right', 
                        'Emp ID or Password are wrong',
                        ''
                    );

                   
                }
                
            }  
        }); 
    
    
});