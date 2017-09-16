<?php
	//$dbInfo = "mysql:host=localhost;dbname=cstar";	
	//$dbUser = "cstar";
	//$dbPassword ="cstar2k17";
	
	$dbhost = 'localhost:3306';
	$dbuser = 'cstar';
	$dbpass = 'cstar2k17';
   
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cstar');
   
    if(! $conn )
	{
		echo "Could not connect: " . mysqli_error();
	}
	
	//try
	//{
	//	$db = new PDO($dbInfo,$dbUser,$dbPassword);
	//	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	echo "
		<html>
			<head>
				<title>C-Star</title>
				<link rel='stylesheet' href='style.css'>
			</head>
			<body>
				<div class='main-text'>
					<!--img src='images/logo.jpg' width='150px' height='100px'-->
					C-Star
				</div>";
	$n=2;
	$answers=array();
	
	session_start();
	$r=$_SESSION['reg'];
	if(isset($_SESSION['answ'])
		$answers=$_SESSION['answ'];
	echo "<br><br>".$r."<br><br>";
	
	print_r($answers);
	$score=0;
	if(isset($_POST['submit']))
	{
		for($i=0;$i<count($answers);$i++)
		{
			echo "<br>in for loop i=".$i;
			$j=$i+1;
			echo "<br>in for loop j=".$j;
			echo "<br>in for loop score=".$score;
			$a="options".$j;
			echo "<br>".$a;
			echo "<br>".$answers[$i];
			echo "<br>".$_POST[$a];
			if(isset($_POST[$a])&&$_POST[$a]==$answers[$i])
				$score++;
		}
		
		//$sql="	UPDATE registration SET score=$score WHERE regno=$regno;";
		//	$db->exec($sql);
			
			echo "<script language='javascript'>
				alert('Thank You participating Your score: $score)');
				</script>
			";
	}
	
	echo "<form method='POST' action='questions.php'>";
	$i=0;
	while( $n > 0 )
	{
		$n--;
		$i++;
		$id=rand(8,13);
		$sql = "SELECT ques,op1,op2,op3,op4,ans from ques_ans where id='$id'";
		//mysql_select_db('cstar');
		$retval = mysqli_query($conn, $sql);
		if(! $retval )
		{
			die('Could not get data: ' . mysqli_error());
		}
		echo "<table border=1>";
		
		while($row = mysqli_fetch_array($retval))
		{
			//echo "{$row['ques']}  <br>" ."{$row['op1']} <br> "."{$row['op2']} <br>"."{$row['op3']} <br>"."{$row['op4']} <br>"."{$row['ans']} <br>";
			echo "
				<tr>
					<td rowspan='5'>ques no</td>
					<td>{$row['ques']}</td>
				</tr>
				<tr>
					<td><input type='radio' name='options$i' value='a'>{$row['op1']}</td>
				</tr>
				<tr>
					<td><input type='radio' name='options$i' value='b'>{$row['op2']}</td>
				</tr>
				<tr>
					<td><input type='radio' name='options$i' value='c'>{$row['op3']}</td>
				</tr>
				<tr>
					<td><input type='radio' name='options$i' value='d'>{$row['op4']}</td>
				</tr>
				<br>
				options
				<br>";
				array_push($answers,"{$row['ans']}");
		}
		$_SESSION['answ']=$answers;
		echo "</table>";
	}
	echo "
			<center><input type='submit' name='submit' value='Submit' class='sub_btn'></center>
		</form>
		<body>
	<html>";
	
	//else
	//	echo "<script language='javascript'>
	//	alert('Please fill all fields!');
	//	</script>
	//	";
	
	
	//}	
	//catch(PDOException $e){	
	//	echo "<h1>Connection failed! :(</h1>";
	//	 echo $sql . "<br>" . $e->getMessage();
	//}
	//$db=null;
	mysqli_close($conn);
?>