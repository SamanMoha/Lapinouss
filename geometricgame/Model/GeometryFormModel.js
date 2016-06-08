var GeometryFormModel = function () {
    
    var updatetimer;
    var gametimer;
    var score = 0;
    
    function startGameTimer() {
        if(gametimer == 0 || gametimer <0){
            gametimer = 30;
            countDown();
            updatetimer = setInterval(countDown, 1000);
        }else if( gametimer == null){
            initListGeometric();
            gametimer = 30;
            countDown();
            updatetimer = setInterval(countDown, 1000);
        }else{
            response = confirm('The game isn\'t finish yet, Do you want to retry ?');
            if(response == true){
                gametimer = 30;
            }
        }
    }
    
    function pauseGameTimer() {
        var result;
        if(updatetimer != null){
            result = "Reprendre";
            clearInterval(updatetimer);
            updatetimer = null;
        }else{
            result = "Pause";
            updatetimer = setInterval(countDown, 1000);
        }
        return result;
    }
    
    function countDown() {
        if(gametimer == 0 && updatetimer != null){
            clearInterval(updatetimer);
        }
        setGameTimer(gametimer);
        gametimer -= 1;
    }
    
    function initListGeometric(){
        console.log($('listgeometric').html());
        $('listgeometric').html("<img src=\"../image/carre.png\" draggable=\"true\">");
    }
    
    function getGameTimer() {
        return $('#gametimer').html("");
    }
    
    function setGameTimer(value) {
        $('#gametimer').html(value);
    }
    
    function getScore() {
        return $('#score').html();
    }
    
    function setScore(value) {
        $('#score').html(value);
    }
    
    return {
        startGameTimer : startGameTimer,
        pauseGameTimer : pauseGameTimer,
        getScore : getScore,
        setScore : setScore,
        countDown : countDown
    }
}