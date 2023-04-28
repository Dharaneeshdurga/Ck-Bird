$(document).ready(function () {
    get_all_egg_details();
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
function get_all_egg_details() {
    
    var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var incub_eggs = last_segment;
    var decode_eggs = incub_eggs.split('%2C');
    var aviary_id  = decode_eggs[0];
    var species_id  = decode_eggs[1];
    var cage  = decode_eggs[2];
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
           "species_id":species_id 
        },
        dataType: "JSON",
        success: function(data) {
            console.log(data);
           // var av_id = data[index].aviary_id;
            var aviary = data[0].aviary_name;
            var aviary_id = data[0].aviary_id;
            var cage = data[0].cage;
            var species = data[0].bird_species;
            var species_id = data[0].species_id;
            $('#aviary_name').val(aviary);
            $('#aviary_id').val(aviary_id);
           
            $('#cage').val(cage);
            $('#species_name').val(species);
            $('#species_id').val(species_id);
            

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
                    egg_html +='<div class="row"><div class="col-md-6">';
                    egg_html +='<label for="feed"> Egg no(Incubation)</label>';
                    egg_html +='<input type="text"name="incub[]"   class="SmallInput form-control"   value="'+data[index].egg_no+'" autocomplete="off" readonly/>';
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
                if(egg_status=="In Fertile"){  
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
         
            get_average();
        }

    });

}

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