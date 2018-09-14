<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>first page</title>
<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
<script type="text/javascript">
function Submit(){
	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
	
	if(document.form.teacher_gender[0].checked == false && document.form.teacher_gender[1].checked == false){
				document.getElementById("errorBox").innerHTML = "select your choice";
			 return false;
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
					
				</tr>
			</table>
		</div>
		<div id="leftpanel"></div>
		<div id="contents">
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Who are You?</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form name="form" method="post">
       						
      						<div id="radio_button">
        						<input type="radio" name="gender" value="Teacher">
        						<label >Group Register</label>
        						&nbsp;&nbsp;&nbsp;
        						<input type="radio" name="gender" value="Student">
        						<label >Send Request</label></p>
      						</div>
      						
      						<br>
       					<div>
         				<input type="submit" id="sign_user" onClick="return Submit()" value="Go" name="Go"/>
      					</div>
     					</form>
    				</div></div></div>
		<?php
  			if(!empty($_REQUEST['Go']))
  			{
  				$gen=real_escape_string($_REQUEST['gender']);
  				if($gen=="Teacher")
  					header('Location:grpid.php');
				else
					header('Location:sendrequest.php');
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
