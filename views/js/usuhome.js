var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/Voluntariado/controller/usuario.php?opc=total_Campos", { usu_id : usu_id }, function (data){
        console.log(data);
        $('#lbltotalCampos').html(data.total);
    });
    $.post("/Voluntariado/controller/usuario.php?opc=total_Voluntarios", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalVoluntarios').html(data.total);
    });
    $.post("/Voluntariado/controller/usuario.php?opc=total_Estudiantes", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEstudiantes').html(data.total);
    });
    $.post("/Voluntariado/controller/usuario.php?opc=total_Gestores", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalGestores').html(data.total);
    });
    $.post("/Voluntariado/controller/usuario.php?opc=total_Externos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalExternos').html(data.total);
    });
});