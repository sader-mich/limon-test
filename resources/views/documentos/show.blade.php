@extends('layouts.app')
@section('content')

    <div class="container" >
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body card text-center">
                    <div style="height: 30px"></div>
                        <h3 class="texto-guinda">Registro del productor</h3>
                        <div style="height: 20px"></div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-id-card texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="identificador" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Identificador:</strong>
                                        </label><br>
                                        <label for="identificador" class="col-form-label text-md-end text-start control-label">
                                            {{ $documento->identificador }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                <div class="row mb-3">
                                    <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-tractor texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="productor" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Productor:</strong>
                                        </label><br>
                                        <label for="productor" class="col-form-label  text-start control-label">
                                            {{ $documento->productor }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                                <em class="fas fa-book texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                            </div>
                                            <div class="col text-start">
                                            <label for="CURP" class="col-form-label text-md-end text-start control-label texto-guinda">
                                                <strong>CURP:</strong>
                                            </label><br>
                                            <label for="CURP" class="col-form-label text-md-end text-start control-label">
                                                {{ $documento->CURP }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                                <em class="fas fa-envelope texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                            </div>
                                            <div class="col text-start">
                                            <label for="correo" class="col-form-label text-md-end text-start control-label texto-guinda">
                                                <strong>Correo:</strong>
                                            </label><br>
                                            <label for="correo" class="col-form-label text-md-end text-start control-label">
                                                {{ $documento->correo }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-phone-alt texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="telefono" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Teléfono:</strong>
                                        </label><br>
                                        <label for="telefono" class="col-form-label text-md-end text-start control-label">
                                            {{ $documento->lada }}{{ $documento->telefono }}
                                        </label>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-calendar texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="fecha" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Fecha de registro:</strong>
                                        </label><br>
                                        <label for="fecha" class="col-form-label text-md-end text-start control-label">
                                        {{ ($documento->created_at)->format('d/m/Y') }}
                                        </label>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-spinner texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="estatus" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Estatus:</strong>
                                        </label><br>
                                        <label for="estatus" class="col-form-label text-md-end text-start control-label">
                                            {{ $documento->estatus }}
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-comments texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="observaciones" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Observaciones:</strong>
                                        </label><br>
                                        <label for="observaciones" class="col-form-label  text-start control-label">
                                            {{ $documento->observaciones }}
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
                                            <em class="fas fa-file-invoice texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="ine" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>INE:</strong>
                                        </label><br><br>
                                        @if($documento->ine != "")
                                        <label for="ine" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->ine) }}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        @elseif($documento->ine == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>No disponible</strong>
                                            </label>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-file-invoice texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="inicio_huerto" class="col-form-label text-md-end text-start control-label texto-guinda">
                                            <strong>Inicio de huerto:</strong>
                                        </label><br><br>
                                        @if($documento->inicio_huerto != "")
                                        <label for="inicio_huerto" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->inicio_huerto) }}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        @elseif($documento->ine == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>No disponible</strong>
                                            </label>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col-md-auto text-start" style="display: contents;">
                                            <em class="fas fa-file-invoice texto-guinda" style="padding-top: 10px;padding-left: 70px;"></em>
                                        </div>
                                        <div class="col text-start">
                                        <label for="certificado" class="col-form-label text-start control-label texto-guinda">
                                            <strong>Certificado de origen y movilización:</strong>
                                        </label><br>
                                        @if($documento->certificado != "")
                                        <label for="ine" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->certificado) }}"
                                                target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                                                <strong>Ver archivo</strong>
                                            </a>
                                        </label>
                                        @elseif($documento->ine == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>No disponible</strong>
                                            </label>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 20px"></div>
                    </div>
                </div>
                <div class="float-end" style="padding-top: 15px">
                    <a href="{{ route('documentos.index') }}" class="btn btn-primary">&larr; Regresar</a>
                </div>
            </div>
            <div style="height: 60px"></div>
        </div>
    </div>
@endsection

