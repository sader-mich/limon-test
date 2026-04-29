@extends('layouts.app')

@section('content') 
<div class="card fondo-blanco">
    <div class="card-header">
            <h3 class="texto-guinda">Administrar Productores</h3><br>
    </div>
    <div class="card-body" >
        <div class="float-end">
            @hasrole('Administrador')
            <div class="col-md-auto" style="padding-left: 5px; padding-right: 0px; width:450px;">
                <form action="{{ route('producers.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="formFile" role="button">Elegir archivo</label>
                        <label for="formFile" class="form-control" id="formFile-label" role="button"
                            style="border-top-right-radius: .375rem;border-bottom-right-radius: .375rem;">Sin archivo seleccionado</label>
                        <input type="file" class="d-none" name="file" id="formFile" accept=".xlsx">
                        <button class="btn btn-primary" type="submit" title="Subir excel"><em
                            class="fa fa-upload"></em> Importar</button>
                    </div>
            </div>
                
            
            </form>
            @endhasrole
        </div>

        @can('crear_productor')
            <a href="{{ route('producers.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Nuevo</a>
        @endcan

        <button class="btn btn-primary" onclick="verProductor()"><i class="fa fa-eye"></i> Ver</button>

        @can('editar_productor')
            <button class="btn btn-primary" onclick="editarProductor()"><i class="fa fa-edit"></i> Editar</button>
        @endcan
        @can('eliminar_productor')
            <button class="btn btn-primary" onclick="eliminarProductor()"><i class="fa fa-trash"></i> Eliminar</button>
        @endcan
        @canany(['crear_registro', 'editar_registro', 'eliminar_registro', 'show'])
            <a href="{{ route('documentos.index') }}" class="btn btn-primary"><i class="fa fa-folder"></i> Documentos</a>
        @endcanany
        @canany(['crear_productor', 'show'])
            <a href="{{ route('descuentos.index') }}" class="btn btn-primary"><i class="fa fa-folder"></i> Descuentos</a>
        @endcanany

        <br><br><br>
        <table id="tableProducers" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-md-start" scope="col">NO</th>
                    <th class="text-md-start" scope="col">IDENTIFICADOR</th>
                    <th class="text-md-start" scope="col">PRODUCTOR</th>
                    <th class="text-md-start" scope="col">CURP</th>
                    <th class="text-md-start" scope="col">TELÉFONO</th>
                    <th class="text-md-start" scope="col">NOMBRE DEL HUERTO</th>
                    <th class="text-md-start" scope="col">MUNICIPIO</th>
                    <th class="text-md-start" scope="col">LOCALIDAD</th>
                    <th class="text-md-start" scope="col">ESPECIE</th>
                    <th class="text-md-start" scope="col">LATITUD</th>
                    <th class="text-md-start" scope="col">LONGITUD</th>
                    <th class="text-md-start" scope="col">TONELADAS</th>
                    <th class="text-md-start" scope="col">DESCUENTO</th>
                    <th class="text-md-start" scope="col">FECHA ALTA</th>
                    <th class="text-md-start" scope="col">NO HA</th>
                    <th class="text-md-start" scope="col">EDAD DE SIEMBRA</th>
                    <th class="text-md-start" scope="col">PROPIA/RENTADA</th>
                    <th class="text-md-start" scope="col">FECHA DE VENCIMIENTO</th>
                </tr>
                <tr>
                    <th data-dt-order="disable"></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar id"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar productor"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar huerto"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar municipio"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar localidad"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar especie"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar latitud"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar longitud"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar toneladas"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar descuento"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar fecha de alta"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar no. ha"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar edad de siembra"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar vencimiento"/></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($producers as $producer)
                <tr>
                    <th>{{ $producer->id }}</th>
                    <th>
                        <a class="col-form-label text-md-end text-start control-label" href="{{ asset('storage/' . $producer->urlcard) }}"
                            target="_blank" style="text-decoration: underline !important;color:#000000 !important">
                            {{ $producer->documento->identificador }}
                        </a>
                    </th>
                    <td>{{ $producer->documento->productor }}</td>
                    <td>{{ $producer->documento->CURP }}</td>
                    <td>{{ $producer->documento->lada }}{{ $producer->documento->telefono }}</td>
                    <td>{{ $producer->huerto }}</td>
                    <td>{{ $producer->municipio }}</td>
                    <td>{{ $producer->localidad}}</td>
                    <td>{{ $producer->especie }}</td>
                    <td>{{ $producer->latitud }}</td>
                    <td>{{ $producer->longitud }}</td>
                    <td>{{ $producer->toneladas }}</td>
                    <td>{{ $producer->descuento }}</td>
                    <td>{{ $producer->fecha_alta }}</td>
                    <td>{{ $producer->no_ha }}</td>
                    <td>{{ $producer->edad_siembra }}</td>
                    <td>{{ $producer->propia_renta }}</td>
                    <td>{{ $producer->vencimiento }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade show" id="eliminarProductor" tabindex="-1" role="dialog" aria-labelledby="eliminarProductor">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h2 class="texto-guinda modal-title" style="margin-bottom: 0 !important;">Eliminar productor</h2>
            </div>
            <div class="modal-body">
                <p class="texto-guinda">¿Desea eliminar a este productor?</p>
                <div class="modal-footer">
                    <form action="{{ route('producers.destroy', 4) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input hidden name="productorEliminar" id="productorEliminar" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Si</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var data;
    var productor;
    $(document).ready(function() {
        table = $('#tableProducers').DataTable({
            scrollX: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json',
            },
            dom: 'Bfrtip',  // Esta propiedad indica que los botones aparecerán en la parte superior de la tabla

            order: [[0, 'desc']],
            
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Exportar Excel',
                    className: 'btn btn-success btn-secondary btn-sm',
                    title: 'Lista de Productores',  // Título del archivo Excel
                    exportOptions: {
                        customizeData: function(data) {
                            data.headerStructure.pop();
                        },
                        columns: ':visible'  // Exporta solo las columnas visibles
                    }
                }
            ],
            columns: [{
                    visible: false
                }, null, null, null, null, null, null, null, null, null,null, null, null, null, null, null, null, null],
            columnDefs: [
                    { targets: '_all', className: 'dt-body-left' }
            ],
            
        });

        $('#tableProducers thead tr:eq(1) th').each(function(i) {
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        });

        $('#tableProducers tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                data = null;
                productor = null;
            } else {
                $('#tableProducers').DataTable().$('tr.selected').removeClass('selected');
                data = table.row(this).data();
                productor = data[0];
                $(this).addClass('selected');
            }
        });

        $('#formFile').change(function(e) {
                let fileName = (e.target.files.length > 0) ? e.target.files[0].name :
                    'No se eligió ningún archivo';
                $('#formFile-label').text(fileName);
        });
    });

    function verProductor() {
        if (productor != null) {
            window.location.href = "{{ route('producers.show', 'placeholder') }}".replace('placeholder', productor);
        }
    }

    function editarProductor() {
        if (productor != null) {
            window.location.href = "{{ route('producers.edit', 'placeholder') }}".replace('placeholder', productor);
        }
    }

    function eliminarProductor() {
        if (productor != null) {
            document.getElementById('productorEliminar').value = productor;
            $('#eliminarProductor').modal('show');
        }
    }
</script>
@endsection