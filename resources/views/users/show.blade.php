@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="texto-guinda">Información del usuario</h3>
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">&larr; Regresar</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Nombre: </strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="username" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Usuario: </strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $user->username }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Correo electrónico: </strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start" style="color: #4A001F;"><strong>Roles: </strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @forelse ($user->getRoleNames() as $role)
                                <span style="color: #4A001F; background-color: #FFC4D0; font-size: 14px; padding: 5px 10px;">{{ $role }}</span>
                            @empty
                            @endforelse
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>    
@endsection