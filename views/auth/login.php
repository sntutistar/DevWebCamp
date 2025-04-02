<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Iniciar sesión en DevWebCamp</p>

    <?php
    require_once __DIR__.'/../templates/alertas.php';
    ?>

    <form method="POST" class="formulario" action="/login">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu E-mail"
                name="email"
                id="email"
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

        <input type="submit" value="Iniciar Sesión" class="formulario__submit">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">Crear una cuenta</a>
        <a href="/olvide" class="acciones__enlace">¿Olvido su contraseña?</a>
    </div>
</main>