<?php
include('dbconn.php');

if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>First Page</title>
		<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
		<script type="text/javascript">
		function error(){
			alert('Please Login');
		}
		</script>
	</head>
	<body>
		<div id="wrapper">
		<div id="header">
			<div id="logo">
				<img src="hitk_logo.jpg" height="120" width="150">
			</div>
			<div id="title">
				<b><i><font color='white' size=40>Heritage Institute Of Technology</font></i></b><br>
				<font color='white' size=40>Project Allocation System</font>
			</div>
			<div id="user">
							</div>
		</div>
		<div id="hmid">
			<table width="96%">
				<tr>
					<td width="120" align="center"><a href="home.php">Home</a></td>
					<?php 
						if(!empty($_SESSION['value']))
						echo"<td  width=130 align=center><b><a href=logout.php>"."Logout"."</a></b></td>";
					?>
				</tr>
			</table>
		</div>
		<div id="leftpanel">
		</div>
		<div id="contents">
			<div id="contentsm">
				<center>
				<form method="POST">
					<?php if(empty($_SESSION['value'])){
					echo"<table cellspacing='6'>
						<tr>
							<td><font color='white'>Email</font></td>
							<td><input type='text' placeholder='Enter Email' name='username'/></td>
						</tr>
						<tr>
							<td><font color='White'>Password</td>
							<td><input type='password' placeholder='Enter Password' name='password'/></td>
						</tr>
						<tr>
							<td></td>
							<td><input type='submit' value='Login' name='login'/></td>
						</tr>
					</table>";
				}
					else
					{
						header("Location:teacher.php");
					}
					?> 
				</form>
				<?php if(!empty($_REQUEST['login']))
						{
							
							if(empty($_REQUEST['username'])||empty($_REQUEST['password']))
							echo "<p align='center'><font color='red'>Please fill all detials</font></p>"."<br>";
							else
							{
								$email=($_REQUEST['username']);
								$pass=md5($_REQUEST['password']);
								$check="SELECT teacher_email,teacher_pass FROM teacher WHERE teacher_email='{$email}'";
									echo "<br>".$check."<br>"."<br>";
									$r=$db->query($check) or die($db->error);
									$rs=$r->fetch_array();
									if($rs[1]==$pass)
									{
										setcookie('username',$_REQUEST['username'],time()+3600);
										setcookie('password',$_REQUEST['password'],time()+3600);
										$_SESSION['value'][0]=$_COOKIE['username'];
										$_SESSION['value'][1]=$_COOKIE['password'];
										header('Location:teacher.php');
									}
									else
										echo "<p align='center'><font color='red'>Incorrect Details</font></p>";
							}
						}
					?>
				</center>
			</div>
		</div>
		<div id="rightpanel">
		</div>
	</div>
	</body>
</html>
