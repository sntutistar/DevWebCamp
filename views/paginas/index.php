<?php include_once __DIR__ . '/conferencias.php' ?>

<section class="resumen">
    <div class="resumen__grid">
        <div data-aos="<?php aosanimacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $ponentet; ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>
        <div data-aos="<?php aosanimacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>
        <div data-aos="<?php aosanimacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>
        <div data-aos="<?php aosanimacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero">500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers DevWebCamp</h2>
    <p class="speakers__descripcion">Conoce a nuestros expertos</p>

    <div class="speakers__grid">
        <?php foreach ($ponentes as $ponente) {
        ?>
            <div data-aos="<?php aosanimacion(); ?>" class="speaker">
                <picture>
                    <source srcset="<?php echo $_ENV['APP_URL'] . '/img/speakers/' . $ponente->imagen; ?>.webp" type="image/webp">
                    <source srcset="<?php echo $_ENV['APP_URL'] . '/img/speakers/' . $ponente->imagen; ?>.png" type="image/png">
                    <img class="speaker__imagen" loading="lazy" width="200" height="300" src="<?php echo $_ENV['APP_URL'] . '/img/speakers/' . $ponente->imagen; ?>.png" alt="Imagen Ponente">
                </picture>

                <div class="speaker__informacion">

                    <h4 class="speaker__nombre"><?php echo $ponente->nombre . ' ' . $ponente->apellido; ?></h4>

                    <p class="speaker__ubicacion"><?php echo $ponente->ciudad . ', ' . $ponente->pais ?></p>

                    <nav class="speaker-sociales">
                        <?php $redes = json_decode($ponente->redes);  ?>

                        <?php if (!empty($redes->facebook)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <span class="speaker-sociales__ocultar">Facebook</span>
                            </a>
                        <?php }; ?>

                        <?php if (!empty($redes->twitter)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </div>
                                <span class="speaker-sociales__ocultar">Twitter</span>
                            </a>
                        <?php }; ?>

                        <?php if (!empty($redes->youtube)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-youtube"></i>
                                </div>
                                <span class="speaker-sociales__ocultar">YouTube</span>
                            </a>
                        <?php }; ?>

                        <?php if (!empty($redes->instagram)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                                <span class="speaker-sociales__ocultar">Instagram</span>
                            </a>
                        <?php }; ?>

                        <?php if (!empty($redes->tiktok)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-tiktok"></i>
                                </div>

                                <span class="speaker-sociales__ocultar">Tiktok</span>
                            </a>
                        <?php }; ?>

                        <?php if (!empty($redes->github)) { ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                                <div class="speaker-sociales__icono">
                                    <i class="fa-brands fa-github"></i>
                                </div>
                                <span class="speaker-sociales__ocultar">Github</span>
                            </a>
                        <?php }; ?>
                    </nav>

                    <ul class="speaker__listado-skills">

                        <?php
                        $tags = explode(',', $ponente->tags);
                        foreach ($tags as $tag) {
                        ?>
                            <li class="speaker__skill">
                                <?php echo $tag; ?>
                            </li>
                        <?php
                        };
                        ?>

                    </ul>
                </div>
            </div>
        <?php
        } ?>
    </div>
</section>

<div id="mapa" class="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos & Precios</h2>
    <p class="boletos__descripcion">Precios para DevWebCamp</p>

    <div class="boletos__grid">
        <div data-aos="<?php aosanimacion(); ?>" class="boleto boleto--presencial">
            <h4 class="boleto__logo">&#60; DevWebCamp/></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>
        <div data-aos="<?php aosanimacion(); ?>" class="boleto boleto--virtual">
            <h4 class="boleto__logo">&#60; DevWebCamp/></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$49</p>
        </div>
        <div data-aos="<?php aosanimacion(); ?>" class="boleto boleto--gratis">
            <h4 class="boleto__logo">&#60; DevWebCamp/></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">$0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver paquetes</a>
    </div>
</section>