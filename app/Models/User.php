<?php

namespace Vchat\Models;

use Vchat\Models\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
   use Authenticatable;
   protected $table = 'users'; 
   
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    
    protected $hidden = [
        'password',
         'remember_token',
    ];

    //get the users name or username
    public function getName(){
        if ($this->first_name && $this->last_name){
            //if first or last name exists
            return "{$this->first_name} {$this->last_name}";
        }
        //if only firstname exists
        if($this->first_name){
            return $this->first_name;
        }
        //otherwise
        return null;
    }
    
    public function getNameOrUsername(){
        return $this->getName() ?: $this->username;
    }
    public function getFirstNameOrUsername(){
        return $this->first_name ?: $this->username;
    }

    //using gravatar
    //mm = mystery man 
    public function getAvatarUrl($size = 30){
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=$size";
    }

    //creates a relationship between user and statuses
    public function statuses(){
        return $this->hasMany('Vchat\Models\Status', 'user_id');
        //vchat\models\user_id is the path to the model i created for user status that will be inserted into dbase
           //user_id is the foreign key 
    }

    public function likes(){
        return $this->hasMany('Vchat\Models\Like', 'user_id');
    }

    public function friendsOfMine(){
        //these are the user's friends
//friend_id is the foreign key
       return $this->belongsToMany('Vchat\Models\User', 'friends', 'user_id', 'friend_id');

    }
    public function friendOf(){
        //these are friends who has the user as a friends also
        //paramters (model, pivot_table,)
        return $this->belongsToMany('Vchat\Models\User', 'friends', 'friend_id', 'user_id');
 
     }

     public function friends(){
         //General method for general users' friends
         //pivot = friends table
         //merging the friendOf and Frie9ndofmine relationship
         return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
     }

     //viewing friend requests
     //those whose friend requts are yet to be accepted
     public function friendRequests(){
         return $this->friendsOfMine()->wherePivot('accepted', false)->get();
     }

     public function friendRequestsPending(){
         return $this->friendOf()->wherePivot('accepted', false)->get();
     }

     public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            //first() refers to the user we fetched from
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    //determine if a user has liked something
    public function hasLikedStatus(Status $status){
        // return (bool) $status->likes
        // ->where('likeable_id', $status->id) //where likeable = status_id
        // ->where('likeable_type', get_class($status))
        // ->where('user_id', $this->id)
        // ->count();   Refactoring this code gives us below
        return (bool) $status->likes->where('user_id', $this->id)->count();
    }
}
