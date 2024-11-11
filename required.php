<?php
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['user_id'] && $_SESSION['role']) {}else {header("Location: login.php");}
?>