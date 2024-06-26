<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php include '../includes/admin_nav.php'; ?>
        <div class="main-content">
            <div id="content-container">
                <h1>Bienvenido Administrador, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function loadPage(page) {
                $.ajax({
                    url: page,
                    method: 'GET',
                    success: function(data) {
                        $('#content-container').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error loading page: ' + textStatus + ', ' + errorThrown);
                    }
                });
            }

            // Load default content
            loadPage('welcome.php');

            // Bind click events to nav links
            $('.nav-list a').on('click', function(e) {
                e.preventDefault();
                var page = $(this).attr('data-page');
                if (page) {
                    loadPage(page);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
