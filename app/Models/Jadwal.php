<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalFactory> */
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the pasien that owns the Daftar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class)->withDefault();
    }

    /**
     * Get the peserta associated with the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function peserta(): HasOne
    // {
    //     return $this->hasOne(Peserta::class);
    // }

    /**
     * Get the pendaftaran associated with the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pendaftaran(): HasOne
    {
        return $this->hasOne(User::class);
    }

}
