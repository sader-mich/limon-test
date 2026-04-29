

@extends('layouts.app')

@section('content')

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body card text-center"><br>
                            <label class="text-center texto-guinda">
                                ¡Registro Exitoso! <br> <br>
                            </label>
                            <div class="row mb-3">
                                <div class="col text-start">
                                <label class="col-form-label text-start control-label">
                                    Estimado/a <strong>{{ $registro->productor }}</strong><br><br>
                                    Nos complace informarle que su registro ha sido creado exitosamente. <br> 
                                    Su ID de registro es: <strong>{{ $registro->identificador }}</strong> <br><br>
                                    Es muy importante que guarde este ID en un lugar seguro. Este ID es único y será necesario en caso de que necesite editar o actualizar su información en el futuro.
                                </label>
                                </div>
                            </div>

                            <br><br>

                            <div class="row">
                                <a href="{{ route('documentos.preregistro') }}" class="btn btn-primary">Aceptar</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    
@endsection