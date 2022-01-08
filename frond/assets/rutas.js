
$(document).on('click', '#create_form', function(e) {
    var action=$(this).data("id");
    localStorage.setItem('action', action);

    window.location.href = "frond/panel.php";
});