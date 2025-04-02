<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información personal</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            class="formulario__input"
            name="nombre"
            id="nombre"
            placeholder="Nombre del ponente"
            value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input
            type="text"
            class="formulario__input"
            name="apellido"
            id="apellido"
            placeholder="Apellido del ponente"
            value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input
            type="text"
            class="formulario__input"
            name="ciudad"
            id="ciudad"
            placeholder="Ciudad del ponente"
            value="<?php echo $ponente->ciudad ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="pais">Pais</label>
        <input
            type="text"
            class="formulario__input"
            name="pais"
            id="pais"
            placeholder="Pais del ponente"
            value="<?php echo $ponente->pais ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input
            type="file"
            class="formulario__input formulario__input--file"
            name="imagen"
            id="imagen">
    </div>

    <?php if (isset($ponente->imagen_actual)) {
    ?>
        <p class="formulario__texto">Imagen actual</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['APP_URL'].'/img/speakers/'.$ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['APP_URL'].'/img/speakers/'.$ponente->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['APP_URL'].'/img/speakers/'.$ponente->imagen; ?>.png" alt="Imagen Ponente">
            </picture>
        </div>
    <?php
    } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información extra</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Areas de experiencia (Separadas por coma) </label>
        <input
            type="text"
            class="formulario__input"
            id="tags_input"
            placeholder="Ej. node.js, Angular, React, etc">
        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook-f"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[facebook]"
                placeholder="Facebook"
                value="<?php echo $redes->facebook ?? ''; ?>">
        </div>

    </div>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-x-twitter"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[twitter]"
                placeholder="X-twitter"
                value="<?php echo $redes->twitter ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[youtube]"
                placeholder="YouTube"
                value="<?php echo $redes->youtube ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[instagram]"
                placeholder="Instagram"
                value="<?php echo $redes->instagram ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[tiktok]"
                placeholder="Tiktok"
                value="<?php echo $redes->tiktok ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contendeor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[github]"
                placeholder="Github"
                value="<?php echo $ponente->github ?? ''; ?>">
        </div>
    </div>

</fieldset>