<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
    ];

    protected $table = "localidades";
    public $timestamps = false;

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipioid', 'id');
    }

    public function producers()
    {
        return $this->hasMany(Producer::class, 'localidad_id', 'id');
    }
}
