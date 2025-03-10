<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_project extends Model
{
    use HasFactory;


    public $timestamps = false; // Disable timestamps for pivot table

    protected $fillable = ['user_id', 'project_id'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
