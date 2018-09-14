<?php
	include('dbconn.php');
	$userid=real_escape_string($_REQUEST['uid']);
	$tsql = "SELECT * FROM grp_student WHERE grp_id='{$userid}'";
	$tresult=$db->query($tsql) or die($db);
	$trws=$tresult->fetch_array() or die($db->error);
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
       							<b>Groups Under Teacher</b>
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
			</div>
		</div>
		<div id="contents">
			<div id="contentsm">
				<div id="aboutme">
					<p align="centre"><h1><font color="#28285F">Topic Assign<br></font></h1></p>
				</div>
      					<form name="form" method="post">
       						<table>
							<tr>
								<td>Group id:</td>
								<td><input type="text" name="firstname" value="<?php echo $trws[0];?>"/><br><br></td>
							</tr>

							<tr>
								<td>Group Interest:</td>
								<td><input type="text" name="lastname" value="<?php echo $trws[4];?>"/><br><br></td>
							</tr>
							<tr>
								<td>Teacher Assigned:</td>
								<td><select name="teacher_name">
									<option>Select teacher</option>
									<?php
										$slno=1;
										$trcint="SELECT teacher_name FROM teacher ";
                        				$trintresult=$db->query($trcint) or die($db->error);
                        				while($trrwws=$trintresult->fetch_array())
                        				{
											echo "<option value='".$slno."'>".$trrwws[0]."</option>";
											$slno++;
										}
									?>
								</select><br><br>
								</td>
							</tr>
							<tr>
	      						<td><input type="submit" value="Update Data" name="submitbtn" class="button"/></td>
							</tr>
						</table>
						</form>
						<?php
							if(!empty($_REQUEST['submitbtn']))
							{
								$tgid=$trws[0];
								$teachernos=real_escape_string($_REQUEST['teacher_name']);
								$ttname= "SELECT teacher_name FROM teacher WHERE teacher_id='{$teachernos}'";
								$ttrr=$db->query($ttname) or die($db->error);
								$ttrws=$ttrr->fetch_array();
								$ttteacher=$ttrws[0];
								$tsqlll = "UPDATE grp_student SET teacher_assigned='{$ttteacher}' WHERE grp_id='{$tgid}'";
								$db->query($tsqlll) or die($db->error);
								if($db->affected_rows==1)
								{
									echo "<p align='center'>";
									echo "Successfully Assigned the Teacher"."<br>";
									echo "</p>";
									header("Location:prequest.php");
								}
							}
						?>
					</div>
		</div>
		<div id="rightpanel">
			<div id="rightm">
				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
      						<?php
       							if($_SESSION['value'][0]== 'sm@gmail.com'){
       								echo "
       								<form method='POST' target='_blank' action='pendingrequest.php'>
       								<div id='email_form'>";
       									echo "
       									<b>Pending Requests</b>"."
      									<select name=teacher_name>
											<option>"."Select teacher"."</option>";
											$slno=1;
											$prcint="SELECT teacher_name FROM teacher ";
                        					$printresult=$db->query($prcint) or die($db->error);
                        					while($prrwws=$printresult->fetch_array())
                        					{
												echo "<option value='".$slno."'>".$prrwws[0]."</option>";
												$slno++;
											}
											echo "
										</select>
       	 							</div>
       								<div>
         								<input type='submit' id='psign_user' value='Show' name='pShow'/>
      								</div>
     								</form>";
     							}
     						?>
    					</div>
    				</div>
    			</div>
				<?php
  					if(!empty($_REQUEST['psign_user']))
  					{
						$pteacherno=real_escape_string($_REQUEST['teacher_name']);
						$prname="SELECT teacher_name FROM teacher WHERE teacher_id='{$pteacherno}'";
						$prr=$db->query($prname) or die($db->error);
						$prrws=$prr->fetch_array();
						$prteacher=$prrws[0];
					}
				?>
			</div>
		</div>
	</div>
	</body>
</html>