<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Challan;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    protected $fillable = [
        'prahari_id',
        'category_id',
        'Location',
        'evidence_file',
        'status',
        'violation_date',
    ];

    public function prahari() {
        return $this->belongsTo(Prahari::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function challan() {
        return $this->hasOne(Challan::class);
    }
 }
