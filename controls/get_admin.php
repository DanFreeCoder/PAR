<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

//$user->dept = $_POST['dept'];
//$user->access = $_POST['access'];

$view = $user->view_hr_admin();

while($row = $view->fetch(PDO::FETCH_ASSOC))
{
	echo '<option value="'.$row['id'].'">'.$row['fullname'].'</option>';	
}
?>