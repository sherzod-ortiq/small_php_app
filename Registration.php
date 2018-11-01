<?php

if(!isset($_SESSION['name']))
{

	session_start();
	require_once 'databaseKey/loginUser1.php';
	$connection = new mysqli($hn, $un, $pw, $db);
	if ($connection -> connect_error) die ($connection -> connect_error);

			$name = $surname = $email = $tel = $password = $gender = "";
	
			if($_POST['name1'] != NULL)
			{
				$name = mysql_entities_fix_string($connection, 'name1');
			}

			if($_POST['surname'] != NULL)
			{
				$surname = mysql_entities_fix_string($connection, 'surname');
			}

			if($_POST['email'] != NULL)
			{
				$email = mysql_entities_fix_string($connection, 'email');
			}

			if($_POST['tel'] != NULL)
			{
				$tel = mysql_entities_fix_string($connection, 'tel');
			}

			if($_POST['password'] != NULL)
			{
				$password = mysql_entities_fix_string($connection, 'password');
			}

			if($_POST['gender'] != NULL)
			{
				$gender = mysql_entities_fix_string($connection, 'gender');
			}

				$fail1 = validateName($name);
				$fail2 = validateSurname($surname);
				$fail3 = validateEmail($email);
				$fail4 = validateTel($tel);
				$fail5 = validatePassword($password);
				$fail6 = validateGender($gender);

 
   if (($fail1 == "") && ($fail2 == "") && ($fail3 == "") && ($fail4 == "") && ($fail5 == "") && ($fail6 == ""))
		{
			$salt1 = "kebdoz";
			$salt2 = "reSh";
			$name = mysql_entities_fix_string($connection, 'name1');
			$surname = mysql_entities_fix_string($connection, 'surname');
			$email = mysql_entities_fix_string($connection, 'email');
			$tel = mysql_entities_fix_string($connection, 'tel');
			$passw = mysql_entities_fix_string($connection, 'password');
			$password = hash('ripemd128',"$salt1$passw$salt2");
			$gender = mysql_entities_fix_string($connection, 'gender');
			$query1 = "INSERT INTO subscribers (name, surname, email, tel, password, gender, date) VALUES ('$name', '$surname', '$email', '$tel', '$password', '$gender', NOW())";
			$query2 = "SELECT * FROM subscribers WHERE email = '$email'";

			$result1 = $connection -> query($query1);
				if (!$result1) echo "(1)INSERT failed: $query <br>" . $connection -> error . "<br><br>";

			$result2 = $connection -> query($query2);
				if (!$result2)
				{	die ($connection -> error);	}
				elseif ($result2 -> num_rows)
				{
					$row = $result2 -> fetch_array(MYSQLI_NUM);
					$id = $row[0];
				}

			$query3 = "INSERT INTO balance (id) VALUES ($id)";

			$result3 = $connection -> query($query3);
				if (!$result3) echo "(2)INSERT failed: $query <br>" . $connection -> error . "<br><br>";

				if (!($result1 && $result2 && $result3)) echo "(3)INSERT failed: $query <br>" . $connection -> error . "<br><br>";
				else
				{
						$_SESSION['name'] = $name;
						$_SESSION['surname'] = $surname;
						$_SESSION['email'] = $email;
						$_SESSION['admin'] = "no";
				}

					echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesRegistrationComplete.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
			<title>Registration complete, Dried fruits of Turkey</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey
				</div>
			</div>

			<div id = "contents">

				<div id = "form1">

					<div id = "formHeader">
						Success!
					</div>

					<form name = "Registration" action = "RegistrationTest.php" method = "POST">

						<div id = "text">
							User $name $surname <br> <!-- $row[name] $row[surname] <br> -->
							You have just signed up to our website.
						</div>
					
							<a href="index.php">
   							<input id = "continueButton" type="button" value="continue" />			
							</a>
	
					</form>

				</div>

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

			$result1 -> close();
			$result2 -> close();
			$result3 -> close();


				$connection -> close();

		}
		else
		{	

				echo <<<_END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesRegistration.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
		<script src = "javaScript/validateRegistration.js"></script>
			<title>Registration, Dried fruits of Turkey</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey
				</div>
			</div>

			<div id = "contents">

				<div id = "form1">

					<div id = "formHeader">
						Registration
					</div>

					<form name = "Registration" action = "Registration.php" method = "POST" onsubmit = "return validate(this)">

						<p>
							<label>Name
								<input class = "input1" type = "text" size="20" maxlength="20" name="name1" value = "$name">
							</label>
						</p>

						<div class = "remark">
							$fail1
						</div>

						<p>
							<label>Surname
								<input class = "input1"  type = "text" size="20" maxlength="20" name="surname" value = "$surname">
							</label>
						</p>

						<div class = "remark">
							$fail2
						</div>

						<p>
							<label>Email
								<input class = "input1"  type = "text" size="20" maxlength="20" name="email" value = "$email">
							</label>
						</p>

						<div class = "remark">
							$fail3			
						</div>

						<p>
							<label>Tel
								<input class = "input1"  type = "text" size="20" maxlength="20" name="tel" value = "$tel">
							</label>
						</p>

						<div class = "remark">
							$fail4
						</div>

						<p>
							<label>Think of password
								<input class = "input1"  type = "password" size="20" maxlength="20" name="password" value = "$password">
							</label>
						</p>

						<div class = "remark">
							$fail5
						</div>

							Gender<br><br>
								<label>
									Male
										<input type = "radio" name = "gender" value = "male" $male>
								</label>

								<label>
									Female
										<input type = "radio" name = "gender" value = "female" $female>
								</label>					

						<div class = "remark">
							$fail6
						</div>

					
							<input id = "doneButton" type = "submit" name =  "submit2" value = "continue"><br>

							<a href= "index.php">
   							<input id= "cancellationButton" type="button" name = "cancellation" value = "cancel" >			
							</a> 

							<input id= "resetButton" type = "reset" name =  "reset2" value = "reset">
					
	
					</form>

				</div>

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

			$connection -> close();

		}
	}
	else
{	header("Location: index.php");}

