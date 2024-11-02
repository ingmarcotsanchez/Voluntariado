var usu_id = $('#usu_idx').val();

function init(){
    $("#centro_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#centro_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/centro.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#centro_data').DataTable().ajax.reload();
            $('#modalcrearCentro').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta la Sede/Seccional/Extensión',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#centro_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/centro.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nueva Sede/Seccional/Extensión');
    $('#centro_form')[0].reset();
    $('#modalcrearCentro').modal('show');
}

function editar(cen_id){
    $.post("/Voluntariado/controller/centro.php?opc=mostrar",{cen_id:cen_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#cen_id').val(data.cen_id);
        $('#cen_nom').val(data.cen_nom);
    });
    $('#titulo_modal').html('Editar Sede/Seccional/Extensión');
    $('#modalcrearCentro').modal('show');
}

function eliminar(cen_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar la Sede/Seccional/Extensión?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/centro.php?opc=eliminar",{cen_id:cen_id},function (data){
                $('#centro_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}
function est_act(cen_id){
    $.post("/Voluntariado/controller/centro.php?opc=activo",{cen_id:cen_id},function (data){
        $('#centro_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(cen_id){
    $.post("/Voluntariado/controller/centro.php?opc=inactivo",{cen_id:cen_id},function (data){
        $('#centro_data').DataTable().ajax.reload();
    });
}

init();