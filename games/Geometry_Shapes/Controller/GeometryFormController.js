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

        // Si la partie est gagnée
        if(responseForm == mainForm){
            model.setScore(model.getScore() + 20);
            $('span#score').html(model.getScore());
            $(ui.draggable).hide();
            $('.good').show();
            $('.wrong').hide();
            model.initListGeometric();

            var trophy = 'Assidus';
            if (Number($('#gametimer').text()) < 5) {
                trophy = 'Flash';
            }
            else if (Number($('#gametimer').text()) < 10) {
                trophy = 'Cheval';
            }
            else if (Number($('#gametimer').text()) < 15) {
                trophy = 'Escargot';
            }

            if (Number(model.getScore) > 300) {
                trophy = 'Génie';
            }

            // Mise à jour des statistiques (1 partie jouée, trophée gagné)
            $.post(window.location, { played: true, trophy: trophy });
        }
            // Si la partie est perdue
        else {
            if(model.getScore() >= 10)
                model.setScore(model.getScore() - 10);
            $('.wrong').show();
            $('.good').hide();
            $('span#score').html(model.getScore());

            // Mise à jour des statistiques (1 partie jouée)
            $.post(window.location, { played: true });
        }
    }

    function init () {
        $('#endmessage').hide();
        $('.good').hide();
        $('.wrong').hide();
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