<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SignIn</title>
		
		<link href="css/mycss.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<h2 id="title">Sign In</h2>
		<form name="myform" class="form-horizontal" id="enter" method="POST" action="lists.php">
		  <div class="control-group">
			<label class="control-label" for="inputLogin">Username</label>
			<div class="controls">
			  <input type="text" id="inputLogin" name="login" placeholder="Username">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			  <input type="password" id="inputPassword" name="password" placeholder="Password">
			</div>
		  </div>
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn">Sign in</button>
			</div>
		  </div>
		</form>
		<a href="login.php" id="backref">Зарегистрироваться</a>
	</body>
</html>
