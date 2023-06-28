<?php

namespace Routes;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable('./config/env/'); // -> config de el enviroment
$dotenv->load();
$routes = new \Bramus\Router\Router();

$routes->mount('/api/pais', function() use ($routes) {
    
    $routes->get('/', 'app\Controllers\pais_Controller@GetPais');
    $routes->post('/add', 'app\Controllers\pais_Controller@PostPais');
    $routes->delete('/delete', 'app\Controllers\pais_Controller@DeletePais');
    echo"pais";
});


$routes->mount('/api/departamento', function() use ($routes) {
    
    $routes->get('/', 'app\Controllers\departamento_Controller@GetDepartamento');
    $routes->post('/add', 'app\Controllers\departamento_Controller@PostDepartamento');
    $routes->delete('/delete', 'app\Controllers\departamento_Controller@DeleteDepartamento');
    echo"dep";
});

$routes->mount('/api/region', function() use ($routes) {
    
    $routes->get('/', 'app\Controllers\region_Controller@GetRegion');
    $routes->post('/add', 'app\Controllers\region_Controller@PostRegion');
    $routes->delete('/delete', 'app\Controllers\region_Controller@DeleteRegion');
    echo"region";
});

?>