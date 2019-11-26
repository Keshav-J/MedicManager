<?php
	
include_once 'dbh.inc.php';
session_start();

$data = json_decode(file_get_contents("php://input"));

$id = $data->sid;

$sql = "SELECT * FROM admin WHERE id='$id' OR uid='$id';";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$name = $row['name'];
	$uid = $row['uid'];

	echo '{ "id" : '.$id.' ,
			"name" : "'.$name.'" ,
			"uid" : "'.$uid.'" }';
}
else
	echo 'Admin not found!';

?>