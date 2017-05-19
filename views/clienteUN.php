<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  $app->get('/negocio/clienteUN/{NegocioId}',function(Request $req,Response $res,$args){
    $NegocioId = $args['NegocioId'];
    $clienteun = ClienteUN::where('negocio_id','=',$NegocioId)->where('habilitado','=',1)->get();
    if($clienteun->isEmpty()) return sendResponse(json_encode(array('message'=>'No se encontro')),$res,404);
    sendResponse($clienteun->toJson(),$res,200);
  });
  $app->get('/negocio/clienteUN/id/{id}',function(Request $req,Response $res,$args){
    $id = $args['id'];
    $cliente = ClienteUN::where('id','=',$id)->where('habilitado','=',1)->get();
    if($cliente->isEmpty()) return sendResponse(json_encode(array('message'=>'No se encontro')),$res,404);
    sendResponse($cliente->toJson(),$res,200);
  });
  $app->post('/negocio/clienteUN',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $cun = ClienteUN::where('correo','=',$data['correo'])->get();
    if(count($cun)>0) return sendResponse(json_encode(array('message'=>'Ese correo ya existe')),$res,500);
    
    $cliente = new ClienteUN();
    $cliente->nombre = $data['nombre'];
    $cliente->apellidos = $data['apellidos'];
    $cliente->correo = $data['correo'];
    $cliente->contrasena = $data['contrasena'];
    $cliente->foto = $data['foto'];
    $cliente->habilitado = 1;
    $cliente->c_tipo_usuario_id = $data['c_tipo_usuario_id'];
    $cliente->negocio_id = $data['negocio_id'];
    $cliente->negocio_cliente_id = $data['negocio_cliente_id'];


    if($cliente->save()){
      return sendResponse($cliente->toJson(),$res,200);
    }
    sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
  });
  $app->put('/negocio/clienteUN',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $habilitado = $data['habilidado'];
    $idClienteUN = $data['idUN'];
    $cun = ClienteUN::find($idClienteUN);
    if(count($cun)<=0) return sendResponse(json_encode(array('message'=>'No se encontro')),$res,404);
    $cun->habilitado = $habilitado;
    if($cun->save()) return sendResponse($cun->toJson(),$res,200);
    sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
  });
?>
