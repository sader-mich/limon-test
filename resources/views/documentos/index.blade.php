@extends('layouts.app')

@section('content')

<div class="card fondo-blanco">
    <div class="card-header">
        <h3 class="texto-guinda">Gestión de pre-registro</h3><br>
    </div>
    <div class="card-body" >
        <div class="float-end">
            @can('crear_usuario')
                        <div class="col-md-auto" style="padding-left: 5px; padding-right: 0px; width:450px;">
                            <form action="{{ route('documentos.import') }}" method="POST" enctype="multipart/form-data">
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
                @endcan
        </div>

        @can('crear_registro')
            <a href="{{ route('documentos.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Nuevo</a>
        @endcan
        
        <button class="btn btn-primary" onclick="verDocumento()"><i class="fa fa-eye"></i> Ver</button>

        @can('editar_registro')
            <button class="btn btn-primary" onclick="editarDocumento()"><i class="fa fa-edit"></i> Editar</button>
        @endcan
        @can('eliminar_registro')
            <button class="btn btn-primary" onclick="eliminarDocumento()"><i class="fa fa-trash"></i> Eliminar</button>
        @endcan
        @canany(['crear_productor', 'editar_productor', 'eliminar_productor', 'show'])
            <a href="{{ route('producers.index') }}" class="btn btn-primary"><i class="fa fa-tractor"></i> Productores</a>
        @endcanany

        <br><br><br>
        <table id="tableDocumentos" class="table table-striped table-bordered text-md-start">
            <thead>
                <tr>
                    <th class="text-md-start" scope="col">NO</th>
                    <th class="text-md-start" scope="col">ID</th>
                    <th class="text-md-start" scope="col" style="width: 250px">PRODUCTOR</th>
                    <th class="text-md-start" scope="col">CURP</th>
                    <th class="text-md-start" scope="col">TELEFONO</th>
                    <th class="text-md-start" scope="col">INICIO DE HUERTO</th>
                    <th class="text-md-start" scope="col">CERTIFICADO DE ORIGEN Y MOVILIZACIÓN</th>
                    <th class="text-md-start" scope="col">ESTATUS</th>
                </tr>
                <tr>
                    <th data-dt-order="disable"></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Id"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Productor"  style="width: 250px"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Curp"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Teléfono"/></th>
                    <th class="text-md-start" data-dt-order="disable"></th>
                    <th class="text-md-start" data-dt-order="disable"></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Estatus"/></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $doc)
                <tr>
                    <th>{{ $doc->id }}</th>
                    <td>{{ $doc->identificador }}</td>
                    <td>{{ $doc->productor }}</td>
                    <td>{{ $doc->CURP }}</td>
                    <td>{{ $doc->lada }}{{ $doc->telefono }}</td>
                    <td>{{ $doc->inicio_huerto ? '✔' : '✘' }}</td>
                    <td>{{ $doc->certificado ? '✔' : '✘' }}</td>
                    <!--
                    <td>
                        <a class="col-form-label text-md-end text-start control-label" href=" asset('storage/' . $doc->certificado) }}"
                            target="_blank" style="text-decoration: underline !important;color:#4A001F !important">
                            Ver</a>
                    </td>
                    -->
                    <th>{{ $doc->estatus }}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade show" id="eliminarDocumento" tabindex="-1" role="dialog" aria-labelledby="eliminarDocumento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h2 class="texto-guinda modal-title" style="margin-bottom: 0 !important;">Eliminar documento</h2>
            </div>
            <div class="modal-body">
                <p class="texto-guinda">¿Desea eliminar este registro de los documentos?</p>
                <div class="modal-footer">
                    <form action="{{ route('documentos.destroy', 4) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input hidden name="documentoEliminar" id="documentoEliminar" value="">
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
    var documento;
    $(document).ready(function() {
        table = $('#tableDocumentos').DataTable({
            scrollX: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json',
            },
            order: [[0, 'desc']],
            columns: [{
                    visible: false
                }, null, null, null, null, null, null, null],
            "createdRow": function(row, data, index) {
                var estatus = data[8];
                if (estatus == 'Pendiente') {
                    $('th', row).eq(7).css({
                        'background-color': '#FFAC8B',
                        'background-image': 'linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0))'
                    });
                } else if (estatus == 'En revisión') {
                    $('th', row).eq(1).css({
                        'background-color': '#ffe180',
                        'background-image': 'linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0))'
                    });
                } else if (estatus == 'Aprobado') {
                    $('th', row).eq(7).css({
                        'background-color': '#ADEDD0',
                        'background-image': 'linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0))'
                    });
                }
            },
            columnDefs: [
                { targets: '_all', className: 'dt-body-left' }
            ]
        });

        $('#tableDocumentos thead tr:eq(1) th').each(function(i) {
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        });

        $('#tableDocumentos tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                data = null;
                documento = null;
            } else {
                $('#tableDocumentos').DataTable().$('tr.selected').removeClass('selected');
                data = table.row(this).data();
                documento = data[0];
                $(this).addClass('selected');
            }
        });

        $('#formFile').change(function(e) {
                let fileName = (e.target.files.length > 0) ? e.target.files[0].name :
                    'No se eligió ningún archivo';
                $('#formFile-label').text(fileName);
            });
    });

    function verDocumento() {
        if (documento != null) {
            window.location.href = "{{ route('documentos.show', 'placeholder') }}".replace('placeholder', documento);
        }
    }

    function editarDocumento() {
        if (documento != null) {
            window.location.href = "{{ route('documentos.edit', 'placeholder') }}".replace('placeholder', documento);
        }
    }

    function eliminarDocumento() {
        if (documento != null) {
            document.getElementById('documentoEliminar').value = documento;
            $('#eliminarDocumento').modal('show');
        }
    }
</script>
@endsection