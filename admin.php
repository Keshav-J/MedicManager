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
		<p><b style="font-size:25px;">Admin Adding Page</b> <br><br></p>

		<form>
			
			<input class="form-control" type="text" ng-model="name" name="name" placeholder="AdminName" autofocus required>
			<br>
			<input class="form-control" type="text" ng-model="uid" name="uid" placeholder="UserName" autofocus required>
			<span ng-show="disp1">User Exists</span>
			<br>
			<input class="form-control" type="password" ng-model="pwd" name="pwd" placeholder="Password" autofocus required>
			<span ng-show="disp2">Password Weak</span>
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
				$scope.uid = '';
				$scope.pwd = '';
				$scope.disp1 = false;
				$scope.disp2 = false;
			}
			$scope.add = function() {
			    $http({
				    method: "post",
				    url: "includes/admin.inc.php?page=add",
				    data: {
				        'name': $scope.name,
				        'uid' : $scope.uid,
				        'pwd' : $scope.pwd
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'Admin Id already exists!')
				    	$scope.disp1 = true;
				    else
				    	$scope.disp1 = false;

					if (data.data == 'Your password is weak!')
				    	$scope.disp2 = true;
				    else
				    	$scope.disp2 = false;

				   	if (data.data == 1)
				   	{
				   		$scope.reset();
				   		window.alert('Admin added successfully!');
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

		<p><b style="font-size:25px;">Change Password</b><br><br></p>

		<form>
			<input class="form-control" type="password" ng-model="opwd" name="opwd" placeholder="OldPassword" autofocus required>
			<span ng-show="disp1">Wrong Password</span>
			<br>
			<input class="form-control" type="password" ng-model="npwd" name="npwd" placeholder="NewPassword" autofocus required>
			<span ng-show="disp2">Password Weak</span>
			<br>
			<input class="form-control" type="password" ng-model="cnpwd" name="cnpwd" placeholder="ConfirmNewPassword" autofocus required>
			<span ng-show="disp3">Confirm Password</span>
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
				$scope.opwd = '';
				$scope.npwd = '';
				$scope.cnpwd = '';
				$scope.disp1 = false;
				$scope.disp2 = false;
				$scope.disp3 = false;
			}
			$scope.mod = function() {
			    $http({
				    method: "post",
				    url: "includes/admin.inc.php?page=mod",
				    data: {
				        'opwd': $scope.opwd,
				        'npwd' : $scope.npwd,
				        'cnpwd' : $scope.cnpwd
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'wrng')	$scope.disp1 = true;
				    else			    	$scope.disp1 = false;

					if (data.data == 'weak')$scope.disp2 = true;
				    else			    	$scope.disp2 = false;

				    if (data.data == 'cnfrm')$scope.disp3 = true;
				    else			    	$scope.disp3 = false;

				   	if (data.data == 'success')
				   	{
				   		$scope.reset();
				   		window.alert('Admin modified successfully!');
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

		<p><b style="font-size:25px;">Admin Deleting Page</b> <br><br></p>

		<form>
			<input class="form-control" type="text" ng-model="uid" name="uid" placeholder="UserName" autofocus>
			<span ng-show="disp1">User Not found!</span>
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
				$scope.uid = '';
				$scope.pwd = '';
				$scope.disp1 = false;
			}
			$scope.mod = function() {
			    $http({
				    method: "post",
				    url: "includes/admin.inc.php?page=mod",
				    data: {
				        'uid': $scope.uid,
				        'pwd' : $scope.pwd,
				    }
				}).then(function (data) {
				    console.log(data);
				    if (data.data == 'Admin Id Not Found')
				    	$scope.disp1 = true;
				    else
				    	$scope.disp1 = false;

				   	if (data.data == 1)
				   	{
				   		$scope.reset();
				   		window.alert('Admin deleted successfully!');
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