<?php

namespace Controllers;

use Model\Categoria;
use Model\Dias;
use Model\Evento;
use Model\Horas;
use Model\Ponentes;
use MVC\Router;

class PaginasController
{

    public static function index(Router $router)
    {
        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventosformateados = [];

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dias::find(($evento->dia_id));
            $evento->hora = Horas::find(($evento->hora_id));
            $evento->ponente = Ponentes::find(($evento->ponente_id));

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventosformateados['conferencias_v'][] = $evento;
            } else {
                $eventosformateados['conferencias_v'] = "null";
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventosformateados['conferencias_s'][] = $evento;
            } else {
                $eventosformateados['conferencias_s'] = "null";
            }

            if ($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventosformateados['workshops_v'][] = $evento;
            } else {
                $eventosformateados['workshops_v'] = "null";
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventosformateados['workshops_s'][] = $evento;
            } else {
                $eventosformateados['workshops_s'] = "null";
            }
        }

        //Obtener total de cada bloque
        $ponente = Ponentes::contar();
        $conferencias = Evento::contar('categoria_id',1);
        $workshops = Evento::contar('categoria_id',2);

        //Obtener todos los ponentes
        $ponentes = Ponentes::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio DevWebCamp',
            'eventos' => $eventosformateados,
            'ponentet' =>$ponente,
            'ponentes' =>$ponentes,
            'conferencias' => $conferencias,
            'workshops' => $workshops
        ]);
    }

    public static function evento(Router $router)
    {


        $router->render('paginas/evento', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router)
    {


        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router)
    {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventosformateados = [];

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dias::find(($evento->dia_id));
            $evento->hora = Horas::find(($evento->hora_id));
            $evento->ponente = Ponentes::find(($evento->ponente_id));

            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventosformateados['conferencias_v'][] = $evento;
            } else {
                $eventosformateados['conferencias_v'] = "null";
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventosformateados['conferencias_s'][] = $evento;
            } else {
                $eventosformateados['conferencias_s'] = "null";
            }

            if ($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventosformateados['workshops_v'][] = $evento;
            } else {
                $eventosformateados['workshops_v'] = "null";
            }

            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventosformateados['workshops_s'][] = $evento;
            } else {
                $eventosformateados['workshops_s'] = "null";
            }
        }

        $router->render('paginas/conferencias', [
            'titulo' => 'Workshops & Conferencias DevWebCamp',
            'eventos' => $eventosformateados
        ]);
    }

    public static function error(Router $router)
    {


        $router->render('paginas/error404', [
            'titulo' => 'Pagina no encontrada'
        ]);
    }
}
