<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skema extends Model
{
    /** @use HasFactory<\Database\Factories\SkemaFactory> */
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the jadwal for the Skema
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    /**
     * Get all of the transaksi for the Skema
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function transaksi(): HasMany
    // {
    //     return $this->hasMany(Transaksi::class);
    // }

    /**
     * Get the pendaftaran associated with the Skema
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function pendaftaran(): HasOne
    // {
    //     return $this->hasOne(Pendaftaran::class);
    // }
    
}
