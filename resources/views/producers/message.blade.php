@extends('layouts.app')

@section('content')

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body card text-center"><br>
                            <label class="text-center texto-guinda">
                                ¡Descuento exitoso! <br> <br>
                            </label> 
                            <div class="mb-3 row">
                                <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Productor:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->documento->producer }}" readonly disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Toneladas descontadas de hoy:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    <input type="text" class="form-control" id="productor" name="productor" value="{{ $ton }} t." readonly disabled>
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Total de toneladas descontadas:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->descuento }} t." readonly disabled>
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="productor" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Toneladas restantes:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    <input type="text" class="form-control" id="productor" name="productor" value="{{ $dif }} t." readonly disabled>
                                </div>
                            </div>

                            <br><br>

                            <div class="text-center">
                                <a href="{{ route('producers.trace') }}" class="btn btn-primary">Aceptar</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    
@endsection