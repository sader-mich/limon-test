@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="texto-guinda">Información del rol</h3>
                </div>
                <div class="float-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">&larr; Regresar</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Nombre:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Permisos:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if ($role->name=='Administrador')
                                <span style="color: #4A001F; background-color: #FFC4D0; font-size: 14px; padding: 5px 10px;" >Todos</span>
                            @else
                                @forelse ($rolePermissions as $permission)
                                    <span style="color: #4A001F; background-color: #FFC4D0; font-size: 14px; padding: 5px 10px;" >{{ $permission->name }}</span>
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>    
@endsection