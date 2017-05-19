<?php
	require 'vendor/autoload.php';
	require 'conection.php';
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$c = new \Slim\Container();
	$c['errorHandler'] = function ($c) {
	    return function ($request, $response, $exception) use ($c) {
	    	$error = array('error' => $exception->getMessage());
	      return $c['response']->withStatus(500)
	                             ->withHeader('Content-Type', 'application/json')
	                             ->write(json_encode($error));
	    };
	};

	$app = new \Slim\App($c);
	require 'utils.php';
	require 'views/negocio.php';
	require 'views/cliente.php';
	require 'views/horario.php';
	require 'views/tiempo.php';
	require 'views/clienteUN.php';
	require 'views/usuarios.php';
	require 'views/favoritos.php';


	$app->run();

?>
