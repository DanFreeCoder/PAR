<?php
session_start();
if ($_SESSION['access'] == 1) {
    header('Location: ../pages/admin/index.php'); //admin
} elseif ($_SESSION['access'] == 6) {
    header('Location: ../pages/user/index.php'); //user
} elseif ($_SESSION['role'] == 1) {
    header('Location: ../pages/approver1/index.php'); //approver1(SUPERVISOR)
} elseif ($_SESSION['role'] == 2) {
    header('Location: ../pages/approver2/index.php'); //approver2
} elseif ($_SESSION['role'] == 3) {
    header('Location: ../pages/approver3/index.php'); //approver3(MANAGERS)
} elseif ($_SESSION['access'] == 5) {
    header('Location: ../pages/HR/index.php'); //HR
} else {
    header('Location: ../index.php');
}
