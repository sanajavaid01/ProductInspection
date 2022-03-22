<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product; 

class Inspection extends Model
{
    use HasFactory;
    protected $fillable=[
        'heading',
    ];

    /**
     * Get the sub steps for the inspection.
     */
    public function substeps()
    {
        return $this->hasMany(SubStep::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_inapection');
    }
}
