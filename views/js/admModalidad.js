var usu_id = $('#usu_idx').val();

function init(){
    $("#modalidad_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#modalidad_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/modalidad.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#modalidad_data').DataTable().ajax.reload();
            $('#modalcrearModalidad').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta la Modalidad',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#modalidad_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/modalidad.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Modalidad');
    $('#modalidad_form')[0].reset();
    $('#modalcrearModalidad').modal('show');
}

function editar(mod_id){
    $.post("/Voluntariado/controller/modalidad.php?opc=mostrar",{mod_id:mod_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#mod_id').val(data.mod_id);
        $('#mod_nombre').val(data.mod_nombre);
    });
    $('#titulo_modal').html('Editar Modalidad');
    $('#modalcrearModalidad').modal('show');
}

function eliminar(mod_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar la Modalidad?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/modalidad.php?opc=eliminar",{mod_id:mod_id},function (data){
                $('#modalidad_data').DataTable().ajax.reload();
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
function est_act(mod_id){
    $.post("/Voluntariado/controller/modalidad.php?opc=activo",{mod_id:mod_id},function (data){
        $('#modalidad_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(mod_id){
    $.post("/Voluntariado/controller/modalidad.php?opc=inactivo",{mod_id:mod_id},function (data){
        $('#modalidad_data').DataTable().ajax.reload();
    });
}

init();