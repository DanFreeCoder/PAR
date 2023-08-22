<script>
    //Datatable
    $(document).ready(function() {
        //dataTables
        $('#approverTable').DataTable();
        $('#employeeTable').DataTable();
        $('#btnUpdate').hide();
        $('#user_success').hide();
        $('#user_warning').hide();
        $('#btnUpdateUser').hide();
        $('#btnCancel').hide();
        //datepicker
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "MM dd, yyyy",
            setDate: new Date(),
            autoClose: true
        });

        // auto change '&' to 'and'
        $("textarea").keyup(function() {
            var text = $(this).val();
            var special = new RegExp('&');
            if (special.test(text)) {
                var result = text.replace("&", "and");
                $(this).val(result)
            }
        });

        // auto change '&' to 'and'
        $("input").keyup(function() {
            var text = $(this).val();
            var special = new RegExp('&');
            if (special.test(text)) {
                var result = text.replace("&", "and");
                $(this).val(result)
            }
        });

    });

    //toast
    function showToast() {
        var title = 'Loading...';
        var duration = 500;
        $.Toast.showToast({
            title: title,
            duration: duration,
            image: '../../images/loading.gif'
        });
    }

    function hideLoading() {
        $.Toast.hideToast();
    }
    //save new user
    $('#btnSave').on('click', function(e) {
        e.preventDefault();

        var firstname = $('#add_firstname').val();
        var lastname = $('#add_lastname').val();
        var position = $('#add_position').val();
        var project = $('#add_project').val();
        var date_hire = $('#add_date-hire').val();
        var email = $('#add_email').val();
        var username = $('#add_username').val();
        var access = $('#add_access').val();
        var role = $('#add_role').val();
        var dept = $('#department').val();
        var myData = 'firstname=' + firstname + '&lastname=' + lastname + '&position=' + position + '&project=' + project + '&date_hire=' + date_hire + '&email=' + email + '&username=' + username + '&access=' + access + '&role=' + role + '&dept=' + dept;

        if (firstname != '' && lastname != '' && date_hire != '' && position != '' && project != '' && email != '' && access != 0) {
            $.ajax({
                type: 'POST',
                url: '../../controls/save_user.php',
                data: myData,
                beforeSend: function() {
                    showToast();
                },
                success: function(response) {
                    if (response > 0) {
                        //check if user added is approver/employee
                        if (access == 6) {
                            $.ajax({
                                url: '../../controls/view_all_user.php',
                                success: function(html) {
                                    $('#empTBLbody').html(html);
                                    toastr.success('Congratulations! User account successfully created.');
                                }
                            })
                        } else {
                            $.ajax({
                                url: '../../controls/view_all_approver.php',
                                success: function(html) {
                                    $('#appTBLbody').html(html);
                                    toastr.success('Congratulations! User account successfully created.');
                                }
                            })
                        }
                    } else {
                        toastr.error('ERROR! Failed to submit. Please contact the system administrator at local 124.');
                    }
                }
            })
        } else {
            toastr.error('ERROR! Update failed. Please fill out all the data needed.');
        }
    })

    //Update user detail
    $('.edit').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../../controls/view_user_byID.php',
            data: {
                id: id
            },
            beforeSend: function() {
                showToast();
            },
            success: function(html) {
                $('#updUserModal').modal('show');
                $('#user-body-modal').html(html);
            }
        })
    })

    //btnEdit event handler
    $('#btnEdit').on('click', function(e) {
        e.preventDefault();
        $('#btnLog-out').hide();
        $(this).hide();
        $('#btnUpdateUser').show();
        $('#btnCancel').show();
        //enable all fields
        $('#firstname').prop('disabled', false);
        $('#lastname').prop('disabled', false);
        $('#position').prop('disabled', false);
        $('#project').prop('disabled', false);
        $('#date-hire').prop('disabled', false);
        $('#password').prop('disabled', false);
        $('#password2').prop('disabled', false);
    });
    //btnCancel event handler
    $('#btnCancel').on('click', function(e) {
        e.preventDefault();
        $('#btnLog-out').show();
        $('#btnEdit').show();
        $(this).hide();
        $('#btnUpdateUser').hide();
        $('#btnCancel').hide();
        //enable all fields
        $('#firstname').prop('disabled', true);
        $('#lastname').prop('disabled', true);
        $('#position').prop('disabled', true);
        $('#project').prop('disabled', true);
        $('#date-hire').prop('disabled', true);
        $('#password').prop('disabled', true);
        $('#password2').prop('disabled', true);
    });
    //Update User details
    $('#btnUserUpdate').on('click', function(e) {
        e.preventDefault();

        var id = $('#upd_id').val();
        var firstname = $('#upd_firstname').val();
        var lastname = $('#upd_lastname').val();
        var position = $('#upd_position').val();
        var project = $('#upd_project').val();
        var date_hire = $('#upd_date-hire').val();
        var email = $('#upd_email').val();
        var dept = $('#upd_dept').val();
        var username = $('#upd_username').val();
        var access = $('#upd_access').val();
        var role = $('#upd_role').val();
        var action = 3;

        var myData = 'id=' + id + '&firstname=' + firstname + '&lastname=' + lastname + '&position=' + position + '&project=' + project + '&date_hire=' + date_hire + '&username=' + username + '&email=' + email + '&dept=' + dept + '&access=' + access + '&role=' + role + '&action=' + action;

        if (firstname != '' && lastname != '') {
            $.ajax({
                type: 'POST',
                url: '../../controls/update_user.php',
                data: myData,
                beforeSend: function() {
                    showToast();
                },
                success: function(response) {
                    if (response > 0) {
                        toastr.success('User details are now updated.');
                    } else {
                        toastr.error('ERROR! Update Failed. Please contact the system Administrator at local 124.');
                    }
                }
            })
        } else {
            toastr.error('ERROR! Please fill out all the data needed.');
        }
    })

    //Reset account password
    $('.reset').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../../controls/reset_user.php',
            data: {
                id: id
            },
            beforeSend: function() {
                showToast();
            },
            success: function(response) {
                if (response > 0) {
                    toastr.success('NOTICE:<br> User account reset successfull.');
                    $.ajax({
                        url: '../../controls/view_all_user.php',
                        success: function(html) {
                            $('#listbody').html(html);
                            $('#upd_success').html("<center><i class='fa fa-check menu-icon'></i> User Details successfully updated.</center>");
                            $('#upd_success').show();
                            setTimeout(function() {
                                $('#upd_success').fadeOut();
                            }, 3000)
                        }
                    })
                } else {
                    toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                }
            }
        })
    })

    //remove or deactivate user account
    $('.remove').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../../controls/remove_user.php',
            data: {
                id: id
            },
            beforeSend: function() {
                showToast();
            },
            success: function(response) {
                if (response > 0) {
                    toastr.success('NOTICE:<br>User successfully removed.');
                    $.ajax({
                        url: '../../controls/view_all_user.php',
                        success: function(html) {
                            $('#listbody').html(html);
                            $('#upd_success').html("<center><i class='fa fa-check menu-icon'></i> User Details successfully updated.</center>");
                            $('#upd_success').show();
                            setTimeout(function() {
                                $('#upd_success').fadeOut();
                            }, 3000)
                        }
                    })
                } else {
                    toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                }
            }
        })
    })

    //auto generate username event handler
    $('#add_lastname').blur(function(e) {
        e.preventDefault();

        var str = $('#add_firstname').val();
        var fname = str.replace(/\s/g, '');
        var f = fname.toLowerCase();
        var str1 = $('#add_lastname').val();
        var lname = str1.replace(/\s/g, '');
        var l = lname.toLowerCase();
        var username = f.concat('.').concat(l);
        $('#add_username').val(username);
    })

    $('#add_firstname').blur(function(e) {
        e.preventDefault();

        var str = $('#add_firstname').val();
        var fname = str.replace(/\s/g, '');
        var f = fname.toLowerCase();
        var str1 = $('#add_lastname').val();
        var lname = str1.replace(/\s/g, '');
        var l = lname.toLowerCase();
        var username = f.concat('.').concat(l);
        $('#add_username').val(username);
    })
    //logout
    function logout() {
        showToast();
        location.href = '../../controls/logout.php';
    }
</script>