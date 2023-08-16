<!-- The Modal -->

<div class="modal fade" id="modal_person_update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Actualizar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="form-group row">
                <img id="imagenPersona" class="rounded mx-auto d-block" style="border-radius: 50%; max-width: 90px; height: auto;"  alt="...">
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @include('person_form')
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button id="btnActualizar" onclick="Actualizar()" class="btn btn-primary"
                        type="button">Actualizar</button>
                    <button id="btnLimpiar" onclick="limpiar()" class="btn btn-secondary"
                        type="button">Limpiar</button>
                </div>
            </div>

        </div>
    </div>
</div>
