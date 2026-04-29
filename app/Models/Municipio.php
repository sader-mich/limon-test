<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
    ];

    protected $table = "municipio";
    public $timestamps = false;

    public function localidades()
    {
        return $this->hasMany(Localidad::class, 'municipioid', 'id');
    }

    public function producers()
    {
        return $this->hasMany(Producer::class, 'municipio_id', 'id');
    }
}