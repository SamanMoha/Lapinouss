var app = angular.module('myApp', []);

app.controller('NumberController', function($scope) {
    $scope.tries = 3;
    $scope.countTry = true;
    $scope.result;
    $scope.successMsg = false;
    $scope.errorMsg = false;
    $scope.next = false;

    $scope.init = function(){
        $scope.tries = 3;
        $scope.countTry = true;
        $scope.result;
        $scope.successMsg = false;
        $scope.errorMsg = false;
        $scope.next = false;

        randomNumber();
        randomColor();
    };

    function randomNumber() {
        var operatorType = ['+', '-'];
        var operator = operatorType[Math.floor(Math.random() * operatorType.length)];
        var nb1 = Math.floor((Math.random() * 9) + 1);
        var nb2 = Math.floor((Math.random() * 9) + 1);

        if (operator == '-') {
            while (nb1 < nb2) {
                nb1 = Math.floor((Math.random() * 9) + 1);
                nb2 = Math.floor((Math.random() * 9) + 1);
            }
        }

        $scope.result = eval(nb1  + operator + nb2);

        var soluce1 = randomSoluce($scope.result);
        var soluce2 = randomSoluce($scope.result);


        while(soluce1 == $scope.result){
            soluce1 = randomSoluce($scope.result);
        }

        while(soluce2 == soluce1 || soluce2 == $scope.result){
            soluce2 = randomSoluce($scope.result);
        }

        document.getElementById("number1").innerHTML = nb1;
        document.getElementById("number2").innerHTML = nb2;
        document.getElementById("operator").innerHTML = operator;
		document.getElementById("question").innerHTML = "?";

        var randSoluce = Math.floor(Math.random() * 3) + 1;
        if (randSoluce == 1) {
            document.getElementById("soluce1").innerHTML = soluce1;
            document.getElementById("soluce3").innerHTML = $scope.result;
            document.getElementById("soluce2").innerHTML = soluce2;
        }
        else if(randSoluce == 2) {
            document.getElementById("soluce1").innerHTML = soluce1;
            document.getElementById("soluce2").innerHTML = $scope.result;
            document.getElementById("soluce3").innerHTML = soluce2;
        }
        else {
            document.getElementById("soluce3").innerHTML = soluce1;
            document.getElementById("soluce1").innerHTML = $scope.result;
            document.getElementById("soluce2").innerHTML = soluce2;
        }
    }

    function randomColor() {
        var colors = ['#820DAD', '#0DAD30', '#F2D308', '#F52CCD', '#2C30F5', '#13D4C1', '#E47F0B', '#70DD0A', '#60861E', '#70B577', '#81689F', '#CECB2A'];
        var elementID = ['number1', 'number2', 'operator', 'egal', 'soluce1', 'soluce2', 'soluce3'];

        for (var id in elementID){
            document.getElementById(elementID[id]).style.color = colors[Math.floor(Math.random() * colors.length)];
        }
    }

    function randomSoluce(max) {
        return Math.floor((Math.random() * max) + 4);
    }

    $scope.error = function() {
        if ($scope.tries > 1 ){
            $scope.tries -= 1;
            $scope.errorMsg = true;
            $scope.countTry = true;
        } else {
            $scope.errorMsg = false;
            $scope.countTry = false;
            $scope.next = true;
            document.getElementById("question").innerHTML = $scope.result;
        }
    };

    $scope.bravo = function() {
        document.getElementById("question").innerHTML = $scope.result;
        $scope.errorMsg = false;
        $scope.successMsg = true;
        $scope.countTry = false;
        $scope.next = true;

        $('#gameOver').hide();
    };

});
