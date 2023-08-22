<?php
//this comment is for git push test
include 'config/clsConnection.php';
include 'objects/clsRater.php';

$database = new clsConnection();
$db = $database->connect();

$rater = new Rater($db);
?>
<!DOCTYPE HTML>
<html lang="eng">

<head>
  <title>IGC Online-PAR</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="stylesheet" href="assets/datetimepicker/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/toastr/toastr.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
</head>
<style>
  .modal {
    position: absolute;
    top: 30px;
    right: 100px;
    bottom: 0;
    left: 0;
    z-index: 10040;
    overflow: auto;
    overflow-y: auto;
  }
</style>

<body id="page-top" class="subpage">
  <!-- Header -->
  <header id="header">
    <div class="logo"><a href="index.php">Innogroup <span>Online-PAR</span></a></div>
  </header>
  <!-- One -->
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
          <center>
            <h2>LOGIN</h2>
          </center>
          <div class="row uniform">
            <div class="3u 12u$(xsmall)">
            </div>
            <div class="3u 12u$(xsmall)">
              <input type="text" id="username" placeholder="Username" />
            </div>
            <div class="3u 12u$(xsmall)">
              <input type="password" id="password" placeholder="Password" />
            </div>
            <div class="3u 12u$(xsmall)">
              <a href="#" id="btnLogin" class="button"><b style="color: white;">LOGIN</b></a>
            </div>
          </div><br>
          <div class="row uniform">
            <div class="3u 12u$(xsmall)">
            </div>
            <a href="#" data-toggle="modal" data-target="#newUserModal">Don't have an account yet? <br>Click here to register.</a>
            <div class="1u 12u$(xsmall)">
            </div>
            <a href="#" data-toggle="modal" data-target="#forgot_passModal">Forgot password?</a>
          </div>
        </div>
        <br>
      </div>
    </div>
  </section>

  <!-- ADD USER MODAL-->
  <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-plus-square"></span> Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Firstname</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_firstname" style="color: black;" placeholder="Enter Firstname">
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Lastname</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_lastname" style="color: black;" placeholder="Enter Lastname">
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Date Hire</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_date-hire" class="datepicker" placeholder="Date Hired" style="color: black;" />
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Position</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_position" style="color: black;" placeholder="Enter your Position/Job Title">
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">IGC Email</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_email" style="color: black;" placeholder="Enter your IGC Email">
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Department</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <select id="department" style="color: #555;">
                  <?php
                  $sel = $rater->view_department();
                  while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value=' . $row['id'] . '>' . $row['department'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div><br>
            <div class="row">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Location/Unit</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <select id="sel_project" style="color: #555;" style="color: black; display:none">

                </select>
                <input type="text" id="add_project" style="color: black; display:none" placeholder="Enter your Unit/Project Assigned/Location">
              </div>
            </div>
            <div class="row" style="display: none;">
              <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Username</label>
              </div>
              <div class="9u 12u$(xsmall)">
                <input type="text" id="add_username" style="color: black;" disabled>
              </div>
            </div>
          </div><!-- end of form-group -->
          <!-- Alerts -->
          <div id="user_warning" class="alert alert-danger" role="alert"></div>
          <div id="user_success" class="alert alert-success" role="alert"></div>
        </div><!-- end of modal body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btnSave" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FORGOT PASSWORD USER MODAL (Added by Danilo) -->
  <div class="modal fade" id="forgot_passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Forgot Password?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><b>Don't worry, just enter your registered <span class="text-danger">IGC Email</span> to get a link to change your password. </b></p>
          <div class="form-group">
            <div class="row">
              <div class="12u 12u$(xsmall)">
                <input type="email" id="enter_email" style="color: black;" placeholder="Enter your IGC Email">
              </div>
            </div>
          </div><!-- end of form-group -->
          <!-- Alerts -->
          <div id="forgot_warning" class="alert alert-danger" role="alert" hidden>Please enter valid email</div>
        </div><!-- end of modal body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btnSubmit" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

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
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.scrollex.min.js"></script>
  <script src="assets/js/skel.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/datetimepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/js/jquery.toast.js"></script>
  <script src="assets/toastr/toastr.js"></script>
  <?php include 'index-js.php'; ?>

</body>

</html>