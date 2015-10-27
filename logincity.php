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
	
	//print_r($_POST);
	
	if(isset($_POST['country']))
		$row = $_POST['country'];
	
	//$row = 3;
	
	$result = $db->prepare("SELECT id_city, city_name FROM cities WHERE id_country = :id_country ORDER BY city_name");
	
	$result->bindParam(':id_country', $row);
	
	$result->execute();

	$row1 = $result->fetchAll(PDO::FETCH_ASSOC);
	
	//print_r($row1);
	
	echo json_encode(json_encode($row1, JSON_UNESCAPED_UNICODE), JSON_UNESCAPED_UNICODE);