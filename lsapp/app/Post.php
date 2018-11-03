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
}
