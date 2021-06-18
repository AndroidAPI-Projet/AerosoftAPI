<?php

require './altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', function() {
    echo "Aerosoft API";
});

$router->map('GET', '/vol', function() {
    require __DIR__ . '/api/vol/read.php';
});

$router->map('GET', '/vol/[a:NumVol]', function($NumVol) {
    require __DIR__ . '/api/vol/singleRead.php';
});

$router->map('POST', '/vol/create', function() {
    require __DIR__ . '/api/vol/create.php';
});

$router->map('POST', '/vol/update', function() {
    require __DIR__ . '/api/vol/update.php';
});

$router->map('POST', '/vol/delete', function() {
    require __DIR__ . '/api/vol/delete.php';
});

$router->map('GET', '/pilote', function() {
    require __DIR__ . '/api/pilote/read.php';
});

$router->map('GET', '/pilote/[i:IdPilote]', function($IdPilote) {
    require __DIR__ . '/api/pilote/singleRead.php';
});

$router->map('GET', '/avion', function() {
    require __DIR__ . '/api/avion/read.php';
});

$router->map('GET', '/avion/[i:IdAvion]', function($IdAvion) {
    require __DIR__ . '/api/avion/singleRead.php';
});

$router->map('GET', '/affectation', function() {
    require __DIR__ . '/api/affectation/read.php';
});

$router->map('GET', '/affectation/[:IdAffectation]', function($IdAffectation) {
    require __DIR__ . '/api/affectation/singleRead.php';
});

$router->map('GET', '/aeroport', function() {
    require __DIR__ . '/api/aeroport/read.php';
});

$router->map('GET', '/aeroport/[a:IdAeroport]', function($IdAeroport) {
    require __DIR__ . '/api/aeroport/singleRead.php';
});

$router->map('GET', '/utilisateur', function() {
    require __DIR__ . '/api/utilisateur/read.php';
});

$router->map('GET', '/utilisateur/[i:IdUtilisateur]', function($IdUtilisateur) {
    require __DIR__ . '/api/utilisateur/singleRead.php';
});

$router->map('POST', '/utilisateur/login', function($IdUtilisateur) {
    require __DIR__ . '/api/utilisateur/login.php';
});

$router->map('GET', '/role', function() {
    require __DIR__ . '/api/role/read.php';
});

$router->map('GET', '/role/[i:IdRole]', function($IdRole) {
    require __DIR__ . '/api/role/singleRead.php';
});

$match = $router->match();

if($match) {
	$match['target']($match['params']);
} else {
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}