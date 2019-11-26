<?php

session_start();
include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

$uid = $data->uid;
$pwd = $data->pwd;

$sql = "SELECT * FROM admin WHERE uid='$uid'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) != 1) {
	echo 'User Not Found';
}
else {
	$row = mysqli_fetch_assoc($result);
	$pwdChk = password_verify($pwd, $row['pwd']);

	if($pwdChk == true) {
		$_SESSION['uid'] = $row['uid'];
		$_SESSION['uname'] = $row['name'];

		echo 1;
	}
	else {
		echo 'Wrong Password';
	}
}

?>