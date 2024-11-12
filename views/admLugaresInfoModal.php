<div class="modal fade" id="modalcrearLugarInfo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="lugares_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="lug_id" id="lug_id">
                    <div class="row">
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label for="area_id">Área</label>
                                <select class="form-control select2" style="width:100%" name="area_id" id="area_id" data-placeholder="Seleccione" disabled>
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lug_nom">Nombre</label>
                                <input type="text" class="form-control" name="lug_nom" id="lug_nom" placeholder="Ingrese el código del programa" disabled>
                            </div>
                        </div>
                         --><div class="col-12">
                            <div class="form-group">
                                <label for="lug_descrip">Descripción</label>
                                <input type="text" class="form-control" name="lug_descrip" id="lug_descrip" readonly>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label for="lug_fecini">Fecha Inicial</label>
                                <input type="date" class="form-control" name="lug_fecini" id="lug_fecini" placeholder="Ingrese el código del programa" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lug_fecfin">Fecha Final</label>
                                <input type="date" class="form-control" name="lug_fecfin" id="lug_fecfin" placeholder="Ingrese el nombre del programa" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ext_id">Supervisor</label>
                                <select class="form-control select2" style="width:100%" name="ext_id" id="ext_id" data-placeholder="Seleccione" disabled>
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div> -->
                    </div>  
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
