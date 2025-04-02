<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path){
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

function isAuth(){
    if(!isset($_SESSION)){
        session_start();
    }
    
    return isset($_SESSION['nombre']) && !empty($_SESSION);

}

function isAdmin(){
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aosanimacion() : void{
    $efectos = [
        'fade-up',
        'fade-right',
        'fade-up-right',
        'fade-down-right',
        'zoom-in-up',
        'zoom-in-left'
    ];

    $efecto = array_rand($efectos , 1);
    echo $efectos[$efecto];
}