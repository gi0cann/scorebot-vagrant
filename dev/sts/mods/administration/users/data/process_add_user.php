<?php

if(isset($_SESSION['user_id'])) {
	if($_POST['submit']) {
	
		
	
		$err = array();
		$suc = array();
		
		$fn = mysql_real_escape_string($_POST['fn']);
		$ln = mysql_real_escape_string($_POST['ln']);
		$mail = mysql_real_escape_string($_POST['mail']);
		$location = mysql_real_escape_string($_POST['location']);
		$group = mysql_real_escape_string($_POST['group']);
		$acl = mysql_real_escape_string($_POST['acl']);
		
		if(strlen($fn) < 3) {
			$err[] = 'The first name used was too short.';
		}
		if(strlen($ln) < 3) {
			$err[] = 'The last name used was too short.';
		}
		if(strlen($mail) < 7) {
			$err[] = 'The email address used was too short.';
		}
		$sql = "SELECT * FROM users WHERE mail = '$mail'";
		$num = mysql_num_rows(mysql_query($sql));
		if($num >= 1) {
			$err[] = 'A user with that email already exists.';		
		}

		if(!count($err)) {
		
			//Generate Password
			
			$password = $fn.$ln;
			$db_password = md5($password);
			
		
			//Add the user to the database
			$sql = "INSERT INTO users (fn, ln, mail, password, location_id, group_id, acl_id, fpc) "
			."VALUES ('$fn', '$ln', '$mail', '$db_password', '$location', '$group', '$acl', '1')";
			
			mysql_query($sql);
			echo mysql_error();
			
			$user_id = mysql_insert_id();
			
			$data = 'Hello '.$fn.'!<br /><br />An Express Service Desk user account has been created for you.<br /><br />You can access Express Service Desk by clicking http://'.$application_root.'.<br /><br />Your temporary password is:'.$password;
			
			//Create Notification to be sent to user.
			$sql = "INSERT INTO notifications (user_id, data, dt, state) VALUES "
			."('$user_id', '$data', '$int_date', '1')";
			mysql_query($sql);
			
			$suc[] = 'The user has been added to the database.';
		
		}
	
	}
	
	if(count($err)) {
		echo '<div class="error">';
		echo implode('<br />', $err);
		echo '</div>';
	
	}
	if(count($suc)) {
		echo '<div class="success">';
		echo implode('<br />', $suc);
		echo '</div>';
	
	}
	
}

?>