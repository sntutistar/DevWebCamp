<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dias;
use Model\Evento;
use Model\Horas;
use Model\Ponentes;
use MVC\Router;

class EventosController
{

    public static function eventos(Router $router)
    {
        if (!isAdmin()) {
            header('location: /login');
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('location: /admin/eventos?page=1');
        }

        $por_pagina = 5;
        $total = Evento::contar();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $eventos = Evento::paginar($por_pagina, $paginacion->offset());

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dias::find(($evento->dia_id));
            $evento->hora = Horas::find(($evento->hora_id));
            $evento->ponente = Ponentes::find(($evento->ponente_id));
        }


        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Workshops DevWebCamp',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {
        if (!isAdmin()) {
            header('location: /login');
        }
        $alertas = [];
        $categorias = Categoria::all('ASC');
        $dias = Dias::all('ASC');
        $horas = Horas::all('ASC');
        $evento = new Evento;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) {
                header('location: /login');
            }
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Crear evento en DevWebCamp',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento

        ]);
    }

    public static function editar(Router $router)
    {
        if (!isAdmin()) {
            header('location: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('location: /admin/eventos');
        }
        $categorias = Categoria::all('ASC');
        $dias = Dias::all('ASC');
        $horas = Horas::all('ASC');
        $evento = Evento::find($id);
        if (!$evento) {
            header('location: /admin/eventos');
        }
        $evento->categoria = Categoria::find($evento->categoria_id);
        $evento->dia = Dias::find(($evento->dia_id));
        $evento->hora = Horas::find(($evento->hora_id));
        $evento->ponente = Ponentes::find(($evento->ponente_id));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) {
                header('location: /login');
            }
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('location: /admin/eventos');
                }
            }
        }
        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar evento en DevWebCamp',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }

    public static function eliminar()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];

            if (!isAdmin()) {
                header('location: /login');
            }

            $evento = Evento::find($id);
            if (!isset($evento)) {
                header('location: /admin/eventos');
            }

            $resultado = $evento->eliminar();

            if ($resultado) {
                header('location: /admin/eventos');
            }
        }
    }
}
