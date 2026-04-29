<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Imports\DocumentosImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ImportFailed;
use Exception;
use Gate;
class DocumentoController extends Controller
{
    public function __construct()
    {
        // Aplica el middleware auth solo a las funciones específicas
        $this->middleware('auth')->only([ 'destroy', 'index', 'show']);
        
        // Aplica el middleware auth a todas las funciones excepto a las especificadas
        $this->middleware('auth')->except([ 'create', 'store', 'edit', 'update','preregistro','preregistro_edit']);
    }
    //Display a listing of the resource.
    public function index()
    {
        return view('documentos.index', [
            'documentos' => Documento::latest()->get()
        ]);
    }
    public function create()
    {
        return view('documentos.create');
    }
    public function store(StoreDocumentoRequest $request)
    {
        try{
            $data = $request->all();

            //documentos
                $filename = str_replace(' ', '', $data['productor']);

                if($request->hasFile('ine')){
                    $extension =  $request->file('ine')->getClientOriginalName();
                    $data['ine'] = $request->file('ine')->storeAs('public/Files/Productor',$filename.'-INE-'. $extension);
                    $data['ine'] = str_replace("public/", "", $data['ine']);
                }else {
                    $data['ine'] = "";
                }

                if($request->hasFile('inicio_huerto')){
                    $extension =  $request->file('inicio_huerto')->getClientOriginalName();
                    $data['inicio_huerto'] = $request->file('inicio_huerto')->storeAs('public/Files/Productor',$filename.'-HUERTO-'. $extension);
                    $data['inicio_huerto'] = str_replace("public/", "", $data['inicio_huerto']);
                }else {
                    $data['inicio_huerto'] = "";
                }

                if($request->hasFile('certificado')){
                    $extension =  $request->file('certificado')->getClientOriginalName();
                    $data['certificado'] = $request->file('certificado')->storeAs('public/Files/Productor',$filename.'-CERTIFICADO-'. $extension);
                    $data['certificado'] = str_replace("public/", "", $data['certificado']);
                }else {
                    $data['certificado'] = "";
                }

                
                $prefijo = strtoupper(substr($data['productor'], 0, 2));
                $palabras = preg_split('/\s+/', trim($data['productor']));
                $palabras = array_filter($palabras, fn($p) => $p !== '');

                if (isset($palabras[1])) {
                    // Toma las primeras dos letras de la segunda palabra
                    $prefijo = strtoupper(substr($palabras[1], 0, 2));
                } else {
                    // Si no hay una segunda palabra, manejarlo de alguna manera
                    $prefijo = 'NA';  // O cualquier valor por defecto que necesites
                }
                do {
                    $identificador = $prefijo . date('dmy') . rand(100, 999);
                } while (Documento::where('identificador', $identificador)->exists());
                $data['identificador'] = $identificador;
                $data['estatus'] = 'Aprobado';
                
                
                $create = Documento::create($data);

        }catch(Exception $e){
            if(isset($data['ine'])){
                Storage::delete('public/'.$data['ine']);
            }
            if(isset($data['inicio_huerto'])){
                Storage::delete('public/'.$data['inicio_huerto']);
            }
            if(isset($data['certificado'])){
                Storage::delete('public/'.$data['certificado']);
            }
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('documentos.index');
        }

        $registro = Documento::latest()->first();

        activity()
                ->performedOn($create)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $create->attributesToArray()])
                ->log('El pre registro se ha guardado');

        if(Auth::check()){
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addSuccess('Se agrego un pre registro');
            return redirect()->route('documentos.index');

            return view('documentos.index', [
                'documentos' => Documento::latest()->get()
            ]);
        }
        return view('documentos.message', [
            'registro' => $registro
        ]);
    }
    public function show(Documento $documento)
    {
        return view('documentos.show', [
            'documento' => $documento
        ]);
    }
    //Show the form for editing the specified resource.
    public function edit(Documento $documento)
    {
        return view('documentos.edit', [
            'documento' => $documento
        ]);
    }
    //Update the specified resource in storage.
    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {
        try {
            $data = $request->all();

            $path1 = $documento->ine;
            $path2 = $documento->ficha;
            $path3 = $documento->huerto;
            $path4 = $documento->certificado;

            //evidencias
            $filename = str_replace(' ', '', $data['productor']);

            if($request->hasFile('ine')){
                Storage::delete('public/'.$documento->ine);
                $extension = $request->file('ine')->getClientOriginalName();
                $data['ine'] = 'Files/Productor/'.$filename.'-INE-'. $extension;
                $request->file('ine')->storeAs('public/Files/Productor',$filename.'-INE-'. $extension);
            }else{
                $request['ine'] = $path1;
                /*
                if($request->CURP == "" && $path1 == ""){
                    notyf()
                    ->position('y', 'top')
                    ->position('x', 'center')
                    ->duration(15000)
                    ->addError('Debe proporcionar al menos uno de los siguientes identificadores: INE o CURP.');
                return back();
                }
                */
            }
            if($request->hasFile('inicio_huerto')){
                Storage::delete('public/'.$documento->inicio_huerto);
                $extension = $request->file('inicio_huerto')->getClientOriginalName();
                $data['inicio_huerto'] = 'Files/Productor/'.$filename.'-HUERTO-'. $extension;
                $request->file('inicio_huerto')->storeAs('public/Files/Productor',$filename.'-HUERTO-'. $extension);
            }else{
                $request['inicio_huerto'] = $path3;
            }
            if($request->hasFile('certificado')){
                Storage::delete('public/'.$documento->certificado);
                $extension = $request->file('certificado')->getClientOriginalName();
                $data['certificado'] = 'Files/Productor/'.$filename.'-CERTIFICADO-'. $extension;
                $request->file('certificado')->storeAs('public/Files/Productor',$filename.'-CERTIFICADO-'. $extension);
            }else{
                $request['certificado'] = $path4;
            }
            $documento->update($data);

        } catch(Exception $e) {
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente.');
            return redirect()->route('documentos.index');
        }
        if(Auth::check()){
            activity()
                ->performedOn($documento)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $documento->attributesToArray()])
                ->log('Se actualizo un pre registro');
        }else{
            activity()
                ->performedOn($documento)
                ->withProperties(['attributes' => $documento->attributesToArray(), 'guest_id' => 'guest_' . uniqid()])
                ->log('Productor editó su pre registro.');
        }
        
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El registro se ha actualizado.');
        return redirect()->route('documentos.index');
    }
    //Remove the specified resource from storage.
    public function destroy(Request $request)
    {
        try{
            $documento = Documento::findOrFail($request->documentoEliminar);
            $ine = $documento->ine;
            $inicio_huerto = $documento->inicio_huerto;
            $certificado = $documento->certificado;
            if (isset($ine)) {
                if (Storage::disk('public')->exists($ine)) {
                    Storage::disk('public')->delete($ine);
                }
            }
            if (isset($inicio_huerto)) {
                if (Storage::disk('public')->exists($inicio_huerto)) {
                    Storage::disk('public')->delete($inicio_huerto);
                }
            }
            if (isset($certificado)) {
                if (Storage::disk('public')->exists($certificado)) {
                    Storage::disk('public')->delete($certificado);
                }
            }
            
            
            $documento->delete();

            activity()
                ->performedOn($documento)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $documento->attributesToArray()])
                ->log('Se elimino un pre registro');
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addSuccess('El registro se ha eliminado');
            return redirect()->route('documentos.index');

        } catch(QueryException $e) {
            if ($e->getCode() == '23000' && strpos($e->getMessage(), '1451') !== false) {
                preg_match("/`(.+?)`.`(.+?)`/", $e->getMessage(), $matches);
                $tableName = $matches[2] ?? 'la tabla';
                if($tableName === 'producers'){
                    $tableName = 'productores';
                }
                notyf()
                    ->position('y', 'top')
                    ->position('x', 'center')
                    ->duration(10000)
                    ->addError("Error: No se puede eliminar la documentación porque está relacionado con otros registros en $tableName.");
                return redirect()->route('documentos.index');
            } else {
                Log::error($e);
                notyf()
                    ->position('y', 'top')
                    ->position('x', 'center')
                    ->duration(10000)
                    ->addError('Error, intente nuevamente');
                return redirect()->route('documentos.index');
            }
        } catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('documentos.index');
        }
    }

    public function preregistro(){
        return view('documentos.preregistro');
    }

    public function preregistro_edit(Request $request){
        $identificador = $request->identificador;
        if($identificador){
            $documento = Documento::where('identificador','=',$identificador)->first();
            if($documento){
                if($documento->estatus == 'Aprobado'){
                    notyf()
                    ->position('y', 'top')
                    ->position('x', 'center')
                    ->duration(10000)
                    ->addError('No se puede editar la documentación que ya fue aprobada');
                return redirect()->route('documentos.preregistro');
                }
                return redirect()->route('documentos.edit', $documento);
            } else{
                notyf()
                    ->position('y', 'top')
                    ->position('x', 'center')
                    ->duration(10000)
                    ->addError('No se encontró un registro con el identificador ingresado');
                return redirect()->route('documentos.preregistro');
            }
        } else{
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Ingrese un identificador');
            return redirect()->route('documentos.preregistro');
        }
    }

    public function import(Request $request)
    {
        try {
            if ($request->hasfile('file')) {
                $extension = $request->file->getClientOriginalExtension();
                if ($extension == 'xlsx') {
                    $import = new DocumentosImport();
                    Excel::import($import, $request->file('file'));
                    notyf()
                        ->position('y', 'top')
                        ->addSuccess('registros importados correctamente');
                    return redirect()->back();
                } else {
                    notyf()
                        ->position('y', 'top')
                        ->addError('Error, verifique que el formato del archivo sea correcto (.xlsx)');
                    return redirect()->back();
                }
            } else {
                notyf()
                    ->position('y', 'top')
                    ->addError('Seleccione un archivo antes de importar');
                return redirect()->back();
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $error_message = '';
            foreach ($failures as $failure) {
                $error_message = $error_message."Hubo un error en la fila " . $failure->row() . ", columna " . $failure->attribute() . ". " . implode(", ", $failure->errors())."\n";
            }
            notyf()
                ->position('y', 'top')
                ->duration(0)
                ->ripple(false)
                ->dismissible(true)
                ->addError($error_message);
            return redirect()->back();
        }catch (NoTypeDetectedException $e) {
            notyf()
            ->position('y', 'top')
            ->addError('Seleccione un archivo antes de importar');
            return redirect()->back();
        } catch (Exception $e) {
            notyf()
                ->position('y', 'top')
                ->addError('Error, intente nuevamente');
            return redirect()->back();
        }
    }
}
