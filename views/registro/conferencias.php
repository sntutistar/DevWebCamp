<h1 class="pagina__heading"><?php echo $titulo ?></h1>
<p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias/></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php if (!$eventos || $eventos['conferencias_v'] === "null") {
            ?>
                <p>Aun no hay eventos</p>
            <?php
            } else {
            ?>
            <?php foreach ($eventos['conferencias_v'] as $evento) { ?>
            <?php
                include __DIR__ . '/evento.php';
            ?>
            <?php }; ?>
            <?php
            }; ?>
        </div>

        <p class="eventos-registro__fecha">Sabado 6 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php if (!$eventos || $eventos['conferencias_s'] === "null") {
            ?>
                <p>Aun no hay eventos</p>
                    <?php
                } else {
                    ?>
                    <?php foreach ($eventos['conferencias_s'] as $evento) { ?>
                    <?php
                        include __DIR__ . '/evento.php';
                    ?>
                    <?php }; ?>
            <?php
                }; ?>
        </div>

        <h3 class="eventos-registro__heading--workshops">&lt;Workshops/></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php if (!$eventos || $eventos['workshops_v'] === "null") {
            ?>
                <p>Aun no hay eventos</p>
                    <?php
                } else {
                    ?>
                    <?php foreach ($eventos['workshops_v'] as $evento) { ?>
                    <?php
                        include __DIR__ . '/evento.php';
                    ?>
                    <?php }; ?>
            <?php
                }; ?>
        </div>
        <p class="eventos-registro__fecha">Sabado 6 de Octubre</p>
        <div class="eventos-registro__grid eventos--workshops">
            <?php if (!$eventos || $eventos['workshops_s'] === "null") {
            ?>
                <p>Aun no hay eventos</p>
                    <?php
                } else {
                    ?>
                    <?php foreach ($eventos['workshops_s'] as $evento) { ?>
                    <?php
                        include __DIR__ . '/evento.php';
                    ?>
                    <?php }; ?>
            <?php
                }; ?>
        </div>
    </main>

    <aside class="registro">
        <h2 class="registro__heading">Tu registro</h2>

        <div id="registro-resumen" class="registro__resumen"></div>

        <div class="registro__regalo">
            <label for="regalo" class="registro__label">Selecciona un regalo</label>
            <select id="regalo" class="registro__select">
                <option value="">-- Selecciona un regalo --</option>
                <?php foreach ($regalos as $regalo) {
                ?>
                    <option value="<?php echo $regalo->id; ?>" <?php echo ($regalo->id === "1") ? 'disabled' : ''?>><?php echo $regalo->nombre; ?></option>
                <?php
                }; ?>
            </select>
        </div>

        <form action="" id="registro" class="formulario">
            <div class="formulario__campo">
                <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
            </div>
        </form>

    </aside>
</div>