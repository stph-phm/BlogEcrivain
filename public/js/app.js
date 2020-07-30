tinymce.init({
    selector: 'textarea#default'
});

// Create methods
function confirmDelete(event) {
    var message = 'Êtes vous sur de vouloir supprimer ? ';
    //Condition ternaire => si le message est true sinon false
    action = confirm(message) ? true : event.preventDefault();
}

// On cherche la classe LinkDelete dans HTML et on le met dans une Variable
var linkDelete = document.getElementsByClassName('linkDelete');

// utilisation d'un boucle sous forme de tableau
for( var i = 0, len = linkDelete.length; i < len; i++) {

    linkDelete[i].addEventListener('click', confirmDelete);
}

