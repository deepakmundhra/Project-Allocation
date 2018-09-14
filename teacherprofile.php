<?php
include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Profile Page</title>
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
				<b><font color='blue' size=40>Heritage Institute Of Technology</font></b>
			</div>
			<div id="user">
				<form method="POST">
					<?php 
						if(!empty($_SESSION['value']))
						{
							$k=$_SESSION['value'][0];
							$name="SELECT teacher_name FROM teacher WHERE teacher_email='{$k}'";
							$r=$db->query($name) or die($db->error);
							$rws=$r->fetch_array()or die($db->error);
							echo "<br><h3><ul>
									<li>
										Welcome
									</li>
        							<li>".$rws[0]."&#9662;
            								<ul class='dropdown'>
                								<li><a href='profile.php'>Profile</a></li>
                								<li><a href='update.php'>Update</a></li>
            								</ul>
        							</li>
    							</ul></h3>";
						}
					?>
				</form>
			</div>
		</div>
		<div id="hmid">
			<table width="96%">
				<tr>
					<td width="120" align="center"><a href="home.php">Home</a></td>
					<td width="120" align="center"><a href="aboutus.php">About Us</a></td>
					<td width="120" align="center"><a href="contactus.php">Contact Us</a></td>
					<?php 
						if(!empty($_SESSION['value']))
						/*echo"<td  width=130 align=right><b><a href='register.php' style='font-size:20'>Sign Up</a></b></td>";
						else*/
						echo"<td  width=130 align=center><b><a href=logout.php>"."Logout"."</a></b></td>";
					?>
				</tr>
			</table>
		</div>
		<div id="leftpanel">
			<div id="leftm">
				
			</div>
		</div>
		<div id="contents">
			<div id="contentsm">
			<p align="center">
			<br><br>
			<table cellspacing="8" cellpadding="10">
			<caption><h1><font color="#28285F">Profile</font></h1></caption>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<?php 
				$sqlll="SELECT * FROM teacher WHERE teacher_email='{$_SESSION['value'][0]}'";
						$res=$db->query($sqlll) or die($db->error);
						$rwws=$res->fetch_array();
			echo"<tr><td align='center'><img src='".$rwws[7]."' height='180' width='150'/></td></tr>
				<tr></tr>
				<tr><td><b>".$rwws[1]."</b></td></tr>
				<tr></tr>
				<tr><td><b>Gender:</b>".$rwws[2]."</td></tr>
				<tr></tr>
				<tr><td><b>Date of Joining:</b>".$rwws[3]."</td></tr>
				<tr></tr>
				<tr><td><b>Email:</b>".$rwws[4]."</td></tr>
				<tr></tr>
				<tr><td><b>Interest:</b>".$rwws[8]."</td></tr>";
		?>
	</table>
		</p>
		</div>
		</div>
		<div id="rightpanel">
		<div id="rightm">
			<table align="center" width="90%">
			</table>
			</form>
		</div>
		</div>
	</div>
	</body>
</html>
