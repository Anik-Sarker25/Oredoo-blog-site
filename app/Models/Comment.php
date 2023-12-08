<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function reletionwithreply() {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
