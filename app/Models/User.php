<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'role',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Mutator for capitalizing the first letter of the name.
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getPhoneAttribute($value)
    {
        return substr($value, 0, 4) . '-' . substr($value, 4) ;
    }

    public function projects(){
        return $this->belongsToMany(Project::class, 'user_projects');
    }

}
