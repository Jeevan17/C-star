<?php

	$dbInfo = "mysql:host=localhost;dbname=cstar";	
	$dbUser = "cstar";
	$dbPassword ="cstar2k17";
	
	try
	{
		$db = new PDO($dbInfo,$dbUser,$dbPassword);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		echo "
			<html>
				<head>
					<title>C-Star</title>
					<link rel='stylesheet' href='style.css'>
					<script type='text/javascript'>
						function Redirect() 
						{
							window.location='questions.php';
						}
					</script>
				</head>
				<body>
					<div class='main-text'>
						<!--img src='images/logo.jpg' width='150px' height='100px'-->
						C-Star
					</div>
					<div class='form-content'>
						<form method='POST' action='Registration_form.php'>
								<center>
									Name: 				 <input type='text' name='stname' id='stname'  class='box1' placeholder='Enter Your Name'><br>
									PhoneNo: 			 <input type='text' name='phno' id='phno' class='box2' placeholder='Enter Your Phone Number'><br>
									College Name: 		 <input type='text' name='clgname' id='clgname' class='box3' placeholder='Enter Your College Name'><br>
									Registration Number: <input type='text' name='regno' id='regno' class='box' placeholder='Enter Registration Number'><br>
									<input type='submit' value='Submit' class='sub_btn' name='submit'>
								</center>
						</form>
					</div>
				</body>
			</html>
		";
		session_start();
				
		if(isset($_POST['submit']))
		{
	    
			if($_POST['stname']!=null&&$_POST['phno']!=null&&$_POST['clgname']!=null&&$_POST['regno']!=null)
			{				
				$stname = $_POST['stname'];
				$phno = $_POST['phno'];
				$clgname = $_POST['clgname'];
				$regno = $_POST['regno'];
				
				$_SESSION['reg']=$regno;
				$sql="
					INSERT INTO registration(name,phno,clgname,regno)VALUES('$stname',$phno,'$clgname',$regno);
				";
				$db->exec($sql);
				
				$_SESSION["duration"]=20;
				$_SESSION["start_time"]=date("Y-m-d H:i:s");
				
				$end_time=$end_time=date('Y-m-d H:i:s', strtotime('+' .$_SESSION["duration"].'minutes',strtotime($_SESSION["start_time"])));
				
				$_SESSION["end_time"]=$end_time;
				
				echo "<script language='javascript'>
					window.location=\"questions.php\";
					</script>
				";
			}
			else
                echo "<script language='javascript'>
				alert('Please fill all fields!');
				</script>
				";
		}
	}
	catch(PDOException $e){	
		echo "<h1>Connection failed! :(</h1>";
		 echo $sql . "<br>" . $e->getMessage();
	}
	$db=null;
?>