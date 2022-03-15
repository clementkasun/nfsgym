function loadDashInfo() {
    url = "/actions/get_count_all/";

    ajaxRequest("get", url, null, function(result) {
        $('#user_count').val(result.inst_user_count);
       
    });
}