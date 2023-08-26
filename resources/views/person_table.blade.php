<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('head')
</head>

<body>

    @include('menu')

    <main role="main">
        <div style="margin-top: 1%;" class="container">
            <div class="card">
                <div class="card-header">
                    Consultar Información
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-10">
                            <label for="ddlIeTable">Número de documento </label>
                            <input id="txtNumDocumento" placeholder="Introduza numero de documento"  class="form-control form-control-sm"  >
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <label for="ddlIeTable">Institución</label>
                            <select id="ddlIeTable" class="form-control form-control-sm" required="">
                                <option value='default'>SELECCIONAR</option>
                                @foreach ($entidad as $item)
                                    <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="ddlGradoTable">Grado</label>
                            <select id="ddlGradoTable" class="form-control form-control-sm" required="">
                                <option value='default'>SELECCIONAR</option>
                                @for ($i = 0; $i < 12; $i++)
                                    <option value='{{ $i }}'> {{ $i }} </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="ddlGrupoTable">Grupo</label>
                            <select id="ddlGrupoTable" class="form-control form-control-sm" required="">
                                <option value='default'> SELECCIONAR </option>
                                @foreach ($grupo as $item)
                                <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">

                            <button onclick="cleanerData()" style="top: 50%; position: relative;" id="btnLimpiar"
                            type="button" class="btn btn-warning btn-sm">Limpiar</button>

                        </div>

                        <div class="col-md-5">
                            <label for="ddlEdad">Edad</label>
                            <select id="ddlEdad" class="form-control form-control-sm" required="">
                                <option value='default'> SELECCIONAR </option>
                                @foreach ($edad as $item)
                                    <option value='{{ $item->edad }}'> {{ $item->edad }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="ddlJornada">Jornada</label>
                            <select id="ddlJornada" class="form-control form-control-sm" required="">
                                <option value='default'>SELECCIONAR</option>
                                <option value='MAÑANA'>MAÑANA</option>
                                <option value='TARDE'>TARDE</option>
                                <option value='ÚNICA'>ÚNICA</option>
                               <!-- @for ($i = 0; $i < 12; $i++)
                                    <option value='{{ $i }}'> {{ $i }} </option>
                                @endfor-->
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="ddlSexo">Genero</label>
                            <select id="ddlSexo" class="form-control form-control-sm" required="">
                                <option value='default'> SELECCIONAR </option>
                                <option value='MASCULINO'> MASCULINO </option>
                                <option value='FEMENINO'> FEMENINO </option>
                               <!-- @for ($i = 0; $i < 12; $i++)
                                    <option value='{{ $i }}'> {{ $i }} </option>
                                @endfor-->
                            </select>
                        </div>

                        <div class="col-md-1">

                            <button onclick="selectForData()" style="top: 50%; position: relative;" id="btnGuardar"
                                type="button" class="btn btn-primary btn-sm">Consultar</button>

                        </div>
                        <div class="col-md-1">

                            <button onclick="getDataGraficaNew()" style="top: 50%; position: relative;" id="btnGuardar"
                                type="button" class="btn btn-success btn-sm">Graficar</button>

                        </div>



                    </div>

                    

                    <hr>
                    <div class="row">
                        <table class="table table-striped table table-hover">
                            <thead>
                                <tr>
                                    <th>Tipo Doc.</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Genero</th>
                                    <th colspan="4"></th>
                                </tr>
                            </thead>
                            <tbody id="tableBodyPersona">

                            </tbody>
                        </table>
                    </div>
                    <hr>
                   <!-- <div class="row">
                        <div class="col-md-6">
                            <canvas id="charIMC">
                            </canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="charFCMASCULINO">
                            </canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="charFCFEMENINO">
                            </canvas>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </main>

    @include('person_update')
    @include('person_medida_modal')
    <!-- Botón que activa el modal -->

    <!-- Modal que muestra la gráfica en el boton de gráfica -->
    <div class="modal fade" id="modal_persons_graficas" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Gráficas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="charIMC">
                                </canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="charFCMASCULINO">
                                </canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="charFCFEMENINO">
                                </canvas>
                            </div>
                        </div>

                        <!-- Se agregan nuevas graficas-->
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="charPAMasculino">
                                </canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="charTyP">
                                </canvas>
                            </div>
                        </div>
                    </div>



                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>-->
                </div>
            </div>
        </div>
    </div>

    <script>
        var usuarios;
        var personaSelect = null;
        var dataGrupo = [];
        let auxMedidaID=null;
        getDataGrupo();

        function getDataGrupo() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/grupo' }}',
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success: function(data) {
                    dataGrupo = data.data;
                }
            });
        }

        /**
         * Boton para limpiar datos
         */
        function cleanerData(){

            // Obtener referencias a elementos HTML
            const select = document.getElementById("ddlIeTable");
            select.selectedIndex = 0
            const selectGrado = document.getElementById("ddlGradoTable");
            selectGrado.selectedIndex = 0
            const selectGrupo = document.getElementById("ddlGrupoTable");
            selectGrupo.selectedIndex = 0
            const selectJornada = document.getElementById("ddlJornada");
            selectJornada.selectedIndex = 0
            const selectSexo = document.getElementById("ddlSexo");
            selectSexo.selectedIndex = 0
            const selectEdad = document.getElementById("ddlEdad");
            selectEdad.selectedIndex = 0
        }

        /**
         * Se comenta el evento para poder consultar por separado
         */

        /*$('#ddlGradoTable').on('change', function() {

            var result = dataGrupo.filter((b) => {
                return (b.grado_id == this.value)
            });

            $("#ddlGrupoTable").empty();

            result?.forEach(element => {

                $('#ddlGrupoTable').append($('<option>', {
                    value: element.id,
                    text: element.nombre
                }));
            });
        });*/

        /**
         * Funcion original para consultar por entidad,grado y grupo
         */

        function getData() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/person' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'entidad': $("#ddlIeTable").val(),
                    'grado': $("#ddlGradoTable").val(),
                    'grupo': $("#ddlGrupoTable").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        /**
         * Funcion validacion de campos para consulta
         */
        function validateInputForSelect(){

            
            if (identidad == "default" && grado == "default" && grupo == "default" && jornada == "default" && sexo == "default" && edad == "default") {
                Swal.fire(
                            '',
                            'Seleccione los campos a consultar',
                            'error'
                        );
            }else if(identidad != "default" && grado == "default" && grupo == "default" && jornada == "default" && sexo == "default" && edad == "default"){
                getDataInstitution()
            }else if(identidad == "default" && grado != "default" && grupo == "default" && jornada == "default" && sexo == "default" && edad == "default"){
                getDataGrado()
            }else if(identidad == "default" && grado == "default" && grupo != "default" && jornada == "default" && sexo == "default" && edad == "default"){
                getDataGrupoC()
            }else if(identidad == "default" && grado == "default" && grupo == "default" && jornada != "default" && sexo == "default" && edad == "default"){
                getDataJornada()
            }else if(identidad == "default" && grado == "default" && grupo == "default" && jornada == "default" && sexo != "default" && edad == "default"){
                getDataGenero()
            }else if(identidad == "default" && grado == "default" && grupo == "default" && jornada == "default" && sexo == "default" && edad != "default"){
                getDataEdad()
            }else if(identidad != "default" && grado != "default" && grupo != "default" && jornada == "default" && sexo == "default" && edad == "default"){
                getData()
            }else{
                Swal.fire(
                            '',
                            'Seleccione los campos a consultar',
                            'error'
                        );
            }
        }

        /**
         * Consulta multiple
         */
        function selectForData(){

            console.log("Entrando")
            let dataJson = {
             "identidad":$("#ddlIeTable").val(),
             "grado":$("#ddlGradoTable").val(),
             "grupo": $("#ddlGrupoTable").val(),
             "jornada": $("#ddlJornada").val(),
             "genero":$("#ddlSexo").val(),
             "edad": $("#ddlEdad").val(),
             "documento": $("#txtNumDocumento").val()
            }

            console.log(dataJson)

            if (dataJson.identidad == "default" && dataJson.grado == "default" && dataJson.grupo == "default" && dataJson.jornada == "default" && dataJson.genero == "default" && dataJson.edad == "default" && dataJson.documento == "") {
                Swal.fire(
                            '',
                            'Seleccione los campos a consultar',
                            'error'
                        );
            }else{ 

                console.log(dataJson)

                $.ajax({
                url: '{{ env('APP_URL_API') . '/personSelect' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(dataJson),
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    tabla(data);
                }
                });
            }
        }

        /**
         * Función para obtner los datos por institucion
         */

        function getDataInstitution() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personInstitution' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'entidad': $("#ddlIeTable").val()
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        /**
         *  Función para obtner los datos por grado
         */

        function getDataGrado() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personGrado' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'grado': $("#ddlGradoTable").val()
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        /**
         *  Función para obtner los datos por grupo
         */

         function getDataGrupoC() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personGrupo' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'grupo': $("#ddlGrupoTable").val()
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        /**
         *  Función para obtener los datos por genero
         */
        function getDataGenero(){
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personGenero' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'genero': $("#ddlSexo").val()
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        /**
         *  Función para obtener los datos por jornada
         */
        function getDataJornada(){
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personJornada' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'jornada': $("#ddlJornada").val()
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    tabla(data);
                }
            });
        }

        /**
         *  Función para obtener los datos de la edad y devolver al select
         */

         function getDataEdad(){
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personEdad' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'edad': $("#ddlEdad").val()
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    tabla(data);
                }
            });
         }

        function getDataNumeroDoco() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/person_doco' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'doco': $("#txtNumDocumento").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    tabla(data);
                }
            });
        }

        function getDataGrafica() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/person_grafica' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'grupo': $("#ddlGrupoTable").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    $("#modal_persons_graficas").modal();
                    console.log(data.IMC)
                    IMC(data.IMC);
                    FCMasculino(data.FCMasculino);
                    FCFemenino(data.FCFemenino);
                    PA(data.PA)
                }
            });
        }

        function getDataGraficaNew(){

            let dataJson = {
             "identidad":$("#ddlIeTable").val(),
             "grado":$("#ddlGradoTable").val(),
             "grupo": $("#ddlGrupoTable").val(),
             "jornada": $("#ddlJornada").val(),
             "genero":$("#ddlSexo").val(),
             "edad": $("#ddlEdad").val(),
             "documento" : $("#txtNumDocumento").val()
            }

            $.ajax({
                url: '{{ env('APP_URL_API') . '/person_grafica_new' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(dataJson),
                dataType: 'json',
                success: function(data) {
                    $("#modal_persons_graficas").modal();
                    console.log(data)
                    IMC(data.IMC);
                    FCMasculino(data.FCMasculino);
                    FCFemenino(data.FCFemenino);
                    PAMasculino(data.PAGeneral);
                    TyP(data.TyP);
                }
            });
        }
        
