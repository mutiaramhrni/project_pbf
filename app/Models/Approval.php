<?php

namespace App\Models;

use App\Enums\LetterType;
use App\Enums\Config as ConfigEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_id',
        'user_id',
        'status',
    ];

    // Relationship with Letter
    public function letter()
    {
        return $this->belongsTo(Letters::class, 'letter_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}