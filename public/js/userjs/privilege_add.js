function save_privillege(data) {
    let url = '/actions/save_privillege';
    ajaxRequest('POST', url, data, function (returndata) {
        if (returndata.status == 1) {
            swal.fire('success', 'Successfully save the privilege');
            load_privillege_tbl();
            $('#privillege_name').val('');
        } else {
            swal.fire('failed', 'Privilege saving is unsuccessfull');
        }
    });
}

function update_privillege(id, data) {
    let url = '/actions/update_privillege/id/' + id;
    ajaxRequest('POST', url, data, function (returndata) {
        if (returndata.status == 1) {
            swal.fire('success', 'Successfully updated the privilege');
            load_privillege_tbl();
            $('#privillege_name').val('');
            $('#privillege_update').addClass('d-none');
            $('#privillege_add').removeClass('d-none');
        } else {
            swal.fire('failed', 'Privilege updating is unsuccessfull');
        }
    });
}

function delete_privillege(id) {
    let url = '/actions/delete_privillege/id/' + id;
    ajaxRequest('DELETE', url, null, function (returndata) {
        if (returndata.status == 1) {
            swal.fire('success', 'Successfully delete the privilege');
            load_privillege_tbl();
        } else {
            swal.fire('failed', 'Privilege deleting is unsuccessfull');
        }
    });
}

//load function for registered emp details
function load_privillege_tbl(callBack) {
    privillege_list = $('#privillege_tbl').DataTable({
        "destroy": true,
        "processing": true,
        "colReorder": true,
        "serverSide": false,
        "stateSave": true,
        "pageLength": 10,
        language: {
            searchPlaceholder: "Search..."
        },
        "ajax": {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": "/actions/get_privilleges",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [{
            "data": ""
        },
        {
            "data": "name",
            "defaultContent": "-"
        },
        {
            "data": "id"
        }
        ],
        "columnDefs": [{
            "targets": -1,
            "data": "0",
            "render": function (data, type, full, meta) {
                return getJtableBtnHtml(full);
            }
        }],
        "order": [
            [0, "asc"]
        ],
    });
    $(function () {
        var t = $("#privillege_tbl").DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
        });
        t.on('order.dt search.dt', function () {
            t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
    //data table error handling
    $.fn.dataTable.ext.errMode = 'none';
    $('#privillege_tbl').on('error.dt', function (e, settings, techNote, message) {
        console.log('DataTables error: ', message);
    });
}

function getJtableBtnHtml(full) {
    var html = '';
    html += '<div class="btn-group" role="group"  aria-label="" >';
    html += '<button type="button" class="btn btn-primary edit" value="' + full["id"] + '" data-toggle="tooltip" title="Delete"><i class="fa fa-edit" aria-hidden="true"></i></button>';
    html += '<button type="button" class="btn btn-danger delete" value="' + full["id"] + '" data-toggle="tooltip" title="Edit"><i class="fa fa-trash" aria-hidden="true"></i></button>';
    html += '</div>';
    return html;
}