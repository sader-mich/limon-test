<?php

namespace App\Imports;

use App\Models\Producer;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProducersImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;

    // Store imported producers
    protected $importedProducers = [];

    // Función para convertir fecha de Excel (número de serie) a formato Y-m-d
    public function convertExcelDateToDateString($excelDate)
    {
        if (is_numeric($excelDate)) {
            // Excel empieza desde 1900-01-01, y los números representan días desde esa fecha
            $unixDate = ($excelDate - 25569 + 1) * 86400; // Convertir a segundos Unix
            return date('Y-m-d', $unixDate); // Regresar la fecha en formato YYYY-MM-DD
        }

        // Si ya es una fecha válida o texto en formato adecuado, lo retornamos directamente
        return $excelDate;
    }

    // Create a new producer from each row and store it in the importedProducers array
    public function model(array $row)
    {
        // Create the Producer model instance
        $producer = new Producer([
            'documento_id' => $row['documento_id'],
            'municipio' => $row['municipio'],
            'localidad' => $row['localidad'],
            'huerto' => $row['huerto'],
            'latitud' => $row['latitud'],
            'longitud' => $row['longitud'],
            'especie' => $row['especie'],
            'toneladas' => isset($row['toneladas']) ? $row['toneladas'] : 0,
            'descuento' => isset($row['descuento']) ? $row['descuento'] : 0,
            'urlcard' => $row['urlcard'],
            'urlqr' => $row['urlqr'],
            'fecha_alta' => isset($row['fecha_alta']) ? $this->convertExcelDateToDateString($row['fecha_alta']) : null, 
            'siembra_id' => isset($row['siembra_id']) ? $row['siembra_id'] : 'NA',
            'predio' => isset($row['predio']) ? $row['predio'] : 'NA',
            'no_ha' => $row['no_ha'],
            'edad_siembra' => $row['edad_siembra'],
            'propia_renta' => isset($row['propia_renta']) ? $row['propia_renta'] : 'PROPIA',
            'vencimiento' => isset($row['vencimiento']) ? $row['vencimiento'] : 'NA',
        ]);

        // Save the producer to the database
        $producer->save();

        // Store the imported producer in the array
        $this->importedProducers[] = $producer;

        return $producer; // Return the producer model
    }

    // Get the list of imported producers
    public function getImportedProducers()
    {
        return $this->importedProducers;
    }

    // Validation rules (you can customize this if needed)
    public function rules(): array
    {
        return [
            'documento_id' => ['required','unique:producers,documento_id'],
            'municipio' => ['required', 'string'],
            'localidad' => ['required','string'],
            'fecha_alta' => ['required'],
            'huerto' => ['required', 'string'],
            'latitud' => ['required', 'numeric', 'min:-90', 'max:90'],
            'longitud' => ['required', 'numeric', 'min:-180', 'max:180'],
            'urlcard' => ['required', 'regex:/^Card\/[a-zA-ZÀ-ÿ0-9_ .]+(_[A-Za-zÀ-ÿ0-9]+)?\.png$/'],
            'urlqr' => ['required', 'regex:/^CodeQr\/[A-Za-zÀ-ÿ0-9_ .]+(_[A-Za-zÀ-ÿ0-9]+)?(_QR)?\.png$/'],
            'siembra_id' => ['nullable'],
            'predio' => ['nullable'],
            'no_ha' => ['required'],
            'edad_siembra' => ['required'],
            'especie' => ['required'],
            'propia_renta' => ['nullable'],
            'vencimiento' => ['nullable'],
            'toneladas' => ['required', 'numeric', 'min:0'],
            'descuento' => ['nullable'],
            
        ];
    }
}

