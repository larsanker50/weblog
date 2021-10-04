<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'email'];

    public function getRouteKeyName() {
        return 'username';
    }

    public function posts() {
        return $this->hasMany(Posts::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedbacks::class);
    }

}
