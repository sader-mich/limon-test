<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento_id',
        'municipio',
        'localidad',
        'huerto',
        'latitud',
        'longitud',
        'especie',
        'toneladas',
        'descuento',
        'urlqr',
        'urlcard',
        'fecha_alta',
        'siembra_id',
        'predio',
        'no_ha',
        'edad_siembra',
        'propia_renta',
        'vencimiento'
    ];

    protected $table = "producers";
    public $timestamps = true;

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id');
    }


}
