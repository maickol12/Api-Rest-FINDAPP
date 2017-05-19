<?php
  class Tiempo extends Illuminate\Database\Eloquent\Model{
    protected $table = 'tiempo';
    protected $hidden = array('created_at','updated_at');
    protected $primaryKey = 'id';
  }
?>
