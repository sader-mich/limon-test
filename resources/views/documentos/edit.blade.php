@extends('layouts.app')


@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                <div class="float-start"><br>
                    <div  style="padding-left: 20px;" >
                        <h3 class="texto-guinda">Editar pre-registro del productor</h3><br>
                    </div>
                </div>
                <div class="float-end"><br>
                    <div  style="padding-right: 50px;">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">&larr; Regresar</a><br>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('documentos.update', $documento->id) }}" id="editarDocumentoForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="float-start" >
                        <div style="padding-left: 20px;">
                            <h5 style="color: #4A001F;">Ingrese la información requerida</h5>
                            <p style="color: #4A001F;">*Formatos válidos para la documentación(.pdf, .png, .jpg, .jpeg)</p>  
                            <p style="color: #4A001F;">*Debes ingresar los siguientes campos: Productor(nombre completo), Teléfono y CURP.</p>                   
                        </div>
                    </div>
                    <br><br><br><br><br><br>
                    <div class="mb-3 row">
                        <div class="col-md-auto text-start" style="display: contents;">
                            <em class="fas fa-tractor texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                        </div>
                        <div class="col text-start" style="padding-right: 60px;">
                        <label for="productor" class="col-form-label text-md-end text-start control-label texto-guinda">
                            Productor:
                        </label>
                            <input type="text" class="form-control @error('productor') is-invalid @enderror" id="productor" name="productor"  placeholder="Nombre completo del productor"
                                onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"   value="{{ $documento->productor }}">
                                @if ($errors->has('productor'))
                                    <span class="text-danger">{{ $errors->first('productor') }}</span>
                                @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                    <label for="CURP" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        CURP:
                                    </label>
                                    <input type="text" class="form-control @error('CURP') is-invalid @enderror" id="CURP" name="CURP" 
                                        placeholder="CURP" value="{{ $documento->CURP }}" required>
                                        @if ($errors->has('CURP'))
                                            <span class="text-danger">{{ $errors->first('CURP') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-phone-alt texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                    <label for="telefono" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Teléfono:
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Lada</span>
                                        <div class="col col-md-3">
                                            <input style="border-radius: 0px;" type="tel" class="form-control @error('lada') is-invalid @enderror" id="lada" name="lada" placeholder="443" pattern="[0-9]{3}"  value="{{ $documento->lada }}" required>
                                                @if ($errors->has('lada'))
                                                    <span class="text-danger">{{ $errors->first('lada') }}</span>
                                                @endif
                                        </div>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeholder="1234567" pattern="[0-9]{7}"  value="{{ $documento->telefono }}" required>
                                            @if ($errors->has('telefono'))
                                                <span class="text-danger">{{ $errors->first('telefono') }}</span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- 
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-envelope texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                    <label for="correo" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Correo:
                                    </label>
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo"  
                                        placeholder="Correo electrónico" value="{{ $documento->correo }}" required>
                                        @if ($errors->has('correo'))
                                            <span class="text-danger">{{ $errors->first('correo') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                <label for="ine" class="col-form-label text-md-end text-start control-label texto-guinda">
                                    INE:
                                </label>
                                    <input type="file" class="form-control @error('ine') is-invalid @enderror" id="ine" name="ine" accept= ".pdf, .jpg, .png, .jpeg" required>
                                        @if ($errors->has('ine'))
                                            <span class="text-danger">{{ $errors->first('ine') }}</span>
                                        @endif
                                        @if($documento->ine != "")
                                        <label for="ine" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->ine) }}"
                                                target="_blank" style="text-decoration: underline !important;color:black !important">
                                            <strong>Ver archivo actual</strong></a>
                                        </label>
                                        @elseif($documento->ine == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>Actualmente no tiene este archivo</strong>
                                            </label>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                <label for="inicio_huerto" class="col-form-label text-md-end text-start control-label texto-guinda">
                                    Inicio de huerto:
                                </label>
                                    <input type="file" class="form-control @error('inicio_huerto') is-invalid @enderror" id="inicio_huerto" name="inicio_huerto" accept= ".pdf, .jpg, .png, .jpeg" required>
                                        @if ($errors->has('inicio_huerto'))
                                            <span class="text-danger">{{ $errors->first('inicio_huerto') }}</span>
                                        @endif
                                        @if($documento->inicio_huerto != "")
                                        <label for="inicio_huerto" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->inicio_huerto) }}"
                                                target="_blank" style="text-decoration: underline !important;color:black !important">
                                            <strong>Ver archivo actual</strong></a>
                                        </label>
                                        @elseif($documento->inivio_huerto == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>Actualmente no tiene este archivo</strong>
                                            </label>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-address-card texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 60px;">
                                <label for="certificado" class="col-form-label text-md-end text-start control-label texto-guinda">
                                    Certificado de origen y movilización:
                                </label>
                                    <input type="file" class="form-control @error('certificado') is-invalid @enderror" id="certificado" name="certificado" accept= ".pdf, .jpg, .png, .jpeg" required>
                                        @if ($errors->has('certificado'))
                                            <span class="text-danger">{{ $errors->first('certificado') }}</span>
                                        @endif
                                        @if($documento->certificado != "")
                                        <label for="certificado" class="col-form-label text-md-end text-start control-label">
                                            <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $documento->certificado) }}"
                                                target="_blank" style="text-decoration: underline !important;color:black !important">
                                            <strong>Ver archivo actual</strong></a>
                                        </label>
                                        @elseif($documento->certificado == "")
                                            <label for="ine" class="col-form-label text-md-end text-start control-label">
                                                <strong>Actualmente no tiene este archivo</strong>
                                            </label>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @can('crear_productor')
                        <div class="mb-3 row">
                            <div class="col-md-auto text-start" style="display: contents;">
                                <em class="fas fa-spinner texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                            </div>
                            <div class="col text-start" style="padding-right: 60px;">
                            <label for="estatus" class="col-form-label text-md-end text-start control-label texto-guinda">
                                Estatus:
                            </label><br>
                            <span>Si la documentación proporcionada es correcta, cambie el estatus a Aprobado para continuar con el proceso de registro del productor. </span>
                                <select class="form-control @error('estatus') is-invalid @enderror" id="estatus" name="estatus" required>
                                    <option value="Pendiente" {{ $documento->estatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="En revisión" {{ $documento->estatus == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                                    <option value="Aprobado" {{ $documento->estatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                </select>
                                @if ($errors->has('estatus'))
                                    <span class="text-danger">{{ $errors->first('estatus') }}</span>
                                @endif
                            </div>
                        </div>
 
                        <div class="mb-3 row">
                            <div class="col-md-auto text-start" style="display: contents;">
                                <em class="fas fa-comments texto-guinda" style="padding-top: 10px;padding-left: 30px;"></em>
                            </div>
                            <div class="col text-start" style="padding-right: 60px;">
                            <label for="observaciones" class="col-form-label text-md-end text-start control-label texto-guinda">
                                Observaciones:
                            </label><br>
                            <span>En este espacio se pueden incluir comentarios adicionales sobre la información y documentación proporcionada por el usuario. Estos detalles pueden ser útiles para proporcionar contexto adicional y facilitar el seguimiento del proceso.</span>
                                <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" 
                                    name="observaciones" style="height: 100px; resize: none;"
                                    required>{{ $documento->observaciones }}
                                </textarea>
                                @if ($errors->has('observaciones'))
                                    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                                @endif
                            </div>
                        </div>
                    @endcan
                    <br>

                    <div class="text-center">
                        <button title="Actualizar registro" class="btn btn-primary"><em class="fas fa-edit"></em> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDocumentoRequest', '#editarDocumentoForm') !!}
@endsection