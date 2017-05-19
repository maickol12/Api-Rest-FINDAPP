<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  $app->get('/favoritos',function(Request $req,Response $res,$args){
    $fav = Favoritos::get();
    if(empty($fav)) return sendResponse(json_encode(array('message'=>'no se encontro nada')),$res,404);
    sendResponse($fav->toJson(),$res,200);
  });
  $app->get('/favoritos/{id}',function(Request $req,Response $res,$args){
    $id = $args['id'];
    $fav = Favoritos::where('id','=',$id)->get();
    if($fav->isEmpty()) return sendResponse(json_encode(array('message'=>'no se encontro nada')),$res,500);
    sendResponse($fav->toJson(),$res,200);
  });
  $app->post('/favoritos',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $fav = new Favoritos();
    $fav->usuario_id = $data['usuario_id'];
    $fav->negocio_id = $data['negocio_id'];
    if($fav->save()) return sendResponse($fav->toJson(),$res,200);
    sendResponse(json_encode(array('message'=>'ocurrio un error')),$res,500);
  });
?>
