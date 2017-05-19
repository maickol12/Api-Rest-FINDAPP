<?php
  class ClienteUN extends Illuminate\Database\Eloquent\Model{
    protected $table = 'cliente_usuario_negocio';
    protected $primaryKey = 'id';
    protected $hidden = array('created_at','updated_at');
  }
?>
