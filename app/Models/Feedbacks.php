<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedbacks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'body'];

    public function posts() {
        return $this->belongsToMany(Posts::class, 'user_id');
    }

    public function users() {
        return $this->belongsTo(Users::class);
    }
}
