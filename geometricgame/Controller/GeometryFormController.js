var GeometryFormController = function (pModel) {
    var model = pModel || new GeometryFormModel();
    
    function play_clicked(){
        $('div#gamehome').hide();
        model.startGameTimer();
        
        $('.droppable').droppable({
            accept:".ui-draggable",
            activeClass:"zone-drop-active",
            hoverClass:"zone-drop-survolee",
            drop: handleFigureDrop
        });        
    }
    
    function pause_clicked(){
        $('div#gamehome').show();
        $('input#pausebutton').html(model.pauseGameTimer());
    }
    
    function handleFigureDrop( event, ui){
        var responseForm = ui.draggable.data('form');
        var mainForm = $(this).data('form');
        
        if(responseForm == mainForm){
            model.setScore(model.getScore() + 20);
            $('span#score').html(model.getScore());
            $(ui.draggable).remove();
            model.initListGeometric();
        }else{
            if(model.getScore() >= 10)
            model.setScore(model.getScore() - 10);
            $('span#score').html(model.getScore());
        }
    }
    
    function init () {
        $('#playbutton').click(function(){play_clicked();});
        $('#pausebutton').click(function(){pause_clicked();});
        model.startGameTimer();
        $('.droppable').droppable({
            accept:".ui-draggable",
            activeClass:"zone-drop-active",
            hoverClass:"zone-drop-survolee",
            drop: handleFigureDrop
        });
        model.initListGeometric();
    }
    
    return {
        init : init,
        model : model
    }
}