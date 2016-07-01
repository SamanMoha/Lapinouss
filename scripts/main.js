jQuery(function($){
    $.datepicker.regional['fr'] = {
        closeText: 'Fermer',
        prevText: 'Pr&eacute;cedant',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
            'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
        monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
            'Jul','Aou','Sep','Oct','Nov','Dec'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        showButtonPanel: true
    };

    $.datepicker.setDefaults($.datepicker.regional['fr']);
});

addEventListener(
    "load",
    function() {
        setTimeout(hideURLbar, 0);
    },
    false
);

function hideURLbar() {
    window.scrollTo(0, 1);
}

new WOW().init();

$("span.menu").click(function(){
    $(".top-nav ul").slideToggle(
        500,
        function() { }
    );
});

$(function() {
    $('.about-grid a')
        .Chocolat(
            {
                linkImages:false
            }
        );
});

$(document).ready(function(){
    $(".top-nav li a").click(function(){
        $(this)
            .parent()
            .addClass("active")
            .siblings()
            .removeClass("active");
    });

    $(window).scroll(function(){
        $(".header-home")
            [$(window).scrollTop() >= $(".header-home").offset().top
            ? "addClass"
            : "removeClass"]
        ("fixed")
    });

});