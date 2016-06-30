var app = angular.module('myApp', []);

app.controller('ColorController', function($scope) {
    $scope.play;
	$scope.playUrl;
	$scope.successMsg;
	$scope.errorMsg;
	$scope.next;
	$scope.tries;
	$scope.countTry;
	var colors = ["bleu", "rouge", "jaune", "vert", "orange", "noir"];
	
    $scope.init = function(){
		$scope.tries = 3;
		$scope.countTry = true;
		$scope.successMsg = false;
		$scope.errorMsg = false;
		$scope.next = false;
        $scope.play = colors[Math.floor(Math.random() * colors.length)];
		$scope.playUrl = "colors/"+$scope.play+".mp3";
    };
	
	$scope.tap = function (color) {
		if(color == $scope.play){
			$scope.bravo();
		} else {
			$scope.error();
		}
	};
	
	$scope.error = function() {
		if ($scope.tries > 1 ){
			$scope.tries -= 1;
			$scope.errorMsg = true;
			$scope.countTry = true;
		} else {
			$scope.errorMsg = false;
			$scope.countTry = false;
			$scope.next = true;
		}
	};

    $scope.bravo = function() {
		$scope.errorMsg = false;
		$scope.successMsg = true;
		$scope.countTry = true;
		$scope.next = true;
    };
});
