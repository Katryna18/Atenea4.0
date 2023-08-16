<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('head')
</head>

<body>

    @include('menu')

    <main role="main">
        <div style="margin-top: 1%;" class="container">
            <div class="">


                @include('person_form')


                <div class="form-group">
                    <button id="btnEnviar" onclick="save()" class="btn btn-primary" type="button">Guardar</button>
                    <button id="btnLimpiar" onclick="limpiar()" class="btn btn-secondary"
                        type="button">Limpiar</button>
                </div>

            </div>

            @include('person_medida_modal')

        </div>
    </main>



    <script>
        let auxID;
        function viewMedida(id) {
            console.log("Holaaa"+id);
            auxID=id;
            $("#modal_person_medida").modal();
            $("#tabla_medidas").hide();

        }

        function guardarMedida() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/insertMedida' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'persona_id': auxID,
                    'peso': $("#txtPeso").val(),
                    'altura': $("#txtAltura").val(),
                    'FC': $("#txtFC").val(),
                    'Periodo': $("#txtPR").val(),
                    'PS': $("#txtPS").val(),
                    'PD': $("#txtPD").val(),
                    //'PA': $("#txtPA").val(),
                    'DIAG': $("#txtDAG").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        $("#modal_person_medida").modal('hide');
                        $(":text").val("");
                    }

                    Swal.fire({
                        icon: data.status == 200 ? 'success' : 'error',
                        title: '',
                        text: data.message
                    });
                }
            });
        }

        function limpiar() {
            $(":text").val("");

        }

        function save() {

            var foto = document.getElementById('uploadFoto').files[0]; // Obtener el archivo de la foto seleccionada
            var consentimiento = document.getElementById('uploadFile').files[0]; //obtener el archivo del consentimiento

                    // Crear un objeto FormData y agregar los datos y la foto al formulario
            var formData = new FormData();
            formData.append('foto', foto);
            formData.append('consentimiento', consentimiento); // Agregar el consentimiento al formulario
            formData.append('tipodoco', $("#ddlTipoDocumento").val());
            formData.append('documento', $("#txtNumeroDocumento").val());
            formData.append('nombres', $("#txtNombre").val());
            formData.append('apellidos', $("#txtApelldio").val());
            formData.append('genero', $("#ddlGenero option:selected").val());
            formData.append('entidad', $("#ddlEntidad option:selected").val());
            formData.append('grado', $("#ddlGrado option:selected").val());
            formData.append('grupo', $("#ddlGrupo option:selected").val());
            formData.append('nacimiento', $("#txtFechaNacimiento").val());
            formData.append('jornada', $("#ddlJornada option:selected").val());

                    // Enviar la solicitud AJAX utilizando el objeto FormData
            $.ajax({
                url: '{{ env('APP_URL_API') . '/registerPerson' }}',
                type: 'POST',
                contentType: false, // Importante: establecer contentType en false para que jQuery no establezca automáticamente el encabezado Content-Type
                processData: false, // Importante: establecer processData en false para evitar que jQuery procese el objeto FormData
                data: formData, // Pasar el objeto FormData como datos de la solicitud
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        console.log(data.data);
                        viewMedida(data.data);
                        Swal.fire(
                            '',
                            data.message,
                            'success'
                        );
                        limpiar();
                    }
                    else{
                        Swal.fire(
                            '',
                            data.message,
                            'warning'
                        );
                    }
                }
            });


        }
    </script>



</body>

</html>
