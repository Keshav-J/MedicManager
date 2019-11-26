<?php

	include_once 'header.php';

if(!isset($_GET['page']) || !isset($_SESSION['uid'])) {
	echo "<script>window.top.location='index.php'</script>";
	//header("Location: index.php");
	exit();
}

if($_GET['page'] == 'add') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">
	
		<p><b style="font-size:25px;">Customer Adding Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="name" name="name" placeholder="CustomerName" autofocus required>
			<br>
			<input class="form-control" type="text" ng-model="phnno" name="phnno" placeholder="PhoneNumber" autofocus required>
			<span ng-show="disp1">Number exists!</span>
			<span ng-show="disp2">Enter valid Number!</span>
			<br>
			<button class="btn btn-primary" ng-click="add()">Add</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.name = '';
				$scope.phnno = '';
				$scope.disp1 = false;
				$scope.disp2 = false;
			}
			$scope.add = function() {
			    $http({
				    method: "post",
				    url: "includes/cust.inc.php?page=add",
				    data: {
				        'name': $scope.name,
				        'phnno' : $scope.phnno
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'Customer Phone Number Exists!')
				    	$scope.disp1 = true;
				    else
				       	$scope.disp1 = false;

				    if (data.data == 'Invalid Phone Number!')
				    	$scope.disp2 = true;
				    else
				    	$scope.disp2 = false;

					if (data.data == 1)
				   	{
				   		$scope.reset();
				   		window.alert('Customer added successfully!');
				   	}

				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>

<?php
}

elseif($_GET['page'] == 'mod') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p><b style="font-size:25px;">Customer Modifying Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="id" name="id" placeholder="CustomerId" autofocus required>
			<span ng-show="disp0">Not Found!</span>
			<br>
			<input class="form-control" type="text" ng-model="name" name="name" placeholder="NewName" autofocus required>
			<br> 
			<input class="form-control" type="text" ng-model="phnno" name="phnno" placeholder="NewPhnno" autofocus required>
			<span ng-show="disp1">Number exists!</span> 
			<span ng-show="disp2">Enter valid Number!</span>
			<br>
			<button class="btn btn-primary" ng-click="mod()">Save</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.id = '';
				$scope.name = '';
				$scope.phnno = '';
				$scope.disp0 = false;
				$scope.disp1 = false;
				$scope.disp2 = false;
			}
			$scope.mod = function() {
			    $http({
				    method: "post",
				    url: "includes/cust.inc.php?page=mod",
				    data: {
				    	'id' : $scope.id,
				        'name': $scope.name,
				        'phnno' : $scope.phnno
				    }
				}).then(function (data) {
				    console.log(data);

				    if (data.data == 'Customer Id Not Found!')
				    	$scope.disp0 = true;
				    else
				       	$scope.disp0 = false;

				    if (data.data == 'Phone number already exists!')
				    	$scope.disp1 = true;
				    else
				       	$scope.disp1 = false;

				    if (data.data == 'Invalid Phone Number!')
				    	$scope.disp2 = true;
				    else
				       	$scope.disp2 = false;

					if (data.data == 1)
				   	{
				   		$scope.reset();
				   		window.alert('Customer modified successfully!');
				   	}

				}, function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.reset();
		});
	</script>
<?php
}

elseif($_GET['page'] == 'del') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">
		<p><b style="font-size:25px;">Customer Deleting Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="id" name="id" placeholder="CustomerId" autofocus required>
			<span ng-show="disp">Not Found!</span>
			<br>
			<button class="btn btn-primary" ng-click="del()">Delete</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>
		
	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.id = '';
				$scope.disp = false;
			}
			$scope.del = function() {
			    $http({
				    method: "post",
				    url: "includes/cust.inc.php?page=del",
				    data: {
				    	'id' : $scope.id
				    }
				}).then(function (data) {
				    console.log(data);

				    if (data.data == 'notFound')$scope.disp = true;
				    else				    	$scope.disp = false;

					if (data.data == 'success')
				   	{
				   		$scope.reset();
				   		window.alert('Customer deleted successfully!');
				   	}

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