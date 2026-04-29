@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header"> 
                <div class="float-start"><br>
                    <div  style="padding-left: 40px;" >
                        <h3 class="texto-guinda">Editar productor</h3><br>
                    </div>
                </div>
                <div class="float-end"><br>
                    <div  style="padding-right: 70px;">
                        <a href="{{ route('producers.index') }}" class="btn btn-secondary btn-sm">&larr; Regresar</a>
                    </div><br>
                </div>
            </div>
            <div class="card-body"> 
                <form action="{{ route('producers.update', $producer->id) }}" id="editarProducerForm" method="post">
                    @csrf
                    @method("PUT") 

                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-tractor texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="productor" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Productor:
                                    </label>
                                        <input type="text" class="form-control" id="productor" name="productor" value="{{ $producer->documento->productor }}" readonly disabled>
                                    @if ($errors->has('productor'))
                                        <span class="text-danger">{{ $errors->first('productor') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-route texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="municipio_id" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Municipio:
                                    </label>
                                        <select class="selectpicker form-control" data-live-search="true" data-size="5" data-none-results-text="No se encontraron resultados"
                                            id="municipio_id" name="municipio_id">
                                                <option data-content="<span class='texto-guinda'>{{ $producer->municipio }}</span>"
                                                    value="{{ $producer->municipio }}">{{ $producer->municipio }}
                                                </option>
                                            @foreach ($municipios as $municipio)
                                                <option data-content="<span class='texto-guinda'>{{ $municipio->descripcion }}</span>"
                                                    value="{{ $municipio->id }}">{{ $municipio->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('municipio_id'))
                                        <span class="text-danger">{{ $errors->first('municipio_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-route texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="localidad_id" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Localidad:
                                    </label>
                                        <select class="selectpicker form-control" data-live-search="true" data-size="5" data-none-results-text="No se encontraron resultados"
                                            id="localidad_id" name="localidad_id">
                                            <option data-content="<span class='texto-guinda'>{{ $producer->localidad }}</span>"
                                                value="{{ $producer->localidad }}">{{ $producer->localidad }}
                                            </option>
                                        </select>
                                    @if ($errors->has('localidad_id'))
                                        <span class="text-danger">{{ $errors->first('localidad_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-calendar texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="fecha_alta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Fecha de alta:
                                    </label>
                                    <input type="date" class="form-control @error('fecha_alta') is-invalid @enderror" id="fecha_alta" name="fecha_alta"  
                                        value="{{ $producer->fecha_alta}}" >
                                        @if ($errors->has('fecha_alta'))
                                            <span class="text-danger">{{ $errors->first('fecha_alta') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-tree texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="huerto" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Nombre del huerto:
                                    </label>
                                    <input type="text" class="form-control @error('huerto') is-invalid @enderror" id="huerto" name="huerto"   
                                        value="{{ $producer->huerto}}" >
                                        @if ($errors->has('huerto'))
                                            <span class="text-danger">{{ $errors->first('huerto') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-globe texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="latitud" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Latitud:
                                    </label>
                                <input type="number" step="0.0000000000001" class="form-control @error('latitud') is-invalid @enderror" id="latitud" name="latitud" value="{{ $producer->latitud }}">
                                    @if ($errors->has('latitud'))
                                        <span class="text-danger">{{ $errors->first('latitud') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-globe texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="longitud" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Longitud:
                                    </label>
                                <input type="number" step="0.0000000000001" class="form-control @error('longitud') is-invalid @enderror" id="longitud" name="longitud" value="{{ $producer->longitud }}">
                                    @if ($errors->has('longitud'))
                                        <span class="text-danger">{{ $errors->first('longitud') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-map texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="no_ha" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        No hectáreas:
                                    </label>
                                    <input type="number" class="form-control @error('no_ha') is-invalid @enderror" id="no_ha" name="no_ha"  
                                            step="0.001"  value="{{ $producer->no_ha}}" >
                                        @if ($errors->has('no_ha'))
                                            <span class="text-danger">{{ $errors->first('no_ha') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-calendar-week texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="edad_siembra" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Edad de siembra:
                                    </label>
                                    <input type="text" class="form-control @error('edad_siembra') is-invalid @enderror" id="edad_siembra" name="edad_siembra"  
                                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  
                                        value="{{ $producer->edad_siembra}}">
                                        @if ($errors->has('edad_siembra'))
                                            <span class="text-danger">{{ $errors->first('edad_siembra') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-lemon texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="especie" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Especie:
                                    </label>
                                    <input type="text" class="form-control @error('especie') is-invalid @enderror" id="especie" name="especie"  
                                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  
                                        value="{{ $producer->especie}}" placeholder="LIMÓN">
                                        @if ($errors->has('especie'))
                                            <span class="text-danger">{{ $errors->first('especie') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-weight-hanging texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="toneladas" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Toneladas (rendimiento):
                                    </label>
                                  <input type="number" class="form-control @error('toneladas') is-invalid @enderror" 
                                    id="toneladas" name="toneladas" value="{{ $producer->toneladas}}" placeholder="0" step="0.0001">
                                    @if ($errors->has('toneladas'))
                                        <span class="text-danger">{{ $errors->first('toneladas') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-briefcase texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 40px;">
                                    <label for="propia_renta" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Propia/Rentada:
                                    </label>
                                    <input type="text" class="form-control @error('propia_renta') is-invalid @enderror" id="propia_renta" name="propia_renta"  
                                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  
                                        value="{{ $producer->propia_renta}}" >
                                        @if ($errors->has('propia_renta'))
                                            <span class="text-danger">{{ $errors->first('propia_renta') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-briefcase texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="vencimiento" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Vencimiento:
                                    </label>
                                    <input type="text" class="form-control @error('vencimiento') is-invalid @enderror" id="vencimiento" name="vencimiento"  
                                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  
                                        value="{{ $producer->vencimiento}}" >
                                        @if ($errors->has('vencimiento'))
                                            <span class="text-danger">{{ $errors->first('vencimiento') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div><br>
                    @hasrole('Administrador')
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col-md-auto text-start" style="display: contents;">
                                    <em class="fas fa-weight-hanging texto-guinda" style="padding-top: 10px;padding-left: 50px;"></em>
                                </div>
                                <div class="col text-start" style="padding-right: 80px;">
                                    <label for="descuento" class="col-form-label text-md-end text-start control-label texto-guinda">
                                        Descuento:
                                    </label>
                                  <input type="number" class="form-control @error('descuento') is-invalid @enderror" 
                                    id="descuento" name="descuento" value="{{ $producer->descuento}}" placeholder="0" step="0.0001">
                                    @if ($errors->has('descuento'))
                                        <span class="text-danger">{{ $errors->first('descuento') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><br>
                    @endhasrole
                    
                    <div class="text-center">
                        <button title="Actualizar productor" class="btn btn-primary"><em class="fas fa-edit"></em> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
    {!! JsValidator::formRequest('App\Http\Requests\UpdateProducerRequest', '#editarProducerForm') !!}

    <script>
        $(document).ready(function() {
            let selectMunicipio = document.querySelector('#municipio_id');
    
            function handleMunicipiosChange(){
                let optionMunicipio = document.querySelector("#municipio_id").value;
                var localidades = {!! json_encode($localidads) !!};
                var municipios = {!! json_encode($municipios) !!};
                var municipio = '';
    
                for (var i = 0; i < municipios.length; i++) {
                    if (municipios[i]['id'] == optionMunicipio) {
                        municipio = municipios[i]['id'];
                        break;
                    }
                }
    
                $.ajax({
                    url: '/limon/localidades/'+municipio,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#localidad_id').empty();
                        $.each(data, function(key, value) {
                            $('#localidad_id').append(new Option(value, key));
                        });
                        $('#localidad_id').selectpicker('refresh');
                    }
                });
            }
            selectMunicipio.addEventListener('change', handleMunicipiosChange);
            handleMunicipiosChange.call(selectMunicipio);
        });
    </script>
@endsection