<?php

namespace wishlist\Models;
class Item extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps =  false;

    function liste(){
        return $this->belongsTo('models\liste' , 'id');
    }

    function reservation(){
        return $this->hasMany('models\reservation', 'iditem');
    }
}
