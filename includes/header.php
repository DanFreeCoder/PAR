<?php
session_start();
if (!(isset($_SESSION['fullname']))) {
  header('Location: ../../index.php');
}
//check logcount
if ($_SESSION['logcount'] == 0) {
  header('Location: change-password.php');
}
include '../../config/clsConnection.php';
include '../../objects/clsDetails.php';
include '../../objects/clsUser.php';
include '../../objects/clsRater.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);
$rater = new Rater($db);
?>

<!-- Header -->
<header id="header">
  <div class="logo" style="margin: 0;"><a href="index.php">Innogroup <span>Online-PAR</span></a></div>
  <a href="#menu" style="margin:0;"><?php echo $_SESSION['fullname']; ?></a>
  <div class="progress-bar" id="mybar" style="height:12px; background-color:#04AA6D; width:0%; margin:0; padding:0;"></div>
</header>

<!-- Nav -->
<nav id="menu">
  <ul>
    <div class="row uniform">
      <div>
        <!-- get the user details -->
        <?php
        $user->id = $_SESSION['id'];
        $get = $user->get_user_by_id();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];
          $username = $row['username'];
          $position = $row['position'];
          $dept = $row['dept'];
          $project = $row['project'];
          $unit = $row['unit'];
          $date_hire =  date('F j, Y', strtotime($row['date_hire']));
          $email = $row['email'];
        }
        ?>
        <center>
          <h3>User Details</h3>
        </center>
        <input type="text" id="id" style="color: white; display: none;" value="<?php echo $_SESSION['id']; ?>" />
        <input type="text" id="dept" style="color: white; display: none;" value="<?php echo $_SESSION['dept']; ?>" />
        <input type="text" id="access" style="color: white; display: none;" value="<?php echo $_SESSION['access']; ?>" />
        <input type="text" id="role" style="color: white; display: none;" value="<?php echo $_SESSION['role']; ?>" />
        <input type="text" id="user-firstname" placeholder="Firstname" style="color: white;" value="<?php echo $firstname; ?>" disabled /><br>
        <input type="text" id="user-lastname" placeholder="Lastname" style="color: white;" value="<?php echo $lastname; ?>" disabled /><br>
        <input type="text" id="user-username" placeholder="Username" style="color: white;" value="<?php echo $username; ?>" disabled /><br>
        <input type="text" id="user-position" placeholder="Job Position/Title" style="color: white;" value="<?php echo $position; ?>" disabled /><br>
        <select id="user-department" style="color: white;" disabled>
          <?php
          //get the department by ID
          $details->id = $dept;
          $view = $details->get_emp_department();
          while ($row = $view->fetch(PDO::FETCH_ASSOC)) {
            if ($dept == $row['id']) {
              echo '<option value="' . $row['id'] . '" selected>' . $row['department'] . '</option>';
            } else {
              echo '<option value="0">No Department Selected</option>';
            }
          }
          ?>
        </select><br>
        <select id="user-project" style="color: white;" disabled>
          <?php
          $user->dept_id = $dept; //$_SESSION['dept'];
          $sel = $user->view_unit();
          while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
            if ($row['id'] == $unit) {
              echo '<option value=' . $row['id'] . ' style="color: black;" selected>' . $row['unit_name'] . '</option>';
            } else {
              echo '<option value=' . $row['id'] . ' style="color: black;">' . $row['unit_name'] . '</option>';
            }
          }
          ?>
        </select><br>
        <input type="text" id="user-date-hire" class="datepicker" placeholder="Date Hire" style="color: white;" value="<?php echo $date_hire ?>" disabled /><br>
        <input type="text" id="user-email" placeholder="Username" style="color: white;" value="<?php echo $email; ?>" disabled /><br>
        <input type="password" id="password" placeholder="New Password" style="color: white;" disabled />
      </div>
      <div>
        <a id="btnEdit" class="button"><b>EDIT</b></a>
        <a id="btnUpdateUser" class="button"><b>SAVE</b></a>
        <a id="btnLog-out" class="button" style="background-color: #C5250C;" onclick="logout()">
          <p style="color: whitesmoke;">LOGOUT</p>
        </a>
        <a id="btnCancel" class="button" style="background-color: #C5250C;">
          <p style="color: whitesmoke;">CANCEL</p>
        </a>
      </div>
    </div>
  </ul>
</nav>
<!-- USER ACCOUNT MODAL NOTIFICATION -->
<div id="notificationModal" class="modal" tabindex="1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b><br></b></h3>
      </div>
      <div class="modal-body">
        <p style="color: black;">Congratulation, your password has been successfully updated. You need to login again to complete the process <a href="../controls/logout.php"><b><u>Click here</b></u></a> to continue.</p>
      </div>
      <div class="modal-footer">
        <a href="#" id="btnLogout" class="button" style="background-color: #C5250C;" onclick="logout()">
          <p style="color: whitesmoke;">LOGOUT</p>
        </a>
      </div>
    </div>
  </div>
</div>