$( document ).ready(function() {
    var action = localStorage.getItem('action');

    if (action =="create") {
        var url ="views/formulario.html";
        action_event(url);
    }if(action =="funcionarios") {
        action(url);
        var url ="";
    }
});


function action_event(url) {
   
    $('#contenedor').load(url);
    
}