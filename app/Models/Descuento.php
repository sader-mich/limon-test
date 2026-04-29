<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'producer_id',
        'toneladas'
    ];

    protected $table = "descuentos";
    public $timestamps = true;

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id');
    }


}
