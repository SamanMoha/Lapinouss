var GeometryFormModel = function () {
    
    var updatetimer;
    var gametimer;
    var score = 0;
    
    function startGameTimer() {
        /*if(gametimer == 0 || gametimer <0){
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
        }*/
        gametimer = 30;
        countDown();
        updatetimer = setInterval(countDown, 1000);
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
            $('#endscore').html(getScore());
            $('#endmessage').show();
        }
        setGameTimer(gametimer);
        gametimer -= 1;
    }
    
    function initListGeometric(){
        var randomform = Math.floor((Math.random() * 3));
        
        if(randomform == 0){
            $('<img/>')         
                .attr('src','/Lapinouss/games/Geometry_Shapes/image/green_square.png')
                .data( 'form', 'square' )
                .appendTo( 'div#listgeometric' )
                .draggable( {
                    containment: 'div#content',
                    stack: '#listgeometric div',
                    cursor: 'move',
                    revert: true
                } );
        }else if(randomform == 1) {
            $('<img/>')         
                .attr('src','/Lapinouss/games/Geometry_Shapes/image/blue_circle.png')
                .data( 'form', 'circle' )
                .appendTo( 'div#listgeometric' )
                .draggable( {
                    containment: 'div#content',
                    stack: '#listgeometric div',
                    cursor: 'move',
                    revert: true
                } );
        }else if(randomform == 2){
            $('<img/>')         
                .attr('src','/Lapinouss/games/Geometry_Shapes/image/yellow_star.png')
                .data( 'form', 'star' )
                .appendTo( 'div#listgeometric' )
                .draggable( {
                    containment: 'div#content',
                    stack: '#listgeometric div',
                    cursor: 'move',
                    revert: true
                } );
        }
    }
    
    function getGameTimer() {
        return $('#gametimer').html("");
    }
    
    function setGameTimer(value) {
        $('#gametimer').html(value);
    }
    
    function getScore() {
        return score;
    }
    
    function setScore(value) {
        score = value;
    }
    
    return {
        startGameTimer : startGameTimer,
        pauseGameTimer : pauseGameTimer,
        initListGeometric : initListGeometric,
        getScore : getScore,
        setScore : setScore,
        countDown : countDown
    }
}