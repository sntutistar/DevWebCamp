<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Crear un evento
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($eventos)) {
    ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Evento</th>
                    <th scope="col" class="tabla__th">Tipo</th>
                    <th scope="col" class="tabla__th">Dia y Hora</th>
                    <th scope="col" class="tabla__th">Ponente</th>
                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>
            <tbody class="tabla__tbody">
                <?php foreach ($eventos as $evento) {
                ?>
                    <tr class="tabla__tr">
                        <td class="tabla__td">
                            <?php echo $evento->nombre; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $evento->categoria->nombre; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $evento->dia->nombre . ',(' . $evento->hora->hora . ') '; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $evento->ponente->nombre . ' ' . $evento->ponente->apellido; ?>
                        </td>
                        <td class="tabla__td--acciones">
                            <a class="tabla__accion tabla__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento->id ?>">
                                <i class="fa-solid fa-pen"></i>
                                Editar
                            </a>
                            <form method="POST" class="tabla__formulario" action="/admin/eventos/eliminar">
                                <input type="hidden" name="id" value="<?php echo $evento->id ?>">
                                <button type="submit" class="tabla__accion tabla__accion--eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <p class="text-center">No hay eventos aun</p>
    <?php
    } ?>
</div>

<?php

echo $paginacion;

?>