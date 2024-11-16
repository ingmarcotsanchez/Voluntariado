<div class="modal fade" id="modalcrearLugarInfo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información del lugar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="lugares_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="lug_id" id="lug_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lug_descrip">Descripción</label>
                                <input type="text" class="form-control" name="lug_descrip" id="lug_descrip">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
