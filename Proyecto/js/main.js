$(document).ready(function() {

    //Login
    $( "#tipo" ).selectmenu();

    $("#enviar").click(function() {
        var user1 = $("#user").val();
        var pass = $("#pass").val();
        var emple = $("#emple").val();
        var tipo = $("#tipo").val();

        var data = {
          "user": user1,
          "password": pass,
          "empleado": emple,
          "tipo": tipo
        }

        $.ajax({
            type: "POST",
            url: "usuario.php",
            data: data,
            success: function() {
                Limpiar();
                alert("Usuario agregado con exito");
            }
        });
      //  return false;
    });

    function Limpiar()
    {
        $("#user").val("");
        $("#pass").val("");
        $("#emple").val("");
    }

    // Menus de index
    var menuVenta = $("#menuVenta");
    menuVenta.hide();

    var venta = $("#venta");
    var inventario = $("#inventario");
    var factura = $("#factura");
    var menuAdmin = $("#menuAdmin");

    venta.click(function() {
      $("#menu").hide("fold");
      menuVenta.show();

    });

    // Validacion
    if(window.location.href.indexOf('menu') > -1) {
        $.validate({
            lang: 'es',
            errorMessagePosition: 'top',
            scrollToTopOnError: true,
            modules : 'security'
        });
    }
    if(window.location.href.indexOf('edit_user') > -1) {
        $.validate({
            lang: 'es',
            errorMessagePosition: 'top',
            scrollToTopOnError: true,
            modules : 'security'
        });
    }
    if(window.location.href.indexOf('edit_product') > -1) {
        $.validate({
            lang: 'es',
            errorMessagePosition: 'top',
            scrollToTopOnError: true,
            modules : 'security, file'
        });
    }


});
