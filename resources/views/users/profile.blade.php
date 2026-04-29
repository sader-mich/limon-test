@extends('layouts.app')
@section('content')

    <div class="container" >
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body card text-center">
                    <div style="height: 30px"></div>
                        <h3 class="texto-guinda">Información de perfil</h3>
                        <div style="height: 80px"></div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-4">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-user texto-guinda" style="padding-top: 10px;padding-left: 100px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="nombre" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Nombre:</strong>
                                        </label><br>
                                        <label for="nombre" class="col-form-label  text-start control-label">
                                            {{ Auth::user()->name }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-4">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-envelope texto-guinda" style="padding-top: 10px;padding-left: 60px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="correo" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Correo electrónico:</strong>
                                        </label><br>
                                        <label for="correo" class="col-form-label text-md-end text-start control-label">
                                            {{ Auth::user()->email }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-4">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                                <em class="fas fa-id-card texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="correo" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Usuario:</strong>
                                        </label><br>
                                        <label for="correo" class="col-form-label text-md-end text-start control-label">
                                            {{ Auth::user()->username }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-4">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-briefcase texto-guinda" style="padding-top: 10px;padding-left: 20px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="rol" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Rol:</strong>
                                        </label><br>
                                        <label for="rol" class="col-form-label text-start control-label">
                                            @forelse (Auth::user()->getRoleNames() as $role)
                                                {{ $role }}
                                            @empty
                                            @endforelse
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 20px"></div>
                    </div>
                </div>
                <div class="float-end" style="padding-top: 15px">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">&larr; Regresar</a>
                </div>
            </div>
            <div style="height: 60px"></div>
        </div>
    </div>
@endsection

