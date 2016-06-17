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
    
    function retry_clicked(){
        $('#endmessage').hide();
        model.startGameTimer();
        $('#score').html(model.getScore());
        $('#listgeometric').empty();
        model.initListGeometric();
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
        $('#endmessage').hide();
        $('#buttonretry').click(function(){retry_clicked();});
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