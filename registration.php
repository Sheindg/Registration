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
	
	if(isset($_POST)){
		$login = $_POST['username'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$id_city = $_POST['city'];
		$invite = $_POST['invite'];
	}
	
	$str = $phone;
    $arr = str_split($str);
	$arr1 = null;
	
	for($i = 0, $j = 0; $i < count($arr); ){
		if($arr[$i] == '+' || $arr[$i] == '-' || $arr[$i] == '(' || $arr[$i] == ')' || $arr[$i] == ' '){
			$i++;
		} else {
			$arr1[$j] = $arr[$i];
			$i++;
			$j++;
		}
	}
	
	$phone = join('', $arr1);
	
	$userId = 0;
	
	try {
		$db->beginTransaction();
		
		$result = $db->prepare("SELECT MAX(id_user) AS 'id' FROM users");
		$result->execute();

		$previousId = $result->fetch(PDO::FETCH_ASSOC);
		
		$result = $db->prepare("INSERT INTO users (login, password, phone, id_city, invite) VALUES  (:login, :password, :phone, :id_city, :invite)");
	
		$result->bindParam(':login', $login);
		$result->bindParam(':password', $password);
		$result->bindParam(':phone', $phone);
		$result->bindParam(':id_city', $id_city);
		$result->bindParam(':invite', $invite);
		$result->execute();
		$userId = $db->lastInsertId();
		
		$result = $db->prepare("UPDATE invites SET status = 1, date_status_ = NOW() WHERE invite = :invite");
		
		$result->bindParam(':invite', $invite);
		$result->execute();
		
		$db->commit();
		
		$row = ['message' => 'Регистрация удачно завершена!', 'number' => '1'];
	} catch (PDOException $e) {
		
		$db->rollback();
		
		$row = ['message' => (settype($e->Message(),'string')), 'number' => '0'];
	}
	echo json_encode(json_encode($row, JSON_UNESCAPED_UNICODE), JSON_UNESCAPED_UNICODE);