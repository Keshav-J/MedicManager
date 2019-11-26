<?php

	include_once 'header.php';

if(!isset($_SESSION['uid'])) {
	header("Location: index.php");
	exit();
}
?>

<div  ng-app="myApp" ng-controller="customersCtrl">

	<div ng-show="P3" class="container-display text-center" style="width:650px;">

		<p><b style="font-size:25px;">Bill</b> <br></p>

		<span>Name : {{ P2name }}<br></span>
		<span>CustomerId : {{ P2cid }}<br></span>
		<span>Phone No. : {{ P2phnno }}<br></span>
		<span>Bill no. : {{ P2billno }}<br></span>
		<span>Date : {{ P2date }}<br></span>
		<span>Time : {{ P2time }}<br></span>
		<br>
	
		<table style="font-size:18px; width: 100%;" class="table-hover table-responsive text-left">

			<col width="44">
			<col >
  			<col width="100">
  			<col width="120">
			<col width="50">
			<col width="50">

			<tr>
				<th>S.No.</th>
				<th>Product Name</th>
				<th>Retail PPU</th>
				<th>PricePerUnit</th>
				<th>Units</th>
				<th>Price</th>
			</tr>

	        <tr ng-repeat="x in prod">
		        <td> {{ $index+1 }}</td>
		        <td> {{ x.pname }}</td>
		        <td> {{ x.rpppu }}</td>
		        <td> {{ x.pppu }}</td>
		        <td> {{ x.pnum }}</td>
		        <td> {{ x.pprice }}</td>
	        </tr>
		</table>
		
		<div style="text-align:right;">
			<br>
			<span>Total = Rs. {{ P2total }}</span>
		</div>

		<br>
		<button class="btn btn-primary" ng-click="Reset()">Next Bill</button>

	</div>

	<div ng-show="P2" class="container text-center" style="width:950px; height:500px;">

		<p><b style="font-size:25px;">Billing Page</b> <br></p>

		<ul class="bill list-unstyled">

			<li class="text-center" style="width:500px">

				<span>Name : {{ P2name }}<br></span>
				<span>CustomerId : {{ P2cid }}<br></span>
				<span>Phone No. : {{ P2phnno }}<br></span>
			
				<table style="font-size:18px; width: 100%;" class="table-hover table-responsive text-left">

					<col width="44">
					<col >
		  			<col width="100">
		  			<col width="100">
					<col width="44">
					<col width="42">

					<tr>
						<th>S.No.</th>
						<th>Product Name</th>
						<th>Retail PPU</th>
						<th>PricePerUnit</th>
						<th>Units</th>
						<th>Price</th>
					</tr>

			        <tr ng-repeat="x in prod">
				        <td> {{ $index+1 }}</td>
				        <td> {{ x.pname }}</td>
				        <td> {{ x.rpppu }}</td>
				        <td> {{ x.pppu }}</td>
				        <td> {{ x.pnum }}</td>
				        <td> {{ x.pprice }}</td>
			        </tr>
				</table>
				
				<div style="text-align:right; margin-right:45.6px;">
					<br>
					<span>Total = Rs. {{ P2total }}</span>
				</div>

			</li>

			<li class="text-center" style="width:300px">

				<form>
					
					<input class="form-control" type="text" ng-model="pname" name="pname" placeholder="ProductName/Id" autofoucs required>
					<span ng-show="P2disp1">Product Not Found!</span>
					<br>
					<input class="form-control" type="number" ng-model="rpppu" placeholder="RetailPricePerUnit" disabled>
					<br>
					<input class="form-control" type="number" ng-model="pppu" placeholder="PricePerUnit" disabled>
					<br>
					<input class="form-control" type="number" ng-model="panum" placeholder="AvailableUnits" disabled>
					<br>
					<input class="form-control" type="number" ng-model="pnum" id="pnum" placeholder="NoOfUnits" autofocus>
					<span ng-show="P2disp2">Invalid Quantity!</span>
					<br>
					<button class="btn btn-primary" ng-click="P2add()">Next</button>

				</form>

				<br>
				<button class="btn btn-primary" ng-click="bill()">Bill</button>
				<button class="btn btn-primary" ng-click="Reset()">Cancel</button>
			</li>
		</ul>

	</div>

	<div ng-show="P1" class="container text-center" style="width:auto;">

		<p><b style="font-size:25px;">Billing Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="P1cid" placeholder="CustomerId" autofocus>
			<span ng-show="P1disp">User Not Found!</span>
			<br>
			<button class="btn btn-primary" ng-click="P1send()">Next</button>
		</form>

		<br>
		<a href="cust.php?page=add"><button class="btn btn-primary">New Customer</button></a>

	</div>
</div>

