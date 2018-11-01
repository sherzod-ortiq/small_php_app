<?php

	session_start();

if(!isset($_SESSION['name']))
{
	require_once 'databaseKey/loginUser1.php';
	$connection = new mysqli($hn, $un, $pw, $db);

	if ($connection -> connect_error) die ($connection -> connect_error);

		$password = $email = "";

		if($_POST['email'] != NULL)
		{
			$email = mysql_entities_fix_string($connection, 'email');
			$_SESSION['emailBack'] = $email;
				
				if( $email == "root@root.root")
				{
					$_SESSION['address'] = "adminPage.php";
					$_SESSION['admin'] = "yes";
			  }
				else
				{	$_SESSION['admin'] = "no";}
		}

		if($_POST['password'] != NULL)
		{
			$password = mysql_entities_fix_string($connection, 'password');
		}

			$failEmail = validateEmail($email);
			$failPassword = validatePassword($password);

					$_SESSION['failEmail'] = $failEmail;
					$_SESSION['failPassword'] = $failPassword;


		if(($failEmail == "") && ($failPassword == ""))
		{ 
			$email = mysql_entities_fix_string($connection, 'email');

				$query = "SELECT * FROM subscribers WHERE email = '$email'";
				$result = $connection -> query($query);

					if (!$result)
					{ die ($connection -> error); }
					elseif ($result->num_rows)//this function returns number of rows
					{
						$row = $result -> fetch_array(MYSQLI_NUM);

							$result -> close();

								$salt1 = "kebdoz";
								$salt2 = "reSh";
					      $passw = mysql_entities_fix_string($connection, 'password');
								$password = hash('ripemd128', "$salt1$passw$salt2");

									if ($password == $row[6])
									{
											$_SESSION['name'] = $row[1];
											$_SESSION['surname'] = $row[2];
											$_SESSION['email'] = $row[3];
									}
									else
									{
											$_SESSION['failPassword'] = "Incorrect password";
									}
									
						}
						else
						{
								$_SESSION['failEmail'] = "Incorrect email";									
						}

		}

							$connection -> close();
	
								$url = $_SESSION['address'];

									header( "Location: ".$url);

}
else
{ header("Location: index.php");}

function validateEmail($field)
{
	if($field == "") 
	{	return "No input";	}
	elseif((strlen($field) < 3) || (strlen($field) > 20))
	{	return "Invalid Email";	}
	elseif (!((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $field))
	{	return "Invalid Email";	}
	else
	{	return "";}		
}

function validatePassword($field)
{
	if($field == "") 
	{	return "No input";	}
	elseif((strlen($field) < 2) || (strlen($field) > 4))
	{	return "Invalid Password";	}
  elseif (!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field))
	{	return "Invalid Password";	}
	elseif (preg_match("/[^a-zA-Z0-9]/", $field))
	{	return "Invalid Password";	}
	else
	{	return "";	}		
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
