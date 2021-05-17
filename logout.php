<?php
session_start();
// unset($_SESSION["email"]);
// unset($_SESSION["password"]);
session_destroy();
echo 'Logout successful';
header('Refresh: 1; URL = signin.html');
?>