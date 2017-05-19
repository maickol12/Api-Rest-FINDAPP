<?php
 class Negocio extends Illuminate\Database\Eloquent\Model{
    protected $table = 'negocio';
    protected $primaryKey = 'id';
    protected $hidden = array('created_at','updated_at');
 }

?>
