var usu_id = $('#usu_idx').val();

function init(){
    $("#area_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#area_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/area.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#area_data').DataTable().ajax.reload();
            $('#modalcrearArea').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#area_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/area.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Área');
    $('#area_form')[0].reset();
    $('#modalcrearArea').modal('show');
}

function editar(area_id){
    $.post("/Voluntariado/controller/area.php?opc=mostrar",{area_id:area_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#area_id').val(data.area_id);
        $('#area_nom').val(data.area_nom);
    });
    $('#titulo_modal').html('Editar Área');
    $('#modalcrearArea').modal('show');
}

function eliminar(area_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/area.php?opc=eliminar",{area_id:area_id},function (data){
                $('#area_data').DataTable().ajax.reload();
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
function est_act(area_id){
    $.post("/Voluntariado/controller/area.php?opc=activo",{area_id:area_id},function (data){
        $('#area_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(area_id){
    $.post("/Voluntariado/controller/area.php?opc=inactivo",{area_id:area_id},function (data){
        $('#area_data').DataTable().ajax.reload();
    });
}

init();