<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if (isAuth()) {
            ?>
                <a href="<?php echo isAdmin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__enlace">Administrar</a>
                <form method="POST" class="header__form" action="/logout">
                    <input type="submit" value="Cerrar sesion" class="header__submit">
                </form>
            <?php
            } else {
            ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar sesión</a>
            <?php
            }; ?>

        </nav>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>
            <p class="header__texto">Cursos desarrollo web</p>
            <p class="header__texto header__texto--modalidad">En linea - Presencial</p>

            <a href="/registro" class="header__boton">Comprar pase</a>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">&#60;DevWebCamp/></h2>
        </a>
        <nav class="navegacion">
            <a class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--actual' : '' ?>" href="/devwebcamp">Evento</a>
            <a class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : '' ?>" href="/paquetes">Paquetes</a>
            <a class="navegacion__enlace <?php echo pagina_actual('/workshops-conferencias') ? 'navegacion__enlace--actual' : '' ?>" href="/workshops-conferencias">Workshops / conferencias</a>
            <a class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : '' ?>" href="/registro">Comprar pase</a>
        </nav>
    </div>
</div>