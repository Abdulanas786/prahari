<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'prahari_id',
        'bank_account',
        'amount',
        'status',
        'date'
    ];

    public function prahari() {
        return $this->belongsTo(Prahari::class);
    }
}
