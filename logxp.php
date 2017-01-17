<?php
	if(isset($_SESSION)){
		session_start();
		session_destroy();
	}
session_start();
$errorMessage = '';

if (isset($_POST['uname']) && isset ($_POST['pword'])) 
{
	mysql_connect("localhost","root","");
	mysql_select_db("corpora") or die(mysql_error());
	//include "connection.php";
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	$filename = $uname."_test.html";
	$sql = "SELECT * FROM exp_det WHERE name = '$uname' AND password ='$pword'";
	$result = mysql_query($sql) or die('Query failed. ' . mysql_error());
        if ($_POST['uname'] == "" || $_POST['pword'] == "")
		echo "Please enter username and password.";
	else if ((mysql_num_rows($result) == 1))
	{
		while($row = mysql_fetch_assoc($result))
		{
			$_SESSION['opt']=$row['opt']; 
				if(file_exists($filename))
				$_SESSION['file']=$filename;
				else
				$_SESSION['file']=$row['file'];
		}
		$_SESSION['db_is_logged_in'] = true;
		$_SESSION["username"]=$uname;
		$_SESSION["intime"] =date("Y/m/d    H:i:s");
		
		$query2= "UPDATE exp_det SET intime='".$_SESSION[intime]."' WHERE name='".$_SESSION[username]."'";
		$result2=mysql_query($query2) or die('Query failed.'.mysql_error());
		header('Location: test1.php');
		exit();
	}
	else
	{

                $errorMessage = 'Sorry, The Usename & Password did not match';
	        //echo $errorMessage;

        }

}
?>

<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<TABLE align="center"  bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="1" width="800">
<TR> <TH COLSPAN=2 BGCOLOR="#FFFFFF">
<TABLE WIDTH="100%">
<tr><TD ROWSPAN="2" WIDTH="150"><IMG SRC="iit_logo.gif" HEIGHT="115" WIDTH="115" ALT="Indian Institute of Technology Guwahati" BORDER="0"></A></TD><TD VALIGN="TOP">
  <TR><TD><FONT COLOR = "#505e1e" SIZE="+2" ALIGN="center" ><B>Indian Institute of Technology Guwahati </B></FONT></TD></TR>
</TABLE>
</TABLE>
<center>

<form method="post" name="frmLogin" id="frmLogin" action="logxp.php">
<br /><br /><br /><br /><br /><br />
<table width="400" border="1" align="center" cellpadding="2" cellspacing="2">
<tr>
<td width="100">User Name:</td>
<td><input name="uname" type="text" ></td>
</tr>

<tr>
<td width="100">Password:</td>
<td><input name="pword" type="password"></td>
</tr>

<tr>
<td width="100">&nbsp;</td>
<td><input type="submit" name="btnLogin" value="Login"></td>
</tr>
</table>
<?php
if ($errorMessage != '')

 {
	?>
	<p align="center"><strong><font color="#990000"><?php echo $errorMessage;?></font></strong></p>
	<?php
 }
?>
</form>
</center>
</body>
</html>
