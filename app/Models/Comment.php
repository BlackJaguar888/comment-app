<?php

namespace App\Models;

use App\Collections\CommentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'reply_id',
        'level',
        'text'
    ];

    // Relation to itself
    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id')->with('replies');
    }
}
