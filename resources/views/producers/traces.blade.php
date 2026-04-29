
@extends('layouts.app')

@section('content') 

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card fondo-blanco">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="texto-guinda">Trazabilidad</h3>
                </div>
                <div class="float-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">&larr; Regresar</a>
                </div>
            </div>
            <div class="card-body">

                    <form action="{{ route('producers.deliver', $producer->id) }}" id="traceForm" method="post">
                        @csrf
                        @method("PUT")

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Productor:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->documento->productor }}" readonly disabled>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Municipio:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->municipio }}" readonly disabled>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Localidad:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->localidad }}" readonly disabled>
                            </div> 
                        </div>

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Toneladas (producción):</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->toneladas }} t." readonly disabled>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Toneladas descontadas:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->descuento }} t." readonly disabled>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Toneladas restantes:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->toneladas - $producer->descuento }} t." readonly disabled>
                            </div>
                        </div><br>

                        <div class="mb-3 row">
                            <label for="ton" class="col-md-4 col-form-label text-md-end text-start control-label" style="color: #4A001F;"><strong>Toneladas a descontar: </strong> </label>
                            <div class="col-md-6">
                            <input type="number" step="0.0000000001" class="form-control @error('ton') is-invalid @enderror" id="ton" name="ton" 
                                value="{{ old('ton') }}" placeholder="0.0" >
                                @if ($errors->has('ton'))
                                    <span class="text-danger">{{ $errors->first('ton') }}</span>
                                @endif
                            </div>
                        </div><br><br>
                        
                        
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmTrace">
                                <em class="fas fa-save"></em> Guardar
                            </button>
                        </div>
                    </form>        
        
            </div>
            
        </div>
    </div>    
</div>

<div class="modal fade show" id="confirmTrace" tabindex="-1" role="dialog" aria-labelledby="confirmTrace">
    <div class="modal-dialog" role="trace">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="texto-guinda modal-title" style="margin-bottom: 0 !important;">Confirmar descuento de toneladas</h4>
            </div>
            <div class="modal-body">
                <p class="texto-guinda">¿Está seguro de que desea guardar los cambios?</p>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" id="confirmSave">Si</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmSave').addEventListener('click', function() {
        document.getElementById('traceForm').submit();
    });
</script>
{!! JsValidator::formRequest('App\Http\Requests\TraceRequest', '#traceForm') !!}
    
@endsection