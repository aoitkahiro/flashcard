<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded = ['id'];
    private $image_path;

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function getImageAttribute($value){
        return isset($this->image_path) ? $this->image_path : no_image_path();
    }
}
