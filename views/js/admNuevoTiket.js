function init(){
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){

    // Summernote
    $('#tick_descrip').summernote({
        height: 150,
        lang: "es-ES",
       
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

   

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    if ($('#tick_descrip').summernote('isEmpty') || $('#tick_titulo').val()=='' ){
        Swal.fire({
            title: 'Advertencia!',
            text: 'Falta Descripción',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
    }else{
        var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
        $.ajax({
            url: "/Voluntariado/controller/ticket.php?opc=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            
            success: function(data){  
                //console.log(data);
                data = JSON.parse(data);
                console.log(data[0].tick_id);
                $('#tick_titulo').val('');
                $('#tick_descrip').summernote('reset');

                /* $.post("/Aspirantes/controller/email.php?opc=ticket_abierto", {tick_id : data[0].tick_id}, function (data) {

                }); */
                
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Registro Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }
        }); 
    }
}

init();