function validateName($field)
{
	if($field == "")
	{	return "No Name was entered";	}
	elseif((strlen($field) < 3) || (strlen($field) > 20))
	{	return "Name length should be between 3 and 20";	}
	elseif (preg_match("/[^a-zA-Z']/", $field))
	{	return "Only letters and ' sign are allowed";	}
	else
	{	return "";}		
}
  
function validateSurname($field)
{
	if($field == "") 
	{	return "No Surname was entered";	}
	elseif((strlen($field) < 3) || (strlen($field) > 20))
	{	return "Surame length should be between 3 and 20";	}
	elseif (preg_match("/[^a-zA-Z']/", $field))
	{	return "Only letters and ' sign are allowed";	}
	else
	{	return "";}		
}
    
function validateEmail($field)
{
	if($field == "") 
	{	return "No Email was entered";	}
	elseif((strlen($field) < 3) || (strlen($field) > 20))
	{	return "Email length should be between 3 and 20";	}
	elseif (!((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $field))
	{	return "The Email address is invalid";	}
	else
	{	return "";}		
}

function validateTel($field)
{
	if($field == "") 
	{	return "No Tel was entered";	}
	elseif((strlen($field) < 3) || (strlen($field) > 15))
	{	return "Tel length should be between 3 and 20";	}
	elseif (preg_match("/[^0-9+]/", $field))
	{	return "The Tel is invalid";	}
	elseif(strpos($field,"+") > 0)
	{	return "The Tel is invalid";	}
	else
	{	return "";}		
}

function validatePassword($field)
{
	if($field == "") 
	{	return "No Password was entered";	}
	elseif((strlen($field) < 2) || (strlen($field) > 4))
	{	return "Password length should be between 3 and 4";	}
  elseif (!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field))
	{	return "Password requires 1 each of a-z, A-Z and 0-9";	}
	elseif (preg_match("/[^a-zA-Z0-9]/", $field))
	{	return "Password must contain only a-z, A-Z and 0-9";	}
	else
	{	return "";	}		
}

function validateGender($field)
{
	if($field == "") 
	{	return "Gender wasn't chosen";	}
	elseif($field == "male")
	{	
		global $male;		
		$male = "checked = \"checked\"";	
	}
	elseif($field == "female")
	{	
		global $female;		
		$female = "checked = \"checked\"";	
	}
}
  
function mysql_entities_fix_string($connection, $string)
{
	return htmlentities(mysql_fix_string($connection, $string));
}

function mysql_fix_string($connection, $string)
{
	if (get_magic_quotes_gpc()) $string = stripslashes($_POST[$string]); else $string = $_POST[$string];
		return $connection -> real_escape_string($string);
}

?>
