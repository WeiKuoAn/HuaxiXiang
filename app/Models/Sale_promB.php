<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_promB extends Model
{
    use HasFactory;
    protected $table = "sale_after_prom";

    protected $fillable = [
        'sale_id',
        'after_prom_id',
        'after_prom_total',
    ];

    public function promB_name()
    {
        return $this->hasOne('App\Models\PromB','id','after_prom_id');
    }

    public function sale_data()
    {
        return $this->hasOne('App\Models\Sale','id','sale_id');
    }
}
