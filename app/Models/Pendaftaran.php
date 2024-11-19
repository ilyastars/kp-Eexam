<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    /** @use HasFactory<\Database\Factories\PendaftaranFactory> */
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the skema that owns the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class);
    }

    /**
     * Get the jadwal that owns the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class)->withDefault();
    }

    /**
     * Get the transaksi associated with the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaksi(): HasOne
    {
        return $this->hasOne(Transaksi::class);
    }
}
