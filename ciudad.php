<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	$app->get('/ciudades',function(Request $request,Response $response,$args){
	$ciudades = Ciudad::get();
	return sendOkResponse($ciudades->toJson(),$response,200);
	});
?>
