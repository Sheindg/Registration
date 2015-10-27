<?php
	echo 'logout';
	
	unset($_SESSION['id_user']);
	unset($_SESSION['username']);
	
	session_destroy();
	
	header('Location: signin.php');
?>