<input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">
<!-- <input type="hidden" id="rol_idx" value="<?php //echo $_SESSION["perfil"] ?>"> -->
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Inicio</p>
        </a>
    </li>
    <?php if($_SESSION["usu_rol"] == "C"):?>
    <li class="nav-item">
        <a href="admUsuarios.php" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Usuarios</p>
        </a>
    </li>
    <?php endif; ?>
    <li class="nav-item">
        <a href="perfil.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Perfil</p>
        </a>
    </li>
    <?php if($_SESSION["usu_rol"] == "C"):?>
        <li class="nav-item">
            <a href="manualADM.php" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Manual</p>
            </a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a href="manualPROF.php" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Manual</p>
            </a>
        </li>
    <?php endif; ?>
    <?php if($_SESSION["usu_rol"] == "C"):?>
    <li class="nav-header text-orange">PARAMETRIZACIÓN</li>
    <li class="nav-item">
        <a href="admCentros.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Centros</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admProgramas.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Programas</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admSemestres.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Semestres</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admAsignaturas.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Asignaturas</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admEscalafones.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Escalafón</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admRoles.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Roles</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admJornada.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Jornadas</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admModalidad.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Modalidad</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admTipos.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Tipo Acompañamiento</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admNecesidades.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Necesidades</p>
        </a>
    </li>
    
    
    <li class="nav-item">
        <a href="admEstudiantes.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Estudiantes</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admProfesores.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Profesores</p>
        </a>
    </li>
    <?php endif; ?>
    <?php if($_SESSION["usu_rol"] == "C" OR $_SESSION["usu_rol"] == "GM"):?>
    <li class="nav-header text-orange">EJECUCIÓN</li>
    <li class="nav-item">
        <a href="admRemisiones.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Remisiones</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admSeguimientos.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Seguimientos</p>
        </a>
    </li>
    <?php endif; ?>
    <li class="nav-header text-orange">SALIR</li>
    <li class="nav-item">
        <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Cerra Sesión</p>
        </a>
    </li>
</ul>