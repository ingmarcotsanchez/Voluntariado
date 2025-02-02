function init(){
   
}

$(document).ready(function(){
    var tick_id = getUrlParameter('ID');
    listardetalle(tick_id);
    console.log(tick_id);

    /* TODO: inicializamos input de estrellas */
    $('#tick_estre').on('rating.change', function() {
        console.log($('#tick_estre').val());
    });

});

function listardetalle(tick_id){
    /* TODO: Mostra detalle de ticket */
    $.post("/ISUM/controller/ticket.php?opc=mostrar", { tick_id : tick_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#lblestado').val(data.tick_estado_texto);
        $('#lblnomusuario').val(data.usu_nom +' '+data.usu_apep+' '+data.usu_apem);
        $('#lblfechcrea').val(data.fech_crea);
        $('#lblnomidticket').val(data.tick_id);
        $('#cat_nom').val(data.cat_nom);
        $('#cats_nom').val(data.cats_nom);
        $('#lblfechcierre').val(data.fech_cierre);
        $('#tick_titulo').val(data.tick_titulo);
        $('#prio_nom').val(data.prio_nom);
        

        if (data.tick_estado_texto=='Abierto') {
            window.open('http://localhost/Voluntariado/','_self');
        }else{
            if (data.tick_estre==null){

            }else{
                $('#panel1').hide();
            }
        }
    });
}

/* TODO: Obtener ID de la Url */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

/* TODO:Guardar Informacion de estrella del ticket */
$(document).on("click","#btnguardar", function(){
    var tick_id = getUrlParameter('ID');
    var tick_estre = $('#tick_estre').val(); 
    var tick_coment = $('#tick_coment').val();

    $.post("/Voluntariado/controller/ticket.php?opc=encuesta", { tick_id : tick_id, tick_estre : tick_estre, tick_coment : tick_coment}, function (data) {
        console.log(data);
        $('#panel1').hide();
        Swal.fire({
            title: "Correcto!",
            text: "Gracias por su tiempo",
            icon: "success"
        });
    }); 
});