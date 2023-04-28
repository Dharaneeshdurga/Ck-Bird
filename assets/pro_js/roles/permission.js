$(document).ready(function () {
 // $('.permission-section').hide();
  var show = localStorage.getItem('show1');
  //alert(show);
  if(show !== 'false'){
   // alert("test");
   // var div_id = '#'+show;
   var load_id = '#'+show;
   $('.permission-section').hide();
    $(load_id).show();
    localStorage.setItem('show1', 'false');
  }
  if(show === 'false'){
  //  alert("test");
    $('.permission-section').hide();
    //localStorage.setItem('show1', 'test');
  }
});
function show_hide(class_div){
    alert("test");
    $(class_div).hide();
}
function toggle(div_id){
   // alert(div_id);
    var id = "#"+div_id;
    $(id).toggle();
}
function get_submenu(role_id,menu_id){
  //alert(role_id);
  // get_permission_status(role_id,menu_id);
  $.ajax({
    url: BASE_URL + 'Masters/get_ids_submenu',
    method: "POST",
    data:{"menu_id":menu_id,"role_id":role_id},
    dataType: "JSON",
    success: function(data) {
        var c_html = "";
        var sb_id="";
       // var role_status = data.role_status[0].role_permission;
       // alert(role_status);
        for (let index = 0; index < data.sb_ids.length; index++) {
            sb_id += "sb_permission-"+data.sb_ids[index].id;
            c_html +="<tr>";
            c_html += "<td>" + data.sb_ids[index].submenu_name + "</td>";
            if(!data.role_status){
              var role_status1="";
            }
          
            else{
            var role_status1 = 1;
            }
            var role_status = data.role_status[index].role_permission;
           // console.log(role_status);
            if(role_status == 1){
                 c_html +='<td><label class="switch permissions"><input type="checkbox" value="active"  id="'+sb_id+'" onchange="submenu_Permissions('+"'"+role_id+"'"+','+"'"+menu_id+"'"+','+"'"+data.sb_ids[index].id+"'"+','+"'"+sb_id+"'"+');" checked="checked"><span class="slider round"></span></label></td>';
            }
            else {
                c_html +='<td><label class="switch permissions"><input type="checkbox" value="active"  id="'+sb_id+'" onchange="submenu_Permissions('+"'"+role_id+"'"+','+"'"+menu_id+"'"+','+"'"+data.sb_ids[index].id+"'"+','+"'"+sb_id+"'"+');"><span class="slider round"></span></label></td>';

            }
            //  c_html +='<td><label class="switch permissions"><input type="checkbox" value="active"  id="'+sb_id+'" onchange="submenu_Permissions('+"'"+role_id+"'"+','+"'"+menu_id+"'"+','+"'"+data.sb_ids[index].id+"'"+','+"'"+sb_id+"'"+');"><span class="slider round"></span></label></td>';

             c_html +="</tr>"; 
         }
        $('#all_sb').html(c_html);
        var sub_id = "sub-"+role_id;
       var g_html='<label class="switch mr-2">';
      // g_html +="<input type='checkbox' id='"+sub_id+"' onchange='submenu_AllPermissions('''" +role_id+"'');'>";
      g_html += '<input type="checkbox" id='+sub_id+' onchange="submenu_AllPermissions('+"'"+role_id+"'"+','+"'"+menu_id+"'"+','+"'"+sub_id+"'"+');" >';

      g_html +='<span class="slider round"></span>';
       g_html +='</label>';
       g_html += 'Select All';
      // $('#get_all_submenu_permission').html(g_html);
       
        $('#submenu-modal').modal("show");
            
    }
            
});

}
function get_permission_status(role_id,menu_id,sb_id){
    $.ajax({
        url: BASE_URL + 'Masters/get_role_status',
        method: "POST",
        data:{
            "role_id":role_id,
             "menu_id":menu_id,
             "sbmenu_id":sb_id,
        },
        dataType: "JSON",
        success: function(data) {
           
           $role_status = data[0].role_permission;
           return  $role_status;
               
        }
                
    });  

}
function toggleAllPermissions(role_id, ele,divid) {
   // alert(ele);
   
   var tg_id = ".one_permission-"+role_id;
   //alert(tg_id);
   checkBox = document.getElementById(ele);
  // alert(checkBox);
   // let assignPermission = '0';
    if (checkBox.checked == true){
      var  assignPermission = '1';
      } else {
      var  assignPermission = '0';
      }

      $.ajax({
        url: BASE_URL + 'Masters/toggle_all_menus',
        method: "POST",
        data:{"role_id":role_id,"ap":assignPermission,},
        //dataType: "JSON",
        success: function(data) {
            console.log(data.permission);
            if(data.permission == 1){
                $(tg_id).attr("checked", true);
            }
            if(data.permission == 0){
                $(tg_id).attr("checked", false);
            }
           // $('#test_tog').val(data.permission);
            //$(load_id).load(load_id);
         //  $(load_id).load(document.URL + load_id);
            localStorage.setItem('show1', divid);
            window.location.reload(); 
           // show_hide('.permission-section');
           
               
        }
                
    });
    

}

function togglePermission(role_id,menu_id,ele) {
   
    checkBox = document.getElementById(ele);
   // alert(ele);
    // let assignPermission = '0';
     if (checkBox.checked == true){
       var assignPermission = '1';
       } else {
       var assignPermission = '0';
       }
 
       $.ajax({
         url: BASE_URL + 'Masters/toggle_menus',
         method: "POST",
         data:{
         "role_id":role_id,
         "ap":assignPermission,
         "menu_id":menu_id
        },
         dataType: "JSON",
         success: function(data) {
             //alert(data.permission);
             //window.location.reload();
                 
         }
                 
     });
     
 
 }
 function submenu_Permissions(role_id,menu_id,submenu_id,ele) {
   
    checkBox = document.getElementById(ele);
   // alert(ele);
     let assignPermission = '0';
     if (checkBox.checked == true){
         assignPermission = '1';
       } else {
         assignPermission = '0';
       }
 
       $.ajax({
         url: BASE_URL + 'Masters/toggle_submenus',
         method: "POST",
         data:{
         "role_id":role_id,
         "ap":assignPermission,
         "menu_id":menu_id,
         "submenu_id":submenu_id
        },
         dataType: "JSON",
         success: function(data) {
             //alert(data.permission);
             //window.location.reload();
                 
         }
                 
     });
     
 
 }

 function submenu_AllPermissions(role_id, menu_id,ele) {
    // alert(ele);
    //var div = '#'+ele;
    var tg_id = ".sb_permission"+menu_id;
    //alert(tg_id);
    checkBox = document.getElementById(ele);
   // alert(checkBox);
     let assignPermission = '0';
     if (checkBox.checked == true){
         assignPermission = '1';
       } else {
         assignPermission = '0';
       }
 
       $.ajax({
         url: BASE_URL + 'Masters/submenu_all_permissions',
         method: "POST",
         data:{
             "role_id":role_id,
             "menu_id":menu_id,
             "ap":assignPermission,
            },
         dataType: "JSON",
         success: function(data) {
            // alert(data.permission);
             if(data.permission == 1){
                 $(tg_id).attr("checked", true);
             }
             if(data.permission == 0){
                 $(tg_id).attr("checked", false);
             }
             //window.location.reload(); 
            // $('#submenu-modal').modal("show");
            // window.location.reload();     
         }
                 
     });
     
 
 }