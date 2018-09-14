<?php
include('dbconn.php');
if(!empty($_COOKIE['username']))
	$_SESSION['value'][0]=$_COOKIE['username'];
if(!empty($_COOKIE['password']))
	$_SESSION['value'][1]=$_COOKIE['password'];
?>
<html>
	<head>
		<title>Teacher Groups Total</title>
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
					<td width="120" align="center"><a href="home.php">Home</a></td>
					<td width="120" align="center"><a href="request.php">Requests</a></td>
					<td width="120" align="center"><a href="teachergrp.php">Groups</a></td>
					<td width="120" align="center"><a href="marks.php">Marks</a></td>
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
			<caption><h1><font color="#28285F"></font></h1></caption>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<?php
  				if(!empty($_REQUEST['pShow']))
  				{
					$pteacherno=real_escape_string($_REQUEST['teacher_name']);
					$prname="SELECT teacher_name FROM teacher WHERE teacher_id='{$pteacherno}'";
					$prr=$db->query($prname) or die($db->error);
					$prrws=$prr->fetch_array();
					$prteacher=$prrws[0];
					echo "Name: $prteacher<br><br>";
					$sql = "SELECT grp_id FROM request WHERE teacher_name='$prrws[0]'";
					$psrresult = $db->query($sql) or die($db->error);
					$t=0;
					while($psrrws=$psrresult->fetch_array())
					{
						echo "Group no.:<a href='grpdetails.php?uiid=$psrrws[0]'>$psrrws[0]</a><br>";
						$a[$t]=$psrrws[0];
						$t++;
					}
					echo "Total Groups: $t";
				}
		?>
	</table>
		</p>
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
         						<input type='submit' id='psign_user' value='Show' name='Show'/>
      						</div>
     					</form>";}
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
				</div></table>
		</div>
		</div>
	</div>
	</body>
</html>
