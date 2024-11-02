<div class="modal fade" id="modalcrearFacultades" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="facultades_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="fac_id" id="fac_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cen_id">Centro Educativo</label>
                                <select class="form-control select2" style="width:100%" name="cen_id" id="cen_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingrese el código del programa">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fac_nom">Descripción</label>
                                <input type="text" class="form-control" name="fac_nom" id="fac_nom" placeholder="Ingrese el nombre del programa">
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
