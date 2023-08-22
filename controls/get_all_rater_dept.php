<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';
include '../objects/clsDetails.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);
$details = new ParDetails($db);

$id = $_POST['id'];
if($id == 0)
{
	$user->dept = $_POST['dept'];
	$view = $user->view_sup();
	while($row = $view->fetch(PDO::FETCH_ASSOC))
	{
		echo '<option value="'.$row['id'].'">'.$row['fullname'].'</option>';
	}
}
else
{
	//get the rater_name of par
	$details->id = $id;
	$sel = $details->get_unevaluated_par();
	while($row1 = $sel->fetch(PDO::FETCH_ASSOC))
	{	
		//check the name of all rater
		$user->dept = $_POST['dept'];
		$view = $user->view_sup();
		while($row = $view->fetch(PDO::FETCH_ASSOC))
		{
			if($row['id'] == $row1['rater_id']){
				echo '<option value="'.$row['id'].'" selected>'.$row['fullname'].'</option>';
			}else{
				echo '<option value="'.$row['id'].'">'.$row['fullname'].'</option>';
			}	
		}
	}	
}
?>