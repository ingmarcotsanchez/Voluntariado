var usu_id = $('#usu_idx').val();

function init(){
    $("#facultades_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#facultades_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/facultades.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#facultades_data').DataTable().ajax.reload();
            $('#modalcrearFacultades').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro la Facultad de forma correcta',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#cen_id').select2({
        dropdownParent: $('#modalcrearFacultades')
    });

    combo_centros();

    $('#facultades_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/facultades.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Facultad');
    $('#facultades_form')[0].reset();
    $('#modalcrearFacultades').modal('show');
}

function editar(fac_id){
    $.post("/Voluntariado/controller/facultades.php?opc=mostrar",{fac_id:fac_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#fac_id').val(data.fac_id);
        $('#codigo').val(data.codigo);
        $('#fac_nom').val(data.fac_nom);
        $('#cen_id').val(data.cen_id).trigger('change');
        
    });
    $('#titulo_modal').html('Editar una Facultad');
    $('#modalcrearFacultades').modal('show');
}

function eliminar(fac_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar la Facultad?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/facultades.php?opc=eliminar",{fac_id:fac_id},function (data){
                $('#facultades_data').DataTable().ajax.reload();
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

function combo_centros(){
    $.post("/Voluntariado/controller/centro.php?opc=combo", function (data) {
        $('#cen_id').html(data);
    });
}


init();