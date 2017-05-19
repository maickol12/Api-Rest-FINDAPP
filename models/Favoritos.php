<?php
  class Favoritos extends Illuminate\Database\Eloquent\Model{
    protected $table = 'favoritos';
    protected $hidden = array('updated_at','created_at');
    protected $primaryKey = 'id';
  }
?>
