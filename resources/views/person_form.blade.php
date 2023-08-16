

<div class="form-group row">
    <div class="col-md-6">
        <label for="ddlTipoDocumento">Tipo de documento</label>
        <select id="ddlTipoDocumento" class="form-control input-sm" required="">
            <option disabled selected value> Seleccionar </option>
            <option value="RC:REGISTRO CIVIL DE NACIMIENTO">RC:REGISTRO CIVIL DE NACIMIENTO</option>
            <option value="NES:NÚMERO ESTABLECIDO POR LA SECRETARÍA">NES:NÚMERO ESTABLECIDO POR LA SECRETARÍA</option>
            <option value="TI:TARJETA DE IDENTIDAD">TI:TARJETA DE IDENTIDAD</option>
            <option value="CC:CÉDULA DE CIUDADANÍA">CC:CÉDULA DE CIUDADANÍA</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="txtNumeroDocumento">Número de documento</label>
        <input type="text" maxlength="10" id="txtNumeroDocumento" class="form-control input-sm"
            placeholder="Número Documento" required="">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="txtNombre">Nombres</label>
        <input type="text" maxlength="50" id="txtNombre" class="form-control input-sm" placeholder="Nombre"
            required="">
    </div>
    <div class="col-md-6">
        <label for="txtApelldio">Apellidos</label>
        <input type="text" maxlength="50" id="txtApelldio" class="form-control input-sm" placeholder="Apellido"
            required="">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="txtFechaNacimiento">Fecha de nacimiento</label>
        <div class="input-group">

            <input id="txtFechaNacimiento" type="text" class="form-control datepicker-here" data-language='en' />

        </div>
    </div>

    <div class="col-md-6">
        <label for="txtFechaNacimiento">Jornada</label>
        <div class="input-group">
            <select id="ddlJornada" class="form-control input-sm" required="">
                <option disabled selected value> Seleccionar </option>
                <option value="ÚNICA">ÚNICA</option>
                <option value="TARDE">TARDE</option>
                <option value="MAÑANA">MAÑANA</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="txtNumeroDocumento">Institución educativa</label>
        <div class="input-group">
            <select id="ddlEntidad" class="form-control input-sm" required="">
                @foreach ($entidad as $item)
                    <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="col-md-6">
        <label for="txtNumeroDocumento">Grado</label>
        <div class="input-group">
            <select id="ddlGrado" class="form-control input-sm" required="">
                <option disabled selected value> Seleccionar </option>
                @for ($i = 0; $i < 12; $i++)
                    <option value='{{ $i }}'> {{ $i }} </option>
                @endfor
            </select>

        </div>
    </div>

</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="ddlGrupo">Grupo</label>
        <div class="input-group">
            <select id="ddlGrupo" class="form-control input-sm" required="">
                <option disabled selected value> Seleccionar </option>
                @foreach ($grupo as $item)
                    <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="col-md-6">
        <label for="ddlGenero">Genero</label>
        <select id="ddlGenero" class="form-control input-sm" required="">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>
    </div>

</div>

<div class="form-group row">
    <div class="col-md-6">
        <div>
            <label for="uploadFile">Cargar consentimiento:</label>
            <input type="file" id="uploadFile" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png">
        </div>
        <div>
            <label for="chkPoliticas">Estoy de acuerdo con las políticas</label>
            <input type="checkbox" id="chkPoliticas">
        </div>

    </div>
    <div class="col-md-6">
        <label for="uploadFoto">Cargar foto:</label>
        <input type="file" id="uploadFoto" accept="image/*">
    </div>
</div>
