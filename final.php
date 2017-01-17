<?php
  session_start();
  //if((time() - $_SESSION['timeout'])>5)
    // {  
   
      //      header("Location: session_exp.php"); 
  //   }

?>
<html>
<head>
	<title>New Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="content">
	 
	<?php

	$fh = fopen("test.html", 'r');
	$theData = fread($fh,filesize("test.html"));
	fclose($fh);
        $sentence=explode("।##PUNC",$theData);
	$count=sizeof($sentence);

	echo "<h2 style='text-align:center;'>The updated tagged output:</h2>";
	echo "<div id='para1'>";
	for($i=0;$i<$count;$i++) {
		$Tsent=$sentence[$i]." ।/PUNC";
		//#$words = split("[ ]+", $sentence[$i]);
		$words = split("[ ]+", $Tsent);
		$c=sizeof($words); 
		for($j=0;$j<$c;$j++) {
			if($words[$j]!="") { 
				//#$indv = split("[/]+",$words[$j]);
				$indv = split("[/]+",$words[$j]);
				echo "<span id=\"word".$i.$j."\" style='text-align:left;'>".$indv[0]."/".$_POST["hide$i$j"]."&nbsp;&nbsp;</span>"; 
			
			}
		} 
		echo "<br />";
	}
	?>
	&nbsp;</div>

</div>

</body>
