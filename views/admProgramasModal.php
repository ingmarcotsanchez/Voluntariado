<div class="modal fade" id="modalcrearProgramas" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="programas_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prog_id" id="prog_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cen_id">Centro</label>
                                <select class="form-control select2" style="width:100%" name="cen_id" id="cen_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fac_id">Facultad</label>
                                <select class="form-control select2" style="width:100%" name="fac_id" id="fac_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                     
                        <div class="col-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Ingrese el valor inicial">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese el valor inicial">
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
