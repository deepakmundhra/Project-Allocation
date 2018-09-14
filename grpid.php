<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Register Page</title>
<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
<script type="text/javascript">
function Submit(){
	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
	var fstudent1 = document.form.student_roll1.value,
		fstudent2 = document.form.student_roll2.value,
		fstudent3 = document.form.student_roll3.value,
		finterest = document.form.interests.value;
	if( fstudent1 == "" )
   {document.form.student_roll1.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your roll number";
     return false;}
	if( fstudent2 == "" )
   {document.form.student_roll2.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your roll number";
     return false;}
	if( fstudent3 == "" )
   {document.form.student_roll3.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your roll number";
     return false;}
	 if( finterest == "" )
   {document.form.interests.focus() ;
	 document.getElementById("errorBox").innerHTML = "Select your Interests";
     return false;}
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
							</div>
		</div>
		<div id="hmid">
			<table width="96%">
				<tr>
					<td width="120" align="center"><a href="first.php">Home</a></td>
					
				</tr>
			</table>
		</div>
		<div id="leftpanel">
		</div>
		<div id="contents">
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Group Register Form</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form name="form" method="post">
       						<div id="errorBox"></div>
        						<input type="text" name="roll1" value="" placeholder="Enter your Roll Number Student1"  class="input_name" >
      						</div>
      						<div id="email_form">
        						<input type="text" name="roll2" value="" placeholder="Enter your Roll Number Student2"  class="input_name" >
      						</div>
      						<div id="email_form">
        						<input type="text" name="roll3" value="" placeholder="Enter your Roll Number Student3"  class="input_name" >
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
      						
       					<div>
         					<input type="submit" id="sign_user" onClick="return Submit()" value="Register" name="sign_user"/>
      					</div>
     					</form>
    					</div>
    				</div>
    			</div>
		<?php
  			if(!empty($_REQUEST['sign_user']))
  			{
  				$fstudent1=$_REQUEST['roll1'];
  				$fstudent2=$_REQUEST['roll2'];
  				$fstudent3=$_REQUEST['roll3'];
				$intno=$_REQUEST['area_of_interest'];
				$namee="SELECT interest_name FROM interest WHERE interest_id='{$intno}'";
				$rrr=$db->query($namee) or die($db->error);
				$rwwwws=$rrr->fetch_array() or die($db->error);
				$int=$rwwwws[0];
				$sql = "INSERT INTO grp_student VALUES('','{$fstudent1}','{$fstudent2}','{$fstudent3}','{$int}','','')";
				$db->query($sql) or die($db->error);
				if($db->affected_rows==1)
				{	echo "<p align='center'>";
					$gid="SELECT grp_id FROM grp_student WHERE student_roll1='$fstudent1' ";
      				$gida=$db->query($gid) or die($db->error);
                  	$rwsgid=$gida->fetch_array() or die($db->error);
                        				
					echo "Your Group Number is:";
					echo $rwsgid[0]."<br>";
					echo "Please <a href='sendrequest.php' style='color:blue'>Send Request</a> to your teacher";
					echo "</p>";}
				else
					echo "No record has been inserted";
			}
		?>
			</div>
		</div>
		<div id="rightpanel">
		</div>
		</div>
	</div>
	</body>
</html>
