//quand le document est prêt (à la fin du chargment de la page)
$(document).ready(function () {
    centrerObject("button");
    centrerObject("#selection");
    centrerObject("#newCharForm");
    $("body").css("visibility", "visible");
});

//quand on redimensionne la fenêtre
$(window).resize(function () {
    centrerObject("button");
    centrerObject("#selection");
    centrerObject("#newCharForm");
});

//quand on clique sur le bouton
$("button").click(function () {
    $(this).fadeOut(600, function () {
        $("#selection").fadeIn(600);
    });
});

function centrerObject($objet) {
    //on récupère les dimensions de la fenêtre
    var w = $(window).width();
    var h = $(window).height();
    //on récupère les dimensions du bouton
    var objectw = $($objet).width();
    var objecth = $($objet).height();
    //on calcule la position du bouton afin qu'il soit au centre
    var top = (h - objecth) / 2;
    var left = (w - objectw) / 2;
    //on affecte les nouvelles positions calculées
    $($objet).css({
        "left": left + "px",
        "top": top + "px"
    });
}