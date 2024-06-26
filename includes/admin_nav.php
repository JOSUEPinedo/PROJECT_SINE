<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="sidebar">
    <div class="profile">
        <img src="../img/logo.png" alt="User Icon" class="profile-img">
        <h3><?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Usuario'; ?></h3>
        <button class="logout-btn" onclick="window.location.href='logout.php'"><i class="fas fa-power-off"></i></button>
    </div>
    <ul class="nav-list">
        <li><a href="admin_dashboard.php" class="nav-link"><i class="fas fa-home"></i> Administración</a></li>
        <li><a href="usuarios.php" class="nav-link"><i class="fas fa-users"></i> Usuarios</a></li>
        <li><a href="roles.php" class="nav-link"><i class="fas fa-user-tag"></i> Roles</a></li>
        <li><a href="permisos.php" class="nav-link"><i class="fas fa-key"></i> Permisos</a></li>
        <li>
            <a href="#" class="dropdown-btn"><i class="fas fa-th-large"></i> Laboratorio <i class="fas fa-caret-down"></i></a>
            <ul class="dropdown-container">
                <li><a href="secciones.php" class="nav-link"><i class="fas fa-th-large"></i> Secciones</a></li>
                <li><a href="productos.php" class="nav-link"><i class="fas fa-box"></i> Productos</a></li>
                <li><a href="registro_lab.php" class="nav-link"><i class="fas fa-flask"></i> Registro Laboratorio</a></li>
            </ul>
        </li>
        <li><a href="proveedores.php" class="nav-link"><i class="fas fa-truck"></i> Proveedores</a></li>
        <li><a href="entradas.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> Prestamos</a></li>
        <li>
            <a href="#" class="dropdown-btn"><i class="fas fa-file-pdf"></i> Generar PDF <i class="fas fa-caret-down"></i></a>
            <ul class="dropdown-container">
                <li><a href="generate_pdf_productos.php" class="nav-link">Productos</a></li>
                <li><a href="generate_pdf_entradas.php" class="nav-link">Prestamos</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
// JavaScript para el comportamiento del menú desplegable
document.addEventListener('DOMContentLoaded', function() {
    var dropdowns = document.querySelectorAll('.dropdown-btn');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function() {
            this.classList.toggle('active');
            var dropdownContainer = this.nextElementSibling;
            if (dropdownContainer.style.display === 'block') {
                dropdownContainer.style.display = 'none';
            } else {
                dropdownContainer.style.display = 'block';
            }
        });
    });

    // Manejar clics en enlaces del menú
    var navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var targetPage = this.getAttribute('href');
            window.location.href = targetPage;
        });
    });
});
</script>
