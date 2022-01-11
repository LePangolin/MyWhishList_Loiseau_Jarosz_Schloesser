<?php
namespace wishlist\Models;
class Reservation extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'iditem';
    public $timestamps = false;

    public function reservation(){
        return $this->belongsTo('\models\Item', 'iditem');
    }
}