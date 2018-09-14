<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Teacher Interest</title>
<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
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
                <form method="POST" target="_blank" action="teacherinterest.php">
       				<div id="email_form">
      					<select name="teacher_name">
							<option>Select teacher</option>
							<?php
								$islno=1;
								$ircint="SELECT teacher_name FROM teacher ";
                        		$irintresult=$db->query($ircint) or die($db->error);
                        		while($irrwws=$irintresult->fetch_array())
                        		{
									echo "<option value='".$islno."'>".$irrwws[0]."</option>";
									$islno++;
								}
							?>
						</select>
       	 			</div>
       				<div>
         				<input type="submit" id="Show1" value="Show Interest" name="Show1"/>
      				</div>
     			</form>
            	<form method="POST" target="_blank" action="interestteacher.php">
       				<div id="email_form">
      					<select name="area_of_interest">
							<option>Select interest</option>
								<?php
									$tslno=1;
									$tcint="SELECT interest_name FROM interest ";
                       				$tintresult=$db->query($tcint) or die($db->error);
                       				while($trwws=$tintresult->fetch_array())
                       				{											
										echo "<option value='".$tslno."'>".$trwws[0]."</option>";
										$tslno++;
									}
								?>
						</select>
      				</div>
					<div id="password_form">
         				<input type="submit" id="show2" value="Show  Teacher" name="Show2"/>
      				</div>
      			</form>
			</div>
		</div>
		<div id="contents">
			<?php
  				if(!empty($_REQUEST['Show1']))
  				{

  					$intno=$_REQUEST['teacher_name'];
					$namee="SELECT teacher_name,area_of_interest FROM teacher WHERE teacher_id='{$intno}'";
					$rrr=$db->query($namee) or die($db->error);
					$rwwwws=$rrr->fetch_array() or die($db->error);
					echo "Name:$rwwwws[0]<br>
						Interest:$rwwwws[1]";
					
				}
			?>	
			</div>
		<div id="rightpanel">
		</div>
	</div>
	</body>
</html>