<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'Type',
        'Amount',
    ];

    public function cases() {
        return $this->hasMany(Cases::class);
    }

    public function challans() {
        return $this->hasMany(Challan::class);
    }
}
