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

class Letters extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'id_penerima',
        'tanggal_event',
        'perihal',
        'agenda',
        'lampiran',
        'user_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with User (Recipient)
    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima');
    }

     // Relationship with Approval
     public function approvals()
     {
         return $this->hasMany(Approval::class, 'letter_id');
     }
    
    /**
     * @var string[]
     */
    protected $casts = [
        'letter_date' => 'date',
        'received_date' => 'date',
    ];

    protected $appends = [
        'formatted_letter_date',
        'formatted_received_date',
        'formatted_created_at',
        'formatted_updated_at',
    ];

    public function getFormattedLetterDateAttribute(): string {
        return Carbon::parse($this->letter_date)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedReceivedDateAttribute(): string {
        return Carbon::parse($this->received_date)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedCreatedAtAttribute(): string {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    public function getFormattedUpdatedAtAttribute(): string {
        return $this->updated_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }
   

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', now());
    }

    public function scopeYesterday($query)
    {
        return $query->whereDate('created_at', now()->addDays(-1));
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query, $find) {
            return $query
                ->where('id', $find)
                ->orWhere('nomor_surat', $find)
                ->orWhere('pengirim', 'LIKE', $find . '%')
                ->orWhere('penerima', 'LIKE', $find . '%')
                ->orWhere('tanggal_event', 'LIKE', $find . '%')
                ->orWhere('perihal', 'LIKE', $find . '%');
        });
    }

    // public function scopeRender($query, $search)
    // {
    //     return $query
    //         ->with(['attachments', 'classification'])
    //         ->search($search)
    //         ->latest('letter_date')
    //         ->paginate(Config::getValueByCode(ConfigEnum::PAGE_SIZE))
    //         ->appends([
    //             'search' => $search,
    //         ]);
    // }

    public function scopeAgenda($query, $since, $until, $filter)
    {
        return $query
            ->when($since && $until && $filter, function ($query, $condition) use ($since, $until, $filter) {
                return $query->whereBetween(DB::raw('DATE(' . $filter . ')'), [$since, $until]);
            });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return HasMany
     */
    // public function dispositions(): HasMany
    // {
    //     return $this->hasMany(Disposition::class, 'letter_id', 'id');
    // }

    /**
     * @return HasMany
     */
    
}