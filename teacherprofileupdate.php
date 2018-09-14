<?php
	include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];	
?>
<html>
	<head>
		<title>Profile Update</title>
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
					<form action="search.php" method="GET">
					<td width="80"><input type="text" name="query2" placeholder="Search"/><input type="submit" value="Search" /></td>
					</form>
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
		<div id="leftpanel"></div>
		<div id="contents">
			<div id="contentsm">
			<center>
			<p align="center">
			<br><br>
			<form method="POST">
			<table cellspacing="8" cellpadding="10" align="center">
			<caption><h1><font color="#28285F"> Update Profile</font></h1></caption>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<?php
				$sqlll="SELECT * FROM teacher WHERE teacher_email='{$_SESSION['value'][0]}'";
						$res=$db->query($sqlll) or die($db->error);
						$rwws=$res->fetch_array();
			echo"<tr><td align='center'><img src='".$rwws[7]."' height='200' width='150'/></td></tr>
				<tr></tr>
				<tr><td><input type='file' name='profile_pic' value='".$rwws[7]."'/></td></tr>
				<tr><td><b>".$rwws[1]."</b></td></tr>
				<tr></tr>
				<tr><td><b>Gender:</b>".$rwws[2]."</td></tr>
				<tr></tr>
				<tr><td><b>Date of Joining:</b>".$rwws[3]."</td></tr>
				<tr></tr>
				<tr><td><b>Email:</b>".$rwws[4]."</td></tr>
				<tr></tr>
				<tr><td><b>Interests:</b><br><textarea name="aboutme" value="<?php echo $rwws[8];?>" rows="4" cols="40" placeholder="<?php echo $rwws[11];?>"></textarea></td></tr>
				<!--<tr><td><input type="hidden" name="k" value="<?php echo $_SESSION['value'][0];?>"/></td> -->
				<td><input type="submit" value="Update Data" name="submitbtn" class="button"/></td>
				</tr>
	</table>
	</form>
	<?php
		if(!empty($_REQUEST['submitbtn'])){
			$qual=$_REQUEST['qualification'];
			$about=$_REQUEST['aboutme'];
			$f=$_REQUEST['profile_pic'];
			if(!empty($_REQUEST['profile_pic'])&& !empty($_REQUEST['aboutme']))
			{
					$ddd="UPDATE user_details SET profile_pic='{$f}',qualification='{$qual}',about_me='{$about}' WHERE email='{$_SESSION['value'][0]}'";
				}
			else if(empty($_REQUEST['profile_pic'])&& !empty($_REQUEST['aboutme']))
				$ddd="UPDATE user_details SET profile_pic='{$rwws[7]}',qualification='{$qual}',about_me='{$about}' WHERE email='{$_SESSION['value'][0]}'";
			else if(!empty($_REQUEST['profile_pic'])&& empty($_REQUEST['aboutme']))
				$ddd="UPDATE user_details SET profile_pic='{$f}',qualification='{$qual}',about_me='{$rwws[11]}' WHERE email='{$_SESSION['value'][0]}'";
			else if(empty($_REQUEST['profile_pic'])&& empty($_REQUEST['aboutme']))
				$ddd="UPDATE user_details SET profile_pic='{$rwws[7]}',qualification='{$qual}',about_me='{$rwws[11]}' WHERE email='{$_SESSION['value'][0]}'";
			$db->query($ddd) or die($db->error);
			if($db->affected_rows==1)
				{
					echo "<p align='center'>";
					echo "Successfully Updated!!"."<br>";
					echo "<a href='profile.php' style='color:blue'>Profile</a>";
					echo "</p>";
				}
		}
	?>
	</p>
	</center>
		</div>
		</div>
		<div id="rightpanel"></div>
	</div>
	</body>
</html>