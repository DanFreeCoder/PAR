<?php
session_start();
	include '../../config/clsConnection.php';
	include '../../objects/clsRater.php';

	$database = new clsConnection();
	$db = $database->connect();

	$rater = new Rater($db);
?>
<!DOCTYPE HTML>
<html lang="eng">
	<head>
		<title>IGC Online-PAR</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/main.css"/>
		<link rel="stylesheet" href="../../assets/datetimepicker/css/bootstrap-datepicker.css">
		<link rel="stylesheet" href="../../assets/toastr/toastr.css">
		<link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
	</head>
	<body id="page-top" class="subpage">
		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../../controls/logout.php">Innogroup <span>Online-PAR</span></a></div>
			</header>
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Web Base</p>
						<h2>Performance Assessment Report</h2>
					</header>
				</div>
			</section>
		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<center><h3>First time to login? Please change your password to secure your account.</h3></center><hr>
							<form method="post" action="#">
								<div class="row uniform">
								<div class="3u 12u$(xsmall)">
										<input type="text" id="username" placeholder="Username" value="<?php echo $_SESSION['username']; ?>" disabled/>
										<input type="text" id="user-id" placeholder="Username" value="<?php echo $_SESSION['id']; ?>" hidden/>
										<input type="text" id="firstname" placeholder="Username" value="<?php echo $_SESSION['firstname']; ?>" hidden/>
										<input type="text" id="lastname" placeholder="Username" value="<?php echo $_SESSION['lastname']; ?>" hidden/>
										<input type="text" id="access" placeholder="Username" value="<?php echo $_SESSION['access']; ?>" hidden/>
										<input type="text" id="role" placeholder="Username" value="<?php echo $_SESSION['role']; ?>" hidden/>
									</div>
									<div class="3u 12u$(xsmall)">
										<input type="password" id="password1" placeholder="Enter your New Password" />
										<b><small id="message" style="color: green; display: none">Password Matched!</small></b>
									</div>
									<div class="3u 12u$(xsmall)">
										<input type="password" id="password2" placeholder="Repeat Password" />
									</div>
									<div class="3u 12u$(xsmall)">
										<button id="btnSubmit" class="button fit"><i class="fa fa-save"></i><b style="color: whitesmoke;"> SAVE</b></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>

			<section id="login-form" class="wrapper style2" style="display: none;">
				<div class="inner">
					<div class="box">
						<div class="content">
							<center><label style="color: green;">Password successfully changed.</label></center>
							<center><h3>Please enter your new password to login.</h3></center><hr>
							<form method="post" action="#">
								<div class="row uniform">
								<div class="3u 12u$(xsmall)">
										
									</div>
									<div class="3u 12u$(xsmall)">
									<input type="text" placeholder="Username" value="<?php echo $_SESSION['username']; ?>" disabled/>
									</div>
									<div class="3u 12u$(xsmall)">
										<input type="password" id="password" placeholder="Enter your new password here" /><br>
										<button id="btnLogin" class="button fit"><i class="fa fa-save"></i><b style="color: whitesmoke;"> LOGIN</b></button>
									</div>
									<div class="3u 12u$(xsmall)">
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					&copy; Innogroup of Companies. All rights reserved 2021.
				</div>
			</footer>
		<!-- Scroll to top -->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fa fa-angle-up"></i>
		</a>
<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.scrollex.min.js"></script>
<script src="../../assets/js/skel.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/datetimepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../../assets/js/jquery.toast.js"></script>
<script src="../../assets/toastr/toastr.js"></script>

<script>
//toast
function showToast(){
  var title = 'Loading...';
  var duration = 500;
  $.Toast.showToast({title: title,duration: duration, image: '../../images/loading.gif'});
}
function hideLoading(){
  $.Toast.hideToast();
}

//check if password match
$('#password1').on('change', function(){
	var password1 = $(this).val();
	var password2 = $('#password2').val();

	if(password1 == password2)
	{
		document.getElementById('message').innerHTML = '<small style="color: green;">Password Match</small>';
		$('#message').fadeIn();
	}
	else
	{
		document.getElementById('message').innerHTML = '<small style="color: red;">Password not match.</small>';
		$('#message').fadeIn();
	}
})
$('#password2').keyup(function(){
	var password1 = $('#password1').val();
	var password2 = $(this).val();
	if(password1 == password2)
	{
		document.getElementById('message').innerHTML = '<small style="color: green;">Password Match</small>';
		$('#message').fadeIn();
	}
	else
	{
		document.getElementById('message').innerHTML = '<small style="color: red;">Password not match.</small>';
		$('#message').fadeIn();
	}
})

//save button event handler
$('#btnSubmit').on('click', function(e){
	e.preventDefault();

	var id = $('#user-id').val();
	var username = $('#username').val();
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var access = $('#access').val();
	var role = $('#role').val();
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var myData = 'id=' + id + '&username=' + username + '&firstname=' + firstname + '&lastname=' + lastname + '&password=' + password1 + '&access=' + access + '&role=' + role;

	if(password1 == password2){
		$.ajax({
			type: 'POST',
			url: '../../controls/update_user.php',
			data: myData,
			beforeSend: function()
			{
				showToast();
			},
			success: function(response)
			{
				if(response > 0){
					$('#two').hide();
					$('#login-form').fadeIn();
				}else{
					toastr.error('ERROR! Update Failed. Please contact the system administrator at local 124.');
				}
			}
		})

	}else{
		toastr.error('ERROR! Submit Failed. Password is not match!');
	}
})

//login
$('#btnLogin').on('click', function(e){
	e.preventDefault();

	var username = $('#username').val();
	var password = $('#password').val(); 
	var myData = 'username=' + username + '&password=' + password;

	if(username = '' || password != '')
	{
		$.ajax({
			type: 'POST',
			url: '../../controls/login.php',
			data: myData,
			beforeSend: function()
			{
				showToast();
			},
			success: function(response)
			{
				if(response > 0)
				{
					window.location = '../../controls/checkaccess.php';
				}
				else
				{
					toastr.error('Login Failed. Incorrect user credential. Please try again.');
				}				
			}
		})
	}
	else
	{
		toastr.error('ERROR! Please fill out all the data needed.');
	}
})
</script>
</body>
</html>