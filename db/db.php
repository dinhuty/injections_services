<?php

$connection = mysqli_connect('localhost', 'root', '', 'injections');
mysqli_query($connection, "SET NAMES 'utf8'");

if (!$connection) {
    exit('connect successfully!');
}
