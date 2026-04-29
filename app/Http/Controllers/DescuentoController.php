<?php


namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DescuentoController extends Controller
{
    //Display a listing of the resource.
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:crear_productor|editar_productor|eliminar_productor|show', ['only' => ['index','show']]);
        $this->middleware('permission:crear_productor', ['only' => ['create','store']]);
        $this->middleware('permission:editar_productor', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar_productor', ['only' => ['destroy']]);
    }

    public function index()
    {
        $descuentos = Descuento::latest()->get();

        return view('descuentos.index', [
            'descuentos' => $descuentos
        ]);
    }

    public function create(): View
    {
        //
    }
    public function store(request $request): RedirectResponse
    {
        //
    }
    public function show(Descuento $descuento): View
    {
        //
    }
    //Show the form for editing the specified resource.
    public function edit(Descuento $descuento): View
    {
        //
    }
    //Update the specified resource in storage.
    public function update(Descuento $descuento): RedirectResponse
    {
        //

    }
    //Remove the specified resource from storage.
    public function destroy(Request $request)
    {
        try{
            $descuento = Descuento::findOrFail($request->descuentoEliminar);
            $descuento->delete();

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('descuentos.index');
        }
        notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addSuccess('El descuento se ha eliminado');
        return redirect()->route('descuentos.index');
    }
    
}
