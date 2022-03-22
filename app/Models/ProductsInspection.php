<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsInspection extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id','inspection_id','inspection_steps' 
    ];
}
