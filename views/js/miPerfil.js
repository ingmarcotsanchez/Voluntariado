var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/Voluntariado/controller/usuario.php?opc=mostrar", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_ape').val(data.usu_ape);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_rol').val(data.usu_rol);
    });
});

$(document).on("click","#btnactualizar", function(){
    var pass = $("#txtpass").val();
    var newpass = $("#txtpassnew").val();
    if (pass.length == 0 || newpass.length == 0) {
        //location.reload();
        Swal.fire({
            title: 'Error!',
            text: 'Las contraseñas no puede ir vacia',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
        
        
    } else{
        if (pass==newpass){
            var usu_id = $('#usu_idx').val();
            $.post("/Voluntariado/controller/usuario.php?opc=editPerfil", {usu_id:usu_id,usu_pass:newpass}, function (data) {
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se actualizo Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
                
            });
        }else{
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Las contraseñas no coinciden",
                showConfirmButton: false,
                timer: 2500
            })
            location.reset();
        }
    }
  


});