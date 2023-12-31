<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
        'image_path',
        'os',
        'cost',
        'weight',
        'battery',
        'user_id',
        'purchase_path',
        'star_rating',
    ];
    
    public static $rules = [
        'title' => 'required|string|max:100',
        'body' => 'nullable|string|max:300',
        'image_path' => 'nullable|string|max:255',
        'os' => 'required|string|max:10',
        'cost' => 'required|string|max:20',
        'weight' => 'required|string|max:10',
        'battery' => 'required|string|max:10',
        'user_id' => 'required|integer|exists:users,id', 
        'purchase_path' => 'nullable|string|max:600',
        'star_rating' => 'required|string|max:255',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }    
    
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
    }
    
    public function likeCount()
    {
        return $this->likedBy()->count();
    }
    
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }
    
    public function getByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
}
