<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  $app->get('/clientes',function(Request $req,Response $res,$args){
    $clientes = Cliente::where('habilitado',1)->get();
    if($clientes->isEmpty()) return sendResponse(json_encode(array('message'=>'no se encontro')),$res,404);

    sendResponse($clientes->toJson(),$res,200);
  });
  $app->get('/clientes/{idCliente}',function(Request $req,Response $res,$args){
    $idCliente = $args['clientes'];
    $cliente = Cliente::findOrFail($idCliente);
    sendResponse($cliente->toJson(),$res,200);
  });
  $app->post('/clientes',function(Request $req,Response $res,$args){
      $data = $req->getParsedBody();
      $cliente = Cliente::where('correo',$data['correo'])->get();
      if(count($cliente)>0){
        return sendResponse(json_encode(array('message'=>'Ya existe en la base de datos')),$res,500);
      }
      $cliente = new Cliente();
      $cliente->nombre = $data['nombre'];
      $cliente->apellido_paterno = $data['apellido_paterno'];
      $cliente->apellido_materno = $data['apellido_materno'];
      $cliente->correo = $data['correo'];
      $cliente->contrasena = $data['contrasena'];
      $cliente->registro_facebook = $data['registro_facebook'];
      $cliente->foto = $data['foto'];
      $cliente->tipo = $data['tipo'];
      $cliente->direccion = $data['direccion'];
      $cliente->habilitado = 1;
      $cliente->ciudad_id = $data['ciudad_id'];
      $cliente->c_tipo_cliente_id = $data['c_tiempo_cliente_id'];
      $cliente->c_genero_id = $data['c_genero_id'];

      if($cliente->save()){
        return sendResponse($cliente->toJson(),$res,200);
      }
      sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
  });
  $app->put('/clientes',function(Request $req,Response $res,$args){
    $data = $req->getParsedBody();
    $idCliente = $data['idCliente'];
    $activar = $data['activar'];
    $cliente = Cliente::where('id','=',$idCliente)->first();
    if(count($cliente)>0){
      $cliente->habilitado = $activar;
      $cliente->save();
      return sendResponse($cliente->toJson(),$res,200);
    }
    sendResponse(json_encode(array('message','No se encontro el cliente '.$idCliente)),$res,500);
  });
?>
