@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body card text-center"><br>
                    <label class="text-center texto-guinda">
                        Bienvenido/a al pre registro <br> <br>
                    </label>
                    <div class="row mb-3">
                        <div class="col text-start">
                        <label class="col-form-label text-start control-label">
                            Estimado/a usuario/a, si desea realizar el pre registro de una nueva cuenta
                            por favor seleccione la opción "Nuevo" y llene los campos.
                            En caso de tener una cuenta previamente registrada y desea
                            hacer cambios ingrese su ID y seleccione la opción "Editar".
                        </label>
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col">
                            <a href="{{ route('documentos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
                        </div>
                        <div class="col">
                            <form action="{{ route('documentos.preregistro_edit') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
                                    <input type="text" class="form-control" name="identificador" placeholder="Identificador">
                                </div>
                            </form>
                        </div>
                    </div> 
                    
                    <br><br>
                    @canany(['crear_registro', 'editar_registro', 'eliminar_registro'])
                        <a href="{{ route('documentos.index') }}" class="btn btn-primary"><i class="fa fa-folder"></i> Documentos</a>
                    @endcanany
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.img-fluid').attr('src', '/img/sader.png');
    });
</script>
@endsection