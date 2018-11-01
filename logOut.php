<?php
	session_start();


if($_SESSION['name'] != NULL)
{

		$url = $_SESSION['address'];

			destroy_session_and_data();

				header( 'Location: '.$url );
			
}
else
{
	header('Location: index.php');
}

function destroy_session_and_data()
{
	$_SESSION = array();
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();
}

?>
