<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromB extends Model
{
    use HasFactory;
    protected $table = "after_prom";

    protected $fillable = [
        'name',
        'status'
    ];
}
