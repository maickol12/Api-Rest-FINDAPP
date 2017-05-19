<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/horarios',function(Request $req,Response $res,$args){
      $horarios = Horario::get();
      if(count($horarios)<=0) return sendResponse(json_encode(array('message'=>'No se encontraron horarios')),$res,404);
      sendResponse($horarios->toJson(),$res,200);
    });
    $app->post('/horarios',function(Request $req,Response $res,$args){
      $data = $req->getParsedBody();
      $horario = new Horario();
      $horario->hora_abrir = $data['hora_abrir'];
      $horario->hora_cerrar = $data['hora_cerrar'];
      $horario->negocio_id = $data['negocio_id'];
      $horario->c_dia_id = $data['c_dia_id'];

      if($horario->save()){
        return sendResponse($horario->toJson(),$res,200);
      }
      sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);

    });
    $app->put('/horarios',function(Request $req,Response $res,$args){
      $data = $req->getParsedBody();
      $horario = Horario::where('id','=',$data['idHorario'])->first();
      $horario->hora_abrir = $data['hora_abrir'];
      $horario->hora_cerrar = $data['hora_cerrar'];
      $horario->negocio_id = $data['negocio_id'];
      $horario->c_dia_id = $data['c_dia_id'];

      if($horario->save()){
        return sendResponse($horario->toJson(),$res,200);
      }
      sendResponse(json_encode(array('message'=>'Ocurrio un error')),$res,500);
    });

?>
