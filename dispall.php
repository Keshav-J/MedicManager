<?php

	include_once 'header.php';

if(!isset($_GET['page']) || !isset($_SESSION['uid'])) {
	header("Location: index.php");
	exit();
}

else if($_GET['page'] == 'cust') {
	?>

	<div class="container-display text-center" style="width:auto" ng-app="myApp" ng-controller="customersCtrl" ng-init="total">
		
		<p><b style="font-size:25px;">Customer Details</b> <br><br></p>

		<table style="font-size:18px;" class="table-hover table-responsive text-left">

			<col width="5.5%">
			<col>
  			<col width="12.5%">
  			<col width="37.5%">
			<col width="12.5%">

			<tr style="line-height:35px;">
				<th ng-click="sort('id')" >Id</th>
				<th ng-click="sort('name')" >Customer Name</th>
				<th ng-click="sort('phnno')" >Phone No.</th>
				<th ng-click="sort('billno')"  style="text-align:center;">Bill Nos.</th>
				<th ng-click="sort('total')"  style="text-align:right;">Total Price</th>
			</tr>

			<tr ng-repeat="x in names | orderBy : col : rev">
				<td>{{ x.id }}</td>
				<td>{{ x.name }}</td>
				<td>{{ x.phnno }}</td>
				<td>{{ x.billno }}</td>
				<td style="text-align:right;">{{ x.total }}</td>
			</tr>

		</table>

		<button class="btn btn-primary" ng-click="refresh()">Refresh</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.col = 'id';
			$scope.rev = false;
			$scope.sort = function(x) {
				if(x == $scope.col)
					$scope.rev = !$scope.rev;
				else {
					$scope.col = x;
					$scope.rev = false;
				}
			}
			$scope.refresh = function() {
			    $http.get("includes/dispall.inc.php?page=cust")
		    	.then(function (response) {
		    		$scope.col = 'id';
					$scope.rev = false;
			   		$scope.names = response.data.records;
		    	}
		    	, function myError(response) {
		        	console.log('Error');
			    });
			}
			$scope.refresh();
		});
	</script>

	<?php
}

else if($_GET['page'] == 'prod') {
	?>

	<div class="container-display text-center" style="width:1200px;" ng-app="myApp" ng-controller="customersCtrl">
		
		<p><b style="font-size:25px;">Product Details</b> <br><br></p>

		<table style="font-size:18px; width: 100%;" class="table-hover table-responsive text-left">

			<col width="44">
			<col>
  			<col width="350">
  			<col width="90">
			<col width="90">
			<col width="90">
			<col width="90">

			<tr style="line-height:35px;">
				<th ng-click="sort('pid')">Id</th>
				<th ng-click="sort('name')">Product Name</th>
				<th ng-click="sort('info')">Description</th>
				<th ng-click="sort('rprice')" style="text-align:center;">MRP</th>
				<th ng-click="sort('price')" style="text-align:center;">Store Price</th>
				<th ng-click="sort('disc')" style="text-align:center;">Discount</th>
				<th ng-click="sort('qty')" style="text-align:center;">Quantity</th>
			</tr>

			<tr ng-repeat="x in names | orderBy : col : rev">
				<td>{{ x.pid }}</td>
				<td>{{ x.name }}</td>
				<td>{{ x.info }}</td>
				<td>{{ x.rprice }}</td>
				<td>{{ x.price }}</td>
				<td>{{ x.disc }}</td>
				<td>{{ x.qty }}</td>
			</tr>

		</table>

		<br>

		<button class="btn btn-primary" ng-click="refresh()">Refresh</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.col = 'pid';
			$scope.rev = false;
			$scope.sort = function(x) {
				if(x == $scope.col)
					$scope.rev = !$scope.rev;
				else {
					$scope.col = x;
					$scope.rev = false;
				}
			}
			$scope.refresh = function() {
			    $http.get("includes/dispall.inc.php?page=prod")
			    .then(function (response) {
			    	$scope.col = 'pid';
					$scope.rev = false;
			    	$scope.names = response.data.records;
			    }
			    , function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.refresh();
		});
	</script>

	<?php
}

else if($_GET['page'] == 'bill') {
	?>

	<div class="container-display text-center" style="width:auto" ng-app="myApp" ng-controller="customersCtrl">
		
		<p><b style="font-size:25px;">Customer Details</b> <br><br></p>

		<table style="font-size:18px;" class="table-hover table-responsive text-left">

			<col width="70">
			<col width="80">
  			<col width="100">
  			<col>
			<col width="90">

			<tr style="line-height:35px;">
				<th ng-click="sort('id')" style="text-align:center;">Bill No.</th>
				<th ng-click="sort('cid')" style="text-align:center;">Cust. Id</th>
				<th ng-click="sort('num')" style="text-align:center;">No. of Prod</th>
				<th ng-click="sort('prod')" style="text-align:center;">Products</th>
				<th ng-click="sort('date')" style="text-align:center;">Date</th>
				<th ng-click="sort('total')" style="text-align:center;">Total</th>
			</tr>

			<tr ng-repeat="x in names | orderBy : col : rev">
				<td>{{ x.id }}</td>
				<td>{{ x.cid }}</td>
				<td>{{ x.num }}</td>
				<td>{{ x.prod }}</td>
				<td>{{ x.date }}</td>
				<td>{{ x.total }}</td>
			</tr>

		</table>

		<br>

		<button class="btn btn-primary" ng-click="refresh()">Refresh</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.col = 'id';
			$scope.rev = false;
			$scope.sort = function(x) {
				if(x == $scope.col)
					$scope.rev = !$scope.rev;
				else {
					$scope.col = x;
					$scope.rev = false;
				}
			}
			$scope.refresh = function() {
			    $http.get("includes/dispall.inc.php?page=bill")
			    .then(function (response) {
			    	$scope.col = 'id';
					$scope.rev = false;
			    	$scope.names = response.data.records;
			    }
			    , function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.refresh();
		});
	</script>

	<?php
}

else if($_GET['page'] == 'admin') {
	?>

	<div class="container-display text-center" style="width:auto" ng-app="myApp" ng-controller="customersCtrl">
		
		<p><b style="font-size:25px;">Admin Details</b> <br><br></p>

		<table style="font-size:18px;" class="table-hover table-responsive text-left">

			<col width="100">
			<col>
  			<col width="150">

			<tr style="line-height:35px;">
				<th ng-click="sort('id')">S.No.</th>
				<th ng-click="sort('name')" style="text-align:center;">Admin Name</th>
				<th ng-click="sort('uid')" style="text-align:center;">Admin Id</th>
			</tr>

			<tr ng-repeat="x in names | orderBy : col : rev">
				<td>{{ x.id }}</td>
				<td>{{ x.name }}</td>
				<td style="text-align:center;">{{ x.uid }}</td>
			</tr>

		</table>

		<br>

		<button class="btn btn-primary" ng-click="refresh()">Refresh</button>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.col = 'id';
			$scope.rev = false;
			$scope.sort = function(x) {
				if(x == $scope.col)
					$scope.rev = !$scope.rev;
				else {
					$scope.col = x;
					$scope.rev = false;
				}
			}
			$scope.refresh = function() {
			    $http.get("includes/dispall.inc.php?page=admin")
			    .then(function (response) {
			    	$scope.col = 'id';
					$scope.rev = false;
			    	$scope.names = response.data.records;
			    }
			    , function myError(response) {
			        console.log('Error');
			    });
			}
			$scope.refresh();
		});
	</script>

	<?php
}

	include_once 'footer.php';

?>