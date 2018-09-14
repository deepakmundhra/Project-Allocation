<?php
	include('dbconn.php');
	$db = new mysqli('localhost','root','','dbms')
	or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>student Register Page</title>
		<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
		<script type="text/javascript">
		function Submit(){
			var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
			var iname = document.form.student_name.value;
			if( iname == "" )
			{
				document.form.student_name.focus() ;
				document.getElementById("errorBox").innerHTML = "Enter Your Name";
     			return false;
     		}
		}		  
		function error(){
			alert('Please Login');
		}
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
				<b><i><font color='white' size=40>Heritage Institute Of Technology</font></b></i><br>
				<font color='white' size=40>Group Assign Management v1.1</font>
			</div>
			<div id="user">
			</div>
		</div>
		<div id="hmid">
			<table width="96%">
				<tr>
					<td width="120" align="center"><a href="first.php">Home</a></td>
					<td width="120" align="center"><a href="aboutus.php">About Us</a></td>
					<td width="120" align="center"><a href="contactus.php">Contact Us</a></td>
					<?php 
						if(empty($_SESSION['value']))
						echo"<td  width=130 align=right><b><a href='register.php' style='font-size:20'>Sign Up</a></b></td>";
						else
						echo"<td  width=130 align=center><b><a href=logout.php>"."Logout"."</a></b></td>";
					?>
				</tr>
			</table>
		</div>
		<div id="leftpanel"></div>
		<div id="contents">
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Student Registration</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form name="form" method="post">
       						<div id="errorBox"></div>
        						<input type="text" name="interest_name" value="" placeholder="Enter an interest"  class="input_name" >
      						</div>
       						<div>
         					<input type="submit" id="sign_user" onClick="return Submit()" value="Submit" name="sign_user"/>
      						</div>
     					</form>
    				</div></div></div>
		<?php
  			if(!empty($_REQUEST['sign_user']))
  			{
  				$name=real_escape_string($_REQUEST['interest_name']);
				$sql = "INSERT INTO interest VALUES('','{$name}')";
				$db->query($sql) or die($db->error);
				if($db->affected_rows==1)
				{	echo "<p align='center'>";
					echo "Successfully Entered"."<br>";
					echo "Please <a href='home.php' style='color:blue'>Login</a> with your Details";
					echo "</p>";}
				else
					echo "No record has been inserted";
			}
		?>
		</div></div>
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
