<?php
  class Horario extends Illuminate\Database\Eloquent\Model{
    protected $table = 'horario';
    protected $primaryKey = 'id';
    protected $hidden = array('created_at','updated_at');
  }
?>
