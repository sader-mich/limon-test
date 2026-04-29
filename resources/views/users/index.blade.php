@extends('layouts.app')

@section('content')

<div class="card fondo-blanco">
    <div class="card-header">
        <h3 class="texto-guinda">Administrar Usuarios</h3><br>
    </div>
    <div class="card-body">
        @can('crear_usuario')
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Nuevo</a>
        @endcan
        <br><br>
        <table id="tableUsuarios" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">NO.</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">USUARIO</th>
                <th scope="col">CORREO</th>
                <th scope="col">ROLES</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @forelse ($user->getRoleNames() as $role)
                            <span style="color: #911A3A; background-color: #c2ab8d; font-size: 14px; padding: 5px 10px; border-radius: 10%;">{{ $role }}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Ver </a>

                            @if (in_array('Administrador', $user->getRoleNames()->toArray() ?? []) )
                                @if (Auth::user()->hasRole('Administrador'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> Editar </a>
                                @endif
                            @else
                                @can('editar_usuario')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> Editar </a>   
                                @endcan

                                @can('eliminar_usuario')
                                    @if (Auth::user()->id!=$user->id)
                                        <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('¿Quieres eliminar a este usuario?');"><i class="fa fa-trash"></i> Eliminar </button>
                                    @endif
                                @endcan
                            @endif

                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="5">
                        <span class="text-danger">
                            <strong>No User Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
<script>
    var usuario;
    var data;
    $(document).ready(function() {
        table = $('#tableUsuarios').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json',
            }
        });
    });

</script>
@endsection