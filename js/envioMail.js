// function enviar_correo() {
//     var correo = new FormData();

//     correo.append("name", document.getElementById("first-name").value);
//     correo.append("lastname", document.getElementById("last-name").value);
//     correo.append("email", document.getElementById("email").value);
//     correo.append("phone", document.getElementById("phone").value);
//     correo.append("mensaje", document.getElementById("message").value);

//     $.ajax({
//         url: "enviarFormulario.php",
//         type: "POST",
//         data: correo,
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(resp) {
//             console.log(resp);
//             msj = JSON.parse(resp);
//             alert(msj.mensaje);
//         }
//     });

// }