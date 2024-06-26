<div class="sidebar">
    <div class="profile">
        <img src="../img/logo.png" alt="User Icon" class="profile-img">
        <h3><?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Usuario'; ?></h3>
        <button class="logout-btn" onclick="window.location.href='logout.php'"><i class="fas fa-power-off"></i></button>
    </div>

    <?php
    //  $permisos los permisos del usuario actual
    if (in_array('secciones', $permisos)) {
        echo '<a href="secciones.php" class="btn btn-sidebar"><i class="fas fa-th-large"></i> Secciones</a>';
    }
    if (in_array('categorias', $permisos)) {
        echo '<a href="categorias.php" class="btn btn-sidebar"><i class="fas fa-tags"></i> Categorías</a>';
    }
    if (in_array('proveedores', $permisos)) {
        echo '<a href="proveedores.php" class="btn btn-sidebar"><i class="fas fa-truck"></i> Proveedores</a>';
    }
    if (in_array('productos', $permisos)) {
        echo '<a href="productos.php" class="btn btn-sidebar"><i class="fas fa-box"></i> Productos</a>';
    }
    if (in_array('entradas', $permisos)) {
        echo '<a href="entradas.php" class="btn btn-sidebar"><i class="fas fa-sign-in-alt"></i> Prestamos</a>';
    }
    if (in_array('registro_lab', $permisos)) {
        echo '<a href="registro_lab.php" class="btn btn-sidebar"><i class="fas fa-flask"></i> Registro Laboratorio</a>';
    }
    ?>
</div>