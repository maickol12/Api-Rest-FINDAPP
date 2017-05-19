<?php
  class Cliente extends Illuminate\Database\Eloquent\Model{
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $hidden = array('created_at','updated_at');
  }
?>
