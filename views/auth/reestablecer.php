<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Reestablecer password de DevWebCamp</p>

    <?php
    require_once __DIR__.'/../templates/alertas.php';
    ?>

    <?php if ($token_valido) {
    ?>
        <form method="POST" class="formulario" action="">

            <div class="formulario__campo">
                <label class="formulario__label" for="password">Nuevo Password</label>
                <input
                    type="password"
                    class="formulario__input"
                    placeholder="Tu Password"
                    name="password"
                    id="password">
            </div>

            <input type="submit" value="Guardar password" class="formulario__submit">
        </form>

    <?php

    } ?>


    <div class="acciones">
        <a href="/registro" class="acciones__enlace">Crear una cuenta</a>
        <a href="/olvide" class="acciones__enlace">¿Olvido su contraseña?</a>
    </div>
</main>