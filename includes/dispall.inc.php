<?php

if(!isset($_GET['page'])) {
	header("Location: index.php");
	exit();
}

	include_once 'dbh.inc.php';
	session_start();

if($_GET['page'] == 'cust') {

	$outp = '';

	$sql = "SELECT * FROM customer";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)) {
		if ($outp != "")
			$outp .= ",";
		$outp .= '{"id": '.$row["id"].' ,';
		$outp .= '"name": "'.$row["name"].' ",';
		$outp .= '"phnno": '.$row["phnno"].' ,';
		$outp .= '"billno": "'.$row["billno"].'" ,';
		$outp .= '"total": '.$row["total"].' }';
	}

	$outp ='{"records":['.$outp.']}';
	echo $outp;
}

else if($_GET['page'] == 'prod') {

	$outp = '';

	$sql = "SELECT * FROM product";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)) {
		if ($outp != "")
			$outp .= ",";
		$outp .= '{"pid": '.$row["pid"].' ,';
		$outp .= '"name": "'.$row["name"].'" ,';
		$outp .= '"info": "'.$row["info"].'" ,';
		$outp .= '"rprice": '.$row["rprice"].' ,';
		$outp .= '"price": '.$row["price"].' ,';
		$outp .= '"disc": '.$row["disc"].' ,';
		$outp .= '"qty": '.$row["qty"].' }';
	}

	$outp ='{"records":['.$outp.']}';
	echo $outp;
}

else if($_GET['page'] == 'bill') {

	$outp = '';

	$sql = "SELECT * FROM bill";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)) {
		if ($outp != "")
			$outp .= ",";
		$outp .= '{"id": '.$row["id"].',';
		$outp .= '"cid": '.$row["cid"].',';
		$outp .= '"num": '.$row["num"].',';
		$outp .= '"prod": "';
			$prod = unserialize($row["prod"]);
			if(count($prod) > 0) {
		    	$outp .= $prod[0]['pname'].'('.$prod[0]['pnum'].')';
			}
		    $i = 1;
		    while ($i < count($prod)) {
		        $outp .= ', '.$prod[$i]['pname'].'('.$prod[$i]['pnum'].')';
		        $i++;   
		  	}
		$outp .= '" ,';
		$outp .= '"date": "'.substr($row["dt"], 0, 9).'",';
		$outp .= '"total": '.$row["total"].' }';
	}

	$outp ='{"records":['.$outp.']}';
	echo $outp;
}

else if($_GET['page'] == 'admin') {

	$outp = '';

	$sql = "SELECT * FROM admin";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)) {
		if ($outp != "")
			$outp .= ",";
		$outp .= '{"id": ' . $row["id"] .' ,';
		$outp .= '"name": "'. $row["name"].'" ,';
		$outp .= '"uid": "'. $row["uid"].'" }';
	}

	$outp ='{"records":['.$outp.']}';
	echo $outp;
}

else {
	header("Location: index.php");
	exit();
}

?>