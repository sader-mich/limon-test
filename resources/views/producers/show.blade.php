@extends('layouts.app')
@section('content')

    <div class="container" >
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body card text-center">
                    <div style="height: 30px"></div>
                        <h3 class="texto-guinda">Información del productor</h3>
                        <div style="height: 20px"></div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-tractor texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="productor" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Productor:</strong>
                                        </label><br>
                                        <label for="productor" class="col-form-label  text-start control-label">
                                            {{ $producer->documento->productor }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-route texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="municipio" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Municipio:</strong>
                                        </label><br>
                                        <label for="municipio" class="col-form-label text-start control-label">
                                            {{ $producer->municipio }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-route texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="localidad" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Localidad:</strong>
                                        </label><br>
                                        <label for="localidad" class="col-form-label text-start control-label">
                                            {{ $producer->localidad }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-tree texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="huerto" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Nombre del huerto:</strong>
                                        </label><br>
                                        <label for="huerto" class="col-form-label text-md-end text-start control-label">
                                        {{ $producer->huerto }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-globe texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="latitud" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Latitud:</strong>
                                        </label><br>
                                        <label for="latitud" class="col-form-label text-md-end text-start control-label">
                                        {{ $producer->latitud }}
                                        </label>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-globe texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="longitud" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Longitud:</strong>
                                        </label><br>
                                        <label for="longitud" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->longitud }}
                                        </label>
                                        </div>
                                    </div>
                                </div>        
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-calendar texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="fecha_alta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Fecha de alta:</strong>
                                        </label><br>
                                        <label for="fecha_alta" class="col-form-label text-start control-label">
                                            {{ $producer->fecha_alta }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-map texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="no_ha" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>No. hectáreas:</strong>
                                        </label><br>
                                        <label for="no_ha" class="col-form-label text-md-end text-start control-label">
                                        {{ $producer->no_ha }}
                                        </label>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-calendar-week texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="edad_siembra" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Edad de siembra:</strong>
                                        </label><br>
                                        <label for="edad_siembra" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->edad_siembra }}
                                        </label>
                                        </div>
                                    </div>
                                </div>        
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-lemon texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="especie" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Especie:</strong>
                                        </label><br>
                                        <label for="especie" class="col-form-label text-start control-label">
                                            {{ $producer->especie }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-weight-hanging texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="toneladas" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Toneladas:</strong>
                                        </label><br>
                                        <label for="toneladas" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->toneladas }} t.
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-weight-hanging texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="descuento" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Descuento:</strong>
                                        </label><br>
                                        <label for="descuento" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->descuento }} t.
                                        </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-briefcase texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="propia_renta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Propia/Rentada:</strong>
                                        </label><br>
                                        <label for="propia_renta" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->propia_renta }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-briefcase texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="vencimiento" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Vencimiento:</strong>
                                        </label><br>
                                        <label for="vencimiento" class="col-form-label text-md-end text-start control-label">
                                            {{ $producer->vencimiento }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                            <div style="height: 30px"></div>

                            <h4 class="texto-guinda">Documentación</h4>
                            <div style="height: 20px"></div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-qrcode texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="qr" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Código qr:</strong>
                                        </label><br>
                                        <label for="qr" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $producer->urlqr) }}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="tarjeta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Tarjeta (frente):</strong>
                                        </label><br>
                                        <label for="tarjeta" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $producer->urlcard) }}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="tarjeta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Tarjeta (reverso):</strong>
                                        </label><br>
                                        <label for="tarjeta" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ url('img/reverso_tarjeta.png')}}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 20px"></div>
                    </div>
                </div>
                <div class="float-end" style="padding-top: 15px">
                    <a href="{{ route('producers.index') }}" class="btn btn-primary">&larr; Regresar</a>
                </div>
            </div>
            <div style="height: 60px"></div>
        </div>
    </div>
@endsection

