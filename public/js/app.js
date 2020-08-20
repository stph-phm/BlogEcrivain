//TINYMCE
tinymce.init({
        selector: 'textarea#default'
});

//Confirm delete 
$(".linkDelete").on("click", null, function(){
    return confirm("Êtes vous sur de vouloir supprimer ?");
});