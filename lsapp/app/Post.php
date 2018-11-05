<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Most of the functions are coming from Model base class.
    
    //By default, $table = posts  (lowercase of the first letter for the Class name + s)
    protected $table = 'posts';
    
    //Primary Key
    public $primaryKey = 'id';
    
    //Timestamps
    public $timestamps = true;
    
    //Relationship:
    //A post always has an user.
    //posts to user is N:1 relationship.
    //one user has many posts.
    //This function will return all posts that belongs to
    //a user.
    public function user(){
        return $this->belongsTo('App\User');
    }
}
