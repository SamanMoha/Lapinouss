var app = angular.module('myApp', []);

app.controller('ColorController', function($scope) {
    $scope.play;
	$scope.playUrl;
	$scope.successMsg;
	$scope.errorMsg;
	$scope.next;
	var colors = ["bleu", "rouge", "jaune", "vert", "orange", "noir"];
	
    $scope.init = function(){
		$scope.successMsg = false;
		$scope.errorMsg = false;
		$scope.next = false;
        $scope.play = colors[Math.floor(Math.random() * colors.length)];
		$scope.playUrl = "colors/"+$scope.play+".mp3";
    };
	
	$scope.tap = function (color) {
		if(color == $scope.play){
			$scope.errorMsg = false;
			$scope.successMsg = true;
			$scope.next = true;
		} else {
			$scope.errorMsg = true;
			$scope.successMsg = false;
		}
	};
});
