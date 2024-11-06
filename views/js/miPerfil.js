var usu_id = $('#usu_idx').val();

$('input#usu_dni').keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 10) {
      return false;
    }
});

$("#usu_dni").on("keyup", function() {
    var usu_dni = $("#usu_dni").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
    var longitudCedula = $("#usu_dni").val().length; //CUENTO LONGITUD
  
  //Valido la longitud 
    if(longitudCedula >= 8){
        var dataString = 'usu_dni=' + usu_dni;
  
        $.ajax({
            url: '/Voluntariado/views/js/verificarCedula.php',
            type: "GET",
            data: dataString,
            dataType: "JSON",
  
            success: function(datos){
  
                if( datos.success == 1){
  
                    $("#respuesta").html(datos.message);
  
                    /* $("input").attr('disabled',true);
                    $("select").attr('disabled',true); */
                    $("input#usu_dni").attr('disabled',false);
                    /* $("button").attr('disabled',true); */
  
                }else{
  
                    $("#respuesta").html(datos.message);
                    $("input#usu_dni").attr('disabled',false);
                   /*  $("input").attr('disabled',false);
                    $("select").attr('disabled',false);
                    $("button").attr('disabled',false); */
  
                }
            }
        });
    }
});

$(document).ready(function(){
    $.post("/Voluntariado/controller/centro.php?opc=combo",function(data, status){
        console.log(data);
        $('#cen_id').html(data);
    });

    $("#cen_id").change(function(){
        cen_id = $(this).val();
        $.post("/Voluntariado/controller/facultades.php?opc=combo",{cen_id : cen_id},function(data, status){
            console.log(data);
            $('#fac_id').html(data);
        }); 
    });
   /*   $.post("/Voluntariado/controller/facultades.php?opc=combo",function(data, status){
        console.log(data);
        $('#fac_id').html(data);
    });  */

    $("#fac_id").change(function(){
        fac_id = $(this).val();
        $.post("/Voluntariado/controller/programa.php?opc=combo",{fac_id : fac_id},function(data, status){
            console.log(data);
            $('#prog_id').html(data);
        }); 
    });

    $.post("/Voluntariado/controller/usuario.php?opc=mostrar", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_tipo').val(data.usu_tipo);
        $('#usu_dni').val(data.usu_dni);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_ape').val(data.usu_ape);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_rol').val(data.usu_rol);
        $('#cen_id').val(data.cen_id).trigger('change');
        $('#fac_id').val(data.fac_id).trigger('change');
        $('#prog_id').val(data.prog_id).trigger('change');
    });
});

$(document).on("click","#btnactualizar", function(){
    var pass = $("#txtpass").val();
    var newpass = $("#txtpassnew").val();
    if (pass.length == 0 || newpass.length == 0) {
        location.reload();
        Swal.fire({
            title: 'Error!',
            text: 'Las contraseñas no puede ir vacias',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
        
        
    } else{
        if (pass==newpass){
            var usu_id = $('#usu_idx').val();
            $.post("/Voluntariado/controller/usuario.php?opc=editPerfil", {usu_id:usu_id,usu_tipo : $('#usu_tipo').val(),usu_dni : $('#usu_dni').val(),usu_pass:newpass,cen_id : $('#cen_id').val(),fac_id : $('#fac_id').val(),prog_id : $('#prog_id').val() }, function (data) {
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