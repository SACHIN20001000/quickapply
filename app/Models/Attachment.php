<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = ['lead_id','policy_id','user_id','file_name','type'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
