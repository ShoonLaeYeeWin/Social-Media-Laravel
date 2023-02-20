<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comments';
    protected $fillable = ['post_id','user_id','comment',];

    public function comment()
    {
        return $this->belongsTo(User::class);
    }
}
