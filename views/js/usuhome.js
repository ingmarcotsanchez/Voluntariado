var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/Voluntariado/controller/usuario.php?opc=total", { usu_id : usu_id }, function (data){
        console.log(data);
        $('#lbltotal').html(data.total);
    });
});