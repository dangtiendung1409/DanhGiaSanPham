<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommentImage extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'image_url'];

    public function comment() {
        return $this->belongsTo(ProductComment::class, 'comment_id');
    }
}

