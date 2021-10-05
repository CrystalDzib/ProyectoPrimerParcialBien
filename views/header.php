<?php
$estado_session = session_status();
if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['loggedUserName'])) {
    ?>


    <div class="navbar-fixed">

        <nav class="blue">
            <div class="nav-wrapper container">
                <a href="#!" class="brand-logo right">Crystal Dzib </a>
                <ul class="left">
                    
                     <li><a href="?menu=bienvenida">Inicio</a></li>



                <li><a href="?menu=alumnos">Alumnos</a></li>

                <li><a href="?menu=login">logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
<?php } else {
    ?>

    <!-- navbar menu -->
    <div class="navbar-fixed"/>
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo right">Crystal Dzib</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                
               
                
                <li><a href="?menu=bienvenida">Inicio</a></li>
                    <li><a href="?menu=acercademi">Acerca de mi ...</a></li>
                    <li><a href="?menu=viajes">Viajes</a></li>
                    <li><a href="?menu=escuela">Escuela</a></li>
                    <li><a href="?menu=alumnos">Alumno</a></li>
                    <li><a href="?menu=redesociales">Redes Sociales</a></li>
                    <li><a href="?menu=login">Login</a></li>
            </ul>
        </div>
    </nav>
    </div>
<?php } ?>        