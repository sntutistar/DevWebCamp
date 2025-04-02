<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\ApiPonentesController;
use Controllers\ApiRegalos;
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventosController;
use Controllers\PaginasController;
use Controllers\PonentesController;
use Controllers\RegalosController;
use Controllers\RegistradosController;
use Controllers\RegistroController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//area de administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

//ponentes dashboard
$router->get('/admin/ponentes', [PonentesController::class, 'ponentes']);
$router->get('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->get('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar', [PonentesController::class, 'eliminar']);

//eventos dashboard
$router->get('/admin/eventos', [EventosController::class, 'eventos']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);

//api eventos
$router->get('/api/eventos-horario',[ApiController::class, 'index']);

//api ponentes
$router->get('/api/ponentes',[ApiPonentesController::class, 'index']);
$router->get('/api/ponente',[ApiPonentesController::class, 'ponente']);

//registro de usuarios
$router->get('/finalizar-registro',[RegistroController::class, 'crear']);

//boleto de compra
$router->post('/finalizar-registro/gratis',[RegistroController::class, 'gratis']);
$router->post('/finalizar-registro/pagar',[RegistroController::class, 'pagar']);
$router->get('/finalizar-registro/conferencias',[RegistroController::class, 'conferencias']);
$router->post('/finalizar-registro/conferencias',[RegistroController::class, 'conferencias']);
$router->get('/boleto',[RegistroController::class, 'boleto']);

//registrados dashboard
$router->get('/admin/registrados', [RegistradosController::class, 'registrados']);

//regalos dashboard
$router->get('/admin/regalos', [RegalosController::class, 'regalos']);

//inicio
$router->get('/', [PaginasController::class, 'index']);
$router->get('/devwebcamp', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/workshops-conferencias', [PaginasController::class, 'conferencias']);

//api regalos
$router->get('/api/regalos', [ApiRegalos::class, 'index']);


//pagina 404
$router->get('/404', [PaginasController::class, 'error']);

$router->comprobarRutas();