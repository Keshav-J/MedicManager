<?php

if(!isset($_GET['page'])) {
	header("Location: index.php");
	exit();
}

	include_once 'dbh.inc.php';
	session_start();

if($_GET['page']=='bill') {

	$data = json_decode(file_get_contents("php://input"));
    
    $bid = $data->sbill;

	$sql = "SELECT * FROM bill WHERE id='$bid';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$cid = $row['cid'];
		$num = $row['num'];
		$prod = unserialize($row['prod']);
		$date = $row['dt'];
		$tot = $row['total'];

		$pro = '';
		if(count($prod) > 0) {
	    	$pro .= $prod[0]['pname'].'('.$prod[0]['pnum'].')';
		}
	    $i = 1;
	    while ($i < count($prod)) {
	        $pro .= ', '.$prod[$i]['pname'].'('.$prod[$i]['pnum'].')';
	        $i++;
	  	}

		echo '{ "bid" : '.$bid.' ,
			"cid" : '.$cid.' ,
			"num" : '.$num.' ,
			"prod" : "'.$pro.'" ,
			"date" : "'.$date.'" ,
			"tot" : '.$tot.' ,
			"disp1" : '.true.' ';


		$sql = "SELECT * FROM customer WHERE id='$cid';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			$name = $row['name'];
			$phnno = $row['phnno'];
			$billno = $row['billno'];
			$total = $row['total'];

			echo ',
				"id" : '.$cid.' ,
				"name" : "'.$name.'" ,
				"phnno" : '.$phnno.' ,
				"billno" : "'.$billno.'" ,
				"total" : '.$total.' ,
				"disp2" : '.true.' ';
		}

		echo '}';
	}
}

elseif($_GET['page']=='id') {
	
	$data = json_decode(file_get_contents("php://input"));
    
    $id = $data->sid;

    $sql = "SELECT * FROM customer WHERE id='$id';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$name = $row['name'];
		$phnno = $row['phnno'];
		$billno = $row['billno'];
		$total = $row['total'];

		echo '{ "id" : '.$id.' ,
			"name" : "'.$name.'" ,
			"phnno" : '.$phnno.' ,
			"billno" : "'.$billno.'" ,
			"total" : '.$total.' }';
	}
	else
		echo 'Customer not Found';
}

elseif($_GET['page']=='phno') {
	
	$data = json_decode(file_get_contents("php://input"));
    
    $phnno = $data->sphnno;

    $sql = "SELECT * FROM customer WHERE phnno='$phnno';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$name = $row['name'];
		$phnno = $row['phnno'];
		$billno = $row['billno'];
		$total = $row['total'];

		echo '{ "id" : '.$id.' ,
			"name" : "'.$name.'" ,
			"phnno" : '.$phnno.' ,
			"billno" : "'.$billno.'" ,
			"total" : '.$total.' }';
	}
	else
		echo 'Customer not Found';
}

else {
	header("Location: index.php");
	exit();
}