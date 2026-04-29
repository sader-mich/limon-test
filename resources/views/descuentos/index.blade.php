@extends('layouts.app')

@section('content') 

<div class="card fondo-blanco">
    <div class="card-header">
            <h3 class="texto-guinda">Descuentos</h3><br>
    </div>
    <div class="card-body" >
        
        
        <div class="float-end">
            <a href="{{ route('producers.index') }}" class="btn btn-secondary"></i>&larr; Regresar</a>
        </div>
        @hasrole('Administrador')
            <button class="btn btn-primary" onclick="eliminarDescuento()"><i class="fa fa-trash"></i> Eliminar</button>
        @endhasrole

        <br><br><br>
        <table id="tableDescuentos" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-md-start" scope="col">NO</th>
                    <th class="text-md-start" scope="col">PRODUCTOR</th>
                    <th class="text-md-start" scope="col">NOMBRE DEL HUERTO</th>
                    <th class="text-md-start" scope="col">TONELADAS MOVILIZADAS</th>
                    <th class="text-md-start" scope="col">FECHA</th>
                </tr>
                <tr>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar No"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Productor"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Nombre del huerto"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Toneladas"/></th>
                    <th class="text-md-start" data-dt-order="disable"><input type="text" placeholder="Buscar Fecha"/></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($descuentos as $des)
                <tr>
                    <th>{{ $des->id }}</th>
                    <td>{{ $des->producer->documento->productor }}</td>
                    <td>{{ $des->producer->huerto }}</td>
                    <td>{{ $des->toneladas }} t.</td>
                    <td>{{ ($des->created_at)->format('d/m/Y H:i') }}hrs.</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade show" id="eliminarDescuento" tabindex="-1" role="dialog" aria-labelledby="eliminarDescuento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h2 class="texto-guinda modal-title" style="margin-bottom: 0 !important;">Eliminar descuento</h2>
            </div>
            <div class="modal-body">
                <p class="texto-guinda">¿Desea eliminar este registro?</p>
                <div class="modal-footer">
                    <form action="{{ route('descuentos.destroy', 4) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input hidden name="descuentoEliminar" id="descuentoEliminar" value="">
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
    var descuento;
    $(document).ready(function() {
        table = $('#tableDescuentos').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json',
            },
            columns: [{
                    visible: false
                }, null, null, null, null],
                columnDefs: [
                    { targets: '_all', className: 'dt-body-left' }
                ]
        });

        $('#tableDescuentos thead tr:eq(1) th').each(function(i) {
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        });

        $('#tableDescuentos tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                data = null;
                descuento = null;
            } else {
                $('#tableDescuentos').DataTable().$('tr.selected').removeClass('selected');
                data = table.row(this).data();
                descuento = data[0];
                $(this).addClass('selected');
            }
        });
    });

    function eliminarDescuento() {
        if (descuento != null) {
            document.getElementById('descuentoEliminar').value = descuento;
            $('#eliminarDescuento').modal('show');
        }
    }

</script>
@endsection