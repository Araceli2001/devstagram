import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;


            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },
});

// para ver muchos mas datos de las imagenes
//dropzone.on("success", function (file, xhr, formData) {
    //console.log(file);
    //formData
//})

//para mandar un mensaje de exitoso al subir la foto
dropzone.on("success", function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});


//para cuando borren la immagen de la publicacion que de un string vacio
dropzone.on("removedfile", function () {
    document.querySelector('[name="imagen"]').value = "";
});
//mensaje cuando ocuurra un error al subir aarchivo
//dropzone.on("error", function (file, message) {
    //console.log(message);
//})

//cuando se elimine la imagen saldra este mensaje en inspeccionar jeje
// dropzone.on("removedfile", function () {
//     console.log("Archivo eliminado");
// })
