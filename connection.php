<?php

session_start();

$db = mysql_connect("jatinga11.iitg.ernet.in", "pkdutta", "") or die("Could not connect.");

                      $result = mysql_query("SET NAMES 'utf8'");
                      mysql_query('SET CHARACTER SET `utf8`');
                      mysql_query("set session collation_connection='utf8_general_ci'");
if(!$db) 
   die("no db");

if(!mysql_select_db("corpora",$db))

 	die("No database selected.");
?>


