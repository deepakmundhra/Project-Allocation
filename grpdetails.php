<?php
include('dbconn.php');                        	
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Group Details</title>
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
		</div>
		<div id="contents">
			<div id="contentsm">
			<p align="center">
			<br><br>
			<table cellspacing="8" cellpadding="10">
				<?php
					$userid=$_REQUEST['uiid'];
					$cint="SELECT * FROM grp_student WHERE grp_id='{$userid}' ";
					$intresult=$db->query($cint) or die($db);
					$rws=$intresult->fetch_array();
					$grpdetails="SELECT * FROM student WHERE student_roll='{$rws[1]}'";
					$r=$db->query($grpdetails) or die($db->error);
					$rwws=$r->fetch_array();
					echo "Roll: $rwws[5]<br>
						Name: $rwws[1]<br>
						Gender: $rwws[2]<br>
						Student Year: $rwws[3]<br>
						Email: $rwws[4]<br><hr>";
					$grpdetails2="SELECT * FROM student WHERE student_roll='{$rws[2]}'";
					$r2=$db->query($grpdetails2) or die($db->error);
					$rwws2=$r2->fetch_array()or die($db->error);
					echo "Roll: $rwws2[5]<br>
						Name: $rwws2[1]<br>
						Gender: $rwws2[2]<br>
						Student Year: $rwws2[3]<br>
						Email: $rwws2[4]<br><hr>";
					$grpdetails3="SELECT * FROM student WHERE student_roll='{$rws[3]}'";
					$r3=$db->query($grpdetails3) or die($db->error);
					$rwws3=$r3->fetch_array()or die($db->error);
					echo "Roll: $rwws3[5]<br>
						Name: $rwws3[1]<br>
						Gender: $rwws3[2]<br>
						Student Year: $rwws3[3]<br>
						Email: $rwws3[4]<br>";
                ?>
			</table>
			</p>
			</div>
		</div>
		<div id="rightpanel">
		</div>
		</div>
	</div>
	</body>
</html>
