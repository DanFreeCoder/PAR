<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';
include '../objects/clsRater.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);
$rater = new Rater($db);

$user->id = $_POST['id'];
$get = $user->get_user_by_id();

while($row = $get->fetch(PDO::FETCH_ASSOC))
{
    $date_hire = date_format(new DateTime($row['date_hire']), 'F j, Y');
    echo '<div class="form-group">
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Firstname</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_id" style="color: black; display: none;" value="'.$row['id'].'">
                    <input type="text" id="upd_firstname" style="color: black;" placeholder="Enter Firstname" value="'.$row['firstname'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Lastname</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_lastname" style="color: black;" placeholder="Enter Lastname" value="'.$row['lastname'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Date Hire</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_date-hire" class="datepicker" placeholder="Date Hired" style="color: black;" value="'.$date_hire.'"/>
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Position</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_position" style="color: black;" placeholder="Enter your Position/Job Title" value="'.$row['position'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Project</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_project" style="color: black;" placeholder="Enter your Unit/Project Assigned/Location" value="'.$row['project'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Email</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_email" style="color: black;" placeholder="Enter email" value="'.$row['email'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Department</label>
                </div>
                <div class="9u 12u$(xsmall)">
                <select id="upd_dept" style="color: black;">';
                    $sel = $rater->view_department();
                    while($row1 = $sel->fetch(PDO::FETCH_ASSOC))
                    {
                        if($row['dept'] == $row1['id']){
                            echo '<option value='.$row1['id'].' selected>'.$row1['department'].'</option>';
                        }else{
                            echo '<option value='.$row1['id'].'>'.$row1['department'].'</option>';
                        }
                    }
                echo '</select>
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Username</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <input type="text" id="upd_username" style="color: black;" disabled value="'.$row['username'].'">
                </div>
            </div>
            <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Position</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <select id="upd_access" style="color: black;">';
                    if($row['access'] == 1){
                        echo '<option value="1" selected>Administrator</option>
                              <option value="2" selected>Supervisor / Team Leader</option>
                              <option value="3">Manager</option>
                              <option value="4">Senior Manager</option>
                              <option value="6">Employee/Staff</option>';
                    }elseif($row['access'] == 2){
                        echo '<option value="1">Administrator</option>
                              <option value="2" selected>Supervisor / Team Leader</option>
                              <option value="3">Manager</option>
                              <option value="4">Senior Manager</option>
                              <option value="6">Employee/Staff</option>';
                    }elseif($row['access'] == 3){
                        echo '<option value="1">Administrator</option>
                              <option value="2">Supervisor / Team Leader</option>
                              <option value="3" selected>Manager</option>
                              <option value="4">Senior Manager</option>
                              <option value="6">Employee/Staff</option>';
                    }elseif($row['access'] == 4){
                        echo '<option value="1">Administrator</option>
                              <option value="2">Supervisor / Team Leader</option>
                              <option value="3">Manager</option>
                              <option value="4" selected>Senior Manager</option>
                              <option value="6">Employee/Staff</option>';
                    }else{
                        echo '<option value="1">Administrator</option>
                              <option value="2">Supervisor / Team Leader</option>
                              <option value="3">Manager</option>
                              <option value="4">Senior Manager</option>
                              <option value="6" selected>Employee/Staff</option>';
                    }                    
                    echo '</select>
                </div>
          </div>
          <div class="row">
                <div class="3u 12u$(xsmall)">
                    <label for="exampleInputEmail1">Role</label>
                </div>
                <div class="9u 12u$(xsmall)">
                    <select id="upd_role" style="color: black;">';
                    if($row['role'] == 1){
                        echo '<option value="1" selected>Approver 1</option>
                              <option value="2">Approver 2</option>
                              <option value="3">Approver 3</option>
                              <option value="0">User</option>';
                    }elseif($row['role'] == 2){
                        echo '<option value="1">Approver 1</option>
                              <option value="2" selected>Approver 2</option>
                              <option value="3">Approver 3</option>
                              <option value="0">User</option>';
                    }elseif($row['role'] == 3){
                        echo '<option value="1">Approver 1</option>
                              <option value="2">Approver 2</option>
                              <option value="3" selected>Approver 3</option>
                              <option value="0">User</option>';
                    }else{
                        echo '<option value="1">Approver 1</option>
                              <option value="2">Approver 2</option>
                              <option value="3">Approver 3</option>
                              <option value="0" selected>User</option>';
                    }                    
                    echo '</select>
                </div>
          </div>';
}

?>
<script>
$(document).ready(function(){
    //datepicker
	$('.datepicker').datepicker({
  		clearBtn: true,
  		format: "MM dd, yyyy",
  		setDate: new Date(),
  		autoClose: true
	});
})
//auto generate username event handler in update
$('#upd_lastname').blur(function(e){
  e.preventDefault();

  var str = $('#upd_firstname').val();
  var fname = str.replace(/\s/g,'');
  var f = fname.toLowerCase();
  var str1 = $('#upd_lastname').val();
  var lname = str1.replace(/\s/g,'');
  var l = lname.toLowerCase();
  var username = f.concat('.').concat(l);
  $('#upd_username').val(username);
})

$('#upd_firstname').blur(function(e){
  e.preventDefault();

  var str = $('#upd_firstname').val();
  var fname = str.replace(/\s/g,'');
  var f = fname.toLowerCase();
  var str1 = $('#upd_lastname').val();
  var lname = str1.replace(/\s/g,'');
  var l = lname.toLowerCase();
  var username = f.concat('.').concat(l);
  $('#upd_username').val(username);
})
</script>