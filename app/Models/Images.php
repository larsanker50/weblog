<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];

    public function posts()
    {
        return $this->belongsToOne(Posts::class);
    }
}
