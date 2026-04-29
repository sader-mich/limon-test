<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producer;
use App\Models\Documento;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:crear_usuario|editar_usuario|eliminar_usuario', ['only' => ['index','show']]);
        $this->middleware('permission:crear_usuairo', ['only' => ['create','store']]);
        $this->middleware('permission:editar_usuario', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar_usuario', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try{
            $input = $request->all();
            $input['password'] = Hash::make($request->password);

            $user = User::create($input);
            $user->assignRole($request->roles);

        }catch(Exception $e){
            Log::error($e);

            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('users.index');
        }
        activity()
                ->performedOn($user)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $user->attributesToArray()])
                ->log('Se agrego un nuevo usuario');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El usuario ha sido registrado');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Administrador')){
            if($user->id != auth()->user()->id){
                abort(403, 'EL USUARIO NO TIENE LOS PERMISOS NECESARIOS');
            }
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try{
            $input = $request->all();

            if(!empty($request->password)){
                $input['password'] = Hash::make($request->password);
            }else{
                $input = $request->except('password');
            }
            
            $user->update($input);

            $user->syncRoles($request->roles);

        }catch(Exception $e){
            Log::error($e);

            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('users.index');
        }   
        activity()
                ->performedOn($user)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $user->attributesToArray()])
                ->log('Se actualizo un usuario');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El usuario ha sido actualizado');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try{
            // About if user is Super Admin or User ID belongs to Auth User
            if ($user->hasRole('Administrador') || $user->id == auth()->user()->id)
            {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }

            $user->syncRoles([]);
            $user->delete();
        }catch(Exception $e){
            Log::error($e);

            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('users.index');
        }  
        activity()
                ->performedOn($user)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $user->attributesToArray()])
                ->log('Se elimino un usuario');
        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El usuario ha sido eliminado');
        return redirect()->route('users.index');
    }

    public function profile(User $user): View
    {
        return view('users.profile', [
            'user' => $user
        ]);
    } 
    
}
