<?php
	$dsn='mysql:host=localhost;dbname=login;charset=utf8';
	$user='root';
	$pass='';
	try
	{
		$db = new PDO ($dsn, $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET CHARACTER SET utf8");  
	}
	catch (PDOException $e) {
		echo 'Подключение не удалось: '.$e->getMessage();
	}
	
	if(isset($_POST['id_invite']))
		$row = $_POST['id_invite'];
	
	//$row = 3;
	
	$result = $db->prepare("SELECT invite, status FROM invites WHERE invite = :invite");
	
	$result->bindParam(':invite', $row);
	
	$result->execute();

	$row1 = $result->fetch(PDO::FETCH_ASSOC);
	
	//print_r($row1);
	
	echo json_encode(json_encode($row1));