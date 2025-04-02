<?php

namespace Controllers;

use Model\Categoria;
use Model\Dias;
use Model\Evento;
use Model\EventosRegistros;
use Model\Horas;
use Model\Paquetes;
use Model\Ponentes;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistroController
{

    public static function crear(Router $router)
    {

        if (!isAuth()) {
            header('location: /');
            return;
        }

        //verificar si el usuario ya tiene un registro
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && $registro->paquete_id === "3") {
            header('location: /boleto?id=' . urlencode($registro->token));
            return;
        }
        
        if (isset($registro) && $registro->paquete_id === "2") {
            header('location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if(isset($registro) && $registro->paquete_id === "1") {
            header('location: /finalizar-registro/conferencias');
            return;
        }


        $router->render('registro/crear', [
            'titulo' => 'Finalizar registro DevWebCamp'
        ]);
    }

    public static function gratis()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAuth()) {
                header('location: /');
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if (isset($registro) && $registro->paquete_id === "3") {
                header('location: /boleto?id=' . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            //crear registro

            $datos = [
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if ($resultado) {
                header('location: /boleto?id=' . urlencode($registro->token));
            }
        }
    }

    public static function boleto(Router $router)
    {

        $id = $_GET['id'];

        if (!$id || strlen($id) !== 8) {
            header('location: /');
            return;
        }

        //buscarlo en la bd

        $registro = Registro::where('token', $id);

        if (!$registro) {
            header('location: /');
        }

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquetes::find($registro->paquete_id);

        $router->render('registro/boleto', [
            'titulo' => 'Boleto DevWebCamp',
            'registro' => $registro
        ]);
    }

    public static function pagar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAuth()) {
                header('location: /');
                return;
            }

            //validar que post no este vacio

            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }

            //crear registro
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            //crear registro
            $datos = $_POST;
            $datos['token'] = $token;
            $datos['usuario_id'] = $_SESSION['id'];



            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
    }

    public static function conferencias(Router $router)
    {

        if (!isAuth()) {
            header('location: /');
            return;
        }

        //validar que el usurio tenga el plan presencial

        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        if(isset($registro->regalo_id) && $registro->paquete_id === "2"){
            header('location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if ($registro->paquete_id !== "1") {
            header('location: /');
            return;
        }

        if ($registro->regalo_id !== "1" && $registro->paquete_id === "1"){
            header('location: /boleto?id=' . urlencode($registro->token));
            return;
        }

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

        $regalos = Regalo::all('ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAuth()) {
                header('location: /');
            }

            $eventos = explode(',', $_POST['eventos']);

            if (empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if (!isset($registro) || $registro->paquete_id !== "1") {
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];

            //validar la disponibilidad de los eventos
            foreach ($eventos as $evento_id) {
                $evento = Evento::find($evento_id);
                //comprobar el evento 
                if (!isset($evento) || $evento->disponibles === "0") {
                    echo json_encode(['resultado' => false]);
                    return;
                }

                $eventos_array[] = $evento;
            }

            foreach ($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);

                $registro_usuario->guardar();   
            }

            $registro->sincronizar(['regalo_id' => $_POST['regalo']]);

            $resultado = $registro->guardar();

            if($resultado){
                echo json_encode(['resultado' => $resultado, 'token' => $registro->token]);
            }else{
                echo json_encode(['resultado' => false]);
            }

            return;
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elije Workshops & Conferencias DevWebCamp',
            'eventos' => $eventosformateados,
            'regalos' => $regalos
        ]);
    }
}
