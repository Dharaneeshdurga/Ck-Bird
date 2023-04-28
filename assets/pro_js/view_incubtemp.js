$(document).ready(function () {
    //alert("test");
   //get_incubtemp();
    //get_users();
   // $("#HideShow").hide();
});





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



 //$('#view_incubationTemp').submit(function(e) 
 function get_edit() {
   
    //var formData = new FormData(this);
    //var obj = {};
   
    data1 = $('#cur_date').val();
    data2 = $('#incubation_no').val();
   // if((data1 == "" )||(data2 == "")){
       // alert('Please select Date and Incubation');
    //}
   // else{
    $('#incubtemp_tb').hide();
    $('#HideShow-edit').show();
       // alert(data2);
   
   
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/get_incubtempdetails', 
        method:"POST",  
       // cache:false,
        data:{"date": data1, "incubation":data2},
       // contentType: false,
      //  processData: false,
        dataType:"json",
        
        success: function(data) {
           var da = '<th scope="row">date</th>';
           // for (let index = 0; index < data.length; index++) {
                da +='<td><input type="hidden" name="date" class="SmallInput"  value="'+data[0].date+ '"></td>';
            //}
          $('#date').html(da);
           
           var ind = '<th scope="row">induction</th>';
           // for (let index = 0; index < data.length; index++) {
                ind +='<td><input type="text" name="incubation" class="SmallInput"  value="'+data[0].incub_no+ '"></td>';
            //}
           $('#induction').html(ind);

          /*  var a_html = '<th scope="row">Note Down Time</th>';
            for (let index = 0; index < data.length; index++) {
                a_html +='<td><input type="text" name="notetime'+index+'" class="SmallInput"  value="'+data[index].note_time+ '"></td>';
            }
           $('#notetime').html(a_html);*/
//alert(data.length);
           var id_html = '<th scope="row">id</th>';
           for (let index = 0; index < data.length; index++) {
               id_html +='<td><input type="text" name="id'+index+'" class="SmallInput"  value="'+data[index].id+ '"></td>';
           }
          $('#id').html(id_html);


           var b_html = '<th scope="row">Temperature</th>';
           for (let index = 0; index < data.length; index++) {
            b_html +='<td><input type="text"class="SmallInput" name="temp'+index+'" value="'+data[index].temperature+ '"></td>';
           }
           $('#temperature').html(b_html);
          
           var c_html = '<th scope="row">Relative Humidity</th>';
           for (let index = 0; index < data.length; index++) {
            c_html +='<td><input type="text" class="SmallInput" name="hum'+index+'"value="'+data[index].relative_humidity+ '"></td>';
               //c_html +='<td>'+data[index].relative_humidity+ '</td>';
           }
           $('#rel_hum').html(c_html);

           var d_html = '<th scope="row">Rotation</th>';
           for (let index = 0; index < data.length; index++) {
            d_html +='<td><input type="text"class="SmallInput" name="rotation'+index+'" value="'+data[index].rotation+ '"></td>';
               //d_html +='<td>'+data[index].rotation+ '</td>';
           }
           $('#rotation').html(d_html);

           var e_html = '<th scope="row">Egg No</th>';
           for (let index = 0; index < data.length; index++) {
            e_html +='<td><input type="text" class="SmallInput" name="eggno'+index+'" value="'+data[index].egg_no+ '"></td>';
              // e_html +='<td>'+data[index].egg_no+ '</td>';
           }
           $('#eggno').html(e_html);

        
          
          var f_html = '<th scope="row">Sign</th>';
           
         for (let index = 0; index < data.length; index++) {
          // f_html += '';
           // show_users(data[index].sign);
           f_html += '<td><select name="user'+index+'" id="user6" class="select2">';
              f_html += "<option value=" + data[index].sign + ">" + data[index].user_name + "</option>";
             // show_users();
            f_html += '</select></td>';
            
          }
          
           $('#sign').html(f_html);
           // $('#notetime6').val(a_html);
            //$('#user12p').html(a_html);
            //$('#user2p').html(a_html);
            //$('#user4p').html(a_html);
           // $('#user6p').html(a_html);
            //$('#user8p').html(a_html);
            //$('#user10p').html(a_html);
                
        }
                

        
    }); 
//}// end else
        
} 
//});
function show_users(){
    
    $.ajax({
        url: BASE_URL + 'Incubtemperature/get_users',
        method: "POST",
        data:{},
        dataType: "JSON",
        success: function(data) {
           // var s_html = '<option value="">Select User</option>';
            for (let index = 0; index < data.length; index++) {
              // s_html += '<td><select name="user'+index+'" id="user6" class="select2">';
                
                 var   f_html = "<option value=" + data[index].auto_id + ">" + data[index].user_name + "</option>";
                 //  s_html += '</select></td>';
                
                   // 
            }
           return f_html;
            //$('#user').select2().select2('val',selected_val);

           

        }

    });
}
$('#edit_incub').submit(function(e) {
    //alert('testdatas');
    var formData = new FormData(this);
    e.preventDefault();
        
    $.ajax({  
        url:BASE_URL + 'Incubtemperature/updateIncubationtemp', 
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
                    'updated Successfully..!',
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

