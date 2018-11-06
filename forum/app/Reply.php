<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
   //The following assignement gets rid of
   //Illuminate\Database\Eloquent\MassAssignmentException: body
   protected $guarded = [];
   
   public function owner()
   {
       return $this->belongsTo(User::class, 'user_id');
   }
}
