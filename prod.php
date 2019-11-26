<?php

	include_once 'header.php';

if(!isset($_GET['page']) || !isset($_SESSION['uid'])) {
	header("Location: index.php");
	exit();
}

if($_GET['page'] == 'add') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">
	
		<p><b style="font-size:25px;">Product Adding Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="name" name="name" placeholder="ProductName" autofocus required>
			<span ng-show="disp">Product Exists!</span>
			<br>
			<input class="form-control" type="text" ng-model="info" name="info" placeholder="Description" autofocus required>
			<br>
			<input class="form-control" type="decimal" ng-model="rprice" name="rprice" placeholder="PriceOfEachUnit(MRP)" autofocus required>
			<br>
			<input class="form-control" type="decimal" ng-model="price" name="price" placeholder="PriceOfEachUnit(Our Price)" autofocus required>
			<br>
			<input class="form-control" type="text" ng-model="qty" name="qty" placeholder="Quantity" autofocus required>
			<br>
			<button class="btn btn-primary" ng-click="add()">Add Product</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.name = '';
				$scope.info = '';
				$scope.rprice = '';
				$scope.price = '';
				$scope.qty = '';
				$scope.disp = false;
			}
			$scope.add = function() {
			    $http({
				    method: "post",
				    url: "includes/prod.inc.php?page=add",
				    data: {
				        "name" : $scope.name,
						"info" : $scope.info,
						"rprice" : $scope.rprice,
						"price" : $scope.price,
						"qty" : $scope.qty,
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'exists')	$scope.disp = true;
				    else				    	$scope.disp = false;

				   	if (data.data == '1')
				   	{
				   		$scope.reset();
				   		window.alert('Product added successfully!');
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

elseif ($_GET['page'] == 'mod') {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p><b style="font-size:25px;">Product Modifying Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="oname" placeholder="OldName or OldId" autofocus required>
			<span ng-show="disp">Not Found!</span>
			<br>
			<input class="form-control" type="text" ng-model="nname" placeholder="NewName" autofocus>
			<br>
			<input class="form-control" type="text" ng-model="info" placeholder="NewDescription" autofocus>
			<br>
			<input class="form-control" type="text" ng-model="rprice" placeholder="NewPriceOfEachUnit(MRP)" autofocus>
			<br>
			<input class="form-control" type="text" ng-model="price" placeholder="NewPriceOfEachUnit(Our Price)" autofocus>
			<br>
			<input class="form-control" type="text" ng-model="qty" placeholder="NewQuantity" autofocus>
			<br>
			<button class="btn btn-primary" ng-click="mod()">Modify Product</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.oname = '';
				$scope.nname = '';
				$scope.info = '';
				$scope.rprice = '';
				$scope.price = '';
				$scope.qty = '';
				$scope.disp = false;
			}
			$scope.mod = function() {
			    $http({
				    method: "post",
				    url: "includes/prod.inc.php?page=mod",
				    data: {
				    	"pid" : $scope.oname,
				        "name" : $scope.nname,
						"info" : $scope.info,
						"rprice" : $scope.rprice,
						"price" : $scope.price,
						"qty" : $scope.qty,
				    }
				}).then(function (data) {
				    console.log(data.data);
				    
				   	if (data.data == '1')
				   	{
				   		$scope.reset();
				   		window.alert('Product modified successfully!');
				   	}
				   	else if (data.data == 'Product Not Found!')
			   			$scope.disp = true;
				    else
				    {
				    	$scope.disp = false;
						if(data.data.name != '') $scope.nname = data.data.name;
						if(data.data.info != '') $scope.info = data.data.info;
						if(data.data.rprice != '') $scope.rprice = data.data.rprice;
						if(data.data.price != '') $scope.price = data.data.price;
						if(data.data.qty != '') $scope.qty = data.data.qty;
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
	
		<p><b style="font-size:25px;">Product Deleting Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="name" name="name" placeholder="Name or Id" autofocus>
			<span ng-show="disp">Product Not Found!</span>
			<br>
			<button class="btn btn-primary" ng-click="del()">Delete Product</button>
		</form>

		<br>
		<button class="btn btn-primary" ng-click="reset()">Reset</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.name = '';
				$scope.disp = false;
			}
			$scope.del = function() {
			    $http({
				    method: "post",
				    url: "includes/prod.inc.php?page=del",
				    data: {
				        "name" : $scope.name
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'Product Id/Name Not Found!')$scope.disp = true;
				    else				    	$scope.disp = false;

				   	if (data.data == 1)
				   	{
				   		$scope.reset();
				   		window.alert('Product deleted successfully!');
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