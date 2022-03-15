function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2)
        return parts.pop().split(';').shift();
}
function ajaxRequest(Method, url, data, callBack) {

    //    let token = "eyJpdiI6IkhYRjhKdzNqV1VQVTRWRjBJa3RmTmc9PSIsInZhbHVlIjoieGZIcnlLQjcyaUx2OFVFeW1vK3VVcGZieVg5c0dyY1locGUxZURjOWVJOHRYMThRZThZWVA3NENySy8vc2hiRnR2Uy9NN2xhbTRVeHBTWXliRnh4Q2ZiNFpzWmtUeTBML2FMc0lFT3Ixb2RxS2JCcjB6MXhuRnNWdWVuUE96RE0iLCJtYWMiOiI3ZjFlZmQwZWVlYzVjODRkMWVlNWY0ZTY2NzFlMWMzMTJmNWQ1MTE4YzkzNzA0Y2Q4NzNlMzVhNzYwZWM4MDA4In0%3D";
    //    let token ="Bearer " + getCookie('XSRF-TOKEN');
    $.ajax({
        type: Method,
        headers: {
            //            "X-XSRF-TOKEN": token,
            "X-CSRF-TOKEN": $('meta[name=csrf-token]').attr("content"),
            "Accept": "application/json"
        },
        url: url,
        data: data,
        dataType: "json",
        cache: false,
        success: function (result) {
            if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
                callBack(result);
            }
        }, error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status === 401) {
                msg = 'You Dont Have Privilege To Performe This Action!';
            } else if (jqXHR.status === 422) {
                msg = 'Validation Error !';
            } else if (jqXHR.status === 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status === 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            Toast.fire({
                type: 'error',
                title: 'Error</br>' + msg
            });
            //            alert(msg);
            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                callBack(msg);
            }
        }
    });
}

function submitDataWithFile(url, frmDta, callBack, metod = false) {
    let formData = new FormData();
    // populate fields
    $.each(frmDta, function (k, val) {
        formData.append(k, val);
    });
    ulploadFile2(url, formData, function (result) {
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack(result);
        }
    }, metod);
}
function show_mesege(resp_id) {
    if (resp_id.id === 1) {
        Toast.fire({
            type: 'success',
            title: 'Survey MS</br>Success!'
        });
    } else {
        Toast.fire({
            type: 'error',
            title: resp_id.mgs
        });
    }
}
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
});
//Limit Text
function truncate(source, size) {
    return source.length > size ? source.slice(0, size - 1) + "…" : source;
}

function submitSingleDataByPost(submitPage, submitDataName, submitDataValue) {
    $('<form action="' + submitPage + '" method="POST"/>')
            .append($('<input type="hidden" name="' + submitDataName + '" value ="' + submitDataValue + '">'))
            .appendTo($(document.body))
            .submit();
}

function submitByMultipleData(submitPage, ObjecArray) {
    var a = $('<form action="' + submitPage + '" method="POST"/>');
    $.each(ObjecArray, function (key, value) {
        if (typeof value === 'object') {
            if (Object.keys(value).length === 0) {
                alert("Generating..!");
                return false;
            } else {
                $.each(value, function (k, v) {
                    a.append($('<input type="hidden" name="' + key + '[' + v + ']" value="' + v + '">'));


                });
            }
        } else {
            a.append($('<input type="hidden" name="' + key + '" value ="' + value + '">'));
        }

    });
    //    return false;
    a.appendTo($(document.body));
    a.submit();
}
