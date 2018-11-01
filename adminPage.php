<?php

	session_start();
		$_SESSION['address'] = "index.php";

	if($_SESSION['admin'] == "yes" && $_SESSION['name'] != "")
	{	
	require_once 'databaseKey/loginUser1.php';
		$connection = new mysqli($hn, $un, $pw, $db);
		if ($connection -> connect_error) die ($connection -> connect_error);

////this is for <select YEAR>
			$query = "SELECT MIN(date), MAX(date) FROM subscribers";
			$resultD = $connection -> query($query);
				if (!$resultD) 
				{	die($connection -> error);	}
				elseif($resultD -> num_rows)
				{
					$row = $resultD -> fetch_array(MYSQLI_NUM);
					$date = explode('-', $row[0] . '-' . $row[1]);
				}
////this is for <select YEAR>

////this is for available goods
			$query = "SELECT * FROM availableGoods";
			$resultG = $connection -> query($query);
				if (!$resultG) 
				{	die($connection -> error);	}
////this is for available goods

    if($_POST['formNum'] == "form1")
		{
			$count = 0;

			if($_POST['name1'] != NULL)
			{ 
				$out = mysql_entities_fix_string($connection, 'name1');
				$out1 = 'AND (name LIKE "'. $out .'%")';
				$outBack1 = $out;
					$count ++;
			}

			if($_POST['surname1'] != NULL)
			{ 
				$out = mysql_entities_fix_string($connection, 'surname1');
				$out2 = 'AND (surname LIKE "'. $out .'%")';
				$outBack2 = $out;
					$count ++;
			}

			if($_POST['gender'] != NULL)
			{ 
				$out = $_POST['gender'];
				if( $out != "both")
				{	$out3 = 'AND (gender = "'. $out .'")';	}

					if($out == "male")
					{	$outBack3_1 = "checked = \"checked\"";	}
					elseif($out == "female")
					{	$outBack3_2 = "checked = \"checked\"";	}
					else
					{	$outBack3_3 = "checked = \"checked\"";	}
						$count ++;
			}

			if(($_POST['minBalance'] != NULL) && ($_POST['maxBalance'] != NULL) && ($_POST['minBalance'] <= $_POST['maxBalance']))
			{
				$outBack4_1 = $out4_1 = mysql_entities_fix_string($connection, 'minBalance');
				$outBack4_2 = $out4_2 = mysql_entities_fix_string($connection, 'maxBalance');
				$out4 = 'AND (balanceUSD BETWEEN '. $out4_1 .' AND '. $out4_2 .')';
					$count ++;	
			}

			if(($_POST['yearFrom'] != NULL) && ($_POST['monthFrom'] != NULL) && ($_POST['dayFrom']) && ($_POST['yearTo'] != NULL) && ($_POST['monthTo'] != NULL) && ($_POST['dayTo']) && ($_POST['yearTo'] >= $_POST['yearFrom']))
			{
				$out5_1 = ((mysql_entities_fix_string($connection, 'yearFrom')) .'-'. (mysql_entities_fix_string($connection, 'monthFrom')) .'-'.(mysql_entities_fix_string($connection, 'dayFrom')));
				$out5_2 = ((mysql_entities_fix_string($connection, 'yearTo')) .'-'. (mysql_entities_fix_string($connection, 'monthTo')) .'-'. (mysql_entities_fix_string($connection, 'dayTo')));
				$out5 = 'AND (date BETWEEN \''. $out5_1 .'\' AND \''. $out5_2 .'\')';
				$out5Combined = $out5_1 .'-'. $out5_2;
					$count ++;	
			}

				if($count > 0)
				{	
					$query =' SELECT subscribers.id, name, surname, email, tel, gender, balanceUSD, date from subscribers,balance
										WHERE subscribers.id = balance.id '. $out1 . $out2 . $out3 . $out4 . $out5.' ORDER BY subscribers.id ASC';

					$result = $connection -> query($query);
					if (!$result) 
					{	die($connection -> error);	}
				}

		}


    if($_POST['formNum'] == "form2")
		{
			$count = 0;

			if($_POST['userID1'] != NULL)
			{ 
				$outS = mysql_entities_fix_string($connection, 'userID1');
				$outS1 = ' AND (subscribers.id = "'. $outS .'") ';
				$outBackS1 = $outS;
					$count ++;
			}


			if(($_POST['minWeight'] != NULL) && ($_POST['maxWeight'] != NULL) && ($_POST['minWeight'] <= $_POST['maxWeight']))
			{
				$outBackS2_1 = $outS2_1 = mysql_entities_fix_string($connection, 'minWeight');
				$outBackS2_2 = $outS2_2 = mysql_entities_fix_string($connection, 'maxWeight');
				$outS2 = ' AND (goodOwners.weight BETWEEN '. $outS2_1 .' AND '. $outS2_2 .') ';
					$count ++;	
			}

			if($_POST['goods1'] != NULL)	
			{
				$outS3 = $outBackS3 = $_POST['goods1'];				
				$outS3 = ' AND (goodID = "'. $outS3 .'") ';
					$count ++;	
			}

				if($count > 0)
				{	
					$query ='SELECT subscribers.id, subscribers.name, surname, tel, email, availableGoods.name, goodOwners.weight from subscribers,goodOwners,availableGoods
										WHERE (subscribers.id = goodOwners.userID) AND (goodOwners.goodID = availableGoods.id)'.$outS1.$outS2.$outS3.' ORDER BY subscribers.id ASC , weight DESC';

					$result1 = $connection -> query($query);
					if (!$result1) 
					{	die($connection -> error);	}
				}

		}

    if($_POST['formNum'] == "form3")
		{
			$count = 0;

			if($_POST['userID1'] != NULL)
			{ 
				$outF1 = $outBackF1 = mysql_entities_fix_string($connection, 'userID1');
				$outF1 = 'AND (subscribers.id = "'. $outF1 .'")';
					$count ++;
			}

			if($_POST['goods2'] != NULL)	
			{
				$outF2 = $outBackF2 = $_POST['goods2'];				
				$outF2 = ' AND (transactions.goodID = "'. $outF2 .'") ';
					$count ++;	
			}


			if(($_POST['minWeight'] != NULL) && ($_POST['maxWeight'] != NULL) && ($_POST['minWeight'] <= $_POST['maxWeight']))
			{
				$outBackF3_1 = $outF3_1 = mysql_entities_fix_string($connection, 'minWeight');
				$outBackF3_2 = $outF3_2 = mysql_entities_fix_string($connection, 'maxWeight');
				$outF3 = 'AND (transactions.weight BETWEEN '. $outF3_1 .' AND '. $outF3_2 .')';
					$count ++;	
			}

			if(($_POST['yearFrom'] != NULL) && ($_POST['monthFrom'] != NULL) && ($_POST['dayFrom']) && ($_POST['yearTo'] != NULL) && ($_POST['monthTo'] != NULL) && ($_POST['dayTo']) && ($_POST['yearTo'] >= $_POST['yearFrom']))
			{
				$outF4_1 = ((mysql_entities_fix_string($connection, 'yearFrom')) .'-'. (mysql_entities_fix_string($connection, 'monthFrom')) .'-'.(mysql_entities_fix_string($connection, 'dayFrom')));
				$outF4_2 = ((mysql_entities_fix_string($connection, 'yearTo')) .'-'. (mysql_entities_fix_string($connection, 'monthTo')) .'-'. (mysql_entities_fix_string($connection, 'dayTo')));
				$outF4 = 'AND (transactions.date BETWEEN \''. $outF4_1 .'\' AND \''. $outF4_2 .'\')';
				$outF4Combined = $outF4_1 .'-'. $outF4_2;
					$count ++;	
			}

				if($count > 0)
				{	
					$query ='	SELECT subscribers.id, subscribers.name, surname, tel, email, availableGoods.name, transactions.weight, transactions.priceUSD, transactions.date from subscribers,transactions,availableGoods
										WHERE (subscribers.id = transactions.userID) AND (transactions.goodID = availableGoods.id) '.$outF1.$outF2.$outF3.$outF4.' ORDER BY subscribers.id ASC, transactions.date DESC';

					$result2 = $connection -> query($query);
					if (!$result2) 
					{	die($connection -> error);	}
				}

		}

		if(($rowsNum = $_POST['rowsNum']) != NULL)
		{
			$count1 = 0;
				for($i = 0; $i < $rowsNum; $i++)
				{	
					if(($_POST['weight'.$i] != NULL) && ($_POST['price'.$i] != NULL))
					{	$count1 ++;}
				}

					if($rowsNum == $count1)
					{
						for($j = 0; $j < $rowsNum; $j ++)
						{
							$weightI = $_POST['weight'.$j];
							$priceI = $_POST['price'.$j];
							$ID  = $_POST['ID'.$j];
										
							$query = "UPDATE availableGoods SET weight = $weightI, pricePerKilo = $priceI WHERE id = $ID ";
							$result = $connection -> query($query);
								if(!$result) die($connection -> error);

						}
					}				

 		}


    if(($_POST['formNum'] == "form4") || ($_POST['rowsNum'] != NULL))
		{
			$count = 0;

			if($_POST['goodName'] != NULL)
			{ 
				$outG1 = $outBackG1 = mysql_entities_fix_string($connection, 'goodName');
				$outG1 = '(name LIKE "'. $outG1 .'%") ';
					$count ++;
			}


			if(($_POST['minPrice'] != NULL) && ($_POST['maxPrice'] != NULL) && ($_POST['minPrice'] <= $_POST['maxPrice']))
			{
				$outBackG2_1 = $outG2_1 = mysql_entities_fix_string($connection, 'minPrice');
				$outBackG2_2 = $outG2_2 = mysql_entities_fix_string($connection, 'maxPrice');
					if($_POST['goodName'] != NULL)
					{	$outG2 = ' AND ( pricePerKilo BETWEEN '. $outG2_1 .' AND '. $outG2_2 .')';	}
					else
					{	$outG2 = ' ( pricePerKilo BETWEEN '. $outG2_1 .' AND '. $outG2_2 .')';	}
						$count ++;	
			}

				if($count > 0)
				{	
					$query ='	SELECT id,name,weight,pricePerKilo FROM availableGoods WHERE '.$outG1.$outG2.'  ORDER BY id ASC, pricePerKilo DESC';
					$result3 = $connection -> query($query);
					if (!$result3) 
					{	die($connection -> error);	}
				}

		}


					echo <<<_END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<link href = "css/stylesAdminPage.css" type = "text/css" rel = "stylesheet">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
			<title>Personal page</title>
	</head>

		<body>

			<div id = "header">
				<div id = "header1">
					Dried fruits of Turkey<br>Administration
				</div>
			</div>


			<div id = "contents"> 


					<form class = "form1" name = "searchUsers" action = "adminPage.php" method = "POST">

							Searching for users<br>

							<label>
								Name
								<input  type = "text" size="15" maxlength="15" name="name1" value = "$outBack1">
							</label>

							<label>
								Balance from
								<input class = ""  type = "text" size="6" maxlength="6" name="minBalance" value = "$outBack4_1">
							</label>

							<label>
								to
								<input class = ""  type = "text" size="6" maxlength="6" name="maxBalance" value = "$outBack4_2">
								USD	
							</label>

											<br>
							
							<label>
								Surname
								<input  type = "text" size="15" maxlength="15" name="surname1" value = "$outBack2">
							</label>

							Gender
								<label>
									Male
									<input type = "radio" name = "gender" value = "male" $outBack3_1>
								</label>

								<label>
									Female
									<input type = "radio" name = "gender" value = "female" $outBack3_2>
								</label>					

								<label>
									Both
									<input type = "radio" name = "gender" value = "both" $outBack3_3>
								</label>

												<br>
					
							Registrated between
_END;
								showTime($date,$out5Combined,"From");
echo <<<_END

							and

_END;
								showTime($date,$out5Combined,"To");
echo <<<_END


												<br>

								<input class = "SubRes" type = "submit" name =  "search1" value = "Search">
								<input class = "SubRes" type = "reset" name =  "reset1" value = "reset">

								<input type = "hidden", name = "formNum" value = "form1">

					</form>


_END;
								showResult($result,"1");
echo <<<_END
				
					<form class = "form1" name = "searchGoodOwners" action = "adminPage.php" method = "POST">
						Searching for good owners<br>
						<label>
							User ID
							<input  type = "text" size="15" maxlength="15" name="userID1" value = "$outBackS1">
						</label>

						Choose product
_END;
								displayGoods($resultG,$outBackS3,"1");
echo <<<_END

										<br>

						<label>
							Weight from
							<input class = ""  type = "text" size="6" maxlength="6" name="minWeight" value = "$outBackS2_1">
						</label>

						<label>
							to
							<input class = ""  type = "text" size="6" maxlength="6" name="maxWeight" value = "$outBackS2_2">
							kilos	
						</label>

										<br>

						<input class = "SubRes" type = "submit" name =  "search1" value = "Search">
						<input class = "SubRes" type = "reset" name =  "reset1" value = "reset">

						<input type = "hidden", name = "formNum" value = "form2">

					</form>

_END;
								showResult($result1,"2");
echo <<<_END


					

					<form class = "form1" name = "searchTransactions" action = "adminPage.php" method = "POST">
						Searching for transactions<br>
						<label>
							User ID
							<input  type = "text" size="15" maxlength="15" name="userID1" value = "$outBackF1">
						</label>

						Choose product
_END;
								displayGoods($resultG,$outBackF2,"2");
echo <<<_END

										<br>

						<label>
							Weight from
							<input class = ""  type = "text" size="6" maxlength="6" name="minWeight" value = "$outBackF3_1">
						</label>

						<label>
							to
							<input class = ""  type = "text" size="6" maxlength="6" name="maxWeight" value = "$outBackF3_2">
							kilos	
						</label>

										<br>

							Transacted between
_END;
								showTime($date,$outF4Combined,"From");
echo <<<_END

							and

_END;
								showTime($date,$outF4Combined,"To");
echo <<<_END


						<input class = "SubRes" type = "submit" name =  "search1" value = "Search">
						<input class = "SubRes" type = "reset" name =  "reset1" value = "reset">

						<input type = "hidden", name = "formNum" value = "form3">

					</form>

_END;
								showResult($result2,"3");
echo <<<_END

					<form class = "form1" name = "viewEdit" action = "adminPage.php" method = "POST">
						Viewing and editing available goods<br>
	
						<label>
							Good name 
							<input  type = "text" size="20" maxlength="20" name="goodName" value = "$outBackG1">
						</label>

						<label>
							Price from
							<input class = ""  type = "text" size="6" maxlength="6" name="minPrice" value = "$outBackG2_1">
						</label>

						<label>
							to
							<input class = ""  type = "text" size="6" maxlength="6" name="maxPrice" value = "$outBackG2_2">
							USD per kilo	
						</label>

										<br>

						<input class = "SubRes" type = "submit" name =  "search1" value = "Search">
						<input class = "SubRes" type = "reset" name =  "reset1" value = "reset">

						<input type = "hidden", name = "formNum" value = "form4">

_END;
								showResult($result3,"4"); 
echo <<<_END

				</form>

				<form name = "logOut" action = "logOut.php" method = "POST">
					<p>
						<input type = "submit" name =  "submit1" value = "Log out">
					</p>
				</form>

			</div>

		</body>

</html>

_END;

	}
	else
	{	header("Location: index.php");}

