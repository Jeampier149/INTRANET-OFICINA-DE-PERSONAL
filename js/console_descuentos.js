function verficar_descuento() {

    let concepto = $("#concepto").val();
    let filedesc = $("#fileplh")[0].files[0];
    let fileplh = $("#fileplh")[0].files[0];

    if (concepto.length < 4 ) {
        return Swal.fire({
            icon: "error",
            title: "Error...",
            text: "El concepto debe contener como maximo 4 digitos",
            timer: 2700,
        });
    }

    if (!fileplh) {
        return Swal.fire({
            icon: "error",
            title: "Error...",
            text: "El archivo DATOSPLH es requerido!",
            timer: 2700,
        });
    }
    if (!filedesc) {
        return Swal.fire({
            icon: "error",
            title: "Error...",
            text: "El archivo del descuento es requerido!",
            timer: 2700,
        });
    }

    const formData = new FormData();
    formData.append("concepto", concepto);
    formData.append("filedesc", filedesc);
    formData.append("fileplh", fileplh);

    Swal.fire({
        title: "<strong>Verificando...</strong>",
        showConfirmButton: false
    });

    $.ajax({
        url: "descuento/insertar.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Error...",
                text: "Ocurrió un error en el servidor.",
                timer: 2700,
            });
        },
    }).done((response) => {
        console.log(response)
        const resp = JSON.parse(response);

        if (typeof resp.mes === "string") {
            cleanForm();
            const {
                mes,
                anio
            } = resp;
            $.ajax({
                url: "resumen/crear.php",
                type: "POST",
                data: {
                    mes,
                    anio
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error...",
                        text: "Ocurrió un error en el servidor.",
                        timer: 2700,
                    });
                },
            }).done((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Creado!",
                    text: "El resumen fue creado correctamente!",
                    timer: 2700,
                });
                let ruta = 'resumen/db/' + response
                location.href = ruta;
            });
        } else {
            const {
                errors
            } = resp;
            let msg = "";
            for (const error in errors) {
                msg += errors[error] + " ";
            }
            Swal.fire({
                icon: "error",
                title: "Llenar correctamente!",
                text: msg,
                timer: 2700,
            });
        }
    });
}