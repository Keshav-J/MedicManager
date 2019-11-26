<?php

	include_once 'header.php';

	if(!isset($_SESSION['uid'])) {
		header("Location: index.php");
		exit();
	}

?>

	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p ng-show="!disp"><b style="font-size:25px;">Product Searching Page</b> <br><br></p>
		<p ng-show="disp"><b style="font-size:25px;">Product Details</b> <br><br></p>

		<form>

			<input class="form-control" type="text" ng-model="sname" name="sname" placeholder="Product Name or Id" autofocus>

			<br>

			<table ng-show="disp" style="font-size:18px;" class="table-hover table-responsive text-left">

				<col width="40%">
				<col width="10%">
				<col width="50%">

				<tr>
					<td><b>Id</b></td>
					<td>:</td>
					<td>{{ pid }}</td>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td>:</td>
					<td>{{ name }}</td>
				</tr>
				<tr>
					<td><b>Description</b></td>
					<td>:</td>
					<td>{{ info }}</td>
				</tr>
				<tr>
					<td><b>Max. Retail Price</b></td>
					<td>:</td>
					<td>{{ rprice }}</td>
				</tr>
				<tr>
					<td><b>Store Price</b></td>
					<td>:</td>
					<td>{{ price }}</td>
				</tr>
				<tr>
					<td><b>Discount</b></td>
					<td>:</td>
					<td>{{ disc }}</td>
				</tr>
				<tr>
					<td><b>Quantity Available</b></td>
					<td>:</td>
					<td>{{ qty }}</td>
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
				$scope.pid = '';
				$scope.name = '';
				$scope.info = '';
				$scope.rprice = '';
				$scope.price = '';
				$scope.disc = '';
				$scope.qty = '';
				$scope.sname = '';
				$scope.disp = false;
			}
			$scope.search = function() {
			    $http({
				    method: "post",
				    url: "includes/prodsrch.inc.php",
				    data: {
				        'sname': $scope.sname
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				    $scope.pid = data.data.pid;
		        	$scope.name = data.data.name;
		        	$scope.info = data.data.info;
		        	$scope.pid = data.data.pid;
					$scope.name = data.data.name;
					$scope.info = data.data.pid;
					$scope.rprice = data.data.rprice;
					$scope.price = data.data.price;
					$scope.disc = data.data.disc;
					$scope.qty = data.data.qty;
					$scope.disp = true;
				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>
	
<?php

	include_once 'footer.php';

?>