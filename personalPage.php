<?php

	session_start();

	if (($_SESSION['name'] != NULL) && ($_SESSION['admin'] == "no"))
	{
		$_SESSION['address'] = "index.php";
		$ses_email = $_SESSION['email'];
		$ses_name = $_SESSION['name'];
		$ses_surname = $_SESSION['surname'];


	require_once 'databaseKey/loginUser1.php';
	$connection = new mysqli($hn, $un, $pw, $db);
	if ($connection -> connect_error) die ($connection -> connect_error);

	if($_SESSION['triggerValidate'] == "yes")
	{
			$name = $surname = $email = $tel = $currentPassword = $newPasswod = $gender = "";
			$fail1 = $fail2 = $fail3 = $fail4 = $fail5 = $fail6 = $fail7 = "";	

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

			if($_POST['currentPassword'] != NULL)
			{
				$currentPassword = mysql_entities_fix_string($connection, 'currentPassword');
			}

			if($_POST['newPassword'] != NULL)
			{
				$newPassword = mysql_entities_fix_string($connection, 'newPassword');
			}

			if($_POST['gender'] != NULL)
			{
				$gender = mysql_entities_fix_string($connection, 'gender');
			}

				$fail1 = validateName($name);
				$fail2 = validateSurname($surname);
				$fail3 = validateEmail($email);
				$fail4 = validateTel($tel);
				$fail5 = validatePasswordCurrent($currentPassword);
				$fail6 = validatePasswordNew($newPassword);
				$fail7 = validateGender($gender);

	}

    if (($fail1 == "") && ($fail2 == "") && ($fail3 == "") && ($fail4 == "") && ($fail5 == "") && ($fail7 == "") && ($_SESSION['triggerValidate'] == "yes"))
		{
				$query = "SELECT * FROM subscribers WHERE email = '$ses_email'";
				$result = $connection -> query($query);

					if (!$result)
					{ die ($connection -> error); }
					elseif ($result->num_rows)//this function returns number of rows
					{
						$row = $result -> fetch_array(MYSQLI_NUM);

							$result -> close();

								$salt1 = "kebdoz";
								$salt2 = "reSh";
					      $passw = mysql_entities_fix_string($connection, 'currentPassword');
								$password = hash('ripemd128', "$salt1$passw$salt2");

									if($password == $row[6])
									{
										if ($_POST['newPassword'] != NULL)
										{
											$newPassw = mysql_entities_fix_string($connection, 'newPassword');
											$newPassword = hash('ripemd128',"$salt1$newPassw$salt2");

												$query = "INSERT INTO dataChange (id, name, surname, email, tel, gender, password, date)	VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', NOW())";
												$result = $connection -> query($query);
												if (!$result) die($connection -> error);

												$query = "UPDATE subscribers SET name = '$name', surname = '$surname', email = '$email', tel = '$tel', password = '$newPassword', gender = '$gender'  WHERE email='$ses_email'";     
												$result = $connection -> query($query);

													if (!$result) echo "UPDATE failed: $query <br>" . $connection -> error . "<br><br>";
													else
													{
														$_SESSION['name'] = $name;
														$_SESSION['surname'] = $surname;
														$_SESSION['email'] = $email;
														$success = "is changed successfully!";
													}

										}
										else
										{

												$query = "INSERT INTO dataChange (id, name, surname, email, tel, gender, password, date)	VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', NOW())";
												$result = $connection -> query($query);
												if (!$result) die($connection -> error);

												$query = "UPDATE subscribers SET name = '$name', surname = '$surname', email = '$email', tel = '$tel',gender = '$gender'  WHERE email='$ses_email' ";     
												$result = $connection -> query($query);

													if (!$result) echo "UPDATE failed: $query <br>" . $connection -> error . "<br><br>";
													else
													{
														$_SESSION['name'] = $name;
														$_SESSION['surname'] = $surname;
														$_SESSION['email'] = $email;
														$success = "is changed successfully!";
													}
										}

											displayHTML();
						}
						else
						{
							fetchFromDatabase($ses_email, $connection);
				
								$success = "failed to change";

													displayHTML();
						}
					}
		}
		else
		{
			fetchFromDatabase($ses_email, $connection);

					displayHTML();
					$_SESSION['triggerValidate'] = "yes";
		}
	}
	else
	{
		header("Location: index.php");
	}






function fetchFromDatabase($ses_email, $connection)
{
	$query = "SELECT * FROM subscribers WHERE email = '$ses_email'";
	$result = $connection -> query($query);

		if (!$result)
		{ die ($connection -> error); }
		elseif ($result->num_rows)//this function returns number of rows
		{
			$row = $result -> fetch_array(MYSQLI_NUM);

				global $name; $name = $row[1];
				global $surname; $surname = $row[2];
				global $email; $email = $row[3];
				global $tel; $tel = $row[4];
				global $gender; $gender = $row[5];

					if($gender == "male")
					{
						global $male; $male = "checked = \"checked\"";
					}
					else
					{
						global $female; $female = "checked = \"checked\"";
					}
						$result -> close();
		}
}

function displayHTML()
{
	global $name,$surname,$email,$tel,$gender,$success,$male,$female,$fail1,$fail2,$fail3,$fail4,$fail5,$fail6,$fail7;

	echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylespersonalPage.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
		<script src = "javaScript/validatePersonalPage.js"></script>
			<title>Personal page</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey
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

				<div id = "form1">

					<div id = "formHeader">
						Personal data<br>
						$success
					</div>

					<form name = "personalPage" action = "personalPage.php" method = "POST" onsubmit = "return validate(this)">

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
							$fail7
						</div>

						<p>
							<label>New password
								<input class = "input1"  type = "password" size="20" maxlength="20" name="newPassword" >
							</label>
						</p>
							(Fill it for setting new password)

						<div class = "remark">
							$fail6
						</div>

						<p>
							<label>Current password
								<input class = "input1"  type = "password" size="20" maxlength="20" name="currentPassword">
							</label>
						</p>
							(Enter it for making changes done)

						<div class = "remark">
							$fail5
						</div>
					
							<input id = "doneButton" type = "submit" name =  "submit2" value = "change";><br>

							<a href="http://1testingsite.loc/index.php">
   							<input id = "cancellationButton" type="button" value="cancel" />			
							</a> 

							<input id= "resetButton" type = "reset" name =  "reset2" value = "reset";>
					
	
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

}

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

function validatePasswordCurrent($field)
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

function validatePasswordNew($field)
{
	if($field == "") 
	{	return "";	}
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

