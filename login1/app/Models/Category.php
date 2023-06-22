<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    //faccio la relazione inversa categories ha tanti posts
    //quindi la funzione e' al plurale

    public function posts (){

        return $this->hasMany(Post::class);
    }
}