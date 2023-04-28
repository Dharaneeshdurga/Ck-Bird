$(document).ready(function () {
    get_aviary();
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.add_more_egg'); //Input field wrapper
    var fieldHTML = '<div class="laidf"><div class="form-group"> <label for="aviary_id">Egg laid Date</label><input type="date" class="laid form-control" name="laid_date[]" id="laid" value="" required/></div>';
     fieldHTML += '<div class="form-group"> <label for="aviary_id">Egg Weight</label><input type="text" class="form-control" name="egg_weight[]" value=""id="eggw" required/></div>';
     fieldHTML += '<div class="form-group"> <label for="aviary_id">Days Btw Eggs</label><input type="text" class="form-control" name="dys_bw[]" id="dw" value="" readonly/></div>';
     fieldHTML += '<a href="javascript:void(0);" style="margin-left:180px;" class="remove_button btn-danger">Remove</a></div><br>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            var la ="la"+x;
            var el ="#la"+x;
            var db = "#"+x;
           // alert(db);
           var eggw_id = "eggw"+x; //replacin
           var eggw_call = "#eggw"+x; //calling
            $(wrapper).append(fieldHTML); //Add field html
            document.getElementById("dw").id = x;
            document.getElementById("laid").id = la;
            document.getElementById("eggw").id = eggw_id;
            $(db).val('0');
            $(el).on('change', function() {
               var date2 = $(this).val();
               var x1= x-1;
               var el2 ="#la"+x1;
               var date1 = $(el2).val();
               var last_date = $('#last_date').val(date2);
              
              // alert(x1);
              
               daysdifference(date2, date1,x1);
               get_average();
               //alert(x);
            });
            $(eggw_call).keyup(function(){ 
                
                get_weight();
            });
          
           // $('#total_eggs').val(x);
        }
        //days_diff();
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
       // alert(x);
       var x1= x-1;
     //  $('#total_eggs').val(x1);
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
$('#eggw1').keyup(function(){ 
    get_weight();
});
$("#la1").on('change', function() {
    var date2 = $(this).val();
     $('#last_date').val(date2);
    // get_average();
});
$("#first_date").on('change', function() {
    var date1 = $('#last_date').val();
    var date2 = $('#first_date').val();

    var startDay = new Date(date1);  
    var endDay = new Date(date2);  
    var millisBetween = startDay.getTime() - endDay.getTime();  
    var days = millisBetween / (1000 * 3600 * 24);    
    var clutch_int =  Math.round(Math.abs(days));  
     $('#clutch_int').val(clutch_int);
    
    
});
//formula part
function get_average(){
    var total_days = $("input[name='dys_bw[]']")
    .map(function(){return $(this).val();}).get();
   // console.log(
       // total_days.reduce((a, b) => a + b, 0)
     // )
 //   console.log(total_days);
   var sum =0;

    for(var i=0; i < total_days.length; i++){
          
          sum += parseInt(total_days[i]);
 
         }

   // alert(sum); 
   avg_days = sum/total_days.length;
   $('#avg_day').val(avg_days.toFixed(2));
  
        
}
function get_weight(){
    var total_w = $("input[name='egg_weight[]']")
    .map(function(){return $(this).val();}).get();
  
   var sum =0;

    for(var i=0; i < total_w.length; i++){
          
          sum += parseInt(total_w[i]);
 
         }

   // alert(sum); 
   // if(sum =="NaN"){
   // alert("Only numbers are allowed.. please check input..!!!");
   // }
   avg_w = sum/total_w.length;
   $('#avg_weight').val(avg_w.toFixed(2));
  
        
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
    var days_bw =  Math.round(Math.abs(days));  
    return days_bw;
    //var getid= "#"+id;
//	$(getid).val(days_bw);
   // $('#dys_bw').val(days_bw);
//	$('#age').val('4');

	
}  
function days_diff() {
    var values = $("input[name='laid_date[]']")
    .map(function(){return $(this).val();}).get();
    alert(values);

   }

  /* $(wrapper).on('change', '.laid', function(e){
    var values = $("input[name='laid_date[]']")
    .map(function(){return $(this).val();}).get();
   
    $('input[name^="dys_bw"]').each(function() {
        var oneEgg = $("#dys_bw").val("1");
        var twoEgg = $("#2").val("2");
        
    
    });
   
      var len =values.length;
       for(var i = 0; i < len; i++)
     {
          console.log(values[i]);
        //  var val = values[i];
         
       }

   });*/
  

$("#brn_egg").keyup(function(){  //showing feed volume
    var get_feed = $("#brn_egg").val();
    //alert(get_feed);
    var feed_html="";
    for (let index = 1; index <=get_feed; index ++) {
    // feed_html +=' <div class="col-md-4">';
    // feed_html +=' <div class="form-group">';
     //var index_value = index+1;
   //  feed_html +='<label for="feed"> Egg no '+index+'</label>';
     feed_html +='<input type="text"name="br[]"   class="SmallInput form-control"  placeholder="Egg no'+index+'" required="" autocomplete="off" />';
    // feed_html +=' </div>';
    // feed_html +=' </div>';
 }
$('#br_id').html(feed_html);

    
   });


   $("#if_egg").keyup(function(){  //showing feed volume
    var get_feed = $("#if_egg").val();
    //alert(get_feed);
    var feed_html="";
    for (let index = 1; index <=get_feed; index ++) {
     feed_html +='<input type="text"name="if[]"   class="SmallInput form-control"  placeholder="Egg no'+index+'" required="" autocomplete="off" />';
       }
          $('#if_id').html(feed_html);

   });
   $("#dis_egg").keyup(function(){  //showing feed volume
    var get_feed = $("#dis_egg").val();
    //alert(get_feed);
    var feed_html="";
    for (let index = 1; index <=get_feed; index ++) {
     feed_html +='<input type="text"name="dis[]"   class="SmallInput form-control"  placeholder="Egg no'+index+'" required="" autocomplete="off" />';
       }
          $('#dis_id').html(feed_html);

   });
   $("#hatch_egg").keyup(function(){  //showing feed volume
    var get_feed = $("#hatch_egg").val();
    //alert(get_feed);
    var feed_html="";
    for (let index = 1; index <=get_feed; index ++) {
     feed_html +='<input type="text" name="hatch[]"   class="SmallInput form-control"  placeholder="Egg no'+index+'" required="" autocomplete="off" />';
       }
          $('#hatch_id').html(feed_html);

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
    
    var aviary_id = $('#aviary_id').val();
    var bird_species = $('#bird_species').val();
    var cage = $('#cage').val();
    $('#brn_egg').val(0);
    $('#if_egg').val(0);
    $('#hatch_egg').val(0);
    $('#dis_egg').val(0);
    //alert(bird_species);
    $.ajax({
        url: BASE_URL + 'Breeding/get_total_eggs',
        method: "POST",
        data:{
            "aviary_id":aviary_id,
            "cage_id":cage,
           "species_id":bird_species
        },
        dataType: "JSON",
        success: function(data) {
            var total_eggs = data.length;
            $('#total_eggs').val(total_eggs);
           
            var broken_egg="0";
            var infertile_egg="0";
            var fertile_egg="0";
            var dis_egg="0";
            var egg_html="";
            var if_html ="";
            var f_html ="";
            var dis_html ="";
            for (let index = 0; index < data.length; index++) {
                
             //   var dateAr = data[index].doi.split('-');
               // var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
                var egg_status = data[index].fertile_type;
                if(egg_status=="Broken"){
                   
                    var index1=  index+1;
                    if(index1 == data.length){
                        var date_diff =  0;
                        $('#last_date').val(data[index].doi);
                    }
                    else if(index1 < data.length){
                    var date1=  data[index].doi;
                    var date2= data[index+1].doi;
                   var date_diff =  daysdifference(date1, date2); 
                    }
                    var clutch_eggno_br = index+1;
                    broken_egg++;
                    $('#brn_egg').val(broken_egg);
                   // $('#male_parent_ring').val(data[index].male_parent_ringno);
                   // $('#female_parent_ring').val(data[index].female_parent_ringno);
                    egg_html +='<div class="row"><div class="col-md-6">';
                    egg_html +='<label for="feed"> Egg no(Incubation)</label>';
                    egg_html +='<input type="text"name="incub[]"   class="SmallInput form-control"   value="'+data[index].egg_no+'" autocomplete="off" readonly/>';
                    egg_html +='<input type="hidden" class="form-control" name="male_parent_ring[]" value="'+data[index].male_parent_ringno+'"id="male_parent_ring">';
                    egg_html +=' <input type="hidden" class="form-control" name="female_parent_ring[]" value="'+data[index].female_parent_ringno+'" id="female_parent_ring"></input>';
                    egg_html +='</div>';
                    egg_html +='<div class="col-md-6">';
                    egg_html +='<label for="feed"> Egg No in Current Chick</label>';
                    egg_html +='<input type="text"name="br[]" id="ch'+index+'"  class="SmallInput form-control"    value="'+clutch_eggno_br+'" autocomplete="off" readonly/>';
                    egg_html +='<input type="hidden" name="egg_clutch[]" id="ch'+index+'"  class="SmallInput form-control"    value="'+clutch_eggno_br+'" autocomplete="off" readonly/>';
                    egg_html +='</div>';
                    egg_html +='</div>';
                    egg_html +='<div class="row"><div class="col-md-6">';
                    egg_html +='<label for="feed"> Egg Weight </label>';
                    egg_html +='<input type="text" class="form-control" name="egg_weight[]" value="'+data[index].egg_weight+'" id="eggw" readonly/>';
                    egg_html +='</div>';
                    egg_html +='<div class="col-md-6">';
                    egg_html +='<label for="feed"> Egg laid date</label>';
                    egg_html +='<input type="text" class="laid form-control" name="laid_date[]" id="laid'+index+'" value="'+data[index].doi+'" readonly/>';
                    egg_html +='</div>';
                    egg_html +='<div class="col-md-6">';
                    egg_html +='<label for="feed"> Days btw Eggs</label>';
                    egg_html +='<input type="text" style="background: #31daeb8a;" class="form-control" name="dys_bw[]" id="dw" value="'+date_diff+'" readonly/>';
                    egg_html +='</div>';
                    egg_html +='</div>';
                }
                if(egg_status=="Infertile" || egg_status=="In Fertile"){  
                    var index1=  index+1;
                    if(index1 == data.length){
                        var date_diff =  0;
                        $('#last_date').val(data[index].doi);
                    }
                    else if(index1 < data.length){
                    var date1=  data[index].doi;
                    var date2= data[index+1].doi;
                   var date_diff =  daysdifference(date1, date2); 
                    }
                    var clutch_eggno_inf = index+1; 
                    infertile_egg++;
                    $('#if_egg').val(infertile_egg);
                    if_html +='<div class="row"><div class="col-md-6">';
                    if_html +='<label for="feed"> Egg no(Incubation)</label>';
                    if_html +='<input type="text"name="incub[]"   class="SmallInput form-control"   value="'+data[index].egg_no+'" autocomplete="off" readonly/>';
                    if_html +='<input type="hidden" class="form-control" name="male_parent_ring[]" value="'+data[index].male_parent_ringno+'"id="male_parent_ring">';
                    if_html +=' <input type="hidden" class="form-control" name="female_parent_ring[]" value="'+data[index].female_parent_ringno+'" id="female_parent_ring"></input>';
                    if_html +='</div>';
                    if_html +='<div class="col-md-6">';
                    if_html +='<label for="feed"> Egg No in Current Chick</label>';
                    if_html +='<input type="text"name="if[]"   id="ch'+index+'"  class="SmallInput form-control"  value="'+clutch_eggno_inf+'" autocomplete="off" readonly/>';
                    if_html +='<input type="hidden"name="egg_clutch[]"   id="ch'+index+'"  class="SmallInput form-control"  value="'+clutch_eggno_inf+'" autocomplete="off" readonly/>';

                    if_html +='</div>';
                    if_html +='<div class="row"><div class="col-md-6">';
                    if_html +='<label for="feed"> Egg Weight </label>';
                    if_html +='<input type="text" class="form-control" name="egg_weight[]" value="'+data[index].egg_weight+'" id="eggw" readonly/>';
                    if_html +='</div>';
                    if_html +='<div class="col-md-6">';
                    if_html +='<label for="feed"> Egg laid date</label>';
                    if_html +='<input type="text" class="laid form-control" name="laid_date[]"id="laid'+index+'" value="'+data[index].doi+'" readonly/>';
                    if_html +='</div>';
                    if_html +='<div class="col-md-6">';
                    if_html +='<label for="feed"> Days btw Eggs</label>';
                    if_html +='<input type="text" style="background: #eb31b254;" class="form-control" name="dys_bw[]" id="dw" value="'+date_diff+'" readonly/>';
                    if_html +='</div>';
                    if_html +='</div>';
                }
                if(egg_status=="Fertile"){  
                    var index1=  index+1;
                    if(index1 == data.length){
                        var date_diff =  0;
                        $('#last_date').val(data[index].doi);
                    }
                    else if(index1 < data.length){
                    var date1=  data[index].doi;
                    var date2= data[index+1].doi;
                   var date_diff =  daysdifference(date1, date2); 
                    }
                    var clutch_eggno_f = index+1; 
                    fertile_egg++;
                    $('#hatch_egg').val(fertile_egg);
                    f_html +='<div class="row"><div class="col-md-6">';
                    f_html +='<label for="feed"> Egg no(Incubation)</label>';
                    f_html +='<input type="text"name="incub[]"   class="SmallInput form-control"   value="'+data[index].egg_no+'" autocomplete="off" readonly />';
                    f_html +='<input type="hidden" class="form-control" name="male_parent_ring[]" value="'+data[index].male_parent_ringno+'"id="male_parent_ring">';
                    f_html +=' <input type="hidden" class="form-control" name="female_parent_ring[]" value="'+data[index].female_parent_ringno+'" id="female_parent_ring"></input>';
                    f_html +='</div>';
                    f_html +='<div class="col-md-6">';
                    f_html +='<label for="feed"> Egg No in Current Chick</label>';
                    f_html +='<input type="text"name="hatch[]"  id="ch'+index+'"   class="SmallInput form-control"    value="'+clutch_eggno_f+'" autocomplete="off" readonly/>';
                    f_html +='<input type="hidden"name="egg_clutch[]"  id="ch'+index+'"   class="SmallInput form-control"    value="'+clutch_eggno_f+'" autocomplete="off" readonly/>';

                    f_html +='</div>';
                    f_html +='<div class="row"><div class="col-md-6">';
                    f_html +='<label for="feed"> Egg Weight </label>';
                    f_html +='<input type="text" class="form-control" name="egg_weight[]" value="'+data[index].egg_weight+'" id="eggw" readonly/>';
                    f_html +='</div>';
                    f_html +='<div class="col-md-6">';
                    f_html +='<label for="feed"> Egg laid date</label>';
                    f_html +='<input type="text" class="laid form-control" name="laid_date[]" id="laid'+index+'" value="'+data[index].doi+'" readonly/>';
                    f_html +='</div>';
                    f_html +='<div class="col-md-6">';
                    f_html +='<label for="feed"> Days btw Eggs</label>';
                    f_html +='<input type="text"  style="background: #5631eb8a;"  class="form-control" name="dys_bw[]" id="dw"  value="'+date_diff+'" readonly/>';
                    f_html +='</div>';
                    f_html +='</div>';
                }
                if(egg_status=="Dis"){  
                
                    var index1=  index+1;
                    if(index1 == data.length){
                        var date_diff =  0;
                        $('#last_date').val(data[index].doi);
                    }
                    else if(index1 < data.length){
                    var date1=  data[index].doi;
                    var date2= data[index+1].doi;
                   var date_diff =  daysdifference(date1, date2); 
                    }
                    var clutch_eggno_dis = index+1;
                    dis_egg++;
                    $('#dis_egg').val(dis_egg);
                    dis_html +='<div class="row"><div class="col-md-6">';
                    dis_html +='<label for="feed"> Egg no(Incubation)</label>';
                    dis_html +='<input type="text"name="incub[]"   class="SmallInput form-control"   value="'+data[index].egg_no+'" autocomplete="off" readonly />';
                    dis_html +='<input type="hidden" class="form-control" name="male_parent_ring[]" value="'+data[index].male_parent_ringno+'"id="male_parent_ring">';
                    dis_html +=' <input type="hidden" class="form-control" name="female_parent_ring[]" value="'+data[index].female_parent_ringno+'" id="female_parent_ring"></input>';
                    dis_html +='</div>';
                    dis_html +='<div class="col-md-6">';
                    dis_html +='<label for="feed"> Egg No in Current Chick</label>';
                    dis_html +='<input type="text"name="dis[]"   id="ch'+index+'" class="SmallInput form-control"  value="'+clutch_eggno_dis+'" autocomplete="off" readonly/>';
                    dis_html +='<input type="hidden"name="egg_clutch[]"   id="ch'+index+'" class="SmallInput form-control"  value="'+clutch_eggno_dis+'" autocomplete="off" readonly/>';

                    dis_html +='</div>';
                    dis_html +='<div class="row"><div class="col-md-6">';
                    dis_html +='<label for="feed"> Egg Weight </label>';
                    dis_html +='<input type="text" class="form-control" name="egg_weight[]" value="'+data[index].egg_weight+'" id="eggw" readonly/>';
                    dis_html +='</div>';
                    dis_html +='<div class="col-md-6">';
                    dis_html +='<label for="feed"> Egg laid date</label>';
                    dis_html +='<input type="text" class="laid form-control" name="laid_date[]" id="laid'+index+'" value="'+data[index].doi+'" readonly/>';
                    dis_html +='</div>';
                    dis_html +='<div class="col-md-6">';
                    dis_html +='<label for="feed"> Days btw Eggs</label>';
                    dis_html +='<input type="text"   style="background: #ebd4318a;" class="form-control" name="dys_bw[]" id="dw"  value="'+date_diff+'" readonly/>';
                    dis_html +='</div>';
                    dis_html +='</div>';
                }

            }
            $('#br_id').html(egg_html);
            $('#if_id').html(if_html);
            $('#hatch_id').html(f_html);
            $('#dis_id').html(dis_html);
            get_weight();

            var total_date = $("input[name='laid_date[]']")
            .map(function(){return $(this).val();}).get();
            var arranged = total_date.sort();
           // console.log(arranged);
           // console.log(total_date);
        /*    for(var x=0; x < total_date.length;x++){
              
                var laid_id= "#laid"+x;
                var next_laid= "#laid"+(x+1);
                var value = $(laid_id).val();
              //  var value2 = $(next_laid).val();
               
                 var dy_bw =  "#dw"+x;
                var value_index = arranged.findIndex(checkIndex);
                function checkIndex(val) {
                    return val > value;
                  }
                  if(value_index == -1){
                    var id="#ch"+x;// define id
                   // $(id).val(arranged.length); // egg no in chick
                    $('#last_date').val(value); // last date of egg
                    var day1 = total_date[x];
                   var day2 = total_date[x+1];
                  // $('#dw').val(0); 
                  // document.getElementById("dw").id = arranged.length;
                  // daysdifference(day1, day2,arranged.length);
                   // $(dy_bw).val(value);

                  }
                  else{
                  var id="#ch"+x;// define id
                  // $(id).val(value_index); // egg no in chick
                   document.getElementById("dw").id = value_index;
                  var day1 = total_date[x];
                   var day2 = total_date[x+1];
                  // daysdifference(day1, day2,value_index);
                 
                  }
              // console.log(value_index);
               // calculating chick no
               // console.log("array ="+arranged[x]);
             /* if(arranged[x] == value ){
                 // console.log(x+1);
                 var id="#"+x;// define id
                  $(id).val(x+1); // calculating chick no
              }
            }*/
            get_average();
        }

    });

});

$('#proven_form').submit(function(e) {
    var formData = new FormData(this);
    e.preventDefault();
       // alert(formData );
    $.ajax({  
        url:BASE_URL + 'Breeding/add_breeding_proven', 
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