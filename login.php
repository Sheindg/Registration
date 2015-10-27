<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Login</title>

	<link href="css/style.css" media="screen" rel="stylesheet">
	<link href="css/mycss.css" type="text/css" rel="stylesheet">
	
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
</head> 

	<body id="bodyleft">

	<div class="container mlogin">
		<div id="login">
	<h2>Регистрация</h2>
<form name="loginform" id="loginform" action="" method="">
	<p class="sent">
		<label for="Username">Логин
		<input type="text" name="userName" id="userName" class="input" value="" size="40" placeholder="Enter your login" /></label>
		<div class="disp" id="verno"></div>
		<div class="disp" id="neverno"></div>
	</p>
	<p class="sent">
		<label for="password">Пароль
		<input type="password" name="password" id="password" class="input" value="" size="40" placeholder="Enter your password" /></label>
		<div class="disp" id="verno1"></div>
		<div class="disp" id="neverno1"></div>
	</p>
	<p class="sent">
		<label for="password">Ещё раз пароль
		<input type="password" name="password2" id="password2" class="input" value="" size="40" placeholder="Enter your password again" /></label>
		<div class="disp" id="verno2"></div>
		<div class="disp" id="neverno2"></div>
	</p>
	<p class="sent">
		<label for="phone">Телефон
		<input type="text" name="phone" id="phone" class="input" value="" size="40" placeholder="phone" /></label>
		<div class="disp" id="verno3"></div>
		<div class="disp" id="neverno3"></div>
	</p>
	<p id="country">
		<label for="country">Страна


			<?php

			$dsn='mysql:host=localhost;dbname=login;charset=utf8';
			$user='root';
			$pass='';
			try
			{
				$db= new PDO ($dsn, $user, $pass);
			}
			catch (PDOException $e) {
				echo 'Подключение не удалось: '.$e->getMessage();
			}

			$result = $db->query("SELECT * FROM countries ORDER BY country_name");
			$result->execute();
			$row3 = $result->fetchAll(PDO::FETCH_ASSOC);
			
		
			echo "<select name='country' id='countrylist'>";
			
				for ($i=0; $i < count($row3); $i++){

					echo '<option value="' . $row3[$i]['id_country']. '">' .$row3[$i]['country_name'] . '</option>'; 
					
				}
			
			echo "</select>";

?></label>
</p>

	<p id="citylist">
		<label for="city">Город
		<select id="city">
		</select></label>
		
	</p>

<p class="sent">
<label for="invite">Инвайт
<input type="text" name="invite" id="invite" class="input" value="" size="40" placeholder="invite" /></label>
<div class="disp" id="verno4"></div>
<div class="disp" id="neverno4"></div>
</p>

<p class="submit">
<input type="button" id="btn-submit" name="submit" class="btn btn-default" value="Регистрация" />
<input type="button" id="btn-reset" name="reset" class="btn btn-default" value="Очистить" />
	<div><a href="signin.php" id="ref">Просмотр списка пользователей и инвайтов</a></div>
</p>



</form>

</div>

</div>

<footer>© 2015 DEN. All rights reserved. </footer>
</body>
</html>
