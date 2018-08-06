<?php
namespace Vchat\Models;

use Illuminate\Database\Eloquent\Model; //our database handler

class Like extends Model{
    protected $table = 'likeable';

    public function likeable(){
        return $this->morphTo(); //means it is polymorphic and can be applied to any model
    }

    //check who liked something
    public function user(){
        return $this->belongsTo('Vchat\Models\User', 'user_id');
        //user_id is the foreign key
    }
}