//Tabla consulta general
        function tabla(data) {

            $("#tableBodyPersona").html("");

            usuarios = data.data;

            data.data.forEach(element => {

                let tr = "<tr>";
                tr += "<td>" + element.tipodoco + "</td>";
                tr += "<td>" + element.documento + "</td>";
                tr += "<td>" + element.nombres + "</td>";
                tr += "<td>" + element.apellidos + "</td>";
                tr += "<td>" + element.genero + "</td>";

                tr += "<td title='Editar'><svg width='20px' onclick='viewData(" + element.id +
                    ")' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' fill='#000000'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'><path d='M14.846 1.403l3.752 3.753.625-.626A2.653 2.653 0 0015.471.778l-.625.625zm2.029 5.472l-3.752-3.753L1.218 15.028 0 19.998l4.97-1.217L16.875 6.875z' fill='#80b3ff'></path></g></svg></td>";

                tr +=
                    "<td title='Agregar medida'><svg width='20px' onclick='viewMedida(" + element.id +
                    ")' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <g id='Edit / Add_Plus_Circle'> <path id='Vector' d='M8 12H12M12 12H16M12 12V16M12 12V8M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z' stroke='#000000' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'></path> </g> </g></svg></td>"

                tr +=
                    "<td title='Gráfica'> <a target='_blank' href='{{ url('/dashboard/') }}/" + element.documento +
                    "'> <svg width='20px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M21 21H4.6C4.03995 21 3.75992 21 3.54601 20.891C3.35785 20.7951 3.20487 20.6422 3.10899 20.454C3 20.2401 3 19.9601 3 19.4V3M20 8L16.0811 12.1827C15.9326 12.3412 15.8584 12.4204 15.7688 12.4614C15.6897 12.4976 15.6026 12.5125 15.516 12.5047C15.4179 12.4958 15.3215 12.4458 15.1287 12.3457L11.8713 10.6543C11.6785 10.5542 11.5821 10.5042 11.484 10.4953C11.3974 10.4875 11.3103 10.5024 11.2312 10.5386C11.1416 10.5796 11.0674 10.6588 10.9189 10.8173L7 15' stroke='#000000' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'></path> </g></svg> </a> </td>"

                tr += "<td title='Descargar Consentimiento'><svg width='24px' height='24px' onclick='downloadConsent(" + element.id + ")' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path fill='none' d='M0 0h24v24H0z'/><path d='M17.293 7.293l-4.996 4.996a.5.5 0 0 1-.708 0l-4.996-4.996a.5.5 0 1 1 .708-.708L12 11.293V3.5a.5.5 0 0 1 1 0v7.793l3.293-3.293a.5.5 0 0 1 .708.708z'/><path d='M5 21a.5.5 0 0 1-.5-.5V10.707a.5.5 0 0 1 .854-.354L12 14.793l5.646-5.646a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1-.146-.354V20.5a.5.5 0 0 1-.5.5z'/></svg></td>";


                tr += "<td title='Eliminar'><svg width='20px' onclick='personDelete(" + element.id +
                    ")' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='#D00F26''><path d='M20 11H4c-.55 0-1 .45-1 1s.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1Z'/></svg></td>";




                tr += "</tr>"
                $("#tableBodyPersona").append(tr);

            });
        }


        function getHistoricoSiExiste() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/getHistorico' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'id': personaSelect,
                    'entidad': $("#ddlIeTable").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    tablaMedidas(data.data);
                }
            });
        }

        function tablaMedidas(data) {

            $("#tablaBodyMedida").html("");

            data.Medidas.forEach(element => {
                let tr = "<tr>";
                tr += "<td>" + element.peso + "</td>";
                tr += "<td>" + element.altura + "</td>";
                tr += "<td>" + element.IMC + "</td>";
                tr += "<td>" + element.FC + "</td>";
                tr += "<td>" + element.periodo + "</td>";
                tr += "<td>" + element.PS + "</td>";
                tr += "<td>" + element.PD + "</td>";

                tr += "<td title='Editar'><svg width='20px' onclick='editMedida(" + JSON.stringify(element)  +
                    ")' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' fill='#000000'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'><path d='M14.846 1.403l3.752 3.753.625-.626A2.653 2.653 0 0015.471.778l-.625.625zm2.029 5.472l-3.752-3.753L1.218 15.028 0 19.998l4.97-1.217L16.875 6.875z' fill='#80b3ff'></path></g></svg></td>";

                tr += "<td title='Eliminar'><svg width='20px' onclick='deleteMedida(" + element.id +
                    ")' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='#D00F26''><path d='M20 11H4c-.55 0-1 .45-1 1s.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1Z'/></svg></td>";

                tr += "</tr>"
                $("#tablaBodyMedida").append(tr);

            });
        }

        function viewData(id) {

            $("#modal_person_update").modal();
            let item = usuarios.find(b => b.id == id);
            personaSelect = id;
            console.log(item);

            $("#imagenPersona").attr('src', '/storage/' + item.foto); //URL DE PRUEBAS PARA EL SERVIDOR DE IMAGENES
            //$("#imagenPersona").attr('src', 'http://santanacloud.com:8080/Atenea/public/storage/' + item.foto); //URL DE PRODUCCION PARA EL SERVIDOR DE IMAGENES
            $("#ddlTipoDocumento").val(item.tipodoco);
            $("#txtNumeroDocumento").val(item.documento);
            $("#txtNum").val(item.documento);
            $("#txtNombre").val(item.nombres);
            $("#txtApelldio").val(item.apellidos);
            $("#ddlJornada").val(item.jornada);
            $("#ddlEntidad").val(item.entidad);
            $("#ddlGrado").val(item.grado);
            $("#ddlGrupo").val(item.grupo);
            $("#ddlGenero").val(item.genero);
            $("#txtFechaNacimiento").val(item.nacimiento);
            $("#txtFechaNacimiento").attr('type', 'date');

        }

        function limpiar() {
            $(":text").val("");

        }

        function limpiarMedida() {
            $("input[type='number']").val("");
            $("#txtDAG").val("");
            auxMedidaID=null;
        }

        function Actualizar() {

            var foto = document.getElementById('uploadFoto').files[0];
            var consentimiento = document.getElementById('uploadFile').files[0]; //obtener el archivo del consentimiento
            var formData = new FormData();
            formData.append('foto', foto);
            formData.append('consentimiento', consentimiento); // Agregar el consentimiento al formulario
            formData.append('id', personaSelect);
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

            $.ajax({
                url: '{{ env('APP_URL_API') . '/updatePerson' }}',
                type: 'POST',
                contentType: false, // Importante: establecer contentType en false para que jQuery no establezca automáticamente el encabezado Content-Type
                processData: false, // Importante: establecer processData en false para evitar que jQuery procese el objeto FormData
                data: formData, // Pasar el objeto FormData como datos de la solicitud
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        $("#modal_person_update").modal('hide');

                        Swal.fire(
                            '',
                            data.message,
                            'success'
                        );
                        getDataNumeroDoco();
                        limpiar();
                    }
                }
            });

            /*$.ajax({
                url: '{{ env('APP_URL_API') . '/updatePerson' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'id': personaSelect,
                    'tipodoco': $("#ddlTipoDocumento").val(),
                    'documento': $("#txtNumeroDocumento").val(),
                    'nombres': $("#txtNombre").val(),
                    'apellidos': $("#txtApelldio").val(),
                    'genero': $("#ddlGenero").val(),
                    'entidad': $("#ddlEntidad").val(),
                    'grado': $("#ddlGrado").val(),
                    'grupo': $("#ddlGrupo").val(),
                    'nacimiento': $("#txtFechaNacimiento").val(),
                    'foto': foto,
                }),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {

                        $("#modal_person_update").modal('hide');

                        Swal.fire(
                            '',
                            data.message,
                            'success'
                        );
                        getDataNumeroDoco();
                        limpiar();
                    }
                }
            });*/
        }

        function personDelete(id) {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/personDelete' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'id': id,
                }),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        getData();
                        Swal.fire(
                            '',
                            data.message,
                            'success'
                        );
                    }
                }
            });
        }

      //FUNCIÓN DESCAGAR CONSENTIMIENTO
      function downloadConsent(id) {
    // Obtiene el elemento de carga de archivos
    const inputFile = document.getElementById("uploadFile");

    // Verifica si se ha seleccionado un archivo
    if (inputFile.files.length > 0) {
        const file = inputFile.files[0];

        // Crea un enlace de descarga para el archivo
        const downloadLink = document.createElement("a");
        downloadLink.href = URL.createObjectURL(file);
        downloadLink.download = "consentimiento"; // Nombre de descarga deseado
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
}


        /*MEDIDA*/
        function viewMedida(id) {
            $("#modal_person_medida").modal();
            let item = usuarios.find(b => b.id == id);
            personaSelect = id;
            $("#lblNombrePersona").text(`${item.nombres} ${item.apellidos}`);
            console.log("Holaaa"+personaSelect);
            getHistoricoSiExiste();
        }


        function editMedida(element) {
            $("#txtPeso").val(element.peso);
            $("#txtAltura").val(element.altura);
            $("#txtFC").val(element.FC);
            $("#txtPR").val(element.periodo);
            $("#txtPS").val(element.PS);
            $("#txtPD").val(element.PD);
            $("#txtDAG").val(element.DIAG);
            auxMedidaID=element.id;
        }

        function deleteMedida(id) {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/deleteMedida' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'id': id,
                }),
                dataType: 'json',
                success: function(data) {
                    getHistoricoSiExiste();
                    if (data.status == 200) {
                        getData();
                        Swal.fire(
                            '',
                            data.message,
                            'success'
                        );
                    }
                }
            });
        }

        function guardarMedida() {
            debugger;
                $.ajax({
                    url: '{{ env('APP_URL_API') . '/insertMedida' }}',
                    type: 'POST',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        'persona_id': personaSelect,
                        'peso': $("#txtPeso").val(),
                        'altura': $("#txtAltura").val(),
                        'FC': $("#txtFC").val(),
                        'Periodo': $("#txtPR").val(),
                        'PS': $("#txtPS").val(),
                        'PD': $("#txtPD").val(),
                        'DIAG': $("#txtDAG").val(),
                        'id': auxMedidaID,
                    }),
                    dataType: 'json',
                    success: function(data) {
                        getHistoricoSiExiste;
                        if (data.status == 200) {
                            limpiarMedida();
                            $("#modal_person_medida").modal('hide');
                            $(":text").val("");
                        }
                        auxMedidaID=null;
                        Swal.fire({
                            icon: data.status == 200 ? 'success' : 'error',
                            title: '',
                            text: data.message
                        });
                    }
                });

        }

        /*GRAFICA*/

        function IMC(data) {

            var datos = [];
            var label = [];
            var backgroundColor = [];
            var borderColor = [];


            data.forEach(element => {
                datos.push(
                    element.cantidad,
                );
                label.push(element.estado);

                var o = Math.round,
                    r = Math.random,
                    s = 255;

                color1 = o(r() * s);
                color2 = o(r() * s);
                color3 = o(r() * s);

                backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
            });


            garfica({
                id: 'charIMC',
                type: 'bar',
                labels: label,
                datos: datos,
                titulo: 'IMC',
                backgroundColor: backgroundColor,
                borderColor: borderColor
            });

        }

        function PAFemenino(data) {

                var datos = [];
                var label = [];
                var backgroundColor = [];
                var borderColor = [];


                data.forEach(element => {
                    datos.push(
                        element.cantidad,
                    );
                    label.push(element.estado);

                    var o = Math.round,
                        r = Math.random,
                        s = 255;

                    color1 = o(r() * s);
                    color2 = o(r() * s);
                    color3 = o(r() * s);

                    backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                    borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
                });


                garfica({
                    id: 'charPAFemenino',
                    type: 'bar',
                    labels: label,
                    datos: datos,
                    titulo: 'Presión arterial femenino',
                    backgroundColor: backgroundColor,
                    borderColor: borderColor
                });

        }

        function TyP(data) {

            console.log(data)

            let arrayNewObject = [];

            data.forEach(element => {
                element.forEach(res =>{
                    arrayNewObject.push(res)
                })        
            });


            var datos = [];
            var label = [];
            var backgroundColor = [];
            var borderColor = [];


            arrayNewObject.forEach(element => {
                    datos.push(
                        element.cantidad,
                    );
                    label.push(element.agrupador);

                    var o = Math.round,
                        r = Math.random,
                        s = 255;

                    color1 = o(r() * s);
                    color2 = o(r() * s);
                    color3 = o(r() * s);

                    backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                    borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
                });


                garfica({
                    id: 'charTyP',
                    type: 'bar',
                    labels: label,
                    datos: datos,
                    titulo: 'Talla y Peso',
                    backgroundColor: backgroundColor,
                    borderColor: borderColor
                });

        }

        function PAMasculino(data) {

                    var datos = [];
                    var label = [];
                    var backgroundColor = [];
                    var borderColor = [];


                    data.forEach(element => {
                        datos.push(
                            element.cantidad,
                        );
                        label.push(element.estado);

                        var o = Math.round,
                            r = Math.random,
                            s = 255;

                        color1 = o(r() * s);
                        color2 = o(r() * s);
                        color3 = o(r() * s);

                        backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                        borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
                    });


                    garfica({
                        id: 'charPAMasculino',
                        type: 'bar',
                        labels: label,
                        datos: datos,
                        titulo: 'Presión arterial',
                        backgroundColor: backgroundColor,
                        borderColor: borderColor
                    });

        }

        function FCMasculino(data) {

            var datos = [];
            var label = [];
            var backgroundColor = [];
            var borderColor = [];


            data.forEach(element => {
                datos.push(
                    element.cantidad,
                );
                label.push(element.estado);

                var o = Math.round,
                    r = Math.random,
                    s = 255;

                color1 = o(r() * s);
                color2 = o(r() * s);
                color3 = o(r() * s);

                backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
            });


            garfica({
                id: 'charFCMASCULINO',
                type: 'bar',
                labels: label,
                datos: datos,
                titulo: 'Frecuencia cardiaca en reposo - Masculino',
                backgroundColor: backgroundColor,
                borderColor: borderColor
            });

        }

        function FCFemenino(data) {

            var datos = [];
            var label = [];
            var backgroundColor = [];
            var borderColor = [];


            data.forEach(element => {
                datos.push(
                    element.cantidad,
                );
                label.push(element.estado);

                var o = Math.round,
                    r = Math.random,
                    s = 255;

                color1 = o(r() * s);
                color2 = o(r() * s);
                color3 = o(r() * s);

                backgroundColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 0.2 + ')');
                borderColor.push('rgba(' + color1 + ',' + color2 + ',' + color3 + ',' + 1 + ')');
            });


            garfica({
                id: 'charFCFEMENINO',
                type: 'bar',
                labels: label,
                datos: datos,
                titulo: 'Frecuencia cardiaca en reposo - Femenino',
                backgroundColor: backgroundColor,
                borderColor: borderColor
            });

        }

        function garfica(obj) {

            var ctx = document.getElementById(obj.id);

            var myChart = new Chart(ctx, {
                type: obj.type,
                data: {
                    labels: obj.labels,
                    datasets: [{
                        label: obj.titulo,
                        data: obj.datos,
                        backgroundColor: obj.backgroundColor,
                        borderColor: obj.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });



        }

        
    </script>

</body>

</html>
