<?php

namespace App\Models;

use App\Models\Cases;
use App\Models\Challan;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Prahari extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'Prahari',
        'Mobile',
        'AadhaarStatus',
        'Bank_account_detail',
        'status',
        'language',
        'notifications_enabled'
    ];

    public function cases() {
        return $this->hasMany(Cases::class);
    }

    public function challans() {
        return $this->hasMany(Challan::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
