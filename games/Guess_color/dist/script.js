var app = angular.module('myApp', []);

app.controller('ColorController', function($scope) {
    $scope.play;
	$scope.playUrl;
	$scope.successMsg;
	$scope.errorMsg;
	$scope.next;
	$scope.tries;
	$scope.countTry;
	$scope.nbParty;
	var colors = ["bleu", "rouge", "jaune", "vert", "orange", "noir"];
	
    $scope.init = function(){
		$scope.tries = 3;
		$scope.countTry = true;
		$scope.successMsg = false;
		$scope.errorMsg = false;
		$scope.next = false;
        $scope.play = colors[Math.floor(Math.random() * colors.length)];
		$scope.playUrl = "/Lapinouss/games/Guess_color/colors/"+$scope.play+".mp3";
		$scope.nbParty = 1;
    };
	
	$scope.tap = function (color) {
		if(color == $scope.play){
			$scope.bravo();
		} else {
			$scope.error();
		}
	};

	// Si la partie est perdue
	$scope.error = function() {
		// S'il reste des essais on ne met pas à jour les trophées
		if ($scope.tries > 1 ){
			$scope.tries -= 1;
			$scope.errorMsg = true;
			$scope.countTry = true;
		}
			// Si aucun essai reste
		else {
			$scope.errorMsg = false;
			$scope.countTry = false;
			$scope.next = true;

			// Mise à jour des statistiques (1 partie jouée)
			$.post(window.location, { played: true });
		}
	};

	// Si la partie est gagnée
    $scope.bravo = function() {
		$scope.errorMsg = false;
		$scope.successMsg = true;
		$scope.countTry = true;
		$scope.next = true;

		// S'il s'agit d'une partie sans faute
		if ($scope.tries == 3) {
			// Mise à jour des statistiques (1 partie jouée, trophée gagné)
			$.post(window.location, { played: true, trophy: 'Arc-en-ciel' });
		}
		else {
			// S'il a joué 5 parties
			if ($scope.nbParty == 5) {
				// Mise à jour des statistiques (5 partie jouées, trophée gagné)
				$.post(window.location, { played: true, trophy: 'Licorne' });
			}

			$scope.nbParty++;
			
			// Mise à jour des statistiques (1 partie jouée)
			$.post(window.location, { played: true });
		}
    };
});
