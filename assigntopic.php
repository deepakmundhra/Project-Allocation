<?php
include('dbconn.php');
$userid=$_REQUEST['uid'];
$sql = "SELECT * FROM grp_student WHERE grp_id='{$userid}'";
$result=$db->query($sql) or die($db);
$rws=$result->fetch_array() or die($db->error);

if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Topic Assign</title>
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
					<?php
					if($_SESSION['value'][0]== 'sm@gmail.com'){
						echo "
					<td width=120 align=center><a href=teacher.php>"."Home"."</a></td>	
					<td width=120 align=center><a href=request.php>"."Requests"."</a></td>
					<td width=120 align=center><a href=prequest.php>"."PRequests"."</a></td>
					<td width=120 align=center><a href=teachergrp.php>"."Groups"."</a></td>
					<td width=120 align=center><a href=marks1.php>"."Marks"."</a></td>
					<td width=120 align=center><a href=externalmarks.php>"."External"."</a></td>";}
					else{
						echo "
					<td width=120 align=center><a href=teacher.php>"."Home"."</a></td>	
					<td width=120 align=center><a href=request.php>"."Requests"."</a></td>
					<td width=120 align=center><a href=teachergrp.php>"."Groups"."</a></td>
					<td width=120 align=center><a href=pendingtopic.php>"."Assign Topic"."</a></td>
					<td width=120 align=center><a href=marks1.php>"."Marks"."</a></td>";
					}
					?>
					<?php 
						if(!empty($_SESSION['value']))
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
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Topic Assign</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					
       					<form name="form" method="post">
       					<div id="email_form">
						<tr>
						<td>Group id:</td>
						<td><input type="text" name="firstname" value="<?php echo $rws[0];?>"/></td>
						</tr>
						</div>
						<div id="email_form">
						<tr>
						<td>Group Interest:</td>
						<td><input type="text" name="lastname" value="<?php echo $rws[4];?>"/></td>
						</tr>
						</div>
						<div id="email_form">
						<tr>
						<td>Teacher Assigned:</td>
						<td><input type="text" name="email" value="<?php echo $rws[5];?>"/></td>
						</tr>
						</div>
						<div id="email_form">
						<tr>
						<td>Topic:</td>
        				<td><input type="text" name="topic" value=""  placeholder="Assign the Topic" class="input_email"></td>
        				</tr>
     	 				</div>
     	 				<tr><td></td>
	      				<td><input type="submit" value="Update Data" name="submitbtn" class="button"/></td>
						</tr>
				</form>
			<?php
				if(!empty($_REQUEST['submitbtn']))
				{
					$top=real_escape_string($_REQUEST['topic']);
					$gid=$rws[0];
					$sqlll = "UPDATE grp_student SET project_topic='{$top}' WHERE grp_id='{$gid}'";
					$db->query($sqlll) or die($db->error);
					if($db->affected_rows==1)
					{
						echo "<p align='center'>";
						echo "Successfully Assigned the Topic"."<br>";
						echo "<a href='teacher.php' style='color:blue'>Home</a>";
						echo "</p>";
					}
				}
			?>
		</div></div>
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
