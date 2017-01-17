<?php
session_start();
	include "connection.php";
		mysql_select_db("corpora") or die(mysql_error());
if (isset($_SESSION['db_is_logged_in']))
{		$a =date("Y/m/d    H:i:s");
		
	$query= "UPDATE exp_det SET outtime='".$a."',opt='".$_SESSION[opt]."' WHERE name='".$_SESSION[username]."' AND intime='".$_SESSION[intime]."' ";		
	$result1=mysql_query($query) or die('Query failed.'.mysql_error());
	unset($_SESSION['db_is_logged_in']);
}
header('Location: logxp.php');
#http://www.daniweb.com/web-development/php/threads/124500/session-time-out-in-php
?>

