<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

    <?php
    require_once __DIR__.'/../templates/alertas.php';
    ?>

    <form method="POST" class="formulario" action="/registro">
        <div class="formulario__campo">
            <label class="formulario__label" for="nombre">Nombre</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="Tu Nombre"
                name="nombre"
                id="nombre"
                value="<?php echo $usuario->nombre; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="apellido">Apellido</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="Tu Apellido"
                name="apellido"
                id="apellido"
                value="<?php echo $usuario->apellido; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="email">E-mail</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu E-mail"
                name="email"
                id="email"
                value="<?php echo $usuario->email; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu Password"
                name="password"
                id="password"
            >
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="password2">Repetir Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Repite tu Password"
                name="password2"
                id="password2"
            >
        </div>

        <input type="submit" value="Crear cuenta" class="formulario__submit">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvido su contraseña?</a>
    </div>
</main>