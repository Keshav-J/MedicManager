<?php

	include_once 'header.php';

	if(!isset($_SESSION['uid'])) {
		header("Location: index.php");
		exit();
	}

?>

	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p ng-show="!disp"><b style="font-size:25px;">Admin Searching Page</b> <br><br></p>
		<p ng-show="disp"><b style="font-size:25px;">Admin Details</b> <br><br></p>

		<form>

			<input class="form-control" type="text" ng-model="sid" name="sid" placeholder="UserId or Id" autofocus>
		
			<br>

			<table ng-show="disp" style="font-size:18px;" class="table-hover table-responsive text-left">

				<col width="40%">
				<col width="10%">
				<col width="50%">

				<tr>
					<td><b>Admin Id</b></td>
					<td>:</td>
					<td>{{ id }}</td>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td>:</td>
					<td>{{ name }}</td>
				</tr>
				<tr>
					<td><b>Username</b></td>
					<td>:</td>
					<td>{{ uid }}</td>
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
				$scope.uid = '';
				$scope.sid = '';
				$scope.disp = false;
			}
			$scope.search = function() {
			    $http({
				    method: "post",
				    url: "includes/adminsrch.inc.php",
				    data: {
				        'sid': $scope.sid
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				    $scope.id = data.data['id'];
		        	$scope.name = data.data.name;
		        	$scope.uid = data.data.uid;
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