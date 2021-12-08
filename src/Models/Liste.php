<?php
namespace wishlist\Models;
class Liste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'liste';
    protected $primaryKey = 'no';
    public $timestamps = false;

    public function items(){
        return $this->hasMany('\models\Item', 'liste_id');
    }
}
