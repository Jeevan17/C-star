<?php
	echo "
		<html>
			<head>
				<title>C-Star</title>
				<link rel='stylesheet' href='style.css'>
				
				<script type='text/javascript'>
					function checkform()
					{
						if(document.getElementById('uname').value == 'jeevan' && document.getElementById('pass').value == 'jeevan' )
						{
								alert('Login Successful');
								setTimeout('Redirect()', 1);
						}
						else
						{
								alert('Access denied. Invalid username and password.');
						}
					}
					function Redirect() 
					{
						window.location='add_ques.php';
					}
					
					</script>
			</head>
			<body>
				<div class='main-text'>
					<!--img src='images/logo.jpg' width='150px' height='100px'-->
					C-Star
				</div>
				<div class='login_content'>
					<form>
						<center>
							Username<br><input type='text' id='uname' class='log_text' placeholder='Enter Username'><br>
							Password<br><input type='password' id='pass' class='log_text' placeholder='Enter Password'><br>
							<input type='submit' value='Submit' class='sub_btn' onclick='checkform()'>
						</center>
					</form>
				</div>
			</body>
		</html>
	";
?>