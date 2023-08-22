<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$action = $_POST['action'];

if($action == 1)//UPDATE USER PASSWORD && USER Details
{
    $user->id = $_POST['id'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->position = $_POST['position'];
    $user->unit = $_POST['project'];
    $user->email = $_POST['email'];
    $user->date_hire = date('Y-m-d', strtotime($_POST['date_hire'])); 
    $user->username = $_POST['username'];
    $user->user_pass = md5($_POST['password']);

    $upd = $user->upd_user_password();
    if($upd){
        echo 1;
    }else{
        echo 0;
    }
}
elseif($action == 2)
{
    //update user details only
    $user->id = $_POST['id'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->position = $_POST['position'];
    $user->project = $_POST['project'];    
    $user->date_hire = date('Y-m-d', strtotime($_POST['date_hire'])); 
    $user->dept = $_SESSION['dept'];
    $user->unit = $_POST['project']; 
    $user->email = $_POST['email'];
    $user->username = $_POST['username'];
    $user->access = $_SESSION['access'];    

    $update = $user->updateUserDetails();
    if($update)
    {
        echo 2;
    }
    else
    {
        echo 0;
    }
}
elseif($action == 3)
{
    //update user details without the password
    $user->id = $_POST['id'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->position = $_POST['position'];
    $user->unit = $_POST['project'];
    $user->date_hire = date('Y-m-d', strtotime($_POST['date_hire'])); 
    $user->dept = $_POST['dept'];
    $user->email = $_POST['email'];
    $user->username = $_POST['username'];
    $user->access = $_POST['access'];
    $user->role = $_POST['role'];

    $update = $user->updateDetails();
    if($update)
    {
        echo 3;
    }
    else
    {
        echo 0;
    }
}
else//UPDATE PASSWORD only when 1st time to login
{
    $user->id = $_POST['id'];
    $user->user_pass = md5($_POST['password']);

    $upd = $user->upd_user_pw();
    if($upd){
        echo 4;
    }else{
        echo 0;
    }
}
?>