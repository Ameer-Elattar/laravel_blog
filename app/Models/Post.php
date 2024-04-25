<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ["title", "body","user_id",'image'] ;

    function user(){
        return $this->belongsTo(User::class);
    }
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = basename(Storage::putFile('public/images', $value));
    }
    public function deleteImage()
    {
        if ($this->image) {
            Storage::delete('public/images/' . $this->image);
        }
    }
    public function comments()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('content');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
