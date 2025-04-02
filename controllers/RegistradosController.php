<?php 

namespace Controllers;

use Classes\Paginacion;
use Model\Paquetes;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistradosController{

    public static function registrados(Router $router){

        if (!isAdmin()) {
            header('location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual<1){
            header('location:/admin/registrados?page=1');
        }

        $registros_por_pagina = 4;
        $total = Registro::contar();

        if($total === "0"){
            $total = "1";
        }
        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total);

        if($paginacion->total_pagina() < $pagina_actual){
            header('location:/admin/registrados?page=1');
        }

        $registros = Registro::paginar($registros_por_pagina,$paginacion->offset());

        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id); 
            $registro->paquete = Paquetes::find($registro->paquete_id); 

        }
        
        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios registrados DevWebCamp',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);

    }
}