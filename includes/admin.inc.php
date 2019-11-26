<?php

if(!isset($_GET['page'])) {
	header("Location: index.php");
	exit();
}

	include_once 'dbh.inc.php';
	session_start();

if($_GET['page']=='add') {

	$data = json_decode(file_get_contents("php://input"));

	$name = $data->name;
	$uid = $data->uid;
	$pwd = $data->pwd;

	if(empty($name) || empty($uid) || empty($pwd))
		exit();

	$sql = "SELECT * FROM admin WHERE uid='$uid' OR id='$uid'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		echo 'Admin Id already exists!';
	}
	elseif(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $pwd)) {

		$pwd = password_hash($pwd, PASSWORD_DEFAULT);

		$sql = "INSERT INTO admin(name, uid, pwd) VALUES('$name', '$uid', '$pwd');";
		mysqli_query($conn, $sql);

		echo 1;
	}
	else {
		echo 'Your password is weak!';
	}
}

elseif($_GET['page']=='mod') {

	$data = json_decode(file_get_contents("php://input"));

	$opwd = $data->opwd;
	$npwd = $data->npwd;
	$cnpwd = $data->cnpwd;
	$uid = $_SESSION['uid'];

	$sql = "SELECT * FROM admin WHERE uid='$uid'";
	$result = mysqli_query($conn, $sql);

	if($npwd == $cnpwd) {
		if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $npwd)) {
			$row = mysqli_fetch_assoc($result);
			$npwd = password_hash($npwd, PASSWORD_DEFAULT);
			$pwdChk = password_verify($opwd, $row['pwd']);

			if($pwdChk == true) {
				

				$sql = "UPDATE admin SET pwd='$npwd' WHERE uid='$uid';";
				mysqli_query($conn, $sql);

				echo 'success';
			}
			else {
				echo 'wrng';
			}
		}
		else {
			echo 'weak';
		}
	}
	else {
		echo 'cnfrm';
	}
}

elseif($_GET['page']=='del') {

	$data = json_decode(file_get_contents("php://input"));

	$uid = $data->uid;

	$sql = "SELECT * FROM admin WHERE uid='$uid'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1) {
		echo 'Admin Id Not Found';
	}
	else {
		$sql = "DELETE FROM admin WHERE uid='$uid'";
		mysqli_query($conn, $sql);

		echo 1;
	}
}

else {
	header("Location: index.php");
	exit();
}