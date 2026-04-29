@extends('layouts.app')

@section('content')
<div class="container fondo-blanco">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "><br>
                <h3 class="texto-guinda">¡Bienvenido(a), {{ Auth::guard('web')->user()->name }}!</h3>
                <p class="texto-guinda" style="padding-left: 4px;">¡Qué bueno verte de nuevo! Aquí tienes lo que puedes hacer a continuación.</p>
                <br>
                </div>

                <div class="card-body">

                    @canany(['crear_rol', 'editar_rol', 'eliminar_rol'])
                        <a class="btn btn-primary" href="{{ route('roles.index') }}">
                        <i class="fa fa-users-cog"></i>  Administrar roles</a>
                    @endcanany
                    @canany(['crear_usuario', 'editar_usuario', 'eliminar_usuario'])
                        <a class="btn btn-primary" href="{{ route('users.index') }}">
                        <i class="fa fa-users"></i> Administrar usuarios</a>
                    @endcanany
                    @canany(['crear_productor', 'editar_productor', 'eliminar_productor', 'show'])
                        <a class="btn btn-primary" href="{{ route('producers.index') }}">
                        <i class="fa fa-tractor"></i> Administrar productores</a>
                    @endcanany
                    @canany(['crear_registro', 'editar_registro', 'eliminar_registro', 'show'])
                        <a class="btn btn-primary" href="{{ route('documentos.index') }}">
                        <i class="fa fa-briefcase"></i> Gestión de pre-registro</a>
                    @endcanany
                    @canany(['trazabilidad'])
                        <a class="btn btn-primary" href="{{ route('producers.trace') }}"
                            style="display: inline-block; width: 200px;">
                        <i class="fa fa-store-alt"></i> Trazabilidad</a>
                    @endcanany
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection