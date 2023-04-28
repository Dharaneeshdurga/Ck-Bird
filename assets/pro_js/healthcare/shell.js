$(document).ready(function () {
    get_aviary();
    //  get_datatable();

});

function get_aviary() {
    $.ajax({
        url: BASE_URL + 'Bird/get_aviary',
        method: "POST",
        data: {},
        dataType: "JSON",
        success: function (data) {
            var a_html = '<option value="">Select Aviary</option>';
            for (let index = 0; index < data.length; index++) {
                a_html += "<option value=" + data[index].auto_id + ">" + data[index].aviary_name + "</option>";
            }
            $('#aviary_id').html(a_html);

        }

    });
}


$("#aviary_id").on('change', function () {
    var aviary_id = $('#aviary_id').val();

    $.ajax({
        url: BASE_URL + 'Bird/get_cage_listall',
        method: "POST",
        data: { "aviary_id": aviary_id, },
        dataType: "JSON",
        success: function (data) {
            var c_html = '<option value="">Select Cage</option>';
            for (let index = 0; index < data.length; index++) {
                c_html += "<option value=" + data[index].cage + ">" + data[index].cage + "</option>";
            }
            $('#cage').html(c_html);

        }

    });
});

$("#cage").on('change', function () {

    var aviary_id = $('#aviary_id').val();
    var cage = $('#cage').val();
    // alert(cage);
    $.ajax({
        url: BASE_URL + 'Breeding/get_birdspecies_fm',
        method: "POST",
        data: { "aviary_id": aviary_id, "cage_id": cage, },
        dataType: "JSON",
        success: function (data) {
            var s_html = '<option value="">Select Bird Species</option>';
            for (let index = 0; index < data.length; index++) {
                s_html += "<option value=" + data[index].auto_id + ">" + data[index].bird_species + "</option>";
            }
            $('#bird_species').html(s_html);
            // $('#bird_count').val(data.length);

        }

    });

});

$("#bird_species").on('change', function () {

    var cage_id = $('#cage').val();
    var aviary_id = $('#aviary_id').val();
    var species_id = $('#bird_species').val();
    spc_std_weight(species_id);


    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_no',
        method: "POST",
        data: {
            "species_id": species_id,
            "cage_id": cage_id,
            "aviary_id": aviary_id,
        },
        dataType: "JSON",
        success: function (data) {
            var c_html = '<option value="">Select Egg no</option>';
            for (let index = 0; index < data.length; index++) {
                if (data[index].ring_no != "") {
                    c_html += "<option value=" + data[index].egg_no + ">" + data[index].egg_no + "</option>";
                }
            }
            $('#egg_no').html(c_html);

        }

    });

});
function spc_std_weight(species_id) {
    $.ajax({
        url: BASE_URL + 'Bird/get_birdfeed_fm',
        method: "POST",
        data: { "species_id": species_id },
        dataType: "JSON",
        success: function (data) {
            $('#std_egg_weight').val(data[0].std_egg_weight);
            //  $('#std_hatch_weight').val(data[0].std_hatch_weight);

        }

    });
}
$("#egg_no").on('change', function () {
    var egg_no = $(this).val();
    //  alert(egg_no);
    // get_clutch(egg_no);
    $.ajax({
        url: BASE_URL + 'Healthcare/get_egg_details',
        method: "POST",
        data: {
            "egg_no": egg_no,
        },
        dataType: "JSON",
        success: function (data) {
            $('#dis_date').val(data.full_egg_result[0].dis_date);
            $('#dis_type').val(data.full_egg_result[0].dis_type);
            $('#mp_ring').val(data.full_egg_result[0].male_parent_ringno);
            $('#fp_ring').val(data.full_egg_result[0].female_parent_ringno);
            $('#egg_weight').val(data.full_egg_result[0].egg_weight);
            $('#egg_shell_weight').val(data.full_egg_result[0].shell_weight);
            $('#egg_shell_thick').val(data.full_egg_result[0].shell_thick);

            $('#clutch_no').val(data.clutch_no[0].clutch_no);
            $('#egg_no_clutch').val(data.eggno_in_clutch[0].eggno_in_clutch);
            //  var mp_ring = data.full_egg_result[0].male_parent_ringno;
            //  var fp_ring = data.full_egg_result[0].female_parent_ringno;
            //  get_parents_history(mp_ring,fp_ring)    
            // get_parents_history() 
        }

    });

});

function get_parents_history() {
    var mp_ring = $('#mp_ring').val();
    var fp_ring = $('#fp_ring').val();
    $('#history_modal').modal("show");
    $.ajax({
        url: BASE_URL + 'Healthcare/get_parents_history',
        method: "POST",
        data: {
            "mp_ring": mp_ring,
            "fp_ring": fp_ring,
        },
        dataType: "JSON",
        success: function (data) {
            // console.log(data);
            // alert(data.length);
            var tot = "Total clutch:" + data.length;
            $('#total_clutch').html(tot);

            var tb_html = "";
            for (var i = 0; i < data.length; i++) {
                // alert(i);
                tb_html += "<tr>";
                tb_html += "<td>" + data[i].clutch_no + "</td>";
                tb_html += "<td>" + data[i].egg_hatch + "</td>";
                tb_html += "<td>" + data[i].eggs_if + "</td>";
                tb_html += "<td>" + data[i].eggs_dis + "</td>";
                tb_html += "<td> mid </td>";
                tb_html += "<td>" + data[i].eggs_broken + "</td>";
                tb_html += "<td>" + data[i].total_eggs + "</td>";
                tb_html += '</tr>';
                //console.log(i);
            }
            $('#get_his').html(tb_html);
            // alert("test");
        }

    });

}

$('#shell_form').submit(function (e) {
    var formData = new FormData(this);
    e.preventDefault();
    // alert(formData );
    $.ajax({
        url: BASE_URL + 'Healthcare/add_shell_register',
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",

        success: function (data) {
            if (data.logstatus == 'success') {

                $.Notification.autoHideNotify(
                    'success',
                    'top right',
                    'Added Successfully..!',
                    ''
                );
                setTimeout(
                    function () {
                        window.location = BASE_URL + data.url;
                    },
                    2000);

            }
            else {
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