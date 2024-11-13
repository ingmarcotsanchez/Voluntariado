<div class="modal fade" id="modalasignar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="mdltitulo" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="ticket_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="tick_id" id="tick_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_asig">Usuario de soporte</label>
                                <select class="form-control select2" style="width:100%" name="usu_asig" id="usu_asig" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>