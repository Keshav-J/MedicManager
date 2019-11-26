<?php

if(!isset($_GET['page'])) {
	header("Location: index.php");
	exit();
}

	include_once 'dbh.inc.php';
	session_start();

if($_GET['page']=='add') {

	$data = json_decode(file_get_contents("php://input"));

	$name =  $data->name;
	$info =  $data->info;
	$rprice =  floatval($data->rprice);
	$price =  floatval($data->price);
	$disc = $rprice - $price;
	$qty =  $data->qty;

	if(empty($name) || empty($info) || empty($rprice) || empty($price) || empty($qty))
		exit();

	$sql = "SELECT * FROM product WHERE name='$name';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		echo 'The product already exits!';
	}
	else {
		
		$sql = "INSERT INTO product(name, info, rprice, price, disc, qty) VALUES('$name', '$info', '$rprice', '$price', '$disc', '$qty');";
		mysqli_query($conn, $sql);

		echo 1;
	}
}

elseif($_GET['page']=='mod') {
	$data = json_decode(file_get_contents("php://input"));
	
	$oname =  $data->pid;
	$nname =  $data->name;
	$ninfo =  $data->info;
	$nrprice =  $data->rprice;
	$nprice =  $data->price;
	$nqty =  $data->qty;

	$sql = "SELECT * FROM product WHERE name='$oname' OR pid='$oname';";
	$result = mysqli_query($conn, $sql);

	if(!empty($oname) && empty($nname) && empty($ninfo) && empty($nrprice) && empty($nprice) && empty($nqty)) {
		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			if(empty($nname)) $nname = $row['name'];
			if(empty($ninfo)) $ninfo = $row['info'];
			if(empty($nrprice)) $nrprice = $row['rprice'];
			if(empty($nprice)) $nprice = $row['price'];
			if(empty($nqty)) $nqty = $row['qty'];

			echo '{ "name": "'.$nname.'" ,
					"info": "'.$ninfo.'" ,
					"rprice": '.$nrprice.' ,
					"price": '.$nprice.' ,
					"qty": '.$nqty.' }';
			exit();
		}
	}

	if(empty($oname) || empty($nname) || empty($ninfo) || empty($nrprice) || empty($nprice) || empty($nqty)) {
		echo 'empty';
	}
	elseif(mysqli_num_rows($result) != 1) {
		echo 'Product Not Found!';
	}
	else {
		$ndisc = $nrprice - $nprice;

		$sql = "UPDATE product SET name='$nname', info='$ninfo', rprice='$nrprice', price='$nprice', disc='$ndisc', qty='$nqty' WHERE name='$oname' OR pid='$oname';";
		mysqli_query($conn, $sql);

		echo 1;
	}
}

elseif($_GET['page']=='del') {
	
	$data = json_decode(file_get_contents("php://input"));

	$name =  $data->name;

	$sql = "SELECT * FROM product WHERE name='$name' OR pid='$name'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1) {
		echo 'Product Id/Name Not Found!';
	}
	else {
		$sql = "DELETE FROM product WHERE name='$name' OR pid='$name'";
		mysqli_query($conn, $sql);

		echo 1;
	}
}

else {
	header("Location: index.php");
	exit();
}