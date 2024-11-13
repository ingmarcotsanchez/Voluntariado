function init(){
 
}

$(document).ready(function(){

    var tick_id = getUrlParameter('ID');

    listardetalle(tick_id);

    $('#dtick_descrip').summernote({
        height: 300,
        lang: "es-ES",
         callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        }, 
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#tick_descrip_usu').summernote({
        height: 200,
        lang: "es-ES"
    });
    $('#tick_descrip_usu').summernote('disable');

    tabla=$('#documentos_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                'excelHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '/Aspirantes/controller/documento.php?opc=listar',
            type : "post",
            data : {tick_id:tick_id},
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});

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

$(document).on("click","#btnEnviarTicket", function(){
    var tick_id = getUrlParameter('ID');
    var usu_id = $('#usu_idx').val();
    var dtick_descrip = $('#dtick_descrip').val();

    if ($('#dtick_descrip').summernote('isEmpty')){
        Swal.fire({
            title: 'Advertencia!',
            text: 'Falta Descripción',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
    }else{
        $.post("/Aspirantes/controller/ticket.php?opc=insertdetalle", { tick_id:tick_id,usu_id:usu_id,dtick_descrip:dtick_descrip}, function (data) {
            listardetalle(tick_id);
            $('#dtick_descrip').summernote('reset');
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }); 
    }
});

$(document).on("click","#btnCerrarTicket", function(){
    Swal.fire({
        title: "Cerrar el Ticket?",
        text: "Esta seguro de cerrar el Ticket!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cerrar!"
    }).then((result) => {
        if (result.isConfirmed) {
            var tick_id = getUrlParameter('ID');
            var usu_id = $('#usu_idx').val();
            $.post("/Aspirantes/controller/ticket.php?opc=update", { tick_id : tick_id,usu_id : usu_id }, function (data) {

            }); 

             $.post("/Aspirantes/controller/email.php?opc=ticket_cerrado", {tick_id : tick_id}, function (data) {

            });


            listardetalle(tick_id);

            Swal.fire({
                title: "Cerrado!",
                text: "El ticket se cerro correctamente",
                icon: "success"
            });
        }
    });
    
});

function listardetalle(tick_id){
    $.post("/Aspirantes/controller/ticket.php?opc=listardetalle", { tick_id : tick_id }, function (data) {
        $('#Detalle_ticket').html(data);
    });
     

    $.post("/Aspirantes/controller/ticket.php?opc=mostrar", { tick_id : tick_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#id_ticket').html(data.tick_id);
        $('#Estado').html(data.tick_estado);
        $('#Fecha_creacion').html(data.fech_crea);
        $('#tick_titulo').val(data.tick_titulo);
        $('#tick_descrip_usu').summernote ('code',data.tick_descrip);

        if (data.tick_estado_texto == "Cerrado"){
            $('#panel_detalle').hide();
        }
    }); 
}

init();