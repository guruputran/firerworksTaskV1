<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    use HasFactory;
    protected $table = "rewards";
    public $timestamps = false;
    protected $fillable = [
        'points',
        'order_id',
        'user_id',
        'status'
    ];
}
