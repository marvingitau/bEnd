<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    // protected $fillable=[
    //     'title','description','user_id'
    // ];
    protected $guarded =[];


    public function task(){
       return $this->hasMany(Task::class);
    }
}
