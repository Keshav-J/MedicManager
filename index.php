<?php

	include_once 'header.php';


if(!isset($_SESSION['uid'])) {
?>
	<div class="container text-center" style="width:auto;" ng-app="myApp" ng-controller="customersCtrl">

		<p><b style="font-size:25px;">Login Page</b><br><br></p>
	
		<form>
			<input class="form-control" type="text" ng-model="uid" name="uid" placeholder="UserId" autofocus required>
			<span ng-show="disp1">User Not Found!</span>
			<br>
			<input class="form-control" type="password" ng-model="pwd" name="pwd" placeholder="Password" autofocus required>
			<span ng-show="disp2">Wrong Password!</span>
			<br>
			<button class="btn btn-primary" ng-click="send()">login</button>
		</form>

	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('customersCtrl', function($scope, $http) {
			$scope.reset = function() {
				$scope.uid = '';
				$scope.pwd = '';
				$scope.disp1 = false;
				$scope.disp2 = false;
			}
			$scope.send = function() {
			    $http({
				    method: "post",
				    url: "includes/login.inc.php",
				    data: {
				        'uid' : $scope.uid,
				        'pwd' : $scope.pwd
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'User Not Found')
				    	$scope.disp1 = true;
				    else
				       	$scope.disp1 = false;

					if (data.data == 'Wrong Password')
						$scope.disp2 = true;
				    else
				       	$scope.disp2 = false;

				   	if (data.data == 1)
				   	{
				   		window.top.location='index.php';
				   		exit();
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
	echo "<script>window.top.location='billing.php'</script>";
	//header("Location: billing.php");
	exit();
}


	include_once 'footer.php';

?>