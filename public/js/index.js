function init(){
    $("#usuario_form").on("submit",function(e){
        guardar(e);	
    });
}

$(document).ready(function() {

});

function guardar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?opc=crear",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            //$("#modalsuscribete").modal('hide');

            if (data==1){

                /* $.post("../../controller/usuario.php?opc=emailBienvenida",{usu_correo : $("#usu_correo").val()},function(data){
                    console.log(data);
                }); */

                Swal.fire({
                    icon: 'success',
                    title: 'Universidad de Cundinamarca',
                    text : 'Gracias por suscribirte!',
                    showConfirmButton: false,
                    timer: 2000
                })

                $("#usu_correo").val('');
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Universidad de Cundinamarca',
                    text : 'Correo ya suscrito!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    });
}

init();