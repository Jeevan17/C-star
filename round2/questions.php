<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'cstar';
	$dbpass = 'cstar2k17';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cstar');
   
    if(! $conn )
	{
		echo "Could not connect: " . mysqli_error();
	}
		
	echo "
		<html>
			<head>
				<title>C-Star</title>
				<link rel='stylesheet' href='style.css'>
				<script type='text/javascript'>
					function Redirect() 
					{
						window.location='ttes.php';
					}
					
				</script>
			</head>
			<body>
				<div class='main-text'>
					<!--img src='images/logo.jpg' width='150px' height='100px'-->
					C-Star
					<div class='log_btn' id='response'>
						
					</div>
				</div>";
	
	session_start();
	
	if(isset($_SESSION['reg']))
		$r=$_SESSION['reg'];
	if(!isset($_SESSION['score']))
		$_SESSION['score']=0;
	if(!isset($_SESSION['n']))
		$_SESSION['n']=15;
	if(!isset($_SESSION['answ']))
		$_SESSION['answ']=0;
	
	//echo "<br>reg value:".$r."<br>";		
	
	//echo "<br>n value:".$_SESSION['n']."<br>";

	if(isset($_POST['submit']))
	{
		//echo "<br>jeevan: ".$_POST['options']."<br>gandla: ".$_SESSION['answ']."<br>";
			
		if($_SESSION['n']<=0)
		{
			if(isset($_POST['options'])&&$_POST['options']==$_SESSION['answ'])
				$_SESSION['score']++;
			
			$sql="UPDATE registration SET score=".$_SESSION['score']." WHERE regno='$r';";
			$ret=mysqli_query($conn, $sql);
			//$db->exec($sql);
			if(!$ret)
				echo "<script language='javascript'>
				alert('failed');
				</script>
				";
			else
				echo "<script language='javascript'>
				alert('Thank You participating');
				setTimeout('Redirect()', 1);
				</script>
				";
			//session_unset(); 
			//session_destroy(); 
		}
		else if($_SESSION['n']>0)
		{	
			if(isset($_POST['options'])&&$_POST['options']==$_SESSION['answ'])
			{
				$_SESSION['score']++;
				
			}
		}
		//echo "<br>hello: ".$_SESSION['n']."<br><br>world!".$_SESSION['score']."<br><br>";
	}
	
	
	echo "<form method='POST' action='questions.php'>";
		//$_SESSION['i']++;
		$id=rand(1,106);
		$sql = "SELECT ques,op1,op2,op3,op4,ans from ques_ans where id='$id'";
		//mysql_select_db('cstar');
		$retval = mysqli_query($conn, $sql);
		if(! $retval )
		{
			die('Could not get data: ' . mysqli_error());
		}
		echo "<table>";
		while($row = mysqli_fetch_array($retval))
		{
			echo "
				<tr>
					<td rowspan='5' style='font-size: 30px;border: solid #ccc;'>Q)</td>
					<td style='padding: 15px;padding-left: 25px;padding-right: 500px;border-bottom: solid #ccc;border-right: solid #ccc;border-top: solid #ccc;font-size: 25px;'>{$row['ques']}</td>
				</tr>
				<tr>
					<td style='font-size: 25px;border-right: solid #ccc;border-bottom: solid #ccc;'><input type='radio' name='options' value='a'>{$row['op1']}</td>
				</tr>
				<tr>
					<td style='font-size: 25px;border-right: solid #ccc;border-bottom: solid #ccc;'><input type='radio' name='options' value='b'>{$row['op2']}</td>
				</tr>
				<tr>
					<td style='font-size: 25px;border-right: solid #ccc;border-bottom: solid #ccc;'><input type='radio' name='options' value='c'>{$row['op3']}</td>
				</tr>
				<tr>
					<td style='font-size: 25px;border-right: solid #ccc;border-bottom: solid #ccc;'><input type='radio' name='options' value='d'>{$row['op4']}</td>
				</tr>
				<br>
				<br>";
				$_SESSION['answ']=$row['ans'];
		}
		echo "</table>";
		if($_SESSION['n']>0)
		{
			$_SESSION['n']--;
			if($_SESSION['n']==0)
				echo "<center><input type='submit' name='submit' value='Submit' class='sub_btn1'></center>";
			else	
				echo "<center><input type='submit' name='submit' value='Next' class='sub_btn'></center>";
		}
		else 
		{	
			echo "<center><input type='submit' name='submit' value='Submit' class='sub_btn1'></center>";
		}
		echo "
		</form>
		
		<script type='text/javascript'>
			setInterval(function()
			{
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open(\"GET\",\"response.php\",false);
				xmlhttp.send(null);
				document.getElementById(\"response\").innerHTML=xmlhttp.responseText;
				if(xmlhttp.responseText=='00:00')
				{		alert('Thank You participating');
						window.location='ttes.php';
				}
			},1000);
				
		</script>
		
		
		<body>
	<html>";
	//$getthevalueofid = $_POST['id'];
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