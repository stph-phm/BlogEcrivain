tinymce.init({
        selector: 'textarea#default'
});


//si true OK 
// Si faux => event.preventDefault();

$(".linkDelete").on("click", null, function(){
    return confirm("Êtes vous sur de vouloir supprimer ?");
});