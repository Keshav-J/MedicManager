<?php

if(!isset($_GET['page'])) {
	echo "<script>window.top.location='index.php'</script>";
	//header("Location: index.php");
	exit();
}

	include_once 'dbh.inc.php';
	session_start();

if($_GET['page']=='add') {
	
	$data = json_decode(file_get_contents("php://input"));

	$name = $data->name;
	$phnno = $data->phnno;

	$sql = "SELECT * FROM customer WHERE phnno='$phnno'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		echo 'Customer Phone Number Exists!';
	}
	else {
		if(preg_match("/^[0-9]*$/", $phnno) && strlen($phnno) == 10) {
			$sql = "INSERT INTO customer(name, phnno) VALUES('$name', '$phnno');";
			mysqli_query($conn, $sql);

			echo 1;
		}
		else {
			echo 'Invalid Phone Number!';
		}
	}
}

elseif($_GET['page']=='mod') {
	$data = json_decode(file_get_contents("php://input"));

	$id = $data->id;
	$name = $data->name;
	$phnno = $data->phnno;

	$sql = "SELECT * FROM customer WHERE id='$id'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1) {
		echo 'Customer Id Not Found!';
	}
	else {
		if(preg_match("/^[0-9]*$/", $phnno) && strlen($phnno) == 10) {

			$sql = "SELECT * FROM customer WHERE phnno='$phnno'";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0) {
				echo 'Phone number already exists!';
			}
			else {
				$sql = "UPDATE customer SET name='$name', phnno='$phnno' WHERE id='$id';";
				mysqli_query($conn, $sql);

				echo 1;
			}
		}
		else {
			echo 'Invalid Phone Number!';
		}
	}
}

elseif($_GET['page']=='del') {
	$data = json_decode(file_get_contents("php://input"));

	$id = $data->id;
	
	$sql = "SELECT * FROM customer WHERE id='$id'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1) {
		echo 'Customer Id Not Found!';
	}
	else {
		$sql = "DELETE FROM customer WHERE id='$id'";
		mysqli_query($conn, $sql);

		echo 1;
	}
}

else {
	echo "<script>window.top.location='index.php'</script>";
	//header("Location: index.php");
	exit();
}