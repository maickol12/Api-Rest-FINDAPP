<?php
  class Usuario extends Illuminate\Database\Eloquent\Model{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $hidden = array('updated_at','created_at');
  }

?>
