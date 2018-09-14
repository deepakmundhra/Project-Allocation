<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Teacher Register Page</title>
<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
<script type="text/javascript">
function Submit(){
	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
	var tname = document.form.teacher_name.value,
		temail = document.form.teacher_email.value,
		treemail = document.form.enteremail.value,
		tpassword = document.form.teacher_password.value,
		tinterest = document.form.area_of_interest.value,
		tdoj = document.form.teacher_doj.value;
	if( tname == "" )
   {document.form.teacher_name.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your Name";
     return false;}
	if (temail == "" )
	{document.form.teacher_email.focus();
		document.getElementById("errorBox").innerHTML = "Enter Your Email";
		return false;}
		else if(!emailRegex.test(temail)){
		document.form.teacher_email.focus();
		document.getElementById("errorBox").innerHTML = "enter the valid email";
		return false;}
	if (treemail == "" )
	{document.form.enteremail.focus();
		document.getElementById("errorBox").innerHTML = "Re-enter the email";
		return false;
	 }else if(!emailRegex.test(treemail)){
		document.form.enteremail.focus();
		document.getElementById("errorBox").innerHTML = "Re-enter the valid email";
		return false;}
	if(treemail !=  temail){
		 document.form.enteremail.focus();
		 document.getElementById("errorBox").innerHTML = "emails are not matching, re-enter again";
		 return false; }
	if(tpassword == "")
	 { document.form.teacher_password.focus();
		 document.getElementById("errorBox").innerHTML = "enter the password";
		 return false;}
	if (tdoj == "") {
        document.form.teacher_doj.focus();
		document.getElementById("errorBox").innerHTML = "select the joining year";
        return false; }
    if (tinterest == "") {
        document.form.area_of_interest.focus();
		document.getElementById("errorBox").innerHTML = "select the interest";
        return false; }
	
	if(document.form.teacher_gender[0].checked == false && document.form.teacher_gender[1].checked == false){
				document.getElementById("errorBox").innerHTML = "select your gender";
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
					
				</tr>
			</table>
		</div>
		<div id="leftpanel"></div>
		<div id="contents">
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Teacher Registration</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form name="form" method="post">
       						<div id="errorBox"></div>
        						<input type="text" name="teacher_name" value="" placeholder="Your Name"  class="input_name" >
      						</div>
      						<div id="email_form">
        						<input type="text" name="teacher_email" value=""  placeholder="Your Email" class="input_email">
     	 					</div>
	      					<div id="Re_email_form">
        						<input type="text" name="enteremail" value=""  placeholder="Re-enter Email" class="input_Re_email">
      						</div>
      						<div id="password_form">
        						<input type="password" name="teacher_password" value=""  placeholder="New Password" class="input_password">
      						</div>
      						<div id="birthday"><p align="center">
      							<h3>Date of Joining college:</h3>
        						<input type="date" name="teacher_doj" value=""  placeholder="Your Date of Joining" class="input_dob"></p>
      						</div>
      						<div id="radio_button">
        						<input type="radio" name="gender" value="Male">
        						<label >Male</label>
        						&nbsp;&nbsp;&nbsp;
        						<input type="radio" name="gender" value="Female">
        						<label >Female</label></p>
      						</div>
      						<div id="password_form">
        						<select name="area_of_interest">
									<option>Select interest</option>
									<?php
										$slno=1;
										$cint="SELECT interest_name FROM interest ";
                        				$intresult=$db->query($cint) or die($db->error);
                        				while($rwws=$intresult->fetch_array())
                        				{
											
											echo "<option value='".$slno."'>".$rwws[0]."</option>";
											$slno++;
										}
									?>
								</select>
      						</div>
      						
      						<br><br>
       					<div>
         				<input type="submit" id="sign_user" onClick="return Submit()" value="Register" name="sign_user"/>
      					</div>
     					</form>
    				</div></div></div>
		<?php
  			if(!empty($_REQUEST['sign_user']))
  			{
  				$name=$_REQUEST['teacher_name'];
				$mail=$_REQUEST['teacher_email'];
				$pass=md5($_REQUEST['teacher_password']);
				$gen=$_REQUEST['gender'];
				$join=$_REQUEST['teacher_doj'];
				$intno=$_REQUEST['area_of_interest'];
				$namee="SELECT interest_name FROM interest WHERE interest_id='{$intno}'";
				$rrr=$db->query($namee) or die($db->error);
				$rwwwws=$rrr->fetch_array() or die($db->error);
				$int=$rwwwws[0];
				$sql = "INSERT INTO teacher VALUES('','{$name}','{$gen}','{$join}','{$mail}','{$pass}','','{$int}')";
				$db->query($sql) or die($db->error);
				if($db->affected_rows==1)
				{	echo "<p align='center'>";
					echo "Successfully Registered"."<br>";
					echo "Please <a href='home.php' style='color:blue'>Login</a> with your Details";
					echo "</p>";}
				else
					echo "No record has been inserted";
			}
		?>
		</div></div>
		<div id="rightpanel">
		</div>
	</div>
	</body>
</html>
