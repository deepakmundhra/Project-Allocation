<?php
include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Groups</title>
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
				echo "<table>
						<tr><td></td>
							<td>Group id</td><td></td>
							<td>Project Topic</td>
						</tr>";
				$srresult = $db->query($sql) or die($db->error);
				while($srrws=$srresult->fetch_array())
				{
				echo "<tr><td></td>
						<td><a href='grpdetails.php?uiid=$srrws[0]'>$srrws[0]</a></td><td></td>
						<td>$srrws[6]</td>
					</tr>";
				}
				echo "</table>";
			?>
		</div>
		<div id="rightpanel">
			<div id="rightm">
				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
      						<?php
       							if($_SESSION['value'][0] == 'sm@gmail.com'){
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