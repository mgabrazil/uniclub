<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'vendor_id',
        'amount',
        'points_earned',
        'points_redeemed',
        'final_amount',
        'reference_number',
        'description',
        'status',
    ];

    protected static function booted(): void
    {
        static::created(function (Sale $sale) {
            if (is_null($sale->reference_number)) {
                $sale->reference_number = '#' . str_pad($sale->id, 4, '0', STR_PAD_LEFT);
                $sale->saveQuietly();
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function pointMovements()
    {
        return $this->hasMany(PointMovement::class);
    }
}
