<?php
include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Marks</title>
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
					<?php
					if($_SESSION['value'][0]== 'sm@gmail.com'){
						echo "
					<td width=120 align=center><a href=teacher.php>"."Home"."</a></td>	
					<td width=120 align=center><a href=request.php>"."Requests"."</a></td>
					<td width=120 align=center><a href=prequest.php>"."PRequests"."</a></td>
					<td width=120 align=center><a href=teachergrp.php>"."Groups"."</a></td>
					<td width=120 align=center><a href=marks.php>"."Marks"."</a></td>";}
					else{
						echo "
					<td width=120 align=center><a href=teacher.php>"."Home"."</a></td>	
					<td width=120 align=center><a href=request.php>"."Requests"."</a></td>
					<td width=120 align=center><a href=teachergrp.php>"."Groups"."</a></td>
					<td width=120 align=center><a href=marks.php>"."Marks"."</a></td>";
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
				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form method="POST" target="_blank" action="teachergrpdetails.php">
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
    				</div>
    			</div>
    		</div>
				<?php
  				if(!empty($_REQUEST['sign_user']))
  				{
				$teacherno=real_escape_string($_REQUEST['teacher_name']);
				echo "$teacherno";
				$rname="SELECT teacher_name FROM teacher WHERE teacher_id='{$teacherno}'";
				$rr=$db->query($rname) or die($db->error);
				$rrws=$rr->fetch_array();
				$rteacher=$rrws[0];
				echo "$rteacher";
				}
		?>
				</div></table>
			</div>
		</div>
		<div id="contents">
			<?php
				$k=$_SESSION['value'][0];
				$name="SELECT teacher_name FROM teacher WHERE teacher_email='{$k}'";
				$r=$db->query($name) or die($db->error);
				$rws=$r->fetch_array()or die($db->error);					
				$sql = "SELECT * FROM grp_student WHERE teacher_assigned='$rws[0]'";
				echo "<form name='a' method='POST'><table>
						<tr>
							<th>Group id </th><td>	</td>
							<th>  Roll </th><td>	</td>
							<th>  Name </th><td>	</td>
							<th>  Internal </th><td>	</td><th>  External </th><td> </td>
						</tr>";
				$srresult = $db->query($sql) or die($db->error);
				while($srrws=$srresult->fetch_array())
				{
				echo "<tr>
						<td><a href='grpdetails.php?uiid=$srrws[0]'>$srrws[0]</a></td><td>	</td>
						<td><table><tr>$srrws[1]<br></tr><td>	</td>
						<tr>$srrws[2]<br></tr>
						<tr>$srrws[3]</tr></table></td><td>	</td>";
						$sqln1 = "SELECT * FROM student WHERE student_roll='$srrws[1]'";
						$resultn1 = $db->query($sqln1) or die($db->error);
						$srrwsn1=$resultn1->fetch_array();
						echo "<td><table><tr>$srrwsn1[1]<br></tr>";
						$sqln2 = "SELECT * FROM student WHERE student_roll='$srrws[2]'";
						$resultn2 = $db->query($sqln2) or die($db->error);
						$srrwsn2=$resultn2->fetch_array();
						echo "<tr>$srrwsn2[1]<br></tr>";
						$sqln3 = "SELECT * FROM student WHERE student_roll='$srrws[3]'";
						$resultn3 = $db->query($sqln3) or die($db->error);
						$srrwsn3=$resultn3->fetch_array();
						echo "<tr>$srrwsn3[1]</tr></table></td><td>	</td>";
						if("teacher_assigned=='{$k}'")
						{
							echo "<td><table><tr><input type='text' name='s1im' size='3' value='$srrwsn1[6]'><br></tr><td>	</td>
								<tr><input type='text' name='s2im' size='3' value='$srrwsn2[6]'><br></tr>
								<tr><input type='text' name='s3im' size='3' value='$srrwsn3[6]'></tr></table></td><td>	</td>";
							echo "<td><table><tr>$srrwsn1[7]<br></tr><td>	</td>
								<tr>$srrwsn2[7]<br></tr>
								<tr>$srrwsn3[7]</tr></table></td><td>	</td>";
							$submit1="$srrws[0]s1sub";
							echo "<td><table><tr><input type='submit' name='submit1' value='Update'><br></tr><td>	</td>
								<tr><input type='submit' name='submit2'  ><br></tr>
								<tr><input type='submit' name='submit3'  ></tr></table></td><td>	</td></tr>";
							
						}
						/*if("teacher_assigned=='{sm@gmail.com}'")
						{
							echo "<td><table><tr>$srrwsn1[6]<br></tr><td>	</td>
								<tr>$srrwsn2[6]<br></tr>
								<tr>$srrwsn3[6]</tr></table></td><td>	</td>";
							echo "<td><table><tr>$srrwsn1[7]<br></tr><td>	</td>
								<tr>$srrwsn2[7]<br></tr>
								<tr>$srrwsn3[7]</tr></table></td><td>	</td>";
							echo "<td><table><tr><input type='text' name='s1f' size='3'><br></tr><td>	</td>
								<tr><input type='text' name='s2f' size='3'><br></tr>
								<tr><input type='text' name='s3f' size='3'></tr></table></td><td>	</td></tr>";
						}*/
						
						echo "</table></form>";
						$t=0;
						if(!empty($_REQUEST['submit1'])){
							if($t=1)
								break;
							else{
							$s1ima=real_escape_string($_REQUEST['s1im']);
							echo "$s1ima";
							$roll=$srrws[1];
							echo "$roll";
							$ddd="UPDATE student SET internal='{$s1ima}' WHERE student_roll='{$roll}'";
							echo $ddd;
							$db->query($ddd) or die($db->error);
							
							//$roll=" ";
							//$_REQUEST['submitbro']="empty";
							if($db->affected_rows==1)
							{
								echo "<p align='center'>";
								echo "hi";
								$t=$t+1;
								header("Location:marks.php");

								echo "</p>";
							}}
						}
						
				}
				
						
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
