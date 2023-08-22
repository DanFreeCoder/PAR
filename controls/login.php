<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$user->username = $_POST['username'];
$user->user_pass = md5($_POST['password']);

$login = $user->login();

if($row = $login->fetch(PDO::FETCH_ASSOC))
{
    $_SESSION['id'] = $row['user-id'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['position'] = $row['position'];
    $_SESSION['project'] = $row['project'];
    $_SESSION['date_hire'] = $row['date_hire'];
    $_SESSION['access'] = $row['access'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['dept'] = $row['dept'];
    $_SESSION['department'] = $row['department'];
    $_SESSION['logcount'] = $row['logcount'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['unit'] = $row['unit'];
    echo 1;
}
else
{
    echo 0;
}
?>