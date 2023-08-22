<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$date_hire = date('Y-m-d', strtotime($_POST['date_hire']));
$user->id = $_POST['id'];
$user->firstname = $_POST['firstname'];
$user->lastname = $_POST['lastname'];
$user->position = $_POST['position'];
$user->project = $_POST['project'];
$user->date_hire = $date_hire;
$user->dept = $_POST['dept'];
$user->username = $_POST['username'];
$user->email = $_POST['email'];
$user->access = $_POST['access'];
$user->role = $_POST['role'];

$save = $user->updateUserDetails();

if($save)
{
    echo 1;
}
else
{
    echo 0;
}
?>