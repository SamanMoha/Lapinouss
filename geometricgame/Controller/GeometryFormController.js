var GeometryFormController = function (pModel) {
    var model = pModel || new GeometryFormModel();
    
    function play_clicked(){
        console.log($('listgeometric'));
        model.startGameTimer();
    }
    
    function pause_clicked(){
        $('pausebutton').val(model.pauseGameTimer());
    }
    
    function init () {
        $('#playbutton').click(function(){play_clicked();});
        $('#pausebutton').click(function(){pause_clicked();});
        //$('#score').val(model.getScore());
    }
    
    return {
        init : init,
        model : model
    }
}