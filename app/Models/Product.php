<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspection; 

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'sku_code',
        'image',
        'nspection_steps'
    ];

    public function inspections()
    {
        return $this->belongsToMany(Inspection::class, 'product_inapection');
    }
}
