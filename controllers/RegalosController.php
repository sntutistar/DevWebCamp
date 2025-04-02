<?php 

namespace Controllers;

use MVC\Router;

class RegalosController{

    public static function regalos(Router $router){
        if(!isAuth()){
            header('location: /');
        }

        if(!isAdmin()){
            header('location: /');
        }

        $router->render('admin/regalos/index', [
            'titulo' => 'Regalos a usuarios DevWebCamp'
        ]);

    }
}