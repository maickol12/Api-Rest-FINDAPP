<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app->get('/negocios',function(Request $req,Response $res,$args){
	   $ciudades = Negocio::get();
	    return sendOkResponse($ciudades->toJson(),$res,200);
	});
  $app->post('/negocios',function(Request $req,Response $res,$args){
   $data = $req->getParsedBody();
   $negocio = new Negocio();
   $negocio->nombre = ucfirst($data['nombre']);
   $negocio->descripcion = ucfirst($data['descripcion']);
   $negocio->logo = ucfirst($data['logo']);
   $negocio->portada = $data['portada'];
   $negocio->direccion = $data['direccion'];
   $negocio->cordenadas_latitud = $data['lat'];
   $negocio->cordenadas_altitud = $data['lng'];
   $negocio->facebook_id = $data['facebook_id'];
   $negocio->web_url = $data['web_url'];
   $negocio->telefono1 = $data['telefono1'];
   $negocio->telefono2 = $data['telefono2'];
   $negocio->cliente_id = $data['cliente_id'];
   $negocio->ciudad_id = $data['ciudad_id'];
   if($negocio->save()){
     return sendResponse($negocio->toJson(),$res,200);
   }
   sendResponse(json_encode(array('message'=>'error')),$res,500);
 });
 $app->get('/negocios/{idNegocio}',function(Request $req,Response $res,$args){
   $idNegocio = $args['idNegocio'];
   $negocio = Negocio::findOrFail($idNegocio);
   sendOkResponse($negocio->toJson(),$response,200);
 });

?>
