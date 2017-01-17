<?php
$change="";
//ob_clean();
//ob_start();
    session_start();
    $_SESSION['wrdcnt']=0;
    $inactive = 6;
    	if(isset($_SESSION['timeout'])){
    		$_SESSION['life'] = time() - $_SESSION['timeout'];
    			if($_SESSION['life'] > $inactive){ 
				header("Location: session_exp.php"); 
    			}
    	}
    $_SESSION['timeout'] = time();

?>

<html>
<head>
	<style type="text/css">
	.open {
		display:	block;
	}

	.close {
		display:	none;
	}
	</style>

	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript"> 
		var i=0;

		function boca(id1,id2){
                        var str2="hide"+id1+id2;
			i++;
	   			if($('#'+str2).hasClass('open')) {
					$('#'+str2).addClass('close').removeClass('open');
				}
				else {
					$('.open').addClass('close').removeClass('open');
					$('#'+str2).addClass('open').removeClass('close');
			
			    	 }
                        }
	</script>
		
	<script type="text/javascript">
		var count=0;
		var str="";
		function changed(i,j,wrd,old_tag){
			count ++;
			var id = "hide" + i + j ;
			var index=document.getElementById(id).selectedIndex;
			var new_tag=document.getElementById(id).options[index].value;
			str+=wrd+"%"+new_tag+"%"+old_tag+"$";
			document.forms[1].elements[0].value=str;
		}
	</script>
       <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div id="header">
		<img src="iit_logo.gif" alt="Indian Institute of Technology Guwahati" /><span>Indian Institute of Technology Guwahati</span>
	</div>

	<div id="content">
		
		<div id='tags' style='margin:0px auto;'>
			<h2 style='text-align:center;'>The text splitted into sentences</h2>
		</div>
		 
		<?php
		if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) { 	// not logged in, move to login page

  		 	ob_clean();
   			header('Location: logxp.php');
   			exit;
		}
		$val=$_SESSION['file'];
		$_SESSION['file'] = $val;
		$fh = fopen($val, 'r');
		$theData = fread($fh,filesize($val));
		fclose($fh);
                $sentence=explode("।##PUNC",$theData);
		$count=sizeof($sentence);
		echo "<div id='first' style='margin:0px auto';>";
		echo "<table id='table1'>";
			for($i = 0;$i<$count;$i++) {
				$j = $i + 1;
                		$Tsent=$sentence[$i]."  ।/PUNC";
				echo "<tr><td>Sentence[$j] = $Tsent</td></tr>";    
			}
		echo "</table>";
		echo "</div>";
		echo "<div id='tags' style='margin:0px auto;'>";
		echo"<h2 style='text-align:center;'>The tagged output of the input text is:</h2>";
		echo "<form action='final.php','session_exp.php' method='post'>";
		echo "<div id='para1'>";
			for($i=0;$i<$count;$i++) {
				$Tsent=$sentence[$i]." ।/PUNC";
				#$words = split("[ ]+", $sentence[$i]);
				$words = split("[ ]+", $Tsent);
				$c=sizeof($words);
					for($j=0;$j<$c;$j++) {
						if($words[$j]!="") { 
							#$indv = split('[/]+',$words[$j]);
							$indv = split('/',$words[$j]);
							echo "<span id='word$i$j' style='text-align:left;'><a onclick='boca($i,$j)';>$indv[0]</a> &nbsp;<br /> <a><select id='hide$i$j'
class='close' name='hide$i$j' onchange='changed($i,$j,\"$indv[0]\",\"$indv[1]\")';>
 
								<option selected=\"selected\">$indv[1]</option>";
								if($k!='noun'){echo"<option value='noun'>noun</option>";}
								if($k!='Pronoun'){echo"<option value='Pronoun'>Pronoun</option>";}
								if($k!='Verb'){echo"<option value='Verb'>Verb</option>";}
								if($k!='Article'){echo"<option value='Article'>Article</option>";} 
								echo "</select></a></span>";

				
						}
					} 
			}
              		echo "<br>";
			
		?>

	<script>
		document.getElementById('para1').style.height = "200px";
	</script>
			
		<?php
		echo "&nbsp;</div>";
		echo "<input type='submit' value='Click here to get the final result'>";
		echo "</form>";
		echo "</div>";
		?>
	</div>
	<form style="display:none" action="session_exp.php" method="post">
		<input name ="expire" type="hidden" value="Value" />
	</form>
	<script type="text/javascript">
		idleTime = 0;
		$(document).ready(function () {						//Increment the idle time counter every minute.
   		var idleInterval = setInterval("timerIncrement()", 6000); 		// 1 minute
	    		$(this).mousemove(function (e) {
			idleTime = 0;
	   		});

	    		$(this).keypress(function (e) {
			idleTime = 0;
	    		});

			$(this).scroll(function (e) {
			idleTime = 0;
	    		});

			$("#para1").scroll(function (e) {
			idleTime = 0;
	    		});

			$("#first").scroll(function (e) {
			idleTime = 0;
	    		});
		})
			
			function timerIncrement() {
	    		idleTime = idleTime + 1;
	    			if (idleTime > 1) { // 20 minutes
					alert("Your session has expired");
					document.forms[0].action="session_exp.php";
					document.forms[0].submit();
					document.forms[1].submit();
	    			}
			}

	</script>

</body>
</html>
