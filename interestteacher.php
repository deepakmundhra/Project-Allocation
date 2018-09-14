<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Interest Teacher</title>
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
                <form action="search.php" method="GET" target="_blank">
              		<div id="email_form">
               			<input type="text" name="query2" placeholder="Search"/><input type="submit" value="Search" />
                    </div>
               	</form>                    	
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
         				<input type="submit" id="Show1" value="Show" name="Show1"/>
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
         				<input type="submit" id="show2" value="Show" name="Show2"/>
      				</div>
      			</form>
			</div>
		</div>
		<div id="contents">
			<?php
  				if(!empty($_REQUEST['Show2']))
  				{
  					echo "Name of Teachers<br>";
  					$intno=real_escape_string($_REQUEST['area_of_interest']);
					$namee="SELECT interest_name FROM interest WHERE interest_id='{$intno}'";
					$rrr=$db->query($namee) or die($db->error);
					$rwwwws=$rrr->fetch_array() or die($db->error);
					$int=$rwwwws[0];
					$tnamee="SELECT teacher_name FROM teacher WHERE area_of_interest='{$int}'";
					$rrrr=$db->query($tnamee) or die($db->error);
					while($rwwwwsss=$rrrr->fetch_array())
					{
						echo "$rwwwwsss[0]<br>";
					}
					
				}
			?>	
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