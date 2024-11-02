<div class="modal fade" id="modalcrearUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="usu_id" id="usu_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_nom">Nombres</label>
                                <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese sus Nombres">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_ape">Apellidos</label>
                                <input type="text" class="form-control" name="usu_ape" id="usu_ape" placeholder="Ingrese sus Apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="usu_correo">Usuario</label>
                                <input type="email" class="form-control" name="usu_correo" id="usu_correo" placeholder="Ingrese un correo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="usu_pass">Password</label>
                                <input type="password" class="form-control" name="usu_pass" id="usu_pass" placeholder="Ingrese su Contraseña">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="usu_rol">Perfil</label>
                                <select class="form-control select2" name="usu_rol" id="usu_rol" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="C">Administrador</option>
                                    <option value="GC">Gestor Conocimiento</option>
                                    <option value="ES">Estudiante</option>
                                    <option value="EX">Sector Externo</option>
                                    <option value="AS">Aspirante</option>
                                </select>
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