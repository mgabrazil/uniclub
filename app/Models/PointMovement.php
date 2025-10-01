<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'sale_id',
        'transaction_type',
        'points',
        'description',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
