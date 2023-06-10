<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{   
    public $timestamps = false;
    use HasFactory;

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id');
    }

    public function genre()
    {
       return $this->belongsTo(Genre::class, 'genre_id');
    }
    public function country()
    {
       return $this->belongsTo(Country::class, 'country_id');
    }
}
