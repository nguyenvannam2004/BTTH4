<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issues extends Model
{
    use HasFactory;
    protected $fillable = [
        'computer_id', 
        'reported_by', 
        'reported_date', 
        'description', 
        'urgency', 
        'status', 
        'created_at', 
        'updated_at'
    ];
    public function computer()
    {
        return $this->belongsTo(computers::class, 'computer_id');
    }
}
