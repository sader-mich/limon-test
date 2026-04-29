@extends('layouts.app')

@section('content')

<div class="card fondo-blanco">
    <div class="card-header">
        <div class="float-start"><br>
            <div  style="padding-left: 20px;" >
                <h3 class="texto-guinda">Historial</h3><br>
            </div>
        </div>
        <div class="float-end"><br>
            <div  style="padding-right: 50px;">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">&larr; Regresar</a><br>
            </div>
        </div>
    </div>
    <div class="card-body" >

        <br>
        <table id="tableLog" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-md-start" scope="col" style="width: 5%">Id</th>
                    <th scope="col" style="width: 15%">Descripción</th>
                    <th scope="col" style="width: 45%">Valores</th>
                    <th scope="col">Modelo - Id</th>
                    <th scope="col">Usuario</th>
                    <th class="text-md-start" scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historial as $h)
                    <tr>
                        <td class="text-md-start">{{ $h->id }}</td>
                        <td>{{ $h->description }}</td>
                        <td>{{ $h->properties }}</td>
                        <td>{{ $h->subject_type }} - {{ $h->subject_id }}</td>
                        <td>{{ $h->causer_id }}</td>
                        <td class="text-md-start">{{ $h->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#tableLog').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json',
                },
                order: [
                    [0, 'desc']
                ],
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
                ],                dom: 'Bfrtip',
                columnDefs: [
                    { targets: '_all', className: 'dt-body-left' }
                ]
            });
        });

        $('#tableLog thead tr:eq(1) th').each(function(i) {
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        });
    </script>
@endsection
