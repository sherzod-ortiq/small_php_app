<?php

	session_start();

	if (($_SESSION['name'] != NULL) && ($_SESSION['admin'] == "no"))
	{
		$_SESSION['address'] = "index.php";
		$ses_email = $_SESSION['email'];
		$name = $_SESSION['name'];
		$surname = $_SESSION['surname'];
		$_SESSION['triggerValidate'] = ""; // It will be replaced by AJAX functions.

	require_once 'databaseKey/loginUser1.php';
		$connection = new mysqli($hn, $un, $pw, $db);
		if ($connection -> connect_error) die ($connection -> connect_error);

			$query = "SELECT * FROM subscribers WHERE email = '$ses_email'";
			$result = $connection -> query($query);
				if (!$result) 
				{	die($connection -> error);	}
				elseif($result -> num_rows)
				{
					$row = $result -> fetch_array(MYSQLI_NUM);
					$us_id = $row[0];
				}

					if ($_POST['name1'] != NULL)
					{
						$BuyError = $weight = "";
 
							$weight = mysql_entities_fix_string($connection, 'name1');

							$BuyError = validateInput($weight);
							$weightRet = $weight;
							$goodID = mysql_entities_fix_string($connection, 'goodID');
	
						if($BuyError == "")
						{
							$weightRet = "";// because of successful validation

									$query = "SELECT * FROM balance WHERE id = '$us_id'";
									$result = $connection -> query($query);
										if (!$result) die($connection -> error);
										else
										{
											$row = $result -> fetch_array(MYSQLI_NUM);
											$balance = $row[1];
										}

									$query = "SELECT * FROM availableGoods WHERE id = '$goodID'";
									$result = $connection -> query($query);
										if (!$result) die($connection -> error);
										elseif($result -> num_rows)
										{
											$row = $result -> fetch_array(MYSQLI_NUM);
											$price = $row[3];
											$available_weight = $row[2];
										}

											if ($available_weight >= $weight)
											{
												if($balance >= ($sum = ($weight * $price)))
												{
													$query = "SELECT * FROM goodOwners WHERE (userID = '$us_id' && goodID = '$goodID')";
													$result = $connection -> query($query);
														if (!$result) die($connection -> error);
										
															if($result -> num_rows)
															{
																$query = "UPDATE goodOwners SET weight = weight + $weight WHERE (userID = '$us_id' && goodID ='$goodID')";
																$result = $connection -> query($query);
																if (!$result) die($connection -> error);
															}
															else
															{
																$query = "INSERT INTO goodOwners (userID, goodID, weight)	VALUES ('$us_id', '$goodID', '$weight')";
																$result = $connection -> query($query);
																if (!$result) die($connection -> error);
															}

																$query = "UPDATE availableGoods SET weight = weight - $weight WHERE id ='$goodID'";
																$result = $connection -> query($query);
																if (!$result) die($connection -> error);

																$query = "UPDATE balance SET balanceUSD = balanceUSD - $sum WHERE id ='$us_id'";
																$result = $connection -> query($query);
																if (!$result) die($connection -> error);

																$query = "INSERT INTO transactions (userID, goodID, weight, priceUSD, date)	VALUES ('$us_id', '$goodID', '$weight', '$price', NOW())";
																$result = $connection -> query($query);
																if (!$result) die($connection -> error);
												}
												else
												{	
													$BuyError = "Insufficient balance";	
													$weightRet = $weight;
												}

											}
											else
											{	
												$BuyError = "Weight is not available";
												$weightRet = $weight;	
											}										

							}
						}
						elseif(($_POST['cardNum'] != NULL) || ($_POST['moneyAm'] != NULL))
						{
							$cardNumberError = $fillError = "";

							if($_POST['cardNum'] != NULL)
							{
								$cardNum = mysql_entities_fix_string($connection, 'cardNum');
							}

							if($_POST['moneyAm'] != NULL)
							{
								$moneyAm = mysql_entities_fix_string($connection, 'moneyAm');
							}

								$cardNumberError = validateInput($cardNum);
								$fillError = validateInput($moneyAm);


							if(($fillError == "") && ($cardNumberError == ""))
							{
								$cardNum = mysql_entities_fix_string($connection, 'cardNum');
								$moneyAm = mysql_entities_fix_string($connection, 'moneyAm');

							$query = "SELECT * FROM card WHERE number = '$cardNum'";
							$result = $connection -> query($query);
							if (!$result) die($connection -> error);
							
								if($result -> num_rows)
								{ 
									$row = $result -> fetch_array(MYSQLI_NUM);
									$cardBalance = $row[1];

										if($moneyAm <= $cardBalance)
										{
											$query = "UPDATE card SET balanceUSD = balanceUSD - $moneyAm WHERE number = '$cardNum'";
											$result = $connection -> query($query);
											if (!$result) die($connection -> error);

											$query = "UPDATE balance SET balanceUSD = balanceUSD + $moneyAm WHERE id = '$us_id'";
											$result = $connection -> query($query);
											if (!$result) die($connection -> error);

											$query = "INSERT INTO balanceFilling (id, cardNumber, sum, date)	VALUES ('$us_id', '$cardNum', '$moneyAm', NOW())";
											$result = $connection -> query($query);
											if (!$result) die($connection -> error);
										}
										else
										{
											$fillError = "Your card balance is fewer";

												$cardNumRet = $cardNum;
												$moneyAmRet = $moneyAm;
										}
								}
								else
								{	
									$cardNumberError = "Unknown card";

										$cardNumRet = $cardNum;
										$moneyAmRet = $moneyAm;
	
								}
						}
						else
						{
							$cardNumRet = $cardNum;
							$moneyAmRet = $moneyAm;
						}

					}
				

						$query1 = "SELECT * FROM availableGoods";
						$result1 = $connection -> query($query1);
						if (!$result1) die($connection -> error);

						$query = "SELECT * FROM subscribers WHERE email = '$ses_email'";
						$result = $connection -> query($query);
						if (!$result) 
						{	die($connection -> error);	}
						elseif($result -> num_rows)
						{
							$row = $result -> fetch_array(MYSQLI_NUM);
							$us_id = $row[0];
						}

						$query2 = "SELECT * FROM goodOwners WHERE userID = '$us_id'";
						$result2 = $connection -> query($query2);
						if (!$result2) die($connection -> error);

						$query = "SELECT * FROM balance WHERE id = '$us_id'";
						$result = $connection -> query($query);
						if (!$result) die($connection -> error);
						else
						{
							$row = $result -> fetch_array(MYSQLI_NUM);
							$balance = $row[1];
						}

							echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesTrade.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
		<script src = "javaScript/validatePurchase.js"></script>
			<title>Trade page, Dried fruits of Turkey</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey<br>Trade
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
				
				<div id = "contentsLeft">
					<h3>Available goods</h3>

_END;

displayGoods($result1, $goodID, $BuyError,$weightRet);

echo <<<_END

				</div>

				<div id = "contentsRight">
					<h3>You have</h3>

					<div id = "balance">

						Current balance:$balance USD<br>
						Filling

						<form name = "balance" action = "tradePage.php" method = "POST" onsubmit = "return validateBalanceFill(this)">
			
								<label id = "label1"> Card number
								<input class = "text1" type = "text" size="20" maxlength="20" name="cardNum" value = "$cardNumRet">
								</label>

								<div class = "correct">
									$cardNumberError
								</div>

								<label id = "label2" >Money amount
								<input class = "text1" type = "text" size="20" maxlength="20" name="moneyAm" value = "$moneyAmRet">
								</label>

								<div class = "correct">
									$fillError
								</div>

								<input class = "button1" type = "submit" name =  "submit1" value = "Fill">
								<input class = "button1" type = "reset" name =  "reset1" value = "Reset">

						</form>
						
				</div>
_END;

displayGoodOwners($result2, $connection);

echo <<<_END

			</div>

				<div id = "clear">
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
	else
	{ header("Location: index.php"); }


function displayGoods($result1, $goodID, $BuyError, $weightRet)
{
	$num_rows = $result1 -> num_rows;
		for($i = 0; $i < $num_rows; ++$i)
		{
			$result1 -> data_seek($i);
			$row1 = $result1 -> fetch_array(MYSQLI_NUM);

				if($row1[2] > 0)
				{	
					if($goodID == $row1[0])
					{	
						$error = $BuyError;
						$ret = $weightRet;	
					}
					else
					{ 
						$error = '';
						$ret = '';
					}

				echo '<form name = "buy' . $row1[0] . '" action = "tradePage.php" method = "POST" onsubmit = "return validatePurchase(this)">

							<div class = "availableGoods">'
											. $row1[1] .							
					 			'<div class = "weight">'
									. $row1[2] . ' kilos available, '.$row1[3].' USD per kilo
								</div>

								<div class = "transaction">
									<input class = "text1" type = "text"  name =  "name1" value = "'.$ret.'" >kilos
									<input class = "button1" type = "submit" name =  "submit" value = "Buy";>
								</div>

								<div class = "correct">
									' . $error . '
								</div>

						 </div>
							
							<input type = "hidden", name = "goodID" value = "' . $row1[0] . '">

					</form>';
				}

		}
}


function validateInput($field)
{
	if($field == "")
	{	return "No input";	}
	elseif (preg_match("/[^0-9]/", $field))
	{	return "Only numbers are allowed";	}
	else
	{	return "";}		
}

function displayGoodOwners($result2, $connection)
{
	$num_rows = $result2 -> num_rows;
		for($i = 0; $i < $num_rows; ++$i)
		{
			$result2 -> data_seek($i);
			$row2 = $result2 -> fetch_array(MYSQLI_NUM);

				$query = "SELECT * FROM availableGoods WHERE id = '$row2[1]'";
				$result = $connection -> query($query);
				$row = $result -> fetch_array(MYSQLI_NUM);
			
				echo '<div class = "youHave">
								'.$row2[2].' kilos of<br>
								'.$row[1].'
						</div>';
	

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
