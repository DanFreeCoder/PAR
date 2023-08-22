<script>
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
  //view draft PAR new tab
  $('.draft-par').on('click', function(e) {
    e.preventDefault();
    var par_id = $(this).attr('value');
    window.open('draft_par.php?id=' + par_id, '_blank');
  })
  //view unevaluated employee PAR in new tab
  $('.view-par').on('click', function(e) {
    e.preventDefault();
    var par_id = $(this).attr('value');
    window.open('uneval_par.php?id=' + par_id, '_blank');
  })
  //view draft review PAR new tab
  $('.draft-review-par').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('value');
    window.open('draft_eval_par.php?id=' + id, '_blank');
  })
  //view evaluated employee PAR in new tab
  $('.eval-par').on('click', function() {

    var par_id = $(this).attr('value');
    window.open('eval_par.php?id=' + par_id, '_blank');
  })
  //print uneval employee PAR
  $('.print-unevalPAR').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('value');
    window.open('../../print/form/printUnEvalPAR.php?id=' + id, '_blank');
  })
  //print eval employee PAR
  $('.print-evalPAR').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('value');
    window.open('../../print/form/printEvalPAR.php?id=' + id, '_blank');
  })
  //print approved employee PAR
  $('.print-approvedPAR').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('value');
    window.open('../../print/form/printEvalPAR.php?id=' + id, '_blank');
  })
  //APPROVE PAR EVENT HANDLER
  //view evaluated employee PAR in new tab
  $('.approve-par').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('value');

    $.ajax({
      type: 'POST',
      url: '../../controls/approved_par.php',
      data: {
        id: id
      },

      success: function(response) {
        if (response > 0) {
          //view the latest list(FOR FINAL APPROVAL))
          $.ajax({
            url: '../../controls/view_for_finalApproval.php',
            success: function(html) {
              $('#evaluatedTable-body').fadeOut();
              $('#evaluatedTable-body').fadeIn();
              $('#evaluatedTable-body').html(html);
            }
          })
          //view the latest list(APPROVED)
          $.ajax({
            url: '../../controls/view_approved_par.php',
            success: function(html) {
              $('#approvedTable-body').fadeOut();
              $('#approvedTable-body').fadeIn();
              $('#approvedTable-body').html(html);
            }
          })
          toastr.success('Employee PAR successfully Approved & ready for printing.');
        } else {
          toastr.danger('Approve Failed. Please contact the system administrator at local 124.')
        }
      }
    })
  })
  //hide the Update button on users menu
  $(document).ready(function() {
    //dataTables
    $('#unEvalTable').DataTable();
    $('#evalTable').DataTable();
    $('#approvedTable').DataTable();
    $('#draftEvalTable').DataTable();
    $('#draftTable').DataTable();
    $('#submittedTable').DataTable();
    $('#btnUpdateUser').hide();
    $('#btnCancel').hide();
  });
  //btnEdit event handler
  $('#btnEdit').on('click', function(e) {
    e.preventDefault();
    $('#btnLog-out').hide();
    $(this).hide();
    $('#btnUpdateUser').show();
    $('#btnCancel').show();
    //enable all fields
    $('#user-firstname').attr('disabled', false);
    $('#user-lastname').attr('disabled', false);
    $('#user-position').attr('disabled', false);
    $('#user-project').attr('disabled', false);
    $('#user-date-hire').attr('disabled', false);
    $('#user-email').attr('disabled', false);
    $('#password').attr('disabled', false);
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
    $('#user-firstname').attr('disabled', true);
    $('#user-lastname').attr('disabled', true);
    $('#user-position').attr('disabled', true);
    $('#user-project').attr('disabled', true);
    $('#user-date-hire').attr('disabled', true);
    $('#user-email').attr('disabled', true);
    $('#password').attr('disabled', true);
  });
  //Update User details
  $('#btnUpdateUser').on('click', function(e) {
    e.preventDefault();

    var id = $('#id').val();
    var firstname = $('#user-firstname').val();
    var lastname = $('#user-lastname').val();
    var position = $('#user-position').val();
    var project = $('#user-project').val();
    var date_hire = $('#user-date-hire').val();
    var email = $('#user-email').val();
    var dept = $('#dept').val();
    var username = $('#user-username').val();
    var password = $('#password').val();
    var access = $('#access').val();
    var role = $('#role').val();

    if (password == null || password == '') {
      var action = 2;
    } else {
      var action = 1;
    }

    var myData = 'id=' + id + '&firstname=' + firstname + '&lastname=' + lastname + '&position=' + position + '&project=' + project + '&date_hire=' + date_hire + '&username=' + username + '&password=' + password + '&email=' + email + '&dept=' + dept + '&access=' + access + '&role=' + role + '&action=' + action;

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
            $('#notificationModal').modal({
              backdrop: 'static',
              keyboard: false
            });
            $('#notificationModal').modal('show');
          } else {
            toastr.error('ERROR! Update Failed. Please contact the system Administrator at local 124.');
          }
        }
      })
    } else {
      toastr.error('ERROR! Please fill out all the data needed.');
    }
  })
  //auto generate username
  $('#user-firstname').blur(function(e) {
    e.preventDefault();
    var str = $('#user-firstname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#user-lastname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var username = f.concat('.').concat(l);
    $('#user-username').val(username);
  })

  $('#user-lastname').blur(function(e) {
    e.preventDefault();
    var str = $('#user-firstname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#user-lastname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var username = f.concat('.').concat(l);
    $('#user-username').val(username);
  })
  //logout
  function logout() {
    showToast();
    location.href = '../../controls/logout.php';
  }
</script>