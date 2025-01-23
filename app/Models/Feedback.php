<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Add 'user_id' to the fillable property
    protected $fillable = ['user_id', 'feedback', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}