<?php

	session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,intial-scale=1.0">
	<title>MedicKit Pharmacy</title>
	<link rel="icon" type="image" href="logoMain.png">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="style6.css">
</head>
<body>


<?php

if(isset($_SESSION['uid'])) {
	echo '<nav class="navbar navbar-inverse">';
		echo '<div class="container-fluid">';
			//echo '<ul>';
			echo '<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><img src="logo.png" width="55px" height="15px"></a>
				</div>';
			
			echo '<ul class="nav navbar-nav">';
				echo '<li>
						<a href="billing.php">Billing</a>
					</li>';
				echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Customer
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="cust.php?page=add">Add</a></li>
							<li><a href="cust.php?page=mod">Modify</a></li>';
			if($_SESSION['uid'] == 'Admin0')
				echo '		<li><a href="cust.php?page=del">Delete</a></li>';
			echo '		</ul>
					</li>';
				echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" class="dropbtn">Customer Search
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="custsrch.php?page=bill">Bill No</a></li>
							<li><a href="custsrch.php?page=id">Id No</a></li>
							<li><a href="custsrch.php?page=phno">Phone No</a></li>
						</ul>
					</li>';
				echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" class="dropbtn">Product
								<span class="caret"></a>
							<ul class="dropdown-menu">
								<li><a href="prod.php?page=add">Add</a></li>
								<li><a href="prod.php?page=mod">Modify</a></li>
								<li><a href="prod.php?page=del">Delete</a></li>
							</ul>
					</li>';
				echo '<li>
						<a href="prodsrch.php">Product Search</a>
					</li>';
				echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" class="dropbtn">Show All
							<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="dispall.php?page=cust">Customer</a></li>
							<li><a href="dispall.php?page=prod">Product</a></li>
							<li><a href="dispall.php?page=bill">Bill</a></li>';
				if($_SESSION['uid'] == 'Admin0')
				echo '		<li><a href="dispall.php?page=admin">Admin</a></li>';
				echo '	</ul>
					</li>';
				if($_SESSION['uid'] == 'Admin0') {
					echo '<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" class="dropbtn">Admin
								<span class="caret"></a>
							<ul class="dropdown-menu">
								<li><a href="admin.php?page=add">Add</a></li>
								<li><a href="adminsrch.php">Search</a></li>
								<li><a href="admin.php?page=del">Delete</a></li>
							</ul>
						</li>';
				}
				echo '<li>
						<a href="admin.php?page=mod">Change Password</a>
					</li>';
			echo '</ul>';

			echo '<ul class="nav navbar-nav navbar-right">
					<li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a><li>
				</ul>';
		echo '</div>';
	echo '</nav>';
}

?>