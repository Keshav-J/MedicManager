<?php

	session_start();
	include_once 'dbh.inc.php';

if(!isset($_GET['page'])) {
	echo "<script>window.top.location='../index.php'</script>";
	//header("Location: index.php");
	exit();
}

if($_GET['page'] == 'bill1') {
	$data = json_decode(file_get_contents("php://input"));

	$cid = $data->cid;
	
	$sql = "SELECT * FROM customer WHERE id='$cid'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) != 1) {
		echo 'notFound';
	}
	else {
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		$phnno = $row['phnno'];

		echo '{ "name": "'.$name.'" ,
				"phnno": '.$phnno.' ,
				"id": '.$cid.' ,
				"status": "success" }';
	}
}

elseif($_GET['page'] == 'bill2') {
	$data = json_decode(file_get_contents("php://input"));

	$pname = $data->pname;

	$sql = "SELECT * FROM product WHERE name='$pname' OR pid='$pname';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$pname = $row['name'];
		$rpppu = $row['rprice'];
		$pppu = $row['price'];
		$panum = $row['qty'];
		$pnum = 0;
		
		echo '{ "pname": "'.$pname.'" ,
			"rpppu": '.$rpppu.' ,
			"pppu": '.$pppu.' ,
			"panum": '.$panum.' ,
			"pnum": '.$pnum.' ,
			"status": "success" }';
	}
	else{
		echo 'Product not Found!';
	}
}

elseif($_GET['page'] == 'bill3') {
	$data = json_decode(file_get_contents("php://input"));

	date_default_timezone_set("Asia/Kolkata");
    $datetime = date("Y-m-j H:i:s");

	$cid = $data->cid;
	$arr = $data->prod;

	if(empty($cid) || empty($arr))
		exit();

	$i = 0;
	$n = count($arr);
	$total = 0;
	while($i < $n) {
		$row = get_object_vars($arr[$i]);
		$arr[$i] = $row;
		$name = $row['pname'];
		$num = $row['pnum'];
		
		$sql = "SELECT * FROM product WHERE name='$name' OR pid='$name';";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		$total += ($row['price'] * $num);
		$num = $row['qty'] - $num;
		
		$sql = "UPDATE product SET qty='$num' WHERE name='$name' OR pid='$name';";
		mysqli_query($conn, $sql);

		$i++;
	}

	$arr = serialize($arr);
	$sql = "INSERT INTO bill(cid, num, prod, total, dt) VALUES('$cid', '$n', '$arr', '$total', '$datetime');";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM customer WHERE id='$cid';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$billno = $row['billno'];
	$tot = $row['total'];

	$sql = "SELECT max(id) AS billno FROM bill;";
	$result = mysqli_query($conn, $sql);
	$bill = mysqli_fetch_assoc($result)['billno'];

	if(empty($billno)) {
		$billno = $bill;	
	}
	else {
		$billno = $billno.','.$bill;
	}

	$tot = $tot + $total;

	$sql = "UPDATE customer SET billno='$billno', total='$tot' WHERE id='$cid';";
	mysqli_query($conn, $sql);

	$sql = "SELECT dt FROM bill WHERE id='$bill';";
	$result = mysqli_query($conn, $sql);
	$date = explode(' ', mysqli_fetch_assoc($result)['dt']);

	echo '{ "billno": '.$bill.' ,
			"date": "'.$date[0].'" ,
			"time": "'.$date[1].'" }';
}

else {
	header("Location: ../index.php");
	exit();
}