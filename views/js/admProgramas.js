var usu_id = $('#usu_idx').val();

function init(){
    $("#programas_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#programas_form")[0]);
    console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/programa.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#programas_data').DataTable().ajax.reload();
            $('#modalcrearProgramaas').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro el Programa de forma correcta',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

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


    $('#programas_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/programa.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Programa');
    $('#programas_form')[0].reset();
    $('#modalcrearProgramas').modal('show');
}

function editar(prog_id){
    $.post("/Voluntariado/controller/programa.php?opc=mostrar",{prog_id:prog_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#prog_id').val(data.prog_id);
        $('#cen_id').val(data.cen_id).trigger('change');
       /*  $('#descripcion').val(data.descripcion); */
        $('#fac_id').val(data.fac_id).trigger('change');
        
        $('#codigo').val(data.codigo);
        $('#descripcion').val(data.descripcion);
        
    });
    $('#titulo_modal').html('Editar un Programa');
    $('#modalcrearProgramas').modal('show');
}

function eliminar(prog_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar la Subcompetencia?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/programa.php?opc=eliminar",{prog_id:prog_id},function (data){
                $('#programas_data').DataTable().ajax.reload();
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
function combo_facultades(){
    $.post("/Voluntariado/controller/facultades.php?opc=combo", function (data) {
        $('#fac_id').html(data);
    });
}


init();