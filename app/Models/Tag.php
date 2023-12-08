<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    protected $guarded = [''];
    use HasFactory;
    use SoftDeletes;
    public function ManyWithBlogs() {
        return $this->belongsToMany(Blog::class);
    }
}
