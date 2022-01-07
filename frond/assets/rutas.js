function formulario(){
    var url = "frond/view/formulario.html";
    $.ajax({
        url: url,
        method: "get",
        success: function(respuesta) {
            //window.location.href = "";
            console.log(respuesta);

            // $("#AjaxResponse").html(respuesta);
            // //selec_client();
            // $("#titulo").html("Listado de citas");
            // $("#inidicador").html("Citas");

        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
}