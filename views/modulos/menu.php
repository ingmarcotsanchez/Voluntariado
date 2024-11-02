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
    <?php //if($_SESSION["usu_rol"] == "C"):?>
        <!-- <li class="nav-item">
            <a href="manualADM.php" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Manual</p>
            </a>
        </li> -->
    <?php //else: ?>
        <!-- <li class="nav-item">
            <a href="manualPROF.php" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Manual</p>
            </a>
        </li> -->
    <?php //endif; ?>
    <?php if($_SESSION["usu_rol"] == "C"):?>
    <li class="nav-header text-green">PARAMETRIZACIÓN</li>
    <li class="nav-item">
        <a href="admCentros.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Centros</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admFacultades.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Facultades</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admProgramas.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Programas</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admAreas.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Áreas</p>
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
    

    <?php endif; ?>
    <?php if($_SESSION["usu_rol"] == "C" OR $_SESSION["usu_rol"] == "GM"):?>
    <li class="nav-header text-green">EJECUCIÓN</li>
    <li class="nav-item">
        <a href="admPostulaciones.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Postulaciones</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="admAutoevaluacion.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Autoevaluación</p>
        </a>
    </li>
    <?php endif; ?>
    <li class="nav-header text-green">SALIR</li>
    <li class="nav-item">
        <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Cerra Sesión</p>
        </a>
    </li>
</ul>