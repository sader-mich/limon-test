<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'productor',
        'CURP',
        'ine',
        'inicio_huerto',
        'certificado',
        'correo',
        'lada',
        'telefono',
        'identificador',
        'estatus',
        'observaciones',
    ];

    protected $table = "documentos";
    public $timestamps = true;

    public function producer()
    {
        return $this->hasOne(Producer::class, 'documento_id');
    }
    
}
