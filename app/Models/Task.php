<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'deadline' => 'date',
    ];
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'priority',
        'deadline',
        'status',
        'user_id',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
