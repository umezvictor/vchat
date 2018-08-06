<?php
//this Model is for the user's statuses
namespace Vchat\Models;

use Illuminate\Database\Eloquent\Model; //our database handler

class Status extends Model{
    protected $table = 'statuses'; //the table we will insert into
    //the field we will insert into
    protected $fillable = [
        'body'
    ];

    public function user(){
        //specifying d relationship
        return $this->belongsTo('Vchat\Models\User', 'user_id');
    }
//thisis a scope
    public function scopeNotReply($query){
        return $query->whereNull('parent_id');
    }
//relationship for the replies
    public function replies(){
        return $this->hasMany('Vchat\Models\Status', 'parent_id');
    }

    //reference the likeable function
    public function likes(){
        return $this->morphMany('Vchat\Models\Like', 'likeable'); //likeable is the method name in the Like class
    //morphMany allows laravel to detect the model and the id and work out the relationship    
    }
}