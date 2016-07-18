var app = angular.module('myApp', []);

app.controller('NumberController', function($scope) {
    $scope.tries = 3;
    $scope.countTry = true;
    $scope.result = 0;
    $scope.successMsg = false;
    $scope.errorMsg = false;
    $scope.next = false;
    $scope.score = 0;

    $scope.init = function(){
        $scope.tries = 3;
        $scope.countTry = true;
        $scope.successMsg = false;
        $scope.errorMsg = false;
        $scope.next = false;
        $scope.score = 0;

        randomNumber();
        randomColor();
    };

    function randomNumber() {
        var values = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        var operator = Math.floor(Math.random() * 2) == 1 ? '+' : '-';
        var nb1, nb2 = 0;

        do {
            nb1 = randomSoluce();
            nb2 = randomSoluce();
        } while(operator == '-' && nb1 < nb2);

        $scope.result = eval(nb1  + operator + nb2);
        values.slice($scope.result, 1);

        var soluce1 = randomSoluce();
        values.slice(soluce1, 1);

        var soluce2 = randomSoluce();

        $('#number1').text(nb1);
        $('#number2').text(nb2);
        $('#operator').text(operator);
        $('#question').text('?');

        var soluces = [soluce1, soluce2, $scope.result];
        shuffle(soluces);

        for (var i=1; i<=3; i++) {
            $('#soluce'+i).text(soluces[i-1]);
        }
    }

    function shuffle(tab) {
        var j, x, i;
        for (i = tab.length; i; i -= 1) {
            j = Math.floor(Math.random() * i);
            x = tab[i - 1];
            tab[i - 1] = tab[j];
            tab[j] = x;
        }
    }

    function randomColor() {
        var colors = ['#820DAD', '#0DAD30', '#F2D308', '#F52CCD', '#2C30F5', '#13D4C1', '#E47F0B', '#70DD0A', '#60861E', '#70B577', '#81689F', '#CECB2A'];
        var elementID = ['number1', 'number2', 'operator', 'egal', 'soluce1', 'soluce2', 'soluce3'];

        elementID.forEach(
            function (i) {
                $('#'+i).css('color', colors[Math.floor(Math.random() * colors.length)]);
            }
        );
    }

    function randomSoluce() {
        return Math.floor((Math.random() * 9) + 1);
    }

    $scope.choice = function (position) {
        var response = $('#soluce' + position).text();

        // Si la partie est gagnée
        if (response == $scope.result) {
            $('#question').text($scope.result);
            $scope.errorMsg = false;
            $scope.successMsg = true;
            $scope.countTry = false;
            $scope.next = true;

            $('#gameOver').hide();

            // Obtention du score maximum
            $scope.score += 20;

            // Trophée par defaut lors d'une victoire
            var trophy = 'Champignon en Chocolat';
            
            if ($scope.score == 10) {
                trophy = 'Champignon en Bronze';
            }
            else if ($scope.score == 15) {
                trophy = 'Champignon en Argent';
            }
            else if ($scope.score == 20) {
                trophy = 'Champignon en ArgentChampignon en Or';
            }

            // Mise à jour des statistiques (trophée gagné)
            $.post(window.location, { played: true, trophy: trophy });
        }

            // Si la partie est perdue
        else {
            // S'il reste encore des essais
            if ($scope.tries > 1 ){
                $scope.tries -= 1;
                $scope.errorMsg = true;
                $scope.countTry = true;

                if ($scope.tries == 1) {
                    $scope.score -= 15;
                }
                else if ($scope.tries == 2) {
                    $scope.score -= 10;
                }
                else if ($scope.tries == 3) {
                    $scope.score -= 5;
                }
            }
                // S'il ne reste plus d'essais
            else {
                $scope.errorMsg = false;
                $scope.countTry = false;
                $scope.next = true;
                $('#question').text($scope.result);

                $scope.score = 0;

                // Mise à jour des statistiques (1 partie jouée)
                $.post(window.location, { played: true });
            }
        }
    };
});
