<header>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php 
            // Si el usuario NO ha iniciado sesión, mostrar enlaces de Login y Registro
            if (!isset($_SESSION['id'])) { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="registro.php">Registro</a></li>
            <?php 
            // Si el usuario ha iniciado sesión, mostrar enlaces para añadir noticia y cerrar sesión
            } else { ?>
                <li><a href="anadir_noticia.php">Añadir Noticia</a></li>
                <li><a href="index.php?logout=true">Cerrar Sesión</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>