<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	/*$app->get('/clientes',function(Request $request,Response $response,$args){
		$clientes = Cliente::select('idcliente','nombre','apellidos','numero_cuenta')->get();

		return sendOkResponse($clientes->toJson(),$response);
	});*/
	$app->get('/clientes/{limit1}/{limit2}',function(Request $request,Response $response,$args){
		$clientes = Cliente::with('ciudad')->get();

		return sendOkResponse($clientes->toJson(),$response);
	});

	$app->post('/clientes',function(Request $request,Response $response,$args){
		$data = $request->getParsedBody();


		$clientes = new Cliente();
		$clientes->nombre = ucfirst($data['nombre']);
		$clientes->apellidos = ucfirst($data['apellidos']);
		$clientes->numero_cuenta = $data['numero_cuenta'];
		$clientes->id_ciudad = $data['id_ciudad'];
		$clientes->save();


		return $response->getBody()->write($clientes->idcliente);
	});
	$app->put('/clientes/{id}',function(Request $request,Response $response,$args){
		$data = $request->getParsedBody();

		$clientes = Cliente::findOrFail($args['id']);
		$clientes->nombre = $data['nombre'];
		$clientes->apellidos = $data['apellidos'];
		$clientes->numero_cuenta = $data['numero_cuenta'];
		$clientes->id_ciudad = $data['id_ciudad'];
		$clientes->save();

		return print_r(sendOkResponse($clientes->toJson(),$response));
	});
	$app->put('/clientes/delete/{id}',function(Request $request,Response $response,$args){
		$clientes = Cliente::where('idcliente',"=",$args['id'])->firstOrFail();
		$clientes->delete();
		return print_r(sendOkResponse($clientes->toJson(),$response));
	});
	$app->get('/clientes/find/{id}',function(Request $request,Response $response,$args){
		$clientes = Cliente::where('idcliente',$args['id'])->firstOrFail();
		return sendOkResponse($clientes->toJson(),$response);
	});
?>
