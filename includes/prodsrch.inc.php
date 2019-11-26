<?php

include_once 'dbh.inc.php';
session_start();

$data = json_decode(file_get_contents("php://input"));

$name = $data->sname;

$sql = "SELECT * FROM product WHERE name='$name' OR pid='$name';";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
	$row = mysqli_fetch_assoc($result);
	$pid = $row['pid'];
	$name = $row['name'];
	$info = $row['info'];
	$rprice = $row['rprice'];
	$price = $row['price'];
	$disc = $row['disc'];
	$qty = $row['qty'];

	echo '{ "pid" : '.$pid.' ,
			"name" : "'.$name.'" ,
			"info" : "'.$info.'" ,
			"rprice" : '.$rprice.' ,
			"price" : '.$price.' ,
			"disc" : '.$disc.' ,
			"qty" : '.$qty.' }';
}
else
	echo 'Product not Found';

?>