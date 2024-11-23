<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason', 'start_date', 'end_date', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
