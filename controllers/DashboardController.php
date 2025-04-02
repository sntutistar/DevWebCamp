<?php 

namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController{

    public static function index(Router $router){
        //obtener ultimos registros
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);

        }

        $virtuales = Registro::contar('paquete_id', 2);
        $presenciales = Registro::contar('paquete_id', 1);
        
        $ingresos = ($virtuales * 46.41 ) + ($presenciales * 189.54);

        //obtener eventos
        $menos_lugares = Evento::ordenarlimite('disponibles','ASC', 5);
        $mas_lugares = Evento::ordenarlimite('disponibles','DESC', 5);

        $router->render('admin/dashboard/admin', [
            'titulo' => 'Panel de administracion',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_lugares' => $menos_lugares,
            'mas_lugares' => $mas_lugares
        ]);

    }
}