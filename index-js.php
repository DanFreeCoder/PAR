<script>
	$(document).ready(function() {
		$('#user_warning').hide();
		$('#user_success').hide();
		//datepicker
		$('.datepicker').datepicker({
			clearBtn: true,
			format: "MM dd, yyyy",
			setDate: new Date(),
			autoClose: true
		});

		$('#btnSubmit').on('click', function() {
			var email = $('#enter_email').val();

			if (email != '') {
				$.ajax({
					type: 'POST',
					url: 'controls/recover_user.php',
					data: {
						email: email
					},

					success: function(response) {
						if (response > 0) {
							toastr.success("Please check your IGC email for confirmation.");
						} else {
							toastr.error(`The Email you've entered does not exist.`);
						}
					}
				})
			} else {
				toastr.error("Please fill out the field.");
			}
		})

		//accounting Dept units event handler
		var id = 1;
		$.ajax({
			type: 'POST',
			url: 'controls/get_unit.php',
			data: {
				id: id
			},
			success: function(html) {
				$('#sel_project').html(html);
			}
		})
	})
	//toast
	function showToast() {
		var title = 'Loading...';
		var duration = 500;
		$.Toast.showToast({
			title: title,
			duration: duration,
			image: 'images/loading.gif'
		});
	}

	function hideLoading() {
		$.Toast.hideToast();
	}

	//event handler bntLogin
	$('#password').keyup(function(event) {
		if (event.keyCode === 13) {
			$('#btnLogin').click();
		}
	});
	//save user 
	$('#btnSave').on('click', function(e) {
		e.preventDefault();
		var firstname = $('#add_firstname').val();
		var lastname = $('#add_lastname').val();
		var position = $('#add_position').val();
		var date_hire = $('#add_date-hire').val();
		var email = $('#add_email').val();
		var username = $('#add_username').val();
		var department = $('#department').val();
		var unit1 = $('#sel_project').val();
		var unit2 = $('#add_project').val();

		//check if dropdown/input has been fill-out
		if (unit1 == '' || unit1 == null) {
			var project = $('#add_project').val();
		} else {
			var project = $('#sel_project').val();
		}
		var myData = 'firstname=' + firstname + '&lastname=' + lastname + '&position=' + position + '&project=' + project + '&date_hire=' + date_hire + '&email=' + email + '&username=' + username + '&department=' + department;

		if (username != '' && lastname != '' && email != '' && position != '' && project != '' && date_hire != '') {
			//check user if exist 
			$.ajax({
				type: 'POST',
				url: 'controls/check_user.php',
				data: myData,
				success: function(response) {
					if (response > 0) {
						toastr.error('Adding Failed! You have already registered in the system. Please contact the system administrator at local 124 for verification.');
					} else {
						//SAVE user in DB
						$.ajax({
							type: 'POST',
							url: 'controls/save_emp_user.php',
							data: myData,
							beforeSend: function() {
								showToast();
							},
							success: function(response) {
								if (response > 0) {
									toastr.success('Congratulations! User account successfully created. Please check your email for confirmation & your password.');
								} else {
									toastr.error('ERROR! Failed to submit. Please contact the system administrator at local 124.');
								}
							}
						})
					}
				}
			})
		} else {
			toastr.error('ERROR! Please fill out all the data needed.');
		}
	})
	//Login
	$('#btnLogin').on('click', function(e) {
		e.preventDefault();

		var username = $('#username').val();
		var password = $('#password').val();
		var myData = 'username=' + username + '&password=' + password;

		if (username = '' || password != '') {
			$.ajax({
				type: 'POST',
				url: 'controls/login.php',
				data: myData,
				beforeSend: function() {
					showToast();
				},
				success: function(response) {
					if (response > 0) {
						window.location = 'controls/checkaccess.php';
					} else {
						toastr.error('Login Failed. Incorrect user credential. Please try again.');
					}
				}
			})
		} else {
			toastr.error('ERROR! Please fill out all the data needed to proceed.');
		}
	})
	//If Department is change event handler
	$('#department').on('change', function() {
		var id = $(this).val();

		$.ajax({
			type: 'POST',
			url: 'controls/get_unit.php',
			data: {
				id: id
			},
			success: function(html) {
				if (html != null || html != '') {
					$('#sel_project').html(html);
					$('#add_project').hide();
					$('#sel_project').show();

				} else {
					$('#sel_project').hide();
					$('#add_project').show();
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

	//get the UNIT per DEPARTMENT
	$('#department').on('change', function() {
		var id = $(this).val();

		$.ajax({
			type: 'POST',
			url: 'controls/get_unit.php',
			data: {
				id: id
			},
			success: function(html) {
				if (html != '') {
					$('#sel_project').html(html);
				} else {
					$('#sel_project').val('');
					$('#sel_project').hide();
					$('#add_project').show();
				}
			}
		})
	})
</script>