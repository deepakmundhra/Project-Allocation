<?php
include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
$userid=$_REQUEST['uid'];
$sql = "SELECT * FROM student WHERE student_roll='{$userid}'";
$mark=$db->query($sql) or die($db);
$srws=$mark->fetch_array();

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
				$teacherno=$_REQUEST['teacher_name'];
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
			<form method="POST"><table>
				<tr>
					<th>Name</th><td> </td>
					<th>Roll</th><td> </td>
					<th>Internal</th><td> </td>
					<th>External</th>
				</tr>
				<tr>
			<?php 
			echo "<td>$srws[1]</td><td> </td>
					<td>$srws[5]</td><td> </td>
					<td><center>$srws[6]</center></td><td> </td>
					<td><input type='text' name='s1im' size='3' value='$srws[7]'></td>
					<td><input type='submit' name='sub'  ></td></tr></table></form>";
					if(!empty($_REQUEST['sub'])){
							$s1ima=$_REQUEST['s1im'];
							$ddd= " UPDATE student SET external='{$s1ima}' WHERE student_roll='{$srws[5]}'";
							echo $ddd;
							$db->query($ddd) or die($db->error);
							if($db->affected_rows==1)
							{
								echo "hi";
							}
							header("Location:externalmarks.php");
						}
						
			?>
		</div>
		<div id="rightpanel">
		<div id="rightm">
			
		</div>
		</div>
	</div>
	</body>
</html>
