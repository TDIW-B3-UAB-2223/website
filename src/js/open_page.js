if(performance.navigation.type == 2){
    location.reload(true);
 }

async function open_page(address) {
    let response = await fetch(address);
    let contentText = await response.text();
    window.history.pushState({"html": contentText}, "", address.replace('noTemplate=true&', ''));
    $('#content').html(contentText); 
}

function open_product(id) {
    open_page('index.php?noTemplate=true&accio=mostrar-producte&producte=' + id);
}

function open_category(slug) {
    open_page('index.php?noTemplate=true&accio=mostrar-categoria&categoria=' + slug);
}