<script>
	var app = angular.module('myApp', []);
	app.controller('customersCtrl', function($scope, $http) {
		$scope.P1init = function() {
			$scope.P1 = true;
			$scope.P1cid = '';
			$scope.P1disp = false;
		}
		$scope.P2init = function() {
			$scope.P2 = false;
			$scope.P3 = false;
			
			$scope.P2name = '';
			$scope.P2cid = '';
			$scope.P2phnno = '';
			$scope.P2billno = '';
			$scope.P2date = '';
			$scope.P2time = '';
			
			$scope.prod = [];
			$scope.P2total = 0;
			$scope.P2num = 0;
			$scope.P2disp1 = false;
			$scope.P2disp2 = false;

			$scope.pname = '';
			$scope.rpppu = '';
			$scope.pppu = '';
			$scope.panum = '';
			$scope.pnum = '';
		}

		$scope.P2initVal = function() {
			$scope.pname = '';
			$scope.rpppu = '';
			$scope.pppu = '';
			$scope.panum = '';
			$scope.pnum = '';
		}

		$scope.P1send = function() {
		    $http({
			    method: "post",
			    url: "includes/billing.inc.php?page=bill1",
			    data: {
			        'cid' : $scope.P1cid,
			    }
			}).then(function (data) {
			    console.log(data);
			    if (data.data == 'notFound')$scope.P1disp = true;
			    else				    	$scope.P1disp = false;

			   	if (data.data.status == 'success')
			   	{
			   		$scope.P2name = data.data.name;
					$scope.P2cid = $scope.P1cid;
					$scope.P2phnno = data.data.phnno;
					$scope.prod = [];
					$scope.P2total = 0;
					$scope.P2num = 0;

					$scope.P1init();
					$scope.P1 = false;
			   		$scope.P2 = true;
			   	}

			}, function myError(response) {
		        console.log('Error');
		    });
		}

		$scope.P2add = function() {
			$scope.P2disp1 = false;
			$scope.P2disp2 = false;
			if($scope.pname != '') {
				$http({
				    method: "post",
				    url: "includes/billing.inc.php?page=bill2",
				    data: {
				        'pname' : $scope.pname,
				        'rpppu': $scope.rpppu,
				        'pppu' : $scope.pppu,
				        'panum': $scope.panum,
				        'pnum' : $scope.pnum
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'Product not Found!') {
				    	$scope.P2disp1 = true;
				    }
				    else
				    	$scope.P2disp1 = false;

				   	if (data.data.status == 'success')
				   	{
				   		$scope.pname = data.data.pname;
						$scope.rpppu = data.data.rpppu;
						$scope.pppu = data.data.pppu;
						$scope.panum = data.data.panum;

						if($scope.P2disp1 == false && $scope.pnum != '' && $scope.pnum >0 && $scope.pnum <= $scope.panum
							&&	($scope.pnum % 1 == 0)) {
							$scope.prod.push(
							{
								"pname":$scope.pname,
								"rpppu":$scope.rpppu,
								"pppu":$scope.pppu,
								"pnum":$scope.pnum,
								"pprice":($scope.pnum * $scope.pppu).toFixed(2)
							});
							$scope.P2total += parseFloat($scope.prod[$scope.P2num].pprice);
							$scope.P2num++;

							$scope.P2initVal();
						}
						else {
							$scope.P2disp2 = true;
						}
				   	}

				   	$scope.flag = true;
				}, function myError(response) {
			        console.log('Error');
			    });
			}
			
		}

		$scope.bill = function() {
			if($scope.prod != '') {
				$http({
				    method: "post",
				    url: "includes/billing.inc.php?page=bill3",
				    data: {
				    	'cid'  : $scope.P2cid,
				    	'prod': $scope.prod
				    }
				}).then(function (data) {
				    console.log(data);
				    
				    $scope.P2billno = data.data.billno;
					$scope.P2date = data.data.date;
					$scope.P2time = data.data.time;

					$http({
					    method: "post",
					    url: "includes/genPDF.php",
					    data: {
					    	'id'  : $scope.P2cid,
					    	'name' : $scope.P2name,
							'phnno' : $scope.P2phnno,
							'billno' : $scope.P2billno,
							'date' : $scope.P2date,
							'time' : $scope.P2time,
							'prod': $scope.prod,
							'total': $scope.P2total
					    }
					}).then(function (data) {
					    console.log('Success');
					}, function myError(response) {
				        console.log('Error');
				    });

				    $scope.P1init();
					$scope.P1 = false;
					$scope.P2 = false;
					$scope.P3 = true;

				}, function myError(response) {
			        console.log('Error');
			    });
			}
		}

		$scope.Reset = function() {
			$scope.P1init();
			$scope.P2init();
		}
		
		$scope.P1init();
		$scope.P2init();
	});
</script>
	
<?php


	include_once 'footer.php';

?>