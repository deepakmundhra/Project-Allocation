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
	var sname = document.form.student_name.value,
		semail = document.form.student_email.value,
		sreemail = document.form.enteremail.value,
		syear = document.form.student_year.value,
		sroll = document.form.student_roll.value;;
	if( sname == "" )
   {document.form.student_name.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your Name";
     return false;}
	if (semail == "" )
	{document.form.student_email.focus();
		document.getElementById("errorBox").innerHTML = "Enter Your Email";
		return false;}
		else if(!emailRegex.test(semail)){
		document.form.student_email.focus();
		document.getElementById("errorBox").innerHTML = "enter the valid email";
		return false;}
	if (sreemail == "" )
	{document.form.enteremail.focus();
		document.getElementById("errorBox").innerHTML = "Re-enter the email";
		return false;
	 }else if(!emailRegex.test(sreemail)){
		document.form.enteremail.focus();
		document.getElementById("errorBox").innerHTML = "Re-enter the valid email";
		return false;}
	if(sreemail !=  semail){
		 document.form.enteremail.focus();
		 document.getElementById("errorBox").innerHTML = "emails are not matching, re-enter again";
		 return false; }
	 if (syear == "") {
        document.form.student_year.focus();
		document.getElementById("errorBox").innerHTML = "select the joining year";
        return false; }
     if (sroll == "") {
        document.form.student_roll.focus();
		document.getElementById("errorBox").innerHTML = "select the your roll number";
        return false; }
	if(document.form.gender[0].checked == false && document.form.gender[1].checked == false){
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
		<div id="leftpanel">
      		<div class="firstnameorlastname">
                <form action="search.php" method="GET">
              		<div id="email_form">
               			<input type="text" name="query2" placeholder="Search"/><input type="submit" value="Search" />
                    </div>
               	</form>                    	
                <form method="POST" target="_blank" action="teacherinterest.php">
       				<div id="email_form">
      					<select name="teacher_name">
							<option>Select teacher</option>
							<?php
								$slno=1;
								$rcint="SELECT teacher_name FROM teacher ";
                        		$rintresult=$db->query($rcint) or die($db->error);
                        		while($rrwws=$rintresult->fetch_array())
                        		{
									echo "<option value='".$slno."'>".$rrwws[0]."</option>";
									$slno++;
								}
							?>
						</select>
       	 			</div>
       				<div>
         				<input type="submit" id="sign_user" onClick="return Submit()" value="Show" name="Show"/>
      				</div>
     				</form>
            	<form method="POST" target="_blank" action="interestteacher.php">
       				<div id="email_form">
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
					<div id="password_form">
         				<input type="submit" id="sinterest" value="Search" name="sinterest"/>
      				</div>
      			</form>
			</div>
		</div>
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
        						<input type="text" name="student_name" value="" placeholder="Your Name"  class="input_name" >
      						</div>
      						<div id="email_form">
        						<input type="text" name="student_email" value=""  placeholder="Your Email" class="input_email">
     	 					</div>
	      					<div id="Re_email_form">
        						<input type="text" name="enteremail" value=""  placeholder="Re-enter Email" class="input_Re_email">
      						</div>
      						<div id="birthday"><p align="center">
      							<h3>Date of Joining college:</h3>
        						<input type="year" name="student_year" value=""  placeholder="Your year of Joining college" class="input_dob"></p>
      						</div>
      						<div id="email_form"><p align="center">
      							<h3>College Roll Number:</h3>
        						<input type="text" name="student_roll" value=""  placeholder="Your college roll number" class="input_roll"></p>
      						</div>
      						
      						<div id="radio_button">
        						<input type="radio" name="student_gender" value="Male">
        						<label >Male</label>
        						&nbsp;&nbsp;&nbsp;
        						<input type="radio" name="student_gender" value="Female">
        						<label >Female</label></p>
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
  				$name=real_escape_string($_REQUEST['student_name']);
				$mail=real_escape_string($_REQUEST['student_email']);
				$gen=real_escape_string($_REQUEST['student_gender']);
				$join=real_escape_string($_REQUEST['student_year']);
				$roll=real_escape_string($_REQUEST['student_roll']);
				$sql = "INSERT INTO student VALUES('','{$name}','{$gen}','{$join}','{$mail}','{$roll}','','','')";
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
		<div id="rightm">
			<table align="center" width="90%">
			</table>
			</form>
		</div>
		</div>
	</div>
	</body>
</html>