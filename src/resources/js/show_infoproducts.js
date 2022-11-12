$(document).ready(function () {
    $('.boto-producte').click(function () {
        producte_id = $(this).attr('id_producte')
        $('.info-productes').load('routes/infoproducte.php?producte_id=' + producte_id)
    });
});
