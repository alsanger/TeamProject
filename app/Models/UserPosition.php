<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'position_id',
        'status_id',
        'resume',
        'is_removed'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
