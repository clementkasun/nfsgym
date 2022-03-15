function loadDistrictCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_district/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.value) {
                    option += '<option value="' + row.value + '" selected>' + row.label + '</option>';
                } else {
                    option += '<option value="' + row.value + '">' + row.label + '</option>';
                }
            });
        }
        $('.district').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadDsCombo(district_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_ds/id/" + district_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.value) {
                    option += '<option value="' + row.value + '" selected>' + row.label + '</option>';
                } else {
                    option += '<option value="' + row.value + '">' + row.label + '</option>';
                }
            });
        }
        $('.ds_name').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}


function loadGndivisionCombo(ds_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_gn_by_id/id/" + ds_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.gn_name + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.gn_name + '</option>';
                }
            });
        }
        $('.gn').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadNationalitiesCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_nationalities/", null, function(resp) {

        if (resp.length == 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {

                    option += '<option value="' + row.id + '" selected>' + row.nationality + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.nationality + '</option>';
                }
            });
        }
        $('.nationality').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadReligionsCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_religions/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {

                    option += '<option value="' + row.id + '" selected>' + row.religion + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.religion + '</option>';
                }
            });
        }
        $('.religion').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadBanksCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_banks/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {

                    option += '<option value="' + row.id + '" selected>' + row.bank_name + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.bank_name + '</option>';
                }
            });
        }
        $('.bank').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadworkingPlacesCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_places/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {

                    option += '<option value="' + row.id + '" selected>' + row.working_place + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.working_place + '</option>';
                }
            });
        }
        $('.working_place').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadworkingPlacesComboByPost(post_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_places_by_post/post/" + post_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {

                    option += '<option value="' + row.id + '" selected>' + row.working_place + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.working_place + '</option>';
                }
            });
        }
        $('.working_place').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadworkingPlacesByPayrollCombo(payroll_type, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_places_by_payroll_type/payroll_type/" + payroll_type, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += '<option value="' + row.id + '">' + row.working_place + '</option>';
            });
        }
        $('.working_place').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}


function LoadworkingPlacesByPayrollWithSelCombo(payroll_type, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_places_by_payroll_type/payroll_type/" + payroll_type, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += '<option value="' + row.id + '">' + row.working_place + '</option>';
            });
        }
        $('.working_place').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadPayrollType(callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_payroll_types/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += '<option value="' + row.id + '">' + row.payroll_type + '</option>';
            });
        }
        $('.payroll_type').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadEmployeeCombo(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_all_emp/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.name_with_initials + ' ' + row.emp_no + ' ' + row.epf_etf_no + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.name_with_initials + ' - ' + row.emp_no + ' - ' + row.epf_etf_no + '</option>';
                }
            });
        }
        $('.work_employess').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadEmpByPostCombo(post_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_post/post/" + post_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option value=''>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    if (row.epf_etf_no != null) {
                        option += '<option value="' + row.id + '" selected>' + row.name_with_initials + ' - ' + row.emp_no + ' - ' + row.epf_etf_no + '</option>';
                    } else {
                        option += '<option value="' + row.id + '" selected>' + row.name_with_initials + ' - ' + row.emp_no + '</option>';
                    }
                } else {
                    if (row.epf_etf_no != null) {
                        option += '<option value="' + row.id + '">' + row.name_with_initials + ' - ' + row.emp_no + ' - ' + row.epf_etf_no + '</option>';
                    } else {
                        option += '<option value="' + row.id + '">' + row.name_with_initials + ' - ' + row.emp_no + '</option>';
                    }
                }
            });
        }
        $('.work_employess').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadEmpComboByWorkPlace(working_place_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_work_place/work_place_id/" + working_place_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option value=''>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.name_with_initials + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.name_with_initials + '</option>';
                }
            });
        }
        $('.emp').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadEmpByPayroll(payroll_type_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_payroll_type/payroll_type/" + payroll_type_id, null, function(resp) {
        if (resp.length === 0) {
            option = "<option value=''>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    if (row.epf_etf_no != null) {
                        option += '<option value="' + row.id + '" selected>' + row.name_with_initials + ' - ' + row.emp_no + ' - ' + row.epf_etf_no + '</option>';
                    } else {
                        option += '<option value="' + row.id + '" selected>' + row.name_with_initials + ' - ' + row.emp_no + '</option>';
                    }
                } else {
                    if (row.epf_etf_no != null) {
                        option += '<option value="' + row.id + '">' + row.name_with_initials + ' - ' + row.emp_no + ' - ' + row.epf_etf_no + '</option>';
                    } else {
                        option += '<option value="' + row.id + '">' + row.name_with_initials + ' - ' + row.emp_no + '</option>';
                    }
                }
            });
        }
        $('.work_employess').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadPayrollTypeComboById(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_payroll_types/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.payroll_type + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.payroll_type + '</option>';
                }
            });
        }
        $('#payroll_type').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadPayrollTypeComboByClass(selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_payroll_types/", null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.payroll_type + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.payroll_type + '</option>';
                }
            });
        }
        $('.payroll_type').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadEmpCombo(post, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_post/post/" + post, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.name_with_initials + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.name_with_initials + '</option>';
                }
            });
        }
        $('.emp').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadLoanCombo(post, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_loan_by_post/post/" + post, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.name + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.name + '</option>';
                }
            });
        }
        $('.loan').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadEmpComboById(post, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_post/post/" + post, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.name_with_initials + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.name_with_initials + '</option>';
                }
            });
        }
        $('#emp').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadworkingPlacesComboById(post_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_places_by_post/post/" + post_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.working_place + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.working_place + '</option>';
                }
            });
        }
        $('#working_place').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function LoadPostComboByPayroll(payroll_type_id, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_post_by_payroll_type/id/" + payroll_type_id, null, function(resp) {
        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                option += '<option value="' + row.id + '">' + row.post_name + '</option>';
            });
        }
        $('#post').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadPostComboId(payroll_type_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_post_by_payroll_type/id/" + payroll_type_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option value=''>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.post_name + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.post_name + '</option>';
                }
            });
        }
        $('#post').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadPostCombo(payroll_type_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_post_by_payroll_type/id/" + payroll_type_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option value="' + row.id + '" selected>' + row.post_name + '</option>';
                } else {
                    option += '<option value="' + row.id + '">' + row.post_name + '</option>';
                }
            });
        }
        $('.post').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}

function loadEmpComboByWorkPlaceWithPost(working_place_id, selected, callBack) {
    let option = '';
    ajaxRequest("GET", "/actions/get_emp_by_work_place_post/work_place_id/" + working_place_id, null, function(resp) {

        if (resp.length === 0) {
            option = "<option value=''>No Data Found</option>";
        } else {
            $.each(resp, function(index, row) {
                if (!isNaN(parseInt(selected)) && selected == row.id) {
                    option += '<option data-post="' + row.post_id + '" value="' + row.id + '" selected>' + row.name_with_initials + ' - ' + row.post.post_name + '</option>';
                } else {
                    option += '<option data-post="' + row.post_id + '" value="' + row.id + '">' + row.name_with_initials + ' - ' + row.post.post_name + '</option>';
                }
            });
        }
        $('.emp').html(option);
        if (typeof callBack !== 'undefined' && callBack !== null && typeof callBack === "function") {
            callBack();
        }
    });
}