<?php

	session_start();
	$_SESSION['address'] = "Raisins(organic).php";
	$_SESSION['triggerValidate'] = ""; // It will be replaced by AJAX functions.


		if ($_SESSION['name'] != NULL)
		{
			$name = $_SESSION['name'];
			$surname = $_SESSION['surname'];

				echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesRaisins(organic)Authenticated.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
			<title>Raisins(organic), Dried fruits of Turkey</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey
					Organic Raisins
				</div>
			</div>

			<div id = "left">
				<div id = "left1">
					Dried fruits list<br>
						<ul>
							<li><a href = "Apricots(organic).php">Apricots (organic)</a></li>
							<li><a href = "Apricots(sulphured).php">Apricots (sulphured)</a></li>
							<li><a href = "Raisins(organic).php">Raisins (organic)</a></li>
							<li><a href = "index.php">Go to homepage</a></li>
						</ul>
				</div>
			</div>

			<div id = "right">
				<div id = "right1">
				<form name = "logOut" action = "logOut.php" method = "POST">
					User:<br>
						$name<br>
						$surname	
		
					<p>

							<a href="tradePage.php">
   							<input type="button" value="Trade page" />			
							</a> 

							<a href="personalPage.php">
   							<input type="button" value="My profile" />			
							</a> 

						<input type = "submit" name =  "submit1" value = "Log out";>
					</p>

				</form>
				</div>
						
			</div>

			<div id = "contents">

				<div id = "image1wrapper">
				<img id = "image1" src = "source/07.jpeg" width = "500" height = "277">
					<div id = "image1name">
						Sun dried raisins.
					</div>
			</div>
  		aaaaaaaaaaaaa
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
        <div id = image2wrapper>
				<img id = "image2" src="source/08.jpeg" width = "400" height = "300">
					<div id = "image2name">
						10 kilo packing.
					</div>
			</div>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>

				<div id = "contacts">
					Dried fruits of turkey<br>
					Address: Turkey, Istambul, 20<br>
					Tel: +79566554278<br>
					Email: fruitsofturkey@gmail.com 				
				</div>

			</div>

		</body>

</html>

_END;

		}
		else
		{

			$failEmail = $_SESSION['failEmail'];
			$failPassword = $_SESSION['failPassword'];
			$emailBack = $_SESSION['emailBack'];

			echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesRaisins(organic).css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
		<script src = "javaScript/validateAuthentication.js"></script>

			<title>Raisins(organic), Dried fruits of Turkey</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey
					Organic Raisins
				</div>
			</div>

			<div id = "left">
				<div id = "left1">
					Dried fruits list<br>
						<ul>
							<li><a href = "Apricots(organic).php">Apricots (organic)</a></li>
							<li><a href = "Apricots(sulphured).php">Apricots (sulphured)</a></li>
							<li><a href = "Raisins(organic).php">Raisins (organic)</a></li>
							<li><a href = "index.php">Go to homepage</a></li>
						</ul>
				</div>
			</div>

			<div id = "right">
				<div id = "right1">
				<form action = "Authentication.php" method = "POST" onsubmit = "return validate(this)" >
					<p>
						<label>email<br>
							<input type = "text" size="15" id = "email1" maxlength="15" name="email" value = "$emailBack" onblur ="return validateEmail()">
						</label>
					</p>
						
					<div class = "errorMessage" id = "errorEmail">
					$failEmail
					</div>

					<p>
						<label>Password<br>
							<input type = "password" size="15" id = "password1" maxlength="15" name="password" onblur ="return validatePassword()">
						</label>
					</p>

					<div class = "errorMessage" id = errorPassword>
					$failPassword
					</div>

						<input class = "inputFin" type = "submit" name =  "submit1" value = "Log in">
						<input class = "inputFin" type = "button" name =  "reset1" value = "Reset" onclick = "return clearForm(form)">

					<p>
						Not registered yet?<br>
						<a href = "Registration.html">Registration<a>
					</p>


				</div>
				</form>
						
			</div>

			<div id = "contents">

			<div id = "image1wrapper">
				<img id = "image1" src = "source/07.jpeg" width = "500" height = "277">
					<div id = "image1name">
						Sun dried raisins.
					</div>
			</div>
			aaaaaaaaaaaaa
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
      <div id = image2wrapper>
				<img id = "image2" src="source/08.jpeg" width = "400" height = "300">
					<div id = "image2name">
						10 kilo packing.
					</div>
			</div>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>
			aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaa<br>

				<div id = "contacts">
					Dried fruits of turkey<br>
					Address: Turkey, Istambul, 20<br>
					Tel: +79566554278<br>
					Email: fruitsofturkey@gmail.com 				
				</div>

			</div>

		</body>

</html>

_END;

		$_SESSION['failEmail'] = "";
		$_SESSION['failPassword'] = "";
		$_SESSION['emailBack'] = "";

		}

?>
