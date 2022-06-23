<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;

    protected $table = "cashs";

    protected $fillable = [
        'id',
        'title',
        'cash_date',
        'price',
        'comment',
    ];

    public function user_name(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
