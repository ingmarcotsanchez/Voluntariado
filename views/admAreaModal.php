<div class="modal fade" id="modalcrearArea" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="area_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="area_id" id="area_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="area_nom">Áreas de actividades</label>
                                <input type="text" class="form-control" name="area_nom" id="area_nom" placeholder="Ingrese la informacion">
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