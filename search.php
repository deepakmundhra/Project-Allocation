<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
 session_start();
  if(!empty($_COOKIE['username']))
    $_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
    $_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
<head>
    <title>Search results</title>
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
		<div id="leftpanel">
			<table width="96%">
                <tr>
                    <form action="search.php" method="GET">
                    <td width="80"><input type="text" name="query2" placeholder="Search"/><input type="submit" value="Search" /></td>
                    </form>
                </tr>
                <tr>
                	<?php
    				$query1 = $_REQUEST['query2']; 
    				$min_length = 1;
    				if(strlen($query1) >= $min_length)
    				{
        				$query1 = htmlspecialchars($query1); 
        				$query1 = mysqli_real_escape_string($db,$query1);
        				$raw_results="SELECT * FROM teacher WHERE teacher_name LIKE'%{$query1}%'";
           				$r=$db->query($raw_results) or die($db->error);
        				if(mysqli_num_rows($r) > 0)
        				{
            				while($results = mysqli_fetch_array($r))
            				{
                				$soj="SELECT teacher_name FROM teacher WHERE teacher_id='{$results['teacher_id']}' ";
                        		$eresul=$db->query($soj) or die($db->error);
                        		$rws=$eresul->fetch_array();
                        		echo "<h2>".$rws[0]."</h2>";
                			}    
        				}
        				else
        				{
            				echo "No results";
        				}
    				}
    				else
    				{
        				echo "Minimum length is ".$min_length;
    				}
					?>
				</tr>
            </table>
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
  				$name=$_REQUEST['student_name'];
				$mail=$_REQUEST['student_email'];
				$gen=$_REQUEST['student_gender'];
				$join=$_REQUEST['student_year'];
				$roll=$_REQUEST['student_roll'];
				$sql = "INSERT INTO student VALUES('','{$name}','{$gen}','{$join}','{$mail}','{$roll}')";
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
		