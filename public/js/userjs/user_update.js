function loadUserPrevilages(id, roll_id) {
    $(".roleCombo").val(roll_id);
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/actions/user/Privileges/" + id,
        contentType: false,
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            // alert(JSON.stringify(result));
            $('.read').prop('checked', false);
            $('.write').prop('checked', false);
            $('.update').prop('checked', false);
            $('.delete').prop('checked', false);
            if (result.length > 0) {
                $.each(result, function (key, value) {

                    if ($("#pre" + value.id).length == 1) {

                        if (value.pivot.is_read == 1) {

                            $("#pre" + value.id + " .read").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .read").prop('checked', false);
                        }
                        if (value.pivot.is_create == 1) {

                            $("#pre" + value.id + " .write").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .write").prop('checked', false);
                        }
                        if (value.pivot.is_update == 1) {

                            $("#pre" + value.id + " .update").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .update").prop('checked', false);
                        }
                        if (value.pivot.is_delete == 1) {

                            $("#pre" + value.id + " .delete").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .delete").prop('checked', false);
                        }

                    } else {
                        alert('Error Previlage table not found');
                    }
                });
            } else {
                console.log('No Privileges');
            }
            // alert(JSON.stringify(result));
            console.log(result);
        }
    });
}

function loadPrevilages(id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
            "Accept": "application/json"
        },
        url: "/actions/rolls/rollPrivilege/" + id,
        contentType: false,
        dataType: "json",
        cache: false,
        processDaate: false,
        success: function (result) {
            // alert(JSON.stringify(result));
            $('.read').prop('checked', false);
            $('.write').prop('checked', false);
            $('.update').prop('checked', false);
            $('.delete').prop('checked', false);
            if (result.length > 0) {
                $.each(result, function (key, value) {

                    if ($("#pre" + value.id).length == 1) {

                        if (value.pivot.is_read == 1) {

                            $("#pre" + value.id + " .read").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .read").prop('checked', false);
                        }
                        if (value.pivot.is_create == 1) {

                            $("#pre" + value.id + " .write").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .write").prop('checked', false);
                        }
                        if (value.pivot.is_update == 1) {

                            $("#pre" + value.id + " .update").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .update").prop('checked', false);
                        }
                        if (value.pivot.is_delete == 1) {

                            $("#pre" + value.id + " .delete").prop('checked', true);
                        } else {
                            $("#pre" + value.id + " .delete").prop('checked', false);
                        }

                    } else {
                        alert('Error Previlage table not found');
                    }
                });
            } else {
                console.log('No Privileges');
            }
            // alert(JSON.stringify(result));
            console.log(result);
        }
    });
}