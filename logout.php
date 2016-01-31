<?php
	session_start();
	session_unset(); //kills all session variables 
	header("Location: login.php");
?>