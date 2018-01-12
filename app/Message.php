<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'attach', 'is_code'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
