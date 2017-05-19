<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  $app->get('/negocio/tiempo',function(Request $req,Response $res,$args){
    $tiempo = Tiempo::get();
    if(count($tiempo)<=0) return sendResponse(json_encode(array('message'=>'No se encontaron tiempos')),$res,500);
    sendResponse($tiempo->toJson(),$res,200);
  });
  $app->post('/negocio/tiempo',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $tiempo = new Tiempo();
    $tiempo->cantidad_clientes = $data['cantidad_clientes'];
    $tiempo->tiempo_fisico = $data['tiemp_fisico'];
    $tiempo->tiempo_domicilio = $data['tiempo_domicilio'];
    $tiempo->c_color_id = $data['c_color_id'];
    $tiempo->negocio_id = $data['negocio_id'];

    if($tiempo->save()){
      return sendResponse($tiempo->toJson(),$res,200);
    }
    sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
  });
  $app->put('/negocio/tiempo/{idTiempo}',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $idTiempo = $args['idTiempo'];
    $tiempo = Tiempo::where('id','=',$idTiempo)->first();
    $tiempo->cantidad_clientes = $data['cantidad_clientes'];
    $tiempo->tiempo_fisico = $data['tiemp_fisico'];
    $tiempo->tiempo_domicilio = $data['tiempo_domicilio'];
    $tiempo->c_color_id = $data['c_color_id'];
    $tiempo->negocio_id = $data['negocio_id'];
    if($tiempo->save()){
      return sendResponse($tiempo->toJson(),$res,200);
    }
    return sendResponse(json_encode(array('message'=>'No se encontro el registro')),$res,500);

  });

?>
