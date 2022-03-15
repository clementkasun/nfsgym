@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')

@endsection
@section('content')
<section class="content-header">
    <div class="card card-light">
        <div class="row">
            <div class="col-md-12 p-5">
                <div class="row">
                    <div class="col-md-3">
                        <form id="contact_form">
                            <div class="form-group">
                                <label for="tel_no">Telephone Number:</label>
                                <div><input type="number" class="form-control" id="tel_no" name="tel_no" placeholder="Type telephone number" minlength="10" maxlength="10" required></div><br>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary mt-2" id="add_number">Add Number</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_list">Contact List:</label>
                            <table class="table table-bordered" id="contact_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Telephone Number</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <span id="pages"></span>
                            <textarea class="form-control" id="message" rows="8" cols="50" maxlength="500" oninput="message_count()" placeholder="Enter message here" required></textarea>
                        </div>
                        <button type="button" class="btn btn-success" id="send_sms">Send SMS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pageScripts')
<!-- Page script -->

<!-- date-range-picker -->
<script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('/js/Dashboard/dashboard.js')}}"></script>
<script src="{{asset('/js/Dashboard/dashboard.js')}}"></script>

<script>
    $('#send_sms').click(function() {
        let table_length = $("#contact_list tbody").children().length;
        let message_length = $('#message').val();

        if (table_length != 0) {
            if (message_length != '') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Message will be send!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send message!'
                }).then((result) => {
                    if (result.value) {
                        var d = {
                            contacts: contact_list,
                            message: $("#message").val()
                        };
                        send_sms(d);
                    }
                })
            } else {
                Swal.fire({
                    title: 'Message can\'t be empty',
                    text: "Please type some message to send!",
                    icon: 'warning',
                });
            }
        } else {
            Swal.fire({
                title: 'Contact List can\'t be empty',
                text: "Please add number to contact list!",
                icon: 'warning',
            });
        }

    });

    function message_count() {
        var message_length = $("#message").val().length;
        let pages = parseInt(message_length / 159);
        $('#pages').html(pages + '/' + message_length);
    }

    const contact_list = [];
    const added_list = [];

    $('#add_number').click(function() {
        var is_valid = jQuery("#contact_form").valid();
        if (is_valid) {
            let tel_no = $('#tel_no').val();
            contact_list.push(tel_no);
            load_contact_tbl();
            $('#tel_no').val('');
        }
    });

    $('#add_contacts').click(function() {
        $('#contact_list_fil tbody tr td:nth-child(4)').each(function() {
            let check_status = $(this).find('input').is(":checked");
            let contact = $(this).find('input').data('contact');
            if (check_status && $.inArray(contact, added_list) == -1) {
                if (contact != null && contact != '') {
                    added_list.push(contact);
                } else {
                    Swal.fire({
                        title: 'Empty contact number',
                        text: "Selected record doesn\'t have contact number!",
                        icon: 'warning',
                    });
                }
            }
        });

        load_selected_contacts();
    });

    $(document).on('click', '.del', function() {
        let index = $(this).data('index');
        contact_list.splice(index, 1);
        load_contact_tbl();
    });

    $(document).on('click', '.del_sel', function() {
        let index = $(this).data('index');
        added_list.splice(index, 1);
        load_selected_contacts();
    });

    function load_contact_tbl() {
        $("#contact_list tbody").html('');
        let i;
        $.each(contact_list, function(key, val) {
            i = key;
            let dmarkup = "<tr><td>" + (++i) + "</td><td>" + val + "</td><td><button class='btn btn-danger del' data-index=" + (key) + ">Remove</button></td></tr>";
            $("#contact_list tbody").append(dmarkup);
        });
    }

    function load_selected_contacts() {
        $("#added_list tbody").html('');
        let i;
        $.each(added_list, function(key, val) {
            i = key;
            let markup = "<tr><td>" + (++i) + "</td><td>" + val + "</td><td><button class='btn btn-danger del_sel' data-index=" + (key) + ">Remove</button></td></tr>";
            $("#added_list tbody").append(markup);
        });
    }

    function send_sms(d, callBack) {
        ajaxRequest('POST', '/api/send_sms', d, function(response) {
            if (response.status == 1) {
                Swal.fire({
                    title: 'Message sent',
                    text: "Message sent successfully!",
                    icon: 'success',
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: "Message not sent!",
                    icon: 'error',
                });
            }
        });
    }

    var contact_valid_rule;
    contact_valid_rule = $("#contact_form").validate({
        errorClass: "invalid",
        rules: {
            tel_no: {
                valid_lk_phone: true,
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    jQuery.validator.setDefaults({
        errorElement: "span",
        ignore: ":hidden:not(select.chosen-select)",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            if (element.prop("type") === "checkbox") {
                //                error.insertAfter(element.parent("label"));
                error.appendTo(element.parents("validate-parent"));
            } else if (element.is("select.chosen-select")) {
                error.insertAfter(element.siblings(".chosen-container"));
            } else if (element.prop("type") === "radio") {
                error.appendTo(element.parents("div.validate-parent"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            jQuery(element).parents(".validate-parent").addClass("has-error").removeClass("has-success");
        },
        unhighlight: function(element, errorClass, validClass) {
            jQuery(element).parents(".validate-parent").removeClass("has-error");
        }
    });
    jQuery.validator.addMethod("valid_lk_phone", function(value, element) {
        return this.optional(element) || /^0[7][0-9]{8}$/.test(value);
    }, "Please enter a valid phone number");
</script>
@endsection