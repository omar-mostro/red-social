<?php

namespace App\Models;

use App\Traits\HasLikesTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasLikesTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
