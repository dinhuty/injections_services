<?php
include('header.php');
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['user_id'] && $_SESSION['role']) {
    unset($_SESSION['user_id']);
    unset($_SESSION['role']);
}
header("Location: login.php");
