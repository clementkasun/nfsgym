function loadDistrictCombo(callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_district/", null, function(resp) {

        if (resp.length == 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += "<option value='" + row.value + "'>" + row.label + "</option>";
            });
        }
        $('#ins_districts').html(option);
        if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
            callBack();
        }
    });
}

function hello() {
    alert("hello");
}


function loadDsdivisionCombo(district_id, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_ds_division/" + district_id, null, function(resp) {

        if (resp.length == 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += "<option value='" + row.value + "'>" + row.label + "</option>";
            });
        }
        $('#divisional_sec_divisions_id').html(option);
        if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
            callBack();
        }
    });
}