function showTime($date,$row,$name)
{
	$min = $date[0];
	$max = $date[3];
	$row = explode('-',$row);

	if($name == "From")
	{	$row1 = array($row[0] , $row[1] , $row[2]);	}
	else
	{	$row1 = array($row[3] , $row[4] , $row[5]);	}


		echo '<select name="year'. $name .'" size="1">
					<option value = "">Year</option>';
			do
			{
				if($min == $row1[0])
				{	echo '<option value = "'. $min .'" selected = "selected" >'. $min .'</option>';	}
				else
				{	echo '<option value = "'. $min .'" >'. $min .'</option>';	}
			}while(++ $min < $max);


		echo '</select>';

		for($i = 1; $i <= 12; $i++)
		{
			if($i == $row1[1])
			{	$out[$i] = ' selected = "selected"';	}
		}

		echo '
					<select name="month'. $name. '" size="1">
						<option value="">Month</option>
						<option value="01"'.$out[1].'>January</option>
						<option value="02"'.$out[2].'>February</option>
						<option value="03"'.$out[3].'>March</option>
						<option value="04"'.$out[4].'>April</option>
						<option value="05"'.$out[5].'>May</option>
						<option value="06"'.$out[6].'>June</option>
						<option value="07"'.$out[7].'>July</option>
						<option value="08"'.$out[8].'>August</option>
						<option value="09"'.$out[9].'>September</option>
						<option value="10"'.$out[10].'>October</option>
						<option value="11"'.$out[11].'>November</option>
						<option value="12"'.$out[12].'>December</option>
					</select>
				 ';

		echo ' 
					<label>Day
						<input class = "" type = "text" size="2" maxlength="2" name="day'. $name .'" value = "'.$row1[2].'">
					</label>
				';
}

