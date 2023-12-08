<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [''];
    use HasFactory;
    public function RelationWithUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function RelationWithCategory() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function ManyWithTags() {
        return $this->belongsToMany(Tag::class);
    }

}
