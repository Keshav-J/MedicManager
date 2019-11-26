<?php

	include_once 'header.php';

if(!isset($_GET['page']) || !isset($_SESSION['uid'])) {
	echo "<script>window.top.location='index.php'</script>";
	//header("Location: index.php");
	exit();
}

if($_GET['page'] == 'bill') {
?>	
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p ng-show="!disp"><b style="font-size:25px;">Customer Searching Page</b> <br><br></p>
		<p ng-show="disp"><b style="font-size:25px;">Customer Details</b> <br><br></p>

		<form>

			<input class="form-control" type="text" ng-model="sbill" name="sbill" placeholder="Bill Number" autofocus>

			<br ng-show="disp1">

			<table ng-show="disp1" style="font-size:18px;" class="table-hover table-responsive text-left">

				<col width="40%">
				<col width="10%">
				<col width="50%">

				<tr>
					<td><b>Bill No.</b></td>
					<td>:</td>
					<td>{{ bid }}</td>
				</tr>
				<tr>
					<td><b>Date & time</b></td>
					<td>:</td>
					<td>{{ date }}</td>
				</tr>
				<tr>
					<td><b>Customer Id</b></td>
					<td>:</td>
					<td>{{ cid }}</td>
				</tr>
				<tr>
					<td><b>No. of Products</b></td>
					<td>:</td>
					<td>{{ num }}</td>
				</tr>
				<tr>
					<td><b>Products</b></td>
					<td>:</td>
					<td>{{ prod }}</td>
				</tr>
				<tr>
					<td><b>Total Purchased</b></td>
					<td>:</td>
					<td>{{ tot }}</td>
				</tr>
			</table>

			<br ng-show="disp2">

			<table ng-show="disp2" style="font-size:18px;" class="table-hover table-responsive text-left">

				<col width="105px">
				<col width="10px">
					<col>

				<tr>
					<td><b>Customer Id</b></td>
					<td>:</td>
					<td>{{ id }}</td>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td>:</td>
					<td>{{ name }}</td>
				</tr>
				<tr>
					<td><b>Phone No.</b></td>
					<td>:</td>
					<td>{{ phnno }}</td>
				</tr>
				<tr>
					<td><b>Bill No(s).</b></td>
					<td>:</td>
					<td>{{ billno }}</td>
				</tr>
				<tr>
					<td><b>Total Purchased</b></td>
					<td>:</td>
					<td>{{ total }}</td>
				</tr>
			</table>

			<br>

			<button class="btn btn-primary" ng-click="search()">Search</button>

		</form>
		
		<br>
		
		<button ng-show="disp1" class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.bid = '';
	        	$scope.cid = '';
	        	$scope.num = '';
	        	$scope.prod = '';
	        	$scope.tot = '';
	        	$scope.id = '';
				$scope.name = '';
				$scope.phnno = '';
				$scope.billno = '';
				$scope.total = '';
				$scope.sbill = '';
	        	$scope.disp1 = false;
	        	$scope.disp2 = false;
			}
			$scope.search = function() {
				if(!$scope.sbill || typeof $scope.sbill == 'undefined') return;
				
			    $http({
				    method: "post",
				    url: "includes/custsrch.inc.php?page=bill",
				    data: {
				        'sbill': $scope.sbill
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				    $scope.bid = data.data.bid;
				    $scope.date = data.data.date;
		        	$scope.cid = data.data.cid;
		        	$scope.num = data.data.num;
		        	$scope.prod = data.data.prod;
		        	$scope.tot = data.data.tot;
		        	$scope.id = data.data.id;
					$scope.name = data.data.name;
					$scope.phnno = data.data.phnno;
					$scope.billno = data.data.billno;
					$scope.total = data.data.total;
					$scope.sbill = data.data.sbill;
		        	$scope.disp1 = true;
		        	$scope.disp2 = data.data.disp2;
				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>
<?php
}

elseif($_GET['page'] == 'id') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p ng-show="!disp"><b style="font-size:25px;">Customer Searching Page</b> <br><br></p>
		<p ng-show="disp"><b style="font-size:25px;">Customer Details</b> <br><br></p>

		<form>

			<input class="form-control" type="text" ng-model="sid" name="sid" placeholder="Customer Id" autofocus>
		
			<br>

			<table ng-show="disp" style="font-size:18px;" class="table-hover table-responsive text-left">
				<tr>
					<td><b>Customer Id</b></td>
					<td>:</td>
					<td>{{ id }}</td>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td>:</td>
					<td>{{ name }}</td>
				</tr>
				<tr>
					<td><b>Phone No.</b></td>
					<td>:</td>
					<td>{{ phnno }}</td>
				</tr>
				<tr>
					<td><b>Bill No(s).</b></td>
					<td>:</td>
					<td>{{ billno }}</td>
				</tr>
				<tr>
					<td><b>Total Purchased</b></td>
					<td>:</td>
					<td>{{ total }}</td>
				</tr>
			</table>
		
			<br>

			<button class="btn btn-primary" ng-click="search()">Search</button>

		</form>
		
		<br>
		
		<button ng-show="disp" class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.id = '';
	        	$scope.name = '';
	        	$scope.phnno = '';
	        	$scope.billno = '';
	        	$scope.total = '';
	        	$scope.sid = '';
	        	$scope.disp = false;
			}
			$scope.search = function() {
			    $http({
				    method: "post",
				    url: "includes/custsrch.inc.php?page=id",
				    data: {
				        'sid': $scope.sid
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				    $scope.id = data.data.id;
		        	$scope.name = data.data.name;
		        	$scope.phnno = data.data.phnno;
		        	$scope.billno = data.data.billno;
		        	$scope.total = data.data.total;
		        	$scope.disp = true;
				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>

<?php
}

elseif($_GET['page'] == 'phno') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p ng-show="!disp"><b style="font-size:25px;">Customer Searching Page</b> <br><br></p>
		<p ng-show="disp"><b style="font-size:25px;">Customer Details</b> <br><br></p>

		<form>

			<input class="form-control" type="text" ng-model="sphnno" name="sphnno" placeholder="Phone Number" autofocus>
		
			<br>

			<table ng-show="disp" style="font-size:18px;" class="table-hover table-responsive text-left">
				<tr>
					<td><b>Customer Id</b></td>
					<td>:</td>
					<td>{{ id }}</td>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td>:</td>
					<td>{{ name }}</td>
				</tr>
				<tr>
					<td><b>Phone No.</b></td>
					<td>:</td>
					<td>{{ phnno }}</td>
				</tr>
				<tr>
					<td><b>Bill No(s).</b></td>
					<td>:</td>
					<td>{{ billno }}</td>
				</tr>
				<tr>
					<td><b>Total Purchased</b></td>
					<td>:</td>
					<td>{{ total }}</td>
				</tr>
			</table>
		
			<br>

			<button class="btn btn-primary" ng-click="search()">Search</button>

		</form>
		
		<br>
		
		<button ng-show="disp" class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.id = '';
	        	$scope.name = '';
	        	$scope.phnno = '';
	        	$scope.billno = '';
	        	$scope.total = '';
	        	$scope.sphnno = '';
	        	$scope.disp = false;
			}
			$scope.search = function() {
			    $http({
				    method: "post",
				    url: "includes/custsrch.inc.php?page=phno",
				    data: {
				        'sphnno': $scope.sphnno
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				    $scope.id = data.data.id;
		        	$scope.name = data.data.name;
		        	$scope.phnno = data.data.phnno;
		        	$scope.billno = data.data.billno;
		        	$scope.total = data.data.total;
		        	$scope.disp = true;
				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>

<?php
}

else {
	echo "<script>window.top.location='index.php'</script>";
	//header("Location: index.php");
	exit();
}

	include_once 'footer.php';

?>