<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;

    protected $fillable = [
        'prahari_id',
        'case_id',
        'category_id',
        'status',
        'Date',
    ];

    public function prahari() {
        return $this->belongsTo(Prahari::class);
    }

    public function case() {
        return $this->belongsTo(Cases::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
