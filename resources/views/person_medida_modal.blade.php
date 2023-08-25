<!-- The Modal -->
<div class="modal fade" id="modal_person_medida">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"> <label id="lblNombrePersona"></label></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="txtPeso">Peso - Kilogramos</label>
                        <input type="number" maxlength="3" id="txtPeso" class="form-control input-sm" placeholder=""
                            required="">
                    </div>
                    <div class="col-md-6">
                        <label for="txtAltura">Estatura - Metros</label>
                        <input type="number" maxlength="3" id="txtAltura" class="form-control input-sm" placeholder=""
                            required="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="txtPR">Periodo</label>
                        <select id="txtPR" class="form-control input-sm" required>
                            <option value="1">Periodo 1</option>
                            <option value="2">Periodo 2</option>
                            <option value="3">Periodo 3</option>
                            <option value="4">Periodo 4</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="txtFC">Frecuencia cardíaca</label>
                        <input type="number" maxlength="3" id="txtFC" class="form-control input-sm" placeholder=""
                            required="">
                    </div>
                    <!---<div class="col-md-6">
                        <label for="txtPA">Presión Arterial</label>
                        <input type="number" maxlength="3" id="txtPA" class="form-control input-sm" placeholder=""
                            required="">
                    </div> --->
                    <div class="col-md-3">
                        <label for="txtPS">Presión Sistólica</label>
                        <input type="number" maxlength="3" id="txtPS" class="form-control input-sm" placeholder=""
                               required="">
                    </div>
                    <div class="col-md-3">
                        <label for="txtPD">Presión Diastólica</label>
                        <input type="number" maxlength="3" id="txtPD" class="form-control input-sm" placeholder=""
                               required="">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="txtDAG">Diagnóstico</label>
                        <textarea id="txtDAG" class="form-control input-sm" required=""></textarea>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button id="btnEnviar" onclick="guardarMedida()" class="btn btn-primary"
                        type="button">Guardar</button>
                    <button id="btnLimpiar" onclick="limpiarMedida()" class="btn btn-secondary"
                        type="button">Limpiar</button>
                </div>
            </div>

            <hr>
            <div class="col-md-12" id="tabla_medidas">
                <table class="table table-striped table table-hover">
                    <thead>
                    <tr>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>IMC</th>
                        <th>FC</th>
                        <th>Periodo</th>
                        <th>PS</th>
                        <th>PD</th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody id="tablaBodyMedida">

                    </tbody>
                </table>
            </div>
            <hr>

        </div>
    </div>
</div>
