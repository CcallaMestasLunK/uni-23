$(".nuevaFoto").change(function(){
    var imagen = this.files[0];
    console.log("imagen",imagen["type"]);


//Validar el tamaño de la imagen en jpg o png 
if(imagen["type"] != "image/jpg" && imagen["type"] != "image/png"){

    $(".nuevaFoto").val("");

     Swal.fire({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

}else if(imagen["size"] > 2000000){

    $(".nuevaFoto").val("");

     Swal.fire({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

}else{

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){

                    var rutaImagen = event.target.result;

                    $(".previsualizar").attr("src", rutaImagen);

    })

}

})