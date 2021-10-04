<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    
    public function catagories() {
        return $this->belongsToMany(Catagories::class);
    }

    public function users() {
        return $this->belongsTo(Users::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedbacks::class, 'post_id');
    }

    public function images() {
        return $this->hasOne(Images::class);
    }

}
