<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 16</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Update Query Injection [Reset Password]</h3><br>
			<div align="center" style="margin:0 auto; background-color:#E8E8E8; border:1px solid #666; text-align:center; width:350px; height:130px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
				<div style="padding-top:10px; font-size:15px;">
					<form action="" method="post">
						<div style="margin-top:15px; height:30px;">Username : &nbsp;&nbsp;&nbsp;
							<input type="text"  name="user" value=""/>
						</div>  
						<div> Password  : &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text" name="pass" value=""/>
						</div>
						<div style=" margin-top:9px;margin-left:90px;">
							<input type="submit" name="submit" value="Submit" />
						</div>
					</form>
				</div>
			</div>
			<?php
				set_time_limit(0);
				error_reporting(0);
				require_once '../database/config.php';

				function check_input($value) {
					if(!empty($value)) {
						$value = substr($value,0,15);
					}

					if (get_magic_quotes_gpc()) {
						$value = stripslashes($value);
					}

					if (!ctype_digit($value)) {
						$value = "'" . mysql_real_escape_string($value) . "'";
					} else {
						$value = intval($value);
					}

					return $value;
				}

				if(isset($_POST['submit'])) {
					$user = check_input($_POST['user']);
					$pass = $_POST['pass'];

					$sql 	= "SELECT username, password, email FROM users WHERE username=$user LIMIT 0,1";
					$result = mysql_query($sql);
					$row 	= mysql_fetch_array($result);

					if($row) {
					  	$row1 = $row['username'];  	

						$update="UPDATE users SET password = '$pass' WHERE username='$row1'";
						mysql_query($update);
				  		echo "<br>";
				  		echo '<img src="../images/ok.png"';

						if (mysql_error()) {
							echo '<font color= "#900" font size = 3>', print_r(mysql_error(), true), "</br></br></font>";
						} else {
							echo '<font color= "#900" font size = 3 ><br></fonr?';
						}
					
						echo '</font>';

				  	} else {
						echo '<font size="4.5" color="#900"><br>', '<img src="../images/error.png"> </font>';
					}
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>