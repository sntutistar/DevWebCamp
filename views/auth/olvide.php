<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recuperar contraseña de DevWebCamp</p>
    
    <?php
    require_once __DIR__.'/../templates/alertas.php';
    ?>

    <form method="POST" class="formulario" action="/olvide">
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
        

        <input type="submit" value="Recuperar contraseña" class="formulario__submit">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">Crear una cuenta</a>
        <a href="/login" class="acciones__enlace">Iniciar sesión</a>
    </div>
</main>