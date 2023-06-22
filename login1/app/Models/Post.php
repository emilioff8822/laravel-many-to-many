<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'category_id',
    'slug',
    'text',
    'date',
    'reading_time',
    'image_path',
    'image_original_name'


    ];
     //creo la relazione con la tabella categories
    //do il nome category che e; il nome della tabella in camelCase al singolare
    public function category(){
    //restiuitsco che apprtiene alla categoria

        return $this->belongsTo(Category::class);
}

        public function tags() {
        return $this->belongsToMany(Tag::class);
        }
    public static function generateSlug($str){

        $slug = Str::slug($str, '-');
        $original_slug = $slug;
        $slug_exixts = Post::where('slug', $slug)->first();
        $c = 1;
        while($slug_exixts){
            $slug = $original_slug . '-' . $c;
            $slug_exixts = Post::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
}