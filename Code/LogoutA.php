<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   echo 'You have logged out';
   header('Refresh: 0; URL = signin.php');
?>