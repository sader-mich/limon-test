@extends('layouts.app')

@section('content')
<div class="card fondo-blanco">
<div class="card-header">
            <h3 class="texto-guinda">Administrar Roles</h3><br>
    </div>
    <div class="card-body">
        @can('crear_rol')
            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Nuevo</a>
        @endcan
        <br><br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">NOMBRE</th>
                <th scope="col" style="width: 280px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Ver </a>

                            @if ($role->name!='Administrador')
                                @can('editar_rol')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> Editar </a>   
                                @endcan 

                                @can('eliminar_rol')
                                    @if ($role->name!=Auth::user()->hasRole($role->name))
                                        <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('¿Quiere eliminar el rol?');"><i class="fa fa-trash"></i> Eliminar </button>
                                    @endif
                                @endcan
                            @endif

                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>No Role Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $roles->links() }}

    </div>
</div>
@endsection