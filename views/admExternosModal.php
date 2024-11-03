<div class="modal fade" id="modalcrearExternos" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="externos_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="ext_id" id="ext_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="ext_nom">Nombres</label>
                                <input type="text" class="form-control" name="ext_nom" id="ext_nom" placeholder="Ingrese sus Nombres">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="ext_ape">Apellidos</label>
                                <input type="text" class="form-control" name="ext_ape" id="ext_ape" placeholder="Ingrese sus Apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="text_correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="text_correo" id="text_correo" placeholder="Ingrese un correo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="ext_telf">Teléfono de Contacto</label>
                                <input type="text" class="form-control" name="ext_telf" id="ext_telf" placeholder="Ingrese su Contraseña">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>