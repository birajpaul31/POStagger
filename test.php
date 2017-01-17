
<?php
ob_clean();
ob_start();
session_start();
// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in'])
   || $_SESSION['db_is_logged_in'] !== true) {

   // not logged in, move to login page
   ob_clean();
   header('Location: logxp.php');
   exit;
}
//echo "HI";
$val=$_SESSION[file];
//echo "<br>$val<br>";
$fh = fopen($val, 'r');
$theData = fread($fh,filesize($val));
fclose($fh);
header('Location: test1.php');
//echo $theData;

/*echo "<link href='aristyle.css' rel='stylesheet' type='text/css'>";
echo " <div id='ari1'>
               <form name='form1'  method='post' action='test1.php'>
                        <textarea id='ari2'rows=15 cols=100 name='text'>$theData</textarea>
                        <input type='submit' value='Start Tagging'>
               </form>




      </div>";*/




?>









