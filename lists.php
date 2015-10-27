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
	
	if(isset($_POST['login']))
		$login = $_POST['login'];
	
	if(isset($_POST['password']))
		$password = $_POST['password'];
	
	//print_r($_POST);
	
	$result = $db->prepare("SELECT id_user FROM users WHERE login = :login and password = :password");
	
	$result->bindParam(':login', $login);
	$result->bindParam(':password', $password);
	$result->execute();
	
	$row = $result->fetchAll(PDO::FETCH_ASSOC);
	
	//print_r($row);
	
	if($row[0]['id_user'] != null)
	{
		session_start();
		$_SESSION['id_user'] = $row[0]['id_user'];
		$_SESSION['username'] = $login;
	}
	
	if(!isset($_SESSION['id_user'])){
		header('Location: signin.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Lists</title>
		
		<link href="css/mycss.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	
		<form name="myform" class="form-horizontal" id="enter" method="POST" action="logout.php">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn">Log Out</button>
			</div>
		  </div>
		</form>
	
		<h3 id="title">Список ПОЛЬЗОВАТЕЛЕЙ</h3>
		<table class="table table-bordered" style="width: 500px;">
			<tr>
			  <th>id_user</th>
			  <th>login</th>
			  <th>phone</th>
			  <th>invite</th>
			</tr>
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
				
				$result = $db->prepare("SELECT id_user, login, phone, invite FROM users");
				$result->execute();
				
				$row = $result->fetchAll(PDO::FETCH_ASSOC);
				
				for($i = 0; $i < count($row); $i++){
					echo '<tr>';
						echo '<td>'.$row[$i]['id_user'].'</td>';
						echo '<td>'.$row[$i]['login'].'</td>';
						echo '<td>'.$row[$i]['phone'].'</td>';
						echo '<td>'.$row[$i]['invite'].'</td>';
					echo '</tr>';
				}
			?>
		</table>
		
		<h3 id="title">Список ИНВАЙТОВ</h3>
		<table class="table table-bordered" style="width: 500px;">
			<tr>
			  <th>invite</th>
			  <th>status</th>
			  <th>data_status_</th>
			</tr>
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
				
				$result = $db->prepare("SELECT * FROM invites");
				$result->execute();
				
				$row = $result->fetchAll(PDO::FETCH_ASSOC);
				
				for($i = 0; $i < count($row); $i++){
					echo '<tr>';
						echo '<td>'.$row[$i]['invite'].'</td>';
						echo '<td>'.$row[$i]['status'].'</td>';
						echo '<td>'.$row[$i]['date_status_'].'</td>';
					echo '</tr>';
				}
			?>
		</table>
	</body>
</html>
