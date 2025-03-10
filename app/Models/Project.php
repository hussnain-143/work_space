<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_projects');
    }


}

