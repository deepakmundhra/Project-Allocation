<?php
include('dbconn.php');
$db = new mysqli('localhost','root','','dbms')
or die($db->connect_error);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Send Request</title>
	<link rel="stylesheet" type="text/css" href="dbmscss.css"/>
	<script type="text/javascript">
	function Submit(){
	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
	var rgrpid = document.form.grp_id.value,
		rteacher = document.form.teacher_name.value;
	if( rgrpid == "" )
   {document.form.grp_id.focus() ;
	 document.getElementById("errorBox").innerHTML = "Enter Your Group Id";
     return false;}
	if ( rteacher == "") {
        document.form.teacher_name.focus();
		document.getElementById("errorBox").innerHTML = "select the name of teacher";
        return false; }
		function error(){
			alert('Please Login');
		}
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
         				<input type="submit" id="show2" value="Show Teacher" name="Show2"/>
      				</div>
      			</form>
			</div>
		</div>
		<div id="contents">
			<div id="container">
				<div id="aboutme">
				<p align="centre"><h1><font color="#28285F">Request Teacher</font></h1></p>
				</div>
  				<div id="container_body">
    				<div id="form_name">
      					<div class="firstnameorlastname">
       					<form name="form" method="post">
       						<div id="errorBox"></div>
        						<input type="text" name="grp_id" value="" placeholder="Your Group Id"  class="input_name" >
      						</div>
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
         				<input type="submit" id="sign_user" onClick="return Submit()" value="Send Request" name="sign_user"/>
      					</div>
     					</form>
    				</div>
    			</div>
    		</div>
			<?php
  			if(!empty($_REQUEST['sign_user']))
  			{
  				$grpid=real_escape_string($_REQUEST['grp_id']);
				$teacherno=real_escape_string($_REQUEST['teacher_name']);
				$rname="SELECT teacher_name,teacher_gender FROM teacher WHERE teacher_id='{$teacherno}'";
				$rr=$db->query($rname) or die($db->error);
				$rrws=$rr->fetch_array();
				$rteacher=$rrws[0];
				$sql = "INSERT INTO request VALUES('{$grpid}','{$rteacher}','')";
				$db->query($sql) or die($db->error);
				if($db->affected_rows==1)
				{	echo "<p align='center'>";
					if($rrws[1]=="Male")
						echo "Successfully Sent The Request to ".$rteacher." Sir<br>";
					else
						echo "Successfully Sent The Request to ".$rteacher." Madam<br>";
					echo "</p>";
				}
				else
					echo "No record has been inserted";
			}
		?>
		</div>
	</div>
	<div id="rightpanel">
	</div>
</div>
</body>
</html>