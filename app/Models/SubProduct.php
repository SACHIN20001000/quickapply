<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    use HasFactory;
    protected $fillable = ['name','product_id','insurance_id'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function insurances()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
