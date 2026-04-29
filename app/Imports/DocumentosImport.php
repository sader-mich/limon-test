<?php

namespace App\Imports;

use App\Models\Documento;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DocumentosImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        // Verificar si el CURP tiene menos de 10 caracteres
        if (strlen($row['curp']) < 10) {
            // Si el CURP es menor a 10 caracteres, excluir el registro
            return null;
        }
        return new Documento([
            'productor' => $row['productor'],
            'CURP' => $row['curp'],
            'ine' => isset($row['ine']) ? $row['ine'] : null,
            'inicio_huerto' => isset($row['inicio_huerto']) ? $row['inicio_huerto'] : null,
            'certificado' => isset($row['certificado']) ? $row['certificado'] : null,
            'correo' => isset($row['correo']) ? $row['correo'] : null,
            'lada' => $row['lada'],
            'telefono' => $row['telefono'],
            'identificador' => $row['identificador'],
            'estatus' => isset($row['estatus']) ? $row['estatus'] : 'Pendiente',
            'observaciones' => isset($row['observaciones']) ? $row['observaciones'] : 'Sin observaciones',
        ]);
    }

    public function rules(): array
    {
        return [
            'productor' => ['required', 'regex:/^[A-Za-zÀ-ÿ .]+$/'],
            'curp' => ['required'],
            'ine' => ['nullable'],
            'inicio_huerto' => ['nullable'],
            'certificado' => ['nullable'],
            'lada' => ['required', 'numeric', 'digits:3'],
            'telefono' => ['required', 'numeric', 'digits:7'],
            'identificador' => ['required','unique:documentos,identificador'],
            'estatus' => ['nullable'],
            'observaciones' => ['nullable'],
        ];
    }
}