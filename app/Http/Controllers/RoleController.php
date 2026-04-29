<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:crear_rol|editar_rol|eliminar_rol', ['only' => ['index','show']]);
        $this->middleware('permission:crear_rol', ['only' => ['create','store']]);
        $this->middleware('permission:editar_rol', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar_rol', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('roles.index', [
            'roles' => Role::orderBy('id','DESC')->paginate(10)
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('roles.create', [
            'permissions' => Permission::get()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        try{
            $role = Role::create(['name' => $request->name]);

            $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
            
            $role->syncPermissions($permissions);

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('roles.index');
        }   
        activity()
                ->performedOn($role)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $role->attributesToArray()])
                ->log('Se agrego un nuevo rol');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El rol se ha registrado');
        return redirect()->route('roles.index');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View
    {
        $rolePermissions = Permission::join("role_has_permissions","permission_id","=","id")
            ->where("role_id",$role->id)
            ->select('name')
            ->get();
        return view('roles.show', [
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        if($role->name=='Administrador'){
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_id",$role->id)
            ->pluck('permission_id')
            ->all();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        try{
            $input = $request->only('name');

            $role->update($input);

            $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

            $role->syncPermissions($permissions);    

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('roles.index');
        }   
        activity()
                ->performedOn($role)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $role->attributesToArray()])
                ->log('Se actualizo un rol');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El rol se ha actualizado');
        return redirect()->route('roles.index');
        
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        try{

            if($role->name=='Administrador'){
                abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
            }
            if(auth()->user()->hasRole($role->name)){
                abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
            }
            $role->delete();

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('roles.index');
        }   
        activity()
                ->performedOn($role)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $role->attributesToArray()])
                ->log('Se elimino un rol');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El rol de ha eliminado');
        return redirect()->route('roles.index');
    }
}
