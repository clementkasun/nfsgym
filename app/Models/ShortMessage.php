<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'contact_no', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
