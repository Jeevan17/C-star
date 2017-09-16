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
				</head>
				<body>
					<div class='main-text'>
						<!--img src='images/logo.jpg' width='150px' height='100px'-->
						C-Star
					</div>
					<form method='POST' action='add_ques.php'>
						<table>	
							<tr>
								<td>
									<div class='question_login'>
										<textarea rows= '25' cols='100' name='ques' id='ques' style='border-radius: 3px;border-color: brown;'></textarea>
									</div>
								</td>
								<td>
									<table>
										<div class='options_login'>
											<tr>
												<td>
													A) <textarea rows= '3' cols='50' name='op1' id='op1' style='border-radius: 5px;border-color: brown;'></textarea>
												</td>
											</tr>
											<tr>
												<td>
													B) <textarea rows= '3' cols='50' name='op2' id='op2' style='border-radius: 5px;border-color: brown;'></textarea>
												</td>
											</tr>
											<tr>
												<td>
													C) <textarea rows= '3' cols='50' name='op3' id='op3' style='border-radius: 5px;border-color: brown;'></textarea>
												</td>
											</tr>
											<tr>
												<td>
													D) <textarea rows= '3' cols='50' name='op4' id='op4' style='border-radius: 5px;border-color: brown;'></textarea>
												</td>
											</tr>
											<tr>
												<td>
													<br>Answer: <input type='text' name='ans' id='ans' style='border-radius: 10px;border-color: rebeccapurple;padding: 10px 0px;'>
												</td>
											</tr>
										</div>
									</table>
								</td>
							</tr>
						</table>
						<center><input type='submit' value='Submit' class='sub_btn' name='submit'></center>
					</form>
				</body>
			</html>
		";
		if(isset($_POST['submit']))
		{
	    
			if($_POST['ques']!=null&&$_POST['op1']!=null&&$_POST['op2']!=null&&$_POST['op3']!=null&&$_POST['op4']!=null&&$_POST['ans']!=null)
			{
				
				$q = $_POST['ques'];
				$o1 = $_POST['op1'];
				$o2 = $_POST['op2'];
				$o3 = $_POST['op3'];
				$o4 = $_POST['op4'];
				$ans = $_POST['ans'];
		
				$sql="
					INSERT INTO ques_ans(ques,op1,op2,op3,op4,ans)VALUES('$q','$o1','$o2','$o3','$o4','$ans');
				";
				$db->exec($sql);
				
				echo "<script language='javascript'>
					alert('Respone was recorded! See you soon :)');
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