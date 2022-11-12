$(document).ready(function () {
    $('.boto-categoria').click(function () {
        categoria_id = $(this).attr('categoria_id')
        $('.llistar-productes').load('routes/productes.php?id_categoria=' + categoria_id)
    });
});
