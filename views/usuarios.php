<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  $app->get('/usuarios',function(Request $req,Response $res,$args){
    $usuarios = Usuario::get();
    if(count($usuarios)<=0) return sendResponse(json_encode(array('message'=>'No se encontro nada')),$res,404);
    sendResponse($usuarios->toJson(),$res,200);
  });
  $app->get('/usuarios/{id}',function(Request $req,Response $res,$args){
    $id = $args['id'];
    $usuarios = Usuario::where('id','=',$id)->get();
    if(count($usuarios)<=0) return sendResponse(json_encode(array('message'=>'No se encontro')),$res,404);
    sendResponse($usuarios->toJson(),$res,200);
  });
  $app->post('/usuarios',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $usuario = new Usuario();
    $usuario->nombre = $data['nombre'];
    $usuario->apellidos = $data['apellidos'];
    $usuario->correo = $data['correo'];
    $usuario->foto_perfil = $data['foto_perfil'];
    $usuario->telefono = $data['telefono'];
    $usuario->id_facebook = $data['id_facebook'];
    $usuario->c_genero_id = $data['c_genero_id'];

    if($usuario->save()) return sendResponse($usuario->toJson(),$res,200);
    sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
  });

?>
