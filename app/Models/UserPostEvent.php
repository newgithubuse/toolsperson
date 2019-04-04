<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPostEvent extends Model
{
    protected $table = 'user_post_events';
    protected $guarded = ['id'];
}