function showResult($result,$sNum)
{
	$rows = $result -> num_rows;
		if($rows > 0)
		{
			if($sNum == 1)
			{
				echo "Subscribers
		
								<table>
									<tr> <th id = \"hello\">id</th> <th>Name</th> <th>Surname</th> <th>email</th> <th>Tel</th> <th>Gender</th> <th>balance in USD</th> <th>Date of registration</th>  </tr>";

					for ($j = 0; $j < $rows; ++$j)
					{
						$result -> data_seek($j);
						$row = $result -> fetch_array(MYSQLI_NUM);
							echo "<tr>";
								for ($k = 0; $k < 8; ++ $k) echo "<td>$row[$k]</td>";
							echo "</tr>";
					}

				echo "	</table>";
			}
			elseif($sNum == 2)
			{
				echo "Good owners
		
								<table>
									<tr> <th>id</th> <th>Name</th> <th>Surname</th> <th>email</th> <th>Tel</th> <th>Name of good</th> <th>Weight</th> </tr>";

					for ($j = 0; $j < $rows; ++$j)
					{
						$result -> data_seek($j);
						$row = $result -> fetch_array(MYSQLI_NUM);
							echo "<tr>";
								for ($k = 0; $k < 7; ++ $k) echo "<td>$row[$k]</td>";
							echo "</tr>";
					}

				echo "	</table>";		
			}
			elseif($sNum == 3)
			{
				echo "	
					Transactions
								<table>
									<tr> <th>id</th> <th>Name</th> <th>Surname</th> <th>email</th> <th>Tel</th> <th>Name of good</th> <th>Weight</th> <th>Price per kilo (USD)</th><th>Date of transaction</th> </tr>";

					for ($j = 0; $j < $rows; ++$j)
					{
						$result -> data_seek($j);
						$row = $result -> fetch_array(MYSQLI_NUM);
							echo "<tr>";
								for ($k = 0; $k < 9; ++ $k) echo "<td>$row[$k]</td>";
							echo "</tr>";
					}

				echo "	</table>";		
			}

			elseif($sNum == 4)
			{
				echo "<br>Available goods

								<table>
									<tr> <th>id</th> <th>Name of good</th>  <th>Weight</th> <th>Price per kilo (USD)</th>  </tr>";

					for ($j = 0; $j < $rows; ++$j)
					{
						$result -> data_seek($j);
						$row = $result -> fetch_array(MYSQLI_NUM);
	
							echo "<tr>";
								for ($k = 0; $k < 2; ++ $k) 
								{	echo "<td>$row[$k]</td>";	}
									echo "<td><input class = \"input11\"  type = \"text\" size=\"6\" maxlength=\"6\" name=\"weight$j\" value = \"$row[2]\"</td>
												<td><input class = \"input11\" type = \"hidden\" name=\"ID$j\" value = \"$row[0]\"</td>
												<input class = \"input11\" type = \"text\" size=\"6\" maxlength=\"6\" name=\"price$j\" value = \"$row[3]\"";
		
							echo "</tr>";
					}

				echo "	</table>
							
								<input class = \"SubRes\" type = \"submit\" name =  \"search1\" value = \"Change\">
								<input class = \"SubRes\" type = \"reset\" name =  \"reset1\" value = \"reset\">

								<input type = \"hidden\", name = \"rowsNum\" value = \"$rows\">";		
			}


		}
}

function displayGoods($result, $goodID,$name)
{
	$num_rows = $result -> num_rows;

			echo ' <select name="goods'. $name .'" size="1">
					   	<option value = "">All</option>';

		for($i = 0; $i < $num_rows; ++$i)
		{

			$result -> data_seek($i);
			$row = $result -> fetch_array(MYSQLI_NUM);

				if($goodID == $row[0])
				{	echo '<option value = "'. $row[0] .'" selected = "selected" >'. $row[1] .'</option>';	}
				else
				{	echo '<option value = "'. $row[0] .'" >'. $row[1] .'</option>';	}

		}

			echo '</select>';
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

