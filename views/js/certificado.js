var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

/* Inicializamos la imagen */
var image = new Image();
image.src = 'Voluntariado/public/certificado.png';
var imageqr = new Image();

$(document).ready(function(){
    var lugd_id = getUrlParameter('lugd_id');

    $.post("../../controller/usuario.php?opc=mostrar_curso_detalle", { lugd_id : lugd_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);

       
        image.src = data.lug_img;
        
        image.onload = function() {
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
            
            ctx.font = '40px Arial';
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var x = canvas.width / 2;
            ctx.fillText(data.usu_nom+' '+ data.usu_ape, x, 250);

            ctx.font = '30px Arial';
            ctx.fillText(data.lug_nom, x, 320);

            ctx.font = '18px Arial';
            ctx.fillText(data.ext_nom+' '+ data.ext_ape, x, 420);
            ctx.font = '15px Arial';
            ctx.fillText('Sector Externo', x, 450);

            ctx.font = '15px Arial';
            ctx.fillText('Fecha de Inicio : '+data.lug_fechini+' / '+'Fecha de Finalización : '+data.lug_fechfin+'', x, 490);

           
            imageqr.src = "../../public/qr/"+lugd_id+".png";
            
            imageqr.onload = function() {
                ctx.drawImage(imageqr, 400, 500, 100, 100);
            }
            $('#lug_descrip').html(data.lug_descrip);

        };

    });

});

$(document).on("click","#btnpng", function(){
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click","#btnpdf", function(){
    var imgData = canvas.toDataURL('image/png');
    var doc = new jsPDF('l', 'mm');
    doc.addImage(imgData, 'PNG', 30, 15);
    doc.save('Certificado.pdf');
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
