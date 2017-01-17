<?php
session_start();
echo "<h1>Your session has been expired </h1>";
$temp=$_SESSION['username']."_test.html";
$file=fopen($temp,"w+");


$new_data=$_POST['expire'];
$word_grp=explode("$",$new_data);
$count_words=sizeof($word_grp);
echo "<table>";
echo "<th><td>Words</td><td>New Tags</td><td>Old tags</td></th>";
	for($i=0;$i<$count_words;$i++){
		echo "<tr>";
		$word=split('%',$word_grp[$i]);
		echo "<td>$word[0]</td><td>$word[1]</td><td>$word[2]</td>";
		echo "</tr>";
	}
echo "</table>";

	$fh = fopen("test.html", 'r');
	$theData = fread($fh,filesize("test.html"));
	fclose($fh);
        $sentence=explode("।##PUNC",$theData);
	$count=sizeof($sentence);

	
	for($i=0;$i<$count-1;$i++) {
		$Tsent=$sentence[$i];
		$words = split("[ ]+", $Tsent);
		$c=sizeof($words);
		for($j=0;$j<$c;$j++) {
			if($words[$j]!="") { 
				//#$indv = split("[/]+",$words[$j]);
				$indv = split("[/]+",$words[$j]);
				fwrite($file,$indv[0]."/".$_POST["hide$i$j"]." ");
			
			}
		} 
		fwrite($file," ।##PUNC  ");
	}
	fclose($file);

echo"<a href=logxp.php>Click here to login again</a>";
session_destroy();
?>
