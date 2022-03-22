<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStep extends Model
{
    use HasFactory;
    protected $fillable=[
        'sub_step_name','inspection_id' 
    ];

    /**
     * Get the inspection that owns the subtsep